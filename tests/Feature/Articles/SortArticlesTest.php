<?php

namespace Tests\Feature\Articles;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Article;
use Illuminate\Support\Facades\DB;


class SortArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_sort_articles_by_title_asc(): void
    {
        Article::factory()->create(['title' => 'C Title']);
        Article::factory()->create(['title' => 'A Title']);
        Article::factory()->create(['title' => 'B Title']);

        $url = route('api.v1.articles.index', ['sort' => 'title']);

        $this->getJson($url)->assertSeeInOrder([
            'A Title',
            'B Title',
            'C Title',
        ]);
    }

    /** @test */
    public function test_can_sort_articles_by_title_desc(): void
    {
        Article::factory()->create(['title' => 'C Title']);
        Article::factory()->create(['title' => 'A Title']);
        Article::factory()->create(['title' => 'B Title']);

        $url = route('api.v1.articles.index', ['sort' => '-title']);

        $this->getJson($url)->assertSeeInOrder([
            'C Title',
            'B Title',
            'A Title',
        ]);
    }

    /** @test */
    public function test_can_sort_articles_by_title_and_content(): void
    {
        Article::factory()->create(['title' => 'C Title', 'content' => 'C content']);
        Article::factory()->create(['title' => 'A Title', 'content' => 'B content']);
        Article::factory()->create(['title' => 'B Title', 'content' => 'D content']);


        DB::listen(function($db){
            dump($db->sql);
        });

        $url = route('api.v1.articles.index', [], false) . '?sort=title,-content';
        //dd($url);

        $this->getJson($url)->assertSeeInOrder([
            'A Title',
            'B Title',
            'C Title',
        ]);

        $url = route('api.v1.articles.index', [], false) . '?sort=-content,title';
        //dd($url);

        $this->getJson($url)->assertSeeInOrder([
            'D content',
            'C content',
            'B content',
        ]);
    }

    public function test_cannot_sort_articles_by_unknown_fields()
    {
        
        Article::factory(3)->create();

        $url = route('api.v1.articles.index') . '?sort=unknown';

        $this->getJson($url)->assertStatus(400);

    }
}
