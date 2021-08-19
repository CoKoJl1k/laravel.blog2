<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $s = $request->get('s');
        $posts = Posts::where('title', 'like', "%{$s}%")->paginate(2);
        return  view('welcome_search', ['posts' => $posts , 's' => $s]);
    }
}
