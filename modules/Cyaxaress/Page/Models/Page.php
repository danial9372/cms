<?php

namespace Cyaxaress\Page\Models;
use Cyaxaress\Media\Models\Media;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    const STATUS_ACTIVE = 'active';
    const STATUS_DE_ACTIVE = 'de-active';
    static $statuses = [self::STATUS_ACTIVE, self::STATUS_DE_ACTIVE];

    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }


}
