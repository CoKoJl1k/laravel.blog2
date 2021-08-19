<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        //$posts = DB::select('select * from posts order by id desc');
        $posts = DB::table('posts')->paginate(3);
        return  view('welcome', ['posts' => $posts]);
    }
}
