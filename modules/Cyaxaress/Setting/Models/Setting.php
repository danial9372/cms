<?php

namespace Cyaxaress\Setting\Models;
use Cyaxaress\Media\Models\Media;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    const TYPE_TEXT = 'text';
    const TYPE_NUMBER = 'number';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_EDITOR = 'editor';
    const TYPE_IMAGE = 'image';
    const TYPE_EMAIL = 'email';

    const ACCESS_FRONT = 'front';
    const ACCESS_DASHBOARD= 'dashboard';
    const ACCESS_ADMIN= 'admin';
    const ACCESS_GLOBAL= 'global';

    const GROUP_SEO= 'seo';
    const GROUP_GENERAL= 'general';
    const GROUP_SOCIALS= 'socials';
    const GROUP_PHONES= 'phones';
    const GROUP_LOGOS= 'logos';
    const GROUP_ADDRESSES= 'addresses';
    const GROUP_TEXTS= 'texts';
    const GROUP_IMAGES= 'images';
    const GROUP_SYMBOLS= 'symbols';
    const GROUP_SHOP= 'shop';

    static $types = [self::TYPE_TEXT,self::TYPE_EMAIL, self::TYPE_NUMBER ,self::TYPE_TEXTAREA, self::TYPE_EDITOR, self::TYPE_IMAGE];
    static $accesses = [self::ACCESS_GLOBAL,self::ACCESS_FRONT, self::ACCESS_DASHBOARD , self::ACCESS_ADMIN];
    static $groups = [  self::GROUP_GENERAL,self::GROUP_SEO, self::GROUP_TEXTS, self::GROUP_SOCIALS,self::GROUP_ADDRESSES ,self::GROUP_IMAGES,self::GROUP_LOGOS ,self::GROUP_PHONES ,self::GROUP_SYMBOLS ,self::GROUP_SHOP];
}
