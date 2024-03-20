<?php

namespace Tests\Feature\API\Functionalities;

use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);

//Green Phase
test('that mock results can be retrieved', function (){
    $response = $this->getJson('/api/mock-results', [
        'job-id' => 'BdGyuedyVouWNJtYJ6vllp43QKuv4TIo'
    ]);

    $response->assertStatus(200)->assertInvalid()->assertJsonFragment([
        'success' => true,
        'message' => 'mock result retrieved',
        'data' => []
    ]);
});
