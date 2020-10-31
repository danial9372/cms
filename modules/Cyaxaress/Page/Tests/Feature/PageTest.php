<?php

namespace Cyaxaress\Page\Tests\Feature;

use Cyaxaress\Course\Models\Course;
use Cyaxaress\Page\Models\Page;
use Cyaxaress\RolePermissions\Database\Seeds\RolePermissionTableSeeder;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PageTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_permitted_user_can_see_pages_panel()
    {
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_SHOW_PAGES);
        $this->get(route('pages.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_pages_panel()
    {
        $this->actionAsUser();
        $this->get(route('pages.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_create_page()
    {
        $this->withoutExceptionHandling();
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_CREATE_PAGES);
        $this->createPage();
        $this->assertEquals(1, Page::all()->count());
    }

    public function test_permitted_user_can_update_page()
    {
        $newTitle = 'update test name';
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_UPDATE_PAGES);

        $this->createPage();
        $this->assertEquals(1, Page::all()->count());
        $this->patch(route('pages.update', 1), ['title' => $newTitle, "slug" => $this->faker->word]);
        $this->assertEquals(1, Page::whereTitle($newTitle)->count());
    }


    public function test_permitted_user_can_change_status_page()
    {

        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_CHANGE_STATUS_PAGES);

        $this->createPage();
        $this->assertEquals(1, Page::all()->count());
        $this->patch(route('pages.changeStatus', 1), ['status' => Page::STATUS_DE_ACTIVE]);
        $this->assertEquals(1, Page::whereStatus(Page::STATUS_DE_ACTIVE)->count());
    }


    public function test_user_can_delete_page()
    {
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_DELETE_PAGES);

        $this->createPage();
        $this->assertEquals(1, Page::all()->count());

        $this->delete(route('pages.destroy', 1))->assertOk();
    }


    private function createPage()
    {
        return $this->post(route('pages.store'),
            [
                'meta_title' => $this->faker->word,
                'meta_description' => $this->faker->word,
                'body' => $this->faker->word,
                'title' => $this->faker->word,
                "slug" => $this->faker->word,
                "banner_id" => UploadedFile::fake()->image('banner.jpg'),
                "status" => Page::STATUS_ACTIVE,
            ]
        );
    }


    private function actionAsAdmin()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(RolePermissionTableSeeder::class);

    }

    private function actionAsUser()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(RolePermissionTableSeeder::class);
    }
}
