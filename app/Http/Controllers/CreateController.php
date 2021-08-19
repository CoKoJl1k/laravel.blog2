<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;


class CreateController extends Controller
{
    public function index()
    {
        return  view('create');
    }


    public function create(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images' => 'nullable|image'
        ]);
        //dump($request->all());
/*
        $post = new Posts;
        $post->title = $request->title;
        $post->description = $request->description;
        $image = $request->file('file')->store('images');
        $post->images = $image;
        $post->save();  // for object
*/

        if ($request->hasFile('file_name')) {
            $folder = date('Y-d-m');
            $image = $request->file('file_name')->store('/images/'.$folder);
            // don't forget to make  ->  php artisan storage:link and # change settings  // FILESYSTEM_DRIVER=public
        }

        $post= [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'images' => $image ?? null
        ];

        Posts::create($post);// for array
        //dump($request->title);//dump($request);//dd($request->input('title'));
        session()->flash('success' , 'Данные успешно сохранены');
        return redirect('/');
    }
}
