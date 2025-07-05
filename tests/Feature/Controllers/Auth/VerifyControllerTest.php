<?php

namespace Tests\Feature\Controllers\Auth;

use ReflectionMethod;
use App\Enums\HTTPStatus;
use App\Http\Controllers\Auth\VerifyController;
use App\Models\User;
use App\Services\Auth\VerificationLinkGenerator;
use Illuminate\Support\Facades\URL;
use Tests\Interface\MethodsInterfaceTest;
use Tests\TestCase;
use Tests\Traits\MethodsTestTrait;

class VerifyControllerTest extends TestCase implements MethodsInterfaceTest
{
    use MethodsTestTrait;
    public string $class_name = VerifyController::class;

    public static function methodsDataProvider()
    {
        return [
            'email' => [
                'email',
                ReflectionMethod::IS_PUBLIC
            ],
        ];
    }

    public function test_user_can_verify_email()
    {
        $user = User::factory()
            ->unverified()
            ->create();

        $verification_link_generator = app()->make(VerificationLinkGenerator::class);

        $verify_url = $verification_link_generator->forUser($user->id, 'verify.email');

        $response = $this->get($verify_url);

        $response->assertRedirect('');
    }

    public function test_user_is_already_verified()
    {
        $user = User::factory()
            ->create([
                'email_verified_at' => now(),
            ]);
        session()->forget('alerts');

        $verification_link_generator = app()->make(VerificationLinkGenerator::class);

        $verify_url = $verification_link_generator->forUser($user->id, 'verify.email');

        $response = $this->get($verify_url);

        $response->assertSessionHas('alerts', [
            [
                'type' => 'info',
                'message' => __('verification.email_already_verified'),
            ],
        ]);

        $this->assertTrue($user->hasVerifiedEmail());
    }

    public function test_invalid_verification_link()
    {
        $user = User::factory()
            ->unverified()
            ->create();

        $invalid_verify_url = URL::temporarySignedRoute(
            'verify.email',
            now()->addMinutes(60),
            ['id' => $user->id + 1]
        );

        $response = $this->get($invalid_verify_url);

        $response->assertStatus(HTTPStatus::FORBIDDEN->value);
    }

    public function test_expired_verification_link()
    {
        $user = User::factory()
            ->unverified()
            ->create();

        $expired_verify_url = URL::temporarySignedRoute(
            'verify.email',
            now()->subMinutes(61),
            ['id' => $user->id]
        );

        $response = $this->get($expired_verify_url);

        $response->assertStatus(HTTPStatus::FORBIDDEN->value);
    }

    public function test_invalid_signature_without_middleware()
    {
        $this->withoutMiddleware();
        $user = User::factory()
            ->unverified()
            ->create();

        $invalid_signature_url = route('verify.email', ['id' => $user->id]) . '?signature=invalid';

        $response = $this->get($invalid_signature_url);

        $response->assertStatus(HTTPStatus::UNAUTHORIZED->value);
    }
}
