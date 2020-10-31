<?php

namespace Cyaxaress\Faq\Tests\Feature;

use Cyaxaress\Faq\Models\Faq;
use Cyaxaress\FaqCategory\Models\FaqCategory;
use Cyaxaress\RolePermissions\Database\Seeds\SettingTableSeeder;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FaqTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_permitted_user_can_see_faqs_panel()
    {
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_SHOW_FAQS);
        $this->get(route('faqs.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_faqs_panel()
    {
        $this->actionAsUser();
        $this->get(route('faqs.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_create_faq()
    {
        $this->withoutExceptionHandling();
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_CREATE_FAQS);
        $this->createFaq();
        $this->assertEquals(1, Faq::all()->count());
    }

    public function test_permitted_user_can_update_faq()
    {
        $newQuestion = 'update question text';
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_UPDATE_FAQS);
        $faq = $this->createFaq();
        $this->assertEquals(1, Faq::all()->count());
        $this->patch(route('faqs.update', 1), ['question' => $newQuestion, 'faq_category_id' => $faq->category->id]);
        $this->assertEquals(1, Faq::whereQuestion($newQuestion)->count());
    }


    public function test_permitted_user_can_change_status_faq()
    {

        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_CHANGE_STATUS_FAQS);

        $this->createFaq();
        $this->assertEquals(1, Faq::all()->count());
        $this->patch(route('faqs.changeStatus', 1), ['status' => Faq::STATUS_DE_ACTIVE]);
        $this->assertEquals(1, Faq::whereStatus(Faq::STATUS_DE_ACTIVE)->count());
    }


    public function test_user_can_delete_faq()
    {
        $this->actionAsAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_DELETE_FAQS);

        $this->createFaq();
        $this->assertEquals(1, Faq::all()->count());

        $this->delete(route('faqs.destroy', 1))->assertOk();
    }


    private function createFaq()
    {
        $category = $this->createCategory();

        return $this->post(route('faqs.store'),
            [
                'meta_title' => $this->faker->word,
                'meta_description' => $this->faker->word,
                'faq_category_id' => $category->id,
                'body' => $this->faker->word,
                'title' => $this->faker->word,
                "slug" => $this->faker->word,
                "banner_id" => UploadedFile::fake()->image('banner.jpg'),
                "status" => Faq::STATUS_ACTIVE,
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


    private function createCategory()
    {
        return FaqCategory::create(['title' => $this->faker->word, "slug" => $this->faker->word]);
    }
}
