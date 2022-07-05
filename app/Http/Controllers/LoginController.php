<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function index_reg()
    {
        return view('registration');
    }

    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        //dd($request->all());
        //$email = $request->input('email');
        //$password = $request->input('password');
        //$users = DB::select('select * from users where email = :email and password = :password', [":id" => $id, "password" => $password]);
        //$posts = DB::select('select * from posts');
       // return view('admin.edit', ["users" => $users, "posts" => $posts]);
        //return view('admin.welcome');


        if (Auth::attempt(['email' => $request->email , 'password'=> $request->password])) {
            session()->flash('success' , 'Вы успешно вошли.' );
            //dd($request->all());
            $posts = DB::table('posts')->paginate(3);

            if (auth()->user()->indicator == 1){
                return redirect()->route('posts.index', ['posts' => $posts]);
            } else {
                return redirect()->route('welcome', ['posts' => $posts]);
            }
        } else {
            $errors = ["data_has_not_been_delete" => "Email или пароль неправильный!"];
            return redirect()->route('login')->withErrors($errors);
            ///return redirect()->route('login', ['errors' => 'Incorrect password or email']);
        }
    }

    public function registration(Request $request): \Illuminate\Http\RedirectResponse
    {
        $posts = DB::table('posts')->paginate(3);
        //$posts = DB::select('select * from posts order by id desc');
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create(['name'=> $request->name, 'email' => $request->email , 'password'=> Hash::make($request->password)]);
        session()->flash('success', 'Вы успешно зарегистрировались' );
        //dd($request->all());
        Auth::login($user);
        return redirect()->route('posts.index', ['posts' => $posts ]);
    }


    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        //session()->flash('success' , 'Вы успешно вышли');
        return redirect()->route('login_form');
        //return view('login');
    }

}
