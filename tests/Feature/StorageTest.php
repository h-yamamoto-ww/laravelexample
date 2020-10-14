<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class StorageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        /* $response = $this->get('/');

        $response->assertStatus(200); */
        $dummy = UploadedFile::fake()->create('dummy.pdf'); // ①

        $dummy->storeAs('', 'dummy.pdf', ['disk' => 'public']); // ②

        $this->markTestIncomplete(
            'このテストは、まだ実装されていません。'
        );
    }
}
