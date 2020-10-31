<?php
namespace Cyaxaress\Category\Repositories;

use Cyaxaress\Category\Models\Category;

class CategoryRepo
{
    public function all(){
        return Category::all();
    }

    public function allExceptById($id)
    {
        return $this->all()->filter(function ($item) use ($id) {
           return $item->id != $id;
        });
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function store($values)
    {
        return Category::create([
            'title' =>$values->title,
            'slug' =>$values->slug,
            'parent_id' =>$values->parent_id,
            'type' =>$values->type,
        ]);
    }

    public function update($id, $values)
    {
        Category::where('id', $id)->update([
            'title' => $values->title,
            'slug' => $values->slug,
            'parent_id' => $values->parent_id,

        ]);
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
    }


    public function attachCategories($object ,$categories)
    {
        $object->categories()->save($categories);
    }
}
