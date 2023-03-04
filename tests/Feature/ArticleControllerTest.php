<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    use RefreshDatabase;
    

	// ステータスと投稿画面のビューが使用されているかどうかをテスト
    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(400)
            ->assertViewIs('articles.index');
    }


    // ゲストが投稿のURLに遷移してきた際のテスト。リダイレクトするかどうか。
    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }    


	// ログイン済みユーザーとしてテスト
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.create'));
			
        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }


}
