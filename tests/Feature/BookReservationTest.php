<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_book_can_be_added_to_library()
    {

        $this->withoutExceptionHandling();

        $response = $this->post('/books',
        ['title'=>"Book Title",
        'author'=>"Paulo Cohelo",
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /**
     * @test
     */
    public function a_title_is_required()
    {
        $response = $this->post('/books',
        ['title'=>"",
        'author'=>"Paulo Cohelo",
        ]);

        $response->assertSessionHasErrors('title');
    }
    /**
     * @test
     */
    public function a_author_is_required()
    {
        $response = $this->post('/books',
        ['title'=>"Title",
        'author'=>"",
        ]);

        $response->assertSessionHasErrors('author');
    }
    /**
     * @test
     */
    public function a_book_can_be_updated()
    {
        $this->post('/books',
        ['title'=>"Title",
        'author'=>"Author",
        ]);

        $book=Book::first();

        $response =$this->patch('/books/'.$book->id,[
            'title'=>'New Title',
            'author'=>"New Author"
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
    }
}
