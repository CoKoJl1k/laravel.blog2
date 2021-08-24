<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{


    public function index()
    {
        return view('registration');
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
        session()->flash('success' , 'Вы успешо зарегистрировались' );
        //dd($request->all());
        Auth::login($user);
        return redirect()->route('posts.index', ['posts' => $posts ]);
    }
}
