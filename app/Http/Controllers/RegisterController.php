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

    public function registration(Request $request)
    {
        //$posts = DB::select('select * from posts order by id desc');
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required'
        ]);
        //dd($request);
       // $email = DB::select('select email from users where email = :email', [":email" => $request->email]);
       // $emailCount = count($email);
      //  $emailCount = User::where('email', '=', $request->email)->count();
       // if ($emailCount > 0) {
         //   $errors = ["data_has_not_been_delete" => "Данный email уже зарегистрирован на сайте! Введите другой email."];
         //   return view('registration')->withErrors($errors);
            //return redirect()->route('registration_form')->withErrors($errors);
      //  }

        $user = User::create(['name'=> $request->name, 'email' => $request->email, 'password'=> Hash::make($request->password)]);
        session()->flash('success', 'Вы успешно зарегистрировались');
        //dd($request->all());
        Auth::login($user);
        $posts = DB::table('posts')->paginate(3);
        return redirect()->route('posts.index', ['posts' => $posts]);
    }
}
