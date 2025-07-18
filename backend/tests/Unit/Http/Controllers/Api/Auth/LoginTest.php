<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('authenticates user with valid credentials and returns a token', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson(route('api.login'), [
        'email' => 'user@example.com',
        'password' => 'password123',
    ]);

    $response->assertOk()
        ->assertJsonStructure([
            'access_token',
            'token_type',
        ]);

    expect($user->tokens)->toHaveCount(1);
});

it('fails authentication with invalid credentials', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson(route('api.login'), [
        'email' => 'user@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertUnauthorized()
        ->assertJson([
            'message' => 'Invalid authentication, check your credentials'
        ]);
});

it('validates that email is required', function () {
    $response = $this->postJson(route('api.login'), [
        'password' => 'password123',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

it('validates that email must be a valid email address', function () {
    $response = $this->postJson(route('api.login'), [
        'email' => 'invalid-email',
        'password' => 'password123',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

it('validates that password is required', function () {
    $response = $this->postJson(route('api.login'), [
        'email' => 'user@example.com',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['password']);
});