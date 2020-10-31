<?php

namespace Cyaxaress\Faq\Models;
use Cyaxaress\Category\Traits\HasCategories;
 use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasCategories;
    protected $guarded = [];

    const STATUS_ACTIVE = 'active';
    const STATUS_DE_ACTIVE = 'de-active';
    static $statuses = [self::STATUS_ACTIVE, self::STATUS_DE_ACTIVE];





}
