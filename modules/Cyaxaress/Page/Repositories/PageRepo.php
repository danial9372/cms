<?php

namespace Cyaxaress\Page\Repositories;

use Cyaxaress\Page\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageRepo
{
    public function all()
    {
        return Page::all();
    }


    public function paginate()
    {
        return Page::paginate();
    }


    public function findById($id)
    {
        return Page::findOrFail($id);
    }

    public function store($values)
    {
        return Page::create([
            'title' => $values->title,
            'banner_id' => $values->banner_id,
            'slug' => Str::slug($values->slug),
            'status' => $values->status,
            'body' => $values->body,
            'meta_description' => $values->meta_description,
            'meta_title' => $values->meta_title,
        ]);
    }

    public function update($id, $values)
    {
        return $this->findById($id)->update([
            'title' => $values->title,
            'banner_id' => $values->banner_id,
            'status' => $values->status,
            'body' => $values->body,
            'meta_description' => $values->meta_description,
            'meta_title' => $values->meta_title,
        ]);
    }

    public function destroy($id)
    {
        return $this->findById($id)->delete();
    }

    public function changeStatus($id, Request $request)
    {
        return $this->findById($id)->update(['status' => $request->status]);
    }
}
