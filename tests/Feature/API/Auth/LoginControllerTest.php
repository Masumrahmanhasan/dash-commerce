<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

beforeEach(function () {
    if (!defined('LARAVEL_START')) {
        define('LARAVEL_START', microtime(true));
    }
});

it('returns a token on successful login', function () {
    // Create a user for testing
    User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password'), // Hash the password for authentication
    ]);

    // Make a post request to Login
    $response = $this->postJson('/api/auth/login', [
        'email' => 'test@example.com',
        'password' => 'password', // Use the plain password
    ]);

    // Assert the response is successful and has a token
    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
        $json->whereType('data.access_token', 'string')
            ->where('data.token_type', 'bearer')
            ->has('data.expires_in')
            ->etc()
        );
});

it('fails to login with incorrect credentials', function () {
    // Create a user but with a different password
    User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    // Attempt to login with incorrect password
    $response = $this->postJson('/api/auth/login', [
        'email' => 'test@example.com',
        'password' => 'wrong-password',
    ]);

    // Assert the response returns an unauthorized status
    $response->assertStatus(401);
    expect($response->json('message'))->toBeString(Lang::get('auth.failed'));
});
