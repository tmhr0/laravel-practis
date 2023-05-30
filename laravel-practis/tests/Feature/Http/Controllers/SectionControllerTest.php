<?php


namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionControllerTest extends TestCase
{
    // テスト用DBをリセットしている
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        // 事前にテスト用データを作成
        //単数か複数か命名
        $this->companies = Company::factory()->count(2)->create();

        // 最初にcreateした会社データを設定
        $this->company = $this->companies->first();
        $this->user = User::factory(['company_id' => $this->company->id])->create();

        // 最初にcreateした会社データで部署のダミーを設定
        $this->section = Section::factory(['company_id' => $this->company->id])->create();
        $this->section2 = Section::factory(['company_id' => $this->company->id])->create();

        // 最後にcreateした会社データを設定
        $this->company = $this->companies->last();
        $this->user2 = User::factory(['company_id' => $this->company->id])->create();

    }

    public function test_index()
    {
        $url = route('sections.index', $this->company->first()->id);

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        // actingAs 指定ユーザーを現在のユーザーとして認証する
        $this->actingAs($this->user)->get($url)->assertStatus(200);
    }

    public function test_create()
    {
        $url = route('sections.create', $this->company->first()->id);

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        // actingAs 指定ユーザーを現在のユーザーとして認証する
        $this->actingAs($this->user)->get($url)->assertStatus(200);
    }

    public function test_store()
    {
        $company = $this->company->first()->id;
        $section_name = $this->faker->word . '部';

        $url = route('sections.store', ['company' => $this->company->first()->id, 'section' => $this->section->id]);

        // ゲストのときは、loginページにリダイレクトされる
        $this->post($url, ['company_id' => $company, 'name' => $section_name])->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->post($url, ['name' => $section_name]);

        $response->assertStatus(302);

        // 登録データが存在しているかを確認する
        $this->assertDatabaseHas('sections', ['company_id' => $company, 'name' => $section_name]);

        // バリデーションの表示確認
        $this->actingAs($this->user)->post($url, ['name' => null]);

        $validation = '空欄での登録はできません。';
        $this->get(route('sections.create', $this->company->first()->id))->assertSee($validation);

        $this->actingAs($this->user)->post($url, ['name' => str_repeat('a', 31)]);

        $validation = 'nameは、30文字以下で指定してください。';
        $this->get(route('sections.create', $this->company->first()->id))->assertSee($validation);

        $this->actingAs($this->user)->post($url, ['name' => $section_name]);

        $validation = 'nameの値は既に存在しています。';
        $this->get(route('sections.create', $this->company->first()->id))->assertSee($validation);
    }

    public function test_show(): void
    {
        $url = route('sections.show', ['company' => $this->company->first()->id, 'section' => $this->section->id]);

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->get($url);
        $response->assertStatus(200);
    }

    public function test_edit(): void
    {
        $url = route('sections.edit', ['company' => $this->company->first()->id, 'section' => $this->section->id]);

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->get($url);
        $response->assertStatus(200);
    }

    public function test_update()
    {
        // ゲストのときは、loginページにリダイレクトされる
        $company = $this->company;
        $section = $this->section;

        $url = route('sections.update', ['company' => $company->first()->id, 'section' => $section->id]);
        $section_name = $this->faker->word . '部';

        // ゲストのときは、loginページにリダイレクトされる
        $this->put($url, ['name' => $section_name,])->assertRedirect(route('login'));

        $this->actingAs($this->user)
            ->put($url, ['name' => $section_name,])->assertStatus(302);

        // 登録データが存在しているかを確認する
        $this->assertDatabaseHas('sections', ['name' => $section_name]);

        // バリデーションの表示確認
        $this->actingAs($this->user)->put($url, ['name' => null]);

        $validation = '空欄での登録はできません。';
        $this->get(route('sections.edit', ['company' => $this->company->first()->id, 'section' => $this->section->id]))->assertSee($validation);

        $this->actingAs($this->user)->put($url, ['name' => str_repeat('a', 31)]);

        $validation = 'nameは、30文字以下で指定してください。';
        $this->get(route('sections.edit', ['company' => $this->company->first()->id, 'section' => $this->section->id]))->assertSee($validation);


        $section2 = $this->section2;
        $url = route('sections.update', ['company' => $company->id, 'section' => $section2->id]);
        $this->actingAs($this->user)->put($url, ['name' => $section_name]);

        $validation = 'その部署名は既に登録済みです。';
        $this->get(route('sections.edit', ['company' => $this->company->first()->id, 'section' => $this->section->id]))->assertSee($validation);
    }
}
