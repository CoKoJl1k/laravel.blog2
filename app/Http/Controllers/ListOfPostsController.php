<?php

namespace App\Http\Controllers;

use App\Models\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\DateTime;


class ListOfPostsController extends Controller
{
    public function index()
    {
        $posts = DB::select('select * from posts order by id desc');
        return  view('list_of_posts', ['posts' => $posts]);
    }
}
