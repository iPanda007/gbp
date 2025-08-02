<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Services\PostService;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(public PostService $postService)
    {

    }
    public function index()
    {
        $articles = $this->postService->all();
        return Inertia::render('Admin/Dashboard',compact('articles'));
    }
}
