<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return Inertia::render('Post/Index', [
            'posts' => $posts,
        ]);
    }

    // create method
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    // edit view
    public function edit($id)
    {
        $post = Post::find($id);

        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }


    // store method
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        if ($post) {
            return Redirect::route('posts.index')->with('message', 'Post created successfully.');
        }
    }


    public function update(Request $request, Post $post)
    {
        //set validation
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        //update post
        $post->update([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        if ($post) {
            return Redirect::route('posts.index')->with('message', 'Data Berhasil Diupdate!');
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        if ($post) {
            return Redirect::route('posts.index')->with('message', 'Data Berhasil Dihapus!');
        }
    }
}
