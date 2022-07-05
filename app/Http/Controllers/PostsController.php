<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')->paginate(2);
        //$posts = DB::select('select * from posts order by id desc');
        return view('admin.welcome', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images' => 'nullable|image'
        ]);
        // dump($request);
        // dd($request);
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
            //dd($request);
            $folder = date('Y-d-m');
            $image = $request->file('file_name')->store('/images/' . $folder);
            // don't forget to make  ->  php artisan storage:link and # change settings  // FILESYSTEM_DRIVER=public
        }

        $post = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'images' => $image ?? null
        ];

        Posts::create($post);// for array
        session()->flash('success', 'Данные успешно сохранены');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = DB::select('select * from posts where id = :id', [":id" => $id]);
        return view('admin.edit', ['posts' => $posts, "id" => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $images = DB::select('select images from posts where id = :id', [":id" => $id]);
        if ($images) {
            // dump($images);
            if ($request->hasFile('file_name')) {
                // if we have a file on disk, delete it
                if (file_exists('storage/' . $images[0]->images)) {
                    Storage::disk('public')->delete($images[0]->images);
                }
                $folder = date('Y-d-m');
                $image_path = $request->file('file_name')->store('/images/' . $folder);
                // don't forget to make  ->  php artisan storage:link and # change settings  // FILESYSTEM_DRIVER=public
            }

            DB::update('update posts set title = :title, description = :description, images = :image where id = :id',
                [":id" => $id, ":title" => $title, ":description" => $description, ":image" => $image_path ?? $images[0]->images]);
            $posts = DB::table('posts')->paginate(6);
            session()->flash('success', 'Данные успешно сохранены');
            return redirect()->route('posts.index', ['posts' => $posts]);
        } else {
            $errors = ["data_has_not_been_saved" => "Произошла ошибка. Данные не сохранены!"];
            return redirect()->route('errors_update')->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $images = DB::select('select images from posts where id = :id', [":id" => $id]);
        if ($images) {
            // if we have a file on disk, delete it
            if (file_exists('storage/' . $images[0]->images)) {
                Storage::disk('public')->delete($images[0]->images);
            }
            DB::delete('delete from posts where id = :id', [":id" => $id]);
            $posts = DB::table('posts')->paginate(6);
            session()->flash('success', 'Данные успешно удалены');
            return redirect()->route('posts.index', ['posts' => $posts]);
        } else {
            $errors = ["data_has_not_been_delete" => "Произошла ошибка. Данные не удалены!"];
            return redirect()->route('errors_update')->withErrors($errors);
        }
    }
}
