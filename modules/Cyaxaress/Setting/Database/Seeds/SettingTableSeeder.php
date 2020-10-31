<?php

namespace Cyaxaress\RolePermissions\Database\Seeds;

use Cyaxaress\Setting\Models\Setting;
use Illuminate\Database\Seeder;


class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::query()->truncate();
        Setting::insert(
            [
                'group' => Setting::GROUP_SEO,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'meta_title',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SEO,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXTAREA,
                'key' => 'meta_description',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SEO,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_NUMBER,
                'key' => 'google_analytic_track_id',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_GENERAL,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EMAIL,
                'key' => 'email',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_GENERAL,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'brand',
                'value' => null,
                'extra' => null,
            ]

            , [
                'group' => Setting::GROUP_GENERAL,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_NUMBER,
                'key' => 'postal_code',
                'value' => null,
                'extra' => null,
            ]

            , [
                'group' => Setting::GROUP_SOCIALS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'telegram',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SOCIALS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'instagram',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SOCIALS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'twitter',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SOCIALS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'linkedin',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SOCIALS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'facebook',
                'value' => null,
                'extra' => null,
            ], [
                'group' => Setting::GROUP_SOCIALS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'pinterest',
                'value' => null,
                'extra' => null,
            ]

            , [
                'group' => Setting::GROUP_PHONES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_NUMBER,
                'key' => 'primary_phone',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_PHONES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_NUMBER,
                'key' => 'secondary_phone',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_PHONES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_NUMBER,
                'key' => 'primary_mobile',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_PHONES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_NUMBER,
                'key' => 'secondary_mobile',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_LOGOS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_IMAGE,
                'key' => 'large_logo',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_LOGOS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_IMAGE,
                'key' => 'small_logo',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_LOGOS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_IMAGE,
                'key' => 'fav_icon',
                'value' => null,
                'extra' => null,
            ]
             , [
                'group' => Setting::GROUP_ADDRESSES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXTAREA,
                'key' => 'primary_address',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_ADDRESSES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXTAREA,
                'key' => 'secondary_address',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_ADDRESSES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXTAREA,
                'key' => 'secondary_address',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_ADDRESSES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_TEXT,
                'key' => 'location_map',
                'value' => null,
                'extra' => null,
            ] , [
                'group' => Setting::GROUP_TEXTS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'about_us_text',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_TEXTS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'contact_text',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_TEXTS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'header_text',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_TEXTS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'footer_text',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_IMAGES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_IMAGE,
                'key' => 'about_us_image',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_IMAGES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_IMAGE,
                'key' => 'contact_image',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_IMAGES,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_IMAGE,
                'key' => 'blog_image',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SYMBOLS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'enamad',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SYMBOLS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'ecunion',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SYMBOLS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'eanjoman',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SYMBOLS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'samandehi',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SYMBOLS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'saramad',
                'value' => null,
                'extra' => null,
            ]   , [
                'group' => Setting::GROUP_SYMBOLS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'zarinpal',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SYMBOLS,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_EDITOR,
                'key' => 'mellat',
                'value' => null,
                'extra' => null,
            ]
            , [
                'group' => Setting::GROUP_SHOP,
                'access' => Setting::ACCESS_FRONT,
                'type' => Setting::TYPE_NUMBER,
                'key' => 'value_added',
                'value' => null,
                'extra' => null,
            ]
        );
    }
}
