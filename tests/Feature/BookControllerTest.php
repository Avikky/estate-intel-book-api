<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTests extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_for_list_of_all_books(){
        $this->json('get', '/api/v1/books')
        ->assertJsonStructure(
            [
                'status_code',
                'status',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'isbn',
                        'authors',
                        'number_of_pages',
                        'publisher',
                        'release_date',
                    ]
                ],
            ]
        )
        ->assertStatus(200);
    }

    public function test_for_validation_errors(){
        $this->json('post', '/api/v1/books')
        ->assertJsonValidationErrors(['name', 'isbn', 'authors', 'number_of_pages', 'publisher', 'release_date']);
    }

    public function test_for_single_book(){
        $response = $this->get('api/v1/books/1');
        $response->assertStatus(200);
    }

    public function test_if_book_is_created(){
        $data
        return $this->json('POST', '/api/v1/books', [
            'name' => 'New test book',
            'isbn' => '123-3345',
            'authors' => 'Anih Victor',
            'number_of_pages' => 350,
            'publisher' => 'xample publishing',
            'release_date' => '2010-06-02'
        ])->assertCreated();
    }
}
