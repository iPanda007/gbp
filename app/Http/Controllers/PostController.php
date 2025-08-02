<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Enums\PostStatus;
use App\Services\TagService;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\CategoryService;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(public PostService $postService, public CategoryService $categoryService, public TagService $tagService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->all();
        // $categories = $this->categoryService->all()->select('id', 'name');
        return Inertia::render('posts/Index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status =  PostStatus::cases();
        $categories = $this->categoryService->all()->select('id', 'name');
        $tags = $this->tagService->all()->select('id', 'name');
        return Inertia::render('posts/Create', compact('categories', 'tags','status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->postService->store($request);
        return to_route('posts.index')->with('success', 'Post created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = $this->postService->all();
        $categories = $this->categoryService->all()->select('id', 'name');
        $tags = $this->tagService->all()->select('id', 'name');
        return Inertia::render('posts/View', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        $post = $post->load(['category', 'tag']);
        $status =  PostStatus::cases();
        $categories = $this->categoryService->all()->select('id', 'name');
        $tags = $this->tagService->all()->select('id', 'name');
        return Inertia::render('posts/Edit', compact('post', 'categories', 'tags','status'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->postService->update($request, $post);

        return to_route('posts.index')->with('success', 'Post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postService->delete($post);
        return to_route('posts.index')->with('success', 'Post deleted successfully');
    }

    // public function showAll()
    // {
    //     $articles = $this->postService->all(2);
    //     $categories = $this->categoryService->all()->select('id', 'name');
    //     $tags = $this->tagService->all()->select('id', 'name');


    //     return Inertia::render('Articles', compact('articles', 'categories', 'tags'));
    // }
    public function view(Post $post)
    {
        $post = $this->postService->all();
        $categories = $this->categoryService->all()->select('id', 'name');
        $tags = $this->tagService->all()->select('id', 'name');
        return Inertia::render('SingleArticle', compact('post', 'categories', 'tags'));
    }
}
