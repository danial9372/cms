<?php


namespace Cyaxaress\Category\Traits;


use Cyaxaress\Category\Models\Category;

trait HasCategories
{
    public function categories()
    {
        return $this->morphMany(Category::class, 'categorable');
    }
}
