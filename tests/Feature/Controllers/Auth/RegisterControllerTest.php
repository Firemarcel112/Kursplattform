<?php

namespace Tests\Feature\Controllers\Auth;

use ReflectionMethod;
use App\Enums\HTTPStatus;
use App\Events\UserRegistered;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\Interface\MethodsInterfaceTest;
use Tests\TestCase;
use Tests\Traits\MethodsTestTrait;

class RegisterControllerTest extends TestCase implements MethodsInterfaceTest
{
    use MethodsTestTrait;
    public string $class_name = RegisterController::class;

    public static function invalidRegistrationData()
    {
        return [
            'empty_fields' => [
                [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'terms_of_service' => false,
                ],
                ['name', 'email', 'password', 'terms_of_service'],
            ],
            'invalid_email' => [
                [
                    'name' => 'Test User',
                    'email' => 'invalid-email',
                    'password' => 'Password123!',
                    'terms_of_service' => true,
                ],
                ['email'],
            ],
            'password_too_short' => [
                [
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'password' => 'short',
                    'terms_of_service' => true,
                ],
                ['password'],
            ],
            'terms_not_accepted' => [
                [
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'password' => 'Password123!',
                    'terms_of_service' => false,
                ],
                ['terms_of_service'],
            ],
            'missing_name' => [
                [
                    'email' => 'test@example.com',
                    'password' => 'Password123!',
                    'terms_of_service' => true,
                ],
                ['name'],
            ],
            'missing_email' => [
                [
                    'name' => 'Test User',
                    'password' => 'Password123!',
                    'terms_of_service' => true,
                ],
                ['email'],
            ],
            'missing_password' => [
                [
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'terms_of_service' => true,
                ],
                ['password'],
            ],
            'missing_terms_of_service' => [
                [
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'password' => 'Password123!',
                ],
                ['terms_of_service'],
            ],
        ];
    }
    #endregion
    public static function methodsDataProvider()
    {
        return [
            'index' => [
                'index',
                ReflectionMethod::IS_PUBLIC
            ],
            'store' => [
                'store',
                ReflectionMethod::IS_PUBLIC,
            ],
        ];
    }

    #[Test]
    public function test_can_see_register_page()
    {
        $response = $this->get('register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    #[Test]
    public function test_can_register_user()
    {
        $user_data = [
            'name' => 'featureTestUser',
            'email' => 'exampleUser@' . config('mail.test.domain'),
            'password' => fake()->password(8),
            'terms_of_service' => true,
        ];
        Event::fake();


        $response = $this->post(route('register.store'), $user_data);

        $this->assertDatabaseHas('users', [
            'email' => $user_data['email'],
            'name' => $user_data['name'],
        ]);

        $this->assertAuthenticated();
        Event::assertDispatched(UserRegistered::class);
        $response->assertSessionHas('alerts', [
            [
                'type' => 'success',
                'message' => __('auth.register_success', ['name' => $user_data['name']]),
            ],
        ]);
        $response->assertRedirect(route('home'));
    }

    #[DataProvider('invalidRegistrationData')]
    public function test_registration_fails_with_invalid_data($invalidData, $expectedErrors)
    {
        $response = $this->postJson('register', $invalidData);

        $response->assertStatus(HTTPStatus::UNPROCESSABLE_ENTITY->value); // Validation failed

        foreach ($expectedErrors as $error) {
            $response->assertJsonValidationErrors($error);
        }
    }
}
