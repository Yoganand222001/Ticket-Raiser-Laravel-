<?php

namespace App\Http\Controllers;

use App\Mail\TicketRaised;
use App\Models\Category;
use App\Models\CategoryTicket;
use App\Models\Label;
use App\Models\LabelTicket;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\User;
use App\Traits\GetTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class TicketController extends Controller
{
    use GetTickets;
    public function __construct()
    {
        $this->middleware('role:Agent|Admin')->only(['edit', 'update']);
        $this->middleware('role:Admin')->only('destroy');
    }

    public function index(Request $request, $filters = null)
    {

        if($request->ajax()){

            $filters = json_decode($filters);

            if ($filters->status && $filters->priority) {

                $tickets = $this->getTickets($filters->status, $filters->priority, $filters->categories ?? []);
                return [
                    'view' => view('layouts.tickets-layout', compact('tickets'))->render(),
                    'status' => 200,
                ];
            }
            else
            {
                return [
                    'status' => 204,
                    'error' => 'The priority or status filter dropdowns should not be empty for filtration',
                ];
            }
        }

        $categories = DB::table('categories')->select(['category', 'id'])->get();
        return view('tickets.index', compact( 'categories'));

    }

    public function create()
    {
        $categories = Category::all();

        $labels = Label::all();

        return view('tickets.create', compact('categories', 'labels'));
    }

    public function store(StoreTicketRequest $request)
    {
         $ticket = Ticket::create([
             'user_id' => auth()->id(),
             'title' => $request->title,
             'description' => $request->description,
             'priority' => $request->priority
          ]);

         if($request->has('user_files') && $request->user_files != []){

             foreach ($request->user_files as $file){
                 $file->StoreAs('/tickets/_'.$ticket->id, $file->getClientOriginalName());
             }

             $ticket->has_files = 'yes' ;

             $ticket->save();
         }

         foreach ($request->categories as $category_id){
             CategoryTicket::create([
                 'ticket_id' => $ticket->id,
                 'category_id' => $category_id
             ]);
         }

        foreach ($request->labels as $label_id){
            LabelTicket::create([
                'ticket_id' => $ticket->id,
                'label_id' => $label_id
            ]);
        }

        $admins = User::role('Admin')->get();

        foreach ($admins as $admin){
            Mail::to($admin->email)
                ->queue(new TicketRaised(auth()->user()->name, route('ticket.edit', $ticket->id)));
        }

        return redirect()->route('tickets.index');
    }

    public function show($id)
    {
        $ticket = Ticket::where('id',$id)->with([ 'categories', 'labels'])->first();

        return view('tickets.show',compact('ticket'));
    }

    public function edit($id)
    {

        $ticket = Ticket::where('id',$id)->first();

        $categories = Category::all() ;

        $labels = Label::all();

        $agents = User::role('Agent')->get();

        foreach ($ticket->categories as $key => $category) {
            $categories_of_the_ticket[$key] = $category->category;
        }

        foreach ($ticket->labels as $key => $label) {
            $labels_of_the_ticket[$key] = $label->label;
        }

        return view('tickets.edit', compact('ticket', 'labels', 'categories', 'categories_of_the_ticket', 'labels_of_the_ticket',  'agents'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {

        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        if ($request->agent) {
            $ticket->agent_id = $request->agent;
            $ticket->save();
        }

        $ticket->categories()->sync($request->categories);

        $ticket->labels()->sync($request->labels);

        return redirect()->route('ticket.show', $ticket->id);

    }

    /*
     * download() function downloads the files uploaded by the user as a zip file.
     */
     public function download($id){

        $ticket = Ticket::find($id);

         $files = Storage::files('/tickets/_'.$ticket->id);

         $zip = new ZipArchive();

         $filename =  $ticket->user->name.'_files.zip';

         if ($zip->open($filename,  ZipArchive::CREATE) === TRUE)
         {
             foreach ($files as $file) {
                 $zip->addFile(storage_path('app/'.$file), basename($file));
             }

             $zip->close();
         }

         return response()->download(public_path($filename));
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index');
    }

}
