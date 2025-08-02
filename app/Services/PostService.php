<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function all()
    {
        return Post::with(['user', 'category', 'tag'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function find($id)
    {
        return Post::with(['user', 'category', 'tag'])
            ->where('id', $id)
            ->where('status', 'published')
            ->firstOrFail();
    }

    public function store($request)
    {
        $post = $request->user()->posts()->create($request->all());
        if ($post) {
            if ($request->hasFile('image')) {
                $post->addMediaFromRequest('image')
                    ->toMediaCollection('feature_image');
            }
        }
        return true;
    }

    public function update($request, $post)
    {
        $post->update($request->all());
        if ($request->hasFile('image')) {
            $post->clearMediaCollection('feature_image');
            $post->addMediaFromRequest('image')
                ->toMediaCollection('feature_image');
        }

        return true;
    }

    public function delete($post)
    {
        return $post->delete();
    }
}
