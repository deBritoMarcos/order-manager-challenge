<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('revokes the current user token on logout', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->postJson(route('api.logout'));

    $response->assertOk();
    expect($user->tokens)->toHaveCount(0);
});