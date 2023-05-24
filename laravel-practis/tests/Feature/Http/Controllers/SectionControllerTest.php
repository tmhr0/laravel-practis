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
        $this->company = Company::factory()->count(3)->create();
        $this->user = User::factory()->create();
        $this->section = Section::factory()->count(20)->create();
    }

    public function test_index()
    {
        $url = route('sections.index', $this->company->first()->id);

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        // actingAs 指定ユーザーを現在のユーザーとして認証する
        $response = $this->actingAs($this->user)->get($url);
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $url = route('sections.create', $this->company->first()->id);

        // ゲストのときは、loginページにリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        // actingAs 指定ユーザーを現在のユーザーとして認証する
        $response = $this->actingAs($this->user)->get($url);
        $response->assertStatus(200);
    }

    public function test_show(): void
    {
        $url = route('sections.show', ['company' => $this->company->first()->id, 'section' => $this->section->first()->id]);

        // Guest のときは、login にリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->get($url);
        $response->assertStatus(200);
    }

    public function test_edit(): void
    {
        $url = route('sections.edit', ['company' => $this->company->first()->id, 'section' => $this->section->first()->id]);

        // Guest のときは、login にリダイレクトされる
        $this->get($url)->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->get($url);
        $response->assertStatus(200);
    }
}
