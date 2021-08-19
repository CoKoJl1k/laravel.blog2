<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class EditController extends Controller
{
    public function index($id)
    {
        $posts = DB::select('select * from posts where id = :id', [":id" => $id]);
        return view('edit', ['posts' => $posts, "id" => $id]);
    }

    public function update(Request $request, $id): RedirectResponse
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
            return redirect()->route('welcome', ['posts' => $posts]);
        } else {
            $errors = ["data_has_not_been_saved" => "Произошла ошибка. Данные не сохранены!"];
            return redirect()->route('errors_update')->withErrors($errors);
        }
    }

    public function destroy($id): RedirectResponse
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
            return redirect()->route('welcome', ['posts' => $posts]);
        } else {
            $errors = ["data_has_not_been_delete" => "Произошла ошибка. Данные не удалены!"];
            return redirect()->route('errors_update')->withErrors($errors);
        }
    }
}
