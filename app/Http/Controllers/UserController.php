<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list()
    {
        $Users = User::orderBy('id', 'desc')->paginate(20);
        return view('Admin.User.list', compact('Users'));
    }
    public function delete(Request $req)
    {
        $User = User::find($req->deleteId);
        $User->delete();
        return redirect('/admin/users/')->with(['msg-success' => 'User has been deleted']);
    }
    public function view(Request $req)
    {
        $User_id = $req->query('user');
        $roles = Role::get();

        if ($User_id) {
            $user = User::find($User_id);
            return view('Admin.User.form', compact('roles', 'user'));
        }
        return view('Admin.User.form', compact('roles'));
    }
    public function add(Request $req)
    {
        $req->validate([
            'role' => 'required|not_in:0',
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required|same:confirmPassword',
            'confirmPassword' => 'required',
        ]);
        $User = new User();
        $User->first_name = $req->firstname;
        $User->last_name = $req->lastname;
        $User->user_name = $req->username;
        $User->email = $req->email;
        $User->phone = $req->phone;
        $User->role_id = $req->role;
        $User->password = Hash::make($req->password);
        $User->save();
        return redirect('/admin/users')->with(['msg-success' => "User has been added"]);
    }
    function update(Request $req)
    {
        $req->validate([
            'role' => 'required|not_in:0',
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'same:confirmPassword',
            'confirmPassword' => '',
        ]);
        $User =  User::find($req->user_id);
        $User->first_name = $req->firstname;
        $User->last_name = $req->lastname;
        $User->user_name = $req->username;
        $User->email = $req->email;
        $User->phone = $req->phone;
        $User->role_id = $req->role;
        if ($req->password) {
            $User->password = Hash::make($req->password);
        }

        $User->update();
        return redirect('/admin/users')->with(['msg-success' => "User has been added"]);
    }
}
