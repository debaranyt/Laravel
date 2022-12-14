<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller{
    public function index(){
        // Using Laravel query builder
        // $users = DB::table('users')->get();

        //Using Eloquent
        $users = User::all();
        return view('users.index', compact('users'));
        
        // another ways
        // return view('users')->with('users', $users)
        //                     ->with('neas', $neas);
        // return view('users')->with(['users' => $users, 'neas' => $neas]);
        // return view('users', ['users' => $users, 'neas' => $neas]);
    }
     
    public function detail(User $user){
        //Another way
        // $user = User::findOrFail($id);
        // return view('users.show', compact('user'));

        //Another way
        // $user = User::find($id);
        // if($user == null){
            //     return response()->view('404', [], 404);
            // }
            // return view('users.show', compact('user'));
        
        return view('users.show', compact('user'));
    }
    
    public function create(){
       return  view('users.create');
    }

    public function new(){
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required','email', 'unique:users,email'],
            'password' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'password.required' => 'El campo password es obligatorio',
        ]);
        
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        return redirect()->route('users');
        // Another way
        // $data2 = request()->all();
        // if (empty($data['name'])) {
        //     return redirect()->route('users.create')->withErrors([
        //         'name' => 'El campo es obligatorio'
        //     ]);
        // }
    }

    public function edit(User $user){
        // $data = request()->validate([
        //     'name' => 'required',
        //     'email' => ['required','email', 'unique:users,email'],
        //     'password' => 'required',
        // ], [
        //     'name.required' => 'El campo nombre es obligatorio',
        //     'email.required' => 'El campo email es obligatorio',
        //     'password.required' => 'El campo password es obligatorio',
        // ]);
        
        // User::update([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password'])
        // ]);
        // return redirect()->route('users');
        return view('users.edit', compact('user'));
    }
}
 