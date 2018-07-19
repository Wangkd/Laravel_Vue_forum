<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp(); 

        $this->thread = factory('App\Thread')->create();
    }
    
    /** @test */
    public function user_can_see_all_threads()
    {
        $response = $this->get('/threads');

        $response->assertSee($this->thread->title)
                ->assertSee($this->thread->body);
    }

    /** @test */
    public function user_can_see_a_single_thread()
    {
        $response = $this->get('/threads/'.$this->thread->id);

        $response->assertSee($this->thread->title)
                ->assertSee($this->thread->body);
    }
    
    /** @test */
    public function user_can_see_comments_associated_with_a_thread()
    {
        $comment = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $response = $this->get('/threads/'.$this->thread->id);

        $response->assertSee($comment->body);
    }
    
}
