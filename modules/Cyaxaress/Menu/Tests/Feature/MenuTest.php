<?php

namespace Cyaxaress\Menu\Tests\Feature;

use Cyaxaress\Menu\Models\Menu;
use Cyaxaress\RolePermissions\Database\Seeds\RolePermissionTableSeeder;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_permitted_user_can_see_menus_panel()
    {
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_SHOW_MENU);
        $this->get(route('menus.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_menus_panel()
    {
        $this->actionAsUser();
        $this->get(route('menus.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_create_menu()
    {
        $this->withoutExceptionHandling();
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_CREATE_MENU);
        $this->createMenu();
        $this->assertEquals(1, Menu::all()->count());
    }

    public function test_permitted_user_can_update_menu()
    {
        $newTitle = 'update test name';
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_UPDATE_MENU);

        $this->createMenu();
        $this->assertEquals(1, Menu::all()->count());
        $this->patch(route('menus.update', 1), ['title' => $newTitle, "slug" => $this->faker->word]);
        $this->assertEquals(1, Menu::whereTitle($newTitle)->count());
    }


    public function test_permitted_user_can_change_status_menu()
    {

        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_CHANGE_STATUS_MENU);

        $this->createMenu();
        $this->assertEquals(1, Menu::all()->count());
        $this->patch(route('menus.changeStatus', 1), ['status' => Menu::STATUS_DE_ACTIVE]);
        $this->assertEquals(1, Menu::whereStatus(Menu::STATUS_DE_ACTIVE)->count());
    }


    public function test_user_can_delete_menu()
    {
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_DELETE_MENU);

        $this->createMenu();
        $this->assertEquals(1, Menu::all()->count());

        $this->delete(route('menus.destroy', 1))->assertOk();
    }


    private function createMenu()
    {
        return $this->post(route('menus.store'),
            [

                'title' => $this->faker->word,
                "slug" => $this->faker->word,
                "priority" => $this->faker->randomFloat(),
                 "status" => Menu::STATUS_ACTIVE,
                 "position" => Menu::POSITION_TOP,
                 "target" => Menu::TARGET_SELF,
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
