<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
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
                'Error adding new event video post!'
            );
        }

        return redirect()->back()->with(
            'success',
            'New event video post added successfully!'
        );
    }
}
