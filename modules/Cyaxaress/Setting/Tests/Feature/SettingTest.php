<?php

namespace Cyaxaress\Setting\Tests\Feature;

use Cyaxaress\Course\Models\Course;
use Cyaxaress\Setting\Models\Setting;
use Cyaxaress\RolePermissions\Database\Seeds\SettingTableSeeder;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_permitted_user_can_see_settings_panel()
    {
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_SHOW_SETTINGS);
        $this->get(route('settings.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_settings_panel()
    {
        $this->actionAsUser();
        $this->get(route('settings.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_create_setting()
    {
        $this->withoutExceptionHandling();
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_CREATE_SETTINGS);
        $this->createSetting();
        $this->assertEquals(1, Setting::all()->count());
    }

    public function test_permitted_user_can_update_setting()
    {
        $newTitle = 'update test name';
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_UPDATE_SETTINGS);

        $this->createSetting();
        $this->assertEquals(1, Setting::all()->count());
        $this->patch(route('settings.update', 1), ['title' => $newTitle, "slug" => $this->faker->word]);
        $this->assertEquals(1, Setting::whereTitle($newTitle)->count());
    }


    public function test_permitted_user_can_change_status_setting()
    {

        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_CHANGE_STATUS_SETTINGS);

        $this->createSetting();
        $this->assertEquals(1, Setting::all()->count());
        $this->patch(route('settings.changeStatus', 1), ['status' => Setting::STATUS_DE_ACTIVE]);
        $this->assertEquals(1, Setting::whereStatus(Setting::STATUS_DE_ACTIVE)->count());
    }


    public function test_user_can_delete_setting()
    {
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_DELETE_SETTINGS);

        $this->createSetting();
        $this->assertEquals(1, Setting::all()->count());

        $this->delete(route('settings.destroy', 1))->assertOk();
    }


    private function createSetting()
    {
        return $this->post(route('settings.store'),
            [
                'meta_title' => $this->faker->word,
                'meta_description' => $this->faker->word,
                'body' => $this->faker->word,
                'title' => $this->faker->word,
                "slug" => $this->faker->word,
                "banner_id" => UploadedFile::fake()->image('banner.jpg'),
                "status" => Setting::STATUS_ACTIVE,
            ]
        );
    }


    private function actionAsAdmin()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(SettingTableSeeder::class);

    }

    private function actionAsUser()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(SettingTableSeeder::class);
    }
}
