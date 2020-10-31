<?php
namespace Cyaxaress\Category\Models;
use Cyaxaress\Faq\Models\Faq;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded= [];


    const TYPE_FAQ = 'faq';
    const TYPE_POST = 'post';
    const TYPE_COURSE = 'course';

    static $types= [self::TYPE_FAQ, self::TYPE_POST , self::TYPE_COURSE];


    public function categorable()
    {
        return $this->morphTo();
    }



    public function getParentAttribute()
    {
        return (is_null($this->parent_id)) ? 'ندارند' : $this->parentCategory->title;
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        $this->hasMany(Category::class, 'parent_id');
    }


}
