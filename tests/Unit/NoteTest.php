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
     * /* @test
     */
    public function it_can_accept_json_to_create_note()
    {

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
    public function a_note_has_owner()
    {

        $this->signIn();

        $note = factory('App\Note')->create();

        $this->assertInstanceOf('App\User', $note->creator);

    }

    /**
     * /* @test
     */
    public function an_authenticated_user_can_read_its_own_note()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $note = factory('App\Note')->create(['user_id' => auth()->user()->id]);

        $this->json('GET', $note->path())
            ->assertStatus(200)
            ->assertJson(['title' => $note->title]);

    }

    /**
     * /* @test
     */
    public function an_authenticated_user_can_update_its_own_note()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $note = factory('App\Note')->create(['user_id' => auth()->user()->id]);

        $this->assertDatabaseHas('notes', ['title' => $note->title]);

        $this->json('PATCH', $note->path(), ['title' => 'New Title'])
            ->assertStatus(200);

        $this->assertDatabaseHas('notes', ['title' => 'New Title']);

    }


    /**
     * /* @test
     */
    public function it_accepts_json_to_update_note()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $note = factory('App\Note')->create(['user_id' => auth()->user()->id]);

        $this->assertDatabaseHas('notes', ['title' => $note->title]);

        $this->call(
            'PATCH',
            $note->path(),
            [],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json'
            ],
            json_encode(['title' => 'Changed Title'])
        )->assertStatus(200);

        $this->assertDatabaseHas('notes', ['title' => 'Changed Title']);
    }

    /**
     * /* @test
     */
    public function an_authenticated_user_can_delete_its_own_note()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $note = factory('App\Note')->create(['user_id' => auth()->user()->id]);

        $this->assertDatabaseHas('notes', ['title' => $note->title]);

        $this->json('DELETE', $note->path())
            ->assertStatus(200);

        $this->assertDatabaseMissing('notes', ['title' => $note->title]);

    }

}
