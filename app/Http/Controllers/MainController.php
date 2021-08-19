<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->paginate(3);
        return view('welcome', ['posts' => $posts]);
    }
}
