<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     *
     */
    public function index() : View
    {
        //
        return view('posts.index', [
            'posts' => Post::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request) : RedirectResponse
    {
        //
        $validated = $request->validated();

        $validated["slug"] = Str::slug($request->title);

        $request->user()->posts()->create($validated);

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     *
     * @return View
     */
    public function edit(Post $post) : View
    {
        //
        $this->authorize('update', $post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     *
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post) : RedirectResponse
    {
        //
        $this->authorize('update', $post);

        $validated = $request->validated();

        $validated["slug"] = Str::slug($request->title);

        $post->update($validated);

        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     *
     * @return RedirectResponse
     */
    public function destroy(Post $post) : RedirectResponse
    {
        //
        $this->authorize('delete', $post);

        $post->delete();

        return to_route('posts.index');
    }
}
