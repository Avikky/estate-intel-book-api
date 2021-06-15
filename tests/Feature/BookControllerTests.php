<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTests extends TestCase
{
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

     public function testIndexReturnsDataInValidFormat(){
        $this->json('get', 'api/v1/books')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'status_code' => 200,
                'status' => 'success',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                         'isbn',
                         'authors' => [
                            
                         ],
                         'number_of_pages',
                         'publisher',
                         'release_date',
                     ]
                 ]
            ]
        );
     }
}
