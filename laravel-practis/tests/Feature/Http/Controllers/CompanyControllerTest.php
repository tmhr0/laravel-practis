<?php


namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    // テスト用DBをリセットしている
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        // 事前にテスト用データを作成
        $this->companies = Company::factory()->count(3)->create();
        // 最初にcreateした会社データを設定
        $this->company = $this->companies->first();
        $this->user = User::factory(['company_id' => $this->company->id])->create();
    }

    public function test_index()
    {
        $url = route('companies.index');

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));
        // actingAs 指定ユーザーを現在のユーザーとして認証する
        $response = $this->actingAs($this->user)->get($url);

        $response->assertStatus(200);
    }

    public function test_create()
    {
        $url = route('companies.create');

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)
            ->get($url);

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $company_name = $this->faker->company;

        $url = route('companies.store');

        // ゲストのときは、loginページにリダイレクトされる
        $this->post($url, [
            'name' => $company_name,
        ])->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)
            ->post($url, [
                'name' => $company_name,
            ]);

        $response->assertStatus(302);

        // 登録データが存在しているかを確認する
        $this->assertDatabaseHas('companies', [
            'name' => $company_name,
        ]);
    }

    public function test_show()
    {
        $url = route('companies.show', $this->companies->random()->first()->id);

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        $this->actingAs($this->user)->get($url)->assertStatus(200);

    }

    public function test_edit()
    {
        $url = route('companies.edit', $this->companies->random()->first()->id);

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        $this->actingAs($this->user)->get($url)->assertStatus(200);;
    }

    public function test_update()
    {
        $company = $this->companies->random()->first();

        $company_name = $this->faker->company;

        $url = route('companies.update', $company->id);

        // ゲストのときは、loginページにリダイレクトされる
        $this->put($url, [
            'name' => $company_name,
        ])->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)
            ->put($url, [
                'name' => $company_name,
            ]);

        $response->assertStatus(302);

        // 更新後 companies.index にリダイレクトされる
        $response->assertRedirect(route('companies.index', compact('company')));

        // 登録データが存在しているかを確認する
        $this->assertDatabaseHas('companies', [
            'name' => $company_name,
        ]);
    }

    public function test_destroy()
    {
        $company = $this->companies->random()->first();

        $url = route('companies.destroy', $company->id);

        // ゲストのときは、loginページにリダイレクトされる
        $this->delete($url)->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->delete($url);

        $response->assertStatus(302);

        // 削除後 companies.index にリダイレクトされる
        $response->assertRedirect(route('companies.index', compact('company')));

        // データが存在しない（削除されている）ことを確認
        $this->assertDatabaseMissing('companies', [
            'id' => $company->id,
        ]);
    }
}
