<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /*
     * index function acts according to the url
     *
     * User/  or
     * User/Agent or
     * User/Admin
     *
     * */
    public function index(Request $request, $role = null)
    {
        $roles = Role::all();

        $users = $role
            ? User::role($role)->paginate(10)
            : User::with(['roles','tickets'])->paginate(10);

        return view('users.index', compact('users', 'roles' ));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {

        $message = '';

        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
        ]);

        if($request->roles){

            $user->assignRole($request->roles);

            $message = ' with role ';

            $count = count($request->roles)-1 ;

            foreach ($request->roles as $key=>$role){

                if($key != $count)  $message .= $role.' and ' ;

                else $message .= $role.' .' ;
            }
        }

        session()->flash('status', 'User created successfully'.$message);

        return redirect()->route('users.index');

    }

    public function edit(User $user)
    {
        $roles_of_user = $user->getRoleNames()->toArray();

        $roles = Role::all();

        return view('users.edit', compact('user','roles_of_user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $message = '';

        $user->update([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
        ]);

        if($request->roles){

            $user->syncRoles($request->roles);

            $message = ' with role ';

            $count = count($request->roles)-1 ;

            foreach ($request->roles as $key=>$role){

                if($key != $count)  $message .= $role.' and ' ;

                else $message .= $role.' .' ;
            }
        }

        session()->flash('status', '#'.$user->id.' '.$user->name.' updated successfully'.$message);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        session()->flash('status', '#'.$user->id.' '.$user->name.'`s account deleted successfully' );

        $user->delete();

        return redirect()->route('users.index');
    }
}
