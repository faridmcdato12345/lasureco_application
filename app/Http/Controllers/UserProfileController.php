<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = Auth::user();
        $role = DB::table('roles')->where('id',Auth::user()->role_id)->value('name');
        return view('user.change_pass',compact('users','role'));
    }
    public function changePass(Request $request)
    {
        $request->validate([
            'old' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'new_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();
        return redirect('/login');
    }
}
