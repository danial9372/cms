<?php

namespace Cyaxaress\Menu\Models;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    const STATUS_ACTIVE = 'active';
    const STATUS_DE_ACTIVE = 'de-active';

    const POSITION_TOP = 'top';
    const POSITION_BOTTOM = 'bottom';
    const POSITION_SIDEBAR = 'sidebar';

    const TARGET_SELF = '_self';
    const TARGET_BLANK = '_blank';



    static $statuses = [self::STATUS_ACTIVE, self::STATUS_DE_ACTIVE];
    static $positions = [self::POSITION_TOP, self::POSITION_BOTTOM, self::POSITION_SIDEBAR];
    static $targets = [self::TARGET_SELF, self::TARGET_BLANK ];

    public function getParentAttribute()
    {
        return (is_null($this->parent_id)) ? 'ندارند' : $this->parentMenu->title;
    }


    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function subMenus()
    {
        $this->hasMany(Menu::class, 'parent_id');
    }
}
