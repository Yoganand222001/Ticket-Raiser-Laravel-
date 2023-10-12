<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorelabelRequest;
use App\Http\Requests\UpdatelabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LabelController extends Controller
{
    public function index()
    {
        $labels = label::all();

        return view('labels', compact('labels'));
    }

    public function store(StoreLabelRequest $request)
    {
        label::create([
            'label' => $request->validated('label-name')
        ]);

        session()->flash('work_done' , 'label created successfully');

        return redirect()->route('labels');
    }

    public function update(UpdateLabelRequest $request)
    {
        label::where('id', $request->validated('label'))
            ->update([
                'label' => $request->validated('label-rename')
            ]);

        session()->flash('work_done' , 'label updated successfully');

        return redirect()->route('labels');
    }

    public function destroy(Request $request)
    {
        if (!$request->delete_label)
            throw ValidationException::withMessages([
                'delete_label' => 'Must select one label to delete'
            ]);

        label::where('id', $request->delete_label)
            ->delete();

        session()->flash('work_done' , 'label deleted successfully');

        return redirect()->route('labels');
    }
}
