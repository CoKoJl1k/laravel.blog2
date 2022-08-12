<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    public function index()
    {
        $posts = DB::table('posts')->paginate(3);
        //$posts = DB::select('select * from posts order by id desc');
        return view('welcome', ['posts' => $posts]);
    }

    //
    public function test5()
    {
        $posts = DB::table('posts')->paginate(3);
        //$posts = DB::select('select * from posts order by id desc');
        return view('welcome', ['posts' => $posts]);
    }
}
