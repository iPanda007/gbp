<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function all()
    {
        return Tag::all();
    }

    public function find($id)
    {
        return Tag::findOrFail($id);
    }

    public function store($data)
    {
        return Tag::create($data);
    }

    public function update($id, $data)
    {
        $tag = $this->find($id);
        $tag->update($data);
        return $tag;
    }

    public function delete($id)
    {
        $tag = $this->find($id);
        $tag->delete();
        return true;
    }
}
