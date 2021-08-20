<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->paginate(3);
        //$posts = DB::select('select * from posts order by id desc');

        return view('welcome', ['posts' => $posts]);
    }
}
