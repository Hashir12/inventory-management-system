<?php

namespace App\Http\Controllers;

use App\Product;
use App\SaleRecords;
//use App\User;
use Illuminate\Http\Request;
use App\Users;
use App\Mail\sendMail;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function fetchUsers()
    {
        $users = Users::where('id', '!=', Auth::user()->id)->get();
        $products = Product::all();
        $data = ['users' => $users, 'products' => $products];
        return $data;
    }


    public function usersignup(request $request)
    {
        $rules = [
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'email' => 'required|unique:users|email',
        ];

        $messages = [
            'username.required' => 'Username is required',
            'password.required' => 'Password is required',
            'email.required' => 'Email is required',
            'username.unique' => 'This username is already in use',
            'password.min' => 'Password should be 6 characters long',
            'email.unique' => 'This Email is already in use'
        ];

        $this->validate($request, $rules, $messages);

        $user = new Users([
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
            'email' => $request->get('email'),
        ]);
        $user->save();
        return redirect()->back();
    }

    public function userlogin(Request $request)
    {

        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'required' => 'Username or password cannot be empty',
            'mismatch' => 'Username or Password is incorrect'
        ];

        $this->Validate($request, $rules, $messages);

        if (Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ])) {
            return redirect('userprofile');
        } else {
            return redirect()->back()->withErrors($messages['mismatch']);

        }
    }

    public function recover()
    {
        $rules = [
            'email' => 'required',

        ];
        $messages = [
            'required' => "Email can't be empty",
        ];


        $this->validate(\request(), $rules, $messages);

        $user = Users::where('email', '=', \request('email'))->first();
        if (!$user) {
            return $message['mismatch'] = 'This email does not exist';
        }
        Session::put('resetpassword', $user->id);
        if ($user->email == \request('email')) {
            Mail::to(\request('email'))->send(new sendMail());
        }
    }

    public function reset()
    {

        $rules = [
            'new' => 'required|min:6',
            'con' => 'required|min:6',
        ];

        $messages = [
            'required' => 'New and Confirm password cannot be empty',
            'min' => 'New and Confirm password must be 6 characters long.'
        ];

        $this->validate(\request(), $rules, $messages);

        if (\request('new') != \request('con')) {
            return $messages['must_same'] = 'New and Confirm Passwords must be same.';
        } else {
            $user = Users::where('id', '=', Session::get('resetpassword'))->first();
            $data = ['password' => bcrypt(\request('new'))];
            $user->update($data);
        }
    }

    public function profile()
    {
        return view('user.userProfile');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function userRole()
    {
        $user = Users::find(\request('id'));
        $user->user_type = $user->user_type == 'admin' ? 'user' : 'admin';
        $user->save();
        return $user;

    }

    public function usershop()
    {
        $user = Users::find(\request('id'));
        $user->user_role = \request('shop');
        $user->save();
        return $user;
    }

    public function delete()
    {
        $user = Users::find(\request('id'));
        if ($user->user_type == 'user') {
            $user->delete();
        }
        return $user;
    }
}
