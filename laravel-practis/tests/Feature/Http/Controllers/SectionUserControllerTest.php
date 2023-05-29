<?php


namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionUserControllerTest extends TestCase
{
    // テスト用DBをリセットしている
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        // 事前にテスト用データを作成
        //単数か複数か命名
        $this->company = Company::factory()->create();
        $this->user = User::factory(['company_id' => $this->company->id])->create();
        $this->section = Section::factory(['company_id' => $this->company->id])->create();
    }

    public function test_store()
    {
        $user = $this->user->id;
        $company = $this->company->id;
        $section = $this->section->id;

        $url = route('sections.users.store', [
            'company' => $this->company->id,
            'section' => $this->section->id,
        ]);

        // ゲストのときは、loginページにリダイレクトされる
        $this->post($url, [
            'company_id' => $company,
            'section_id' => $section,
        ])->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->post($url, [
            'section_id' => $section,
            'user_id' => $user,
        ]);

        $response->assertStatus(302);

        // 登録後 sections.show にリダイレクトされる
        $response->assertRedirect(route('sections.show', [
            'company' => $company,
            'section' => $section,
        ]));

        // データが存在しない（削除されている）ことを確認
        $this->assertDatabaseHas('section_user', [
            'section_id' => $section,
            'user_id' => $user,
        ]);
    }

    public function test_destroy()
    {
        // 必要なモデルを作成する
        $company = Company::factory()->create();
        $section = Section::factory()->create(['company_id' => $company->id]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $section->users()->attach($user->id);

        $url = route('sections.users.destroy', [
            'company' => $this->company->id,
            'section' => $this->section->id,
            'user' => $this->user->id,
        ]);

        // ゲストのときは、loginページにリダイレクトされる
        $this->delete($url)->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->delete(route('sections.users.destroy', [
            'company' => $company->id,
            'section' => $section->id,
            'user' => $user->id,
        ]));

        $response->assertStatus(302);

        // 削除後 sections.show にリダイレクトされる
        $response->assertRedirect(route('sections.show', [
            'company' => $company,
            'section' => $section,
        ]));

        // データが存在しない（削除されている）ことを確認
        $this->assertDatabaseMissing('section_user', [
            'section_id' => $section->id,
            'user_id' => $user->id,
        ]);
    }
}
