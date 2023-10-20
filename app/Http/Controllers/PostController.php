<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function view(): View
    {
        $result = Post::paginate(10);

        $posts = ! $result->isEmpty() ? $result : [];

        return view('welcome', compact(
            'posts',
        ));
    }

    public function create(Request $request): RedirectResponse
    {
        $post = new Post();
        $post = $this->prepareInputData($post, $request);
        $added = $post->save();

        if (! $added) {
            return redirect()->back()->with(
                'error',
                'Error adding post!'
            );
        }

        return redirect()->back()->with(
            'success',
            'New post added successfully!'
        );
    }

    private function prepareInputData(
        Post $post,
        Request $request
    ): Post {

        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
        ]);

        $post->title = filter_var(
            $request->input('title'),
            FILTER_SANITIZE_STRING
        );
        $post->content = $request->input('content');

        return $post;
    }
}
