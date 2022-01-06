<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['username', 'email', 'password_hash'];


    public function signin($request)
    {
        try {
            Users::where('username', $request['username'])->first()->username;
            Hash::check($request['password'], Users::where('username', $request['username'])->first()->password_hash);
            session()->put('success_signin', 'You are successfully logged in');
            session()->put('auth', 1);
            session()->put('username', Users::where('username', $request['username'])->first()->username);
            return redirect('/');
        } catch (\Exception $exception) {
            session()->put('error_sign', 'Username or password entered incorrectly. Perhaps you haven\'t registered yet?');
            return view('home.login');
        }
    }

    public function signup($request)
    {
        try {
            $request['password_hash'] = Hash::make($request['password_hash']);
            Users::create($request);
            $username = Users::getOne('username', $request['username']);
            session()->put('auth', 1);
            session()->put('username', $username->username);
            session()->put('success_create_user', 'You have successfully registered!');
            return view('ajaxHelper.signup')->render();
        }catch (\Exception $exception){
            session()->put('error_add_user', 'This username or email already exists');
            return view('ajaxHelper.signup')->render();
        }


    }

    public function getOne($column, $value)
    {
        return Users::where($column, $value)->first();
    }
}
