<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_requires_a_correct_captcha(): void
    {
        $user = User::factory()->create(['email' => 'login@example.com']);

        $this->withSession(['login_captcha_answer' => 7])
            ->post(route('login.attempt'), [
                'email' => $user->email,
                'password' => 'password',
                'captcha_answer' => 8,
            ])
            ->assertSessionHasErrors(['captcha_answer' => 'Jawaban CAPTCHA salah.']);

        $this->assertGuest();
    }

    public function test_login_succeeds_with_a_correct_captcha(): void
    {
        $user = User::factory()->create(['email' => 'login@example.com']);

        $this->withSession(['login_captcha_answer' => 7])
            ->post(route('login.attempt'), [
                'email' => $user->email,
                'password' => 'password',
                'captcha_answer' => 7,
            ])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }
}
