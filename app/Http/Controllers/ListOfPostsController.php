<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class ListOfPostsController extends Controller
{
    public function index()
    {
        $posts = DB::select('select * from posts order by id desc');
        return  view('list_of_posts', ['posts' => $posts]);
    }
}
