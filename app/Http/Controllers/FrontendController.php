<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\TagService;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function __construct(public PostService $postService,public CategoryService $categoryService,public TagService $tagService)
    {

    }
    public function home()
    {
        $articles = $this->postService->all();
        // return $articles;
        return Inertia::render('Index',compact('articles'));
    }

    public function showAll()
    {
        $articles = $this->postService->all();
        $categories = $this->categoryService->all()->select('id', 'name');
        $tags = $this->tagService->all()->select('id', 'name');
        return Inertia::render('Articles', compact('articles', 'categories', 'tags'));
    }
}
