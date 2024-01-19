<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthControllerTest extends TestCase
{
	use WithoutMiddleware;

	public function testMustBeAbleToRegisterNewUserSuccessfully()
	{
		$userData = [
			'name' => 'Test User',
			'email' => 'test@example.com',
			'password' => 'password',
			'password_confirmation' => 'password'
		];

		$response = $this->postJson('/api/v1/auth/register', $userData);

		$response->assertStatus(201)
			->assertJsonStructure([
				'status',
				'message',
				'data' => [
					'user' => [
						'id',
						'name',
						'email'
					]
				]
			]);
	}

	public function testMustBeAbleToRegisterNewUserWithExistingEmail()
	{
		$user = User::factory()->create();

		$userData = [
			'name' => 'Test User',
			'email' => $user->email,
			'password' => 'password',
			'password_confirmation' => 'password'
		];

		$response = $this->postJson('/api/v1/auth/register', $userData);

		$response->assertStatus(422);
	}

	public function testMustBeAbleToRegisterNewUserWithInvalidData()
	{
		$userData = [
			'name' => 'Test User',
			'password' => 'password'
		];

		$response = $this->postJson('/api/v1/auth/register', $userData);

		$response->assertStatus(422);
	}

	public function testMustBeAbleToGenerateAccessTokenSuccessfully()
	{
		$user = User::factory()->create();

		$credentials = [
			'email' => $user->email,
			'password' => 'password'
		];

		$response = $this->postJson('/api/v1/auth/token', $credentials);

		$response->assertStatus(200)
			->assertJsonStructure([
				'status',
				'message',
				'data' => [
					'access_token',
					'token_type',
					'user' => [
						'id',
						'name',
						'email'
					]
				]
			]);
	}

	public function testMustBeAbleToGenerateAccessTokenWithInvalidCredentials()
	{
		$credentials = [
			'email' => 'nonexistent@example.com',
			'password' => 'wrongpassword'
		];

		$response = $this->postJson('/api/v1/auth/token', $credentials);

		$response->assertStatus(401);
	}

	public function testMustBeAbleToGenerateAccessTokenWithInvalidData()
	{
		$users = User::factory()->create();

		$credentials = [
			'email' => $users->email
		];

		$response = $this->postJson('/api/v1/auth/token', $credentials);

		$response->assertStatus(422);
	}

	public function testMustBeAbleToRevokeAccessTokenSuccessfully()
	{
		$user = User::factory()->create();
		$token = $user->createToken('auth_token')->plainTextToken;

		$response = $this->actingAs($user)->deleteJson('/api/v1/auth/token');

		$response->assertStatus(204);
	}

	public function testMustBeAbleToRevokeAccessTokenWithoutUser()
	{
		$response = $this->deleteJson('/api/v1/auth/token');

		$response->assertStatus(401);
	}
}
