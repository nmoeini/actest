<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function an_authenticated_user_can_create_note()
    {

        $this->withoutExceptionHandling();

        $this->signin();

        $note = factory('App\Note')->make();

        $response = $this->json('post', '/notes', $note->toArray());

        $this->assertDatabaseHas('notes', ['title' => $note->title]);

    }

    /**
    /* @test
    */
    public function it_can_accept_json_to_create_note(){

        $this->withoutExceptionHandling();

        $this->signin();

        $note = factory('App\Note')->make();

        $this->call(
            'POST',
            '/notes',
            [],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json'
            ],
            json_encode($note->toArray())
        );

        $this->assertDatabaseHas('notes', ['title' => $note->title]);
    }

    /**
     * @test
     */
    public function a_note_has_owner() {

        $this->signIn();

        $note = factory('App\Note')->create();

        $this->assertInstanceOf('App\User', $note->creator);

    }


}
