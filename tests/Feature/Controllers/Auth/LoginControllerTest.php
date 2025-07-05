<?php

namespace Tests\Feature\Controllers\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use ReflectionMethod;
use Tests\Interface\MethodsInterfaceTest;
use Tests\TestCase;
use Tests\Traits\MethodsTestTrait;

class LoginControllerTest extends TestCase implements MethodsInterfaceTest
{
    use MethodsTestTrait;
    public string $class_name = LoginController::class;

    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'testuser',
            'password' => bcrypt('password123'),
        ]);
    }

    public static function methodsDataProvider()
    {
        return [
            'index' => [
                'index',
                ReflectionMethod::IS_PUBLIC,
            ],
            'store' => [
                'store',
                ReflectionMethod::IS_PUBLIC
            ],
            'logout' => [
                'logout',
                ReflectionMethod::IS_PUBLIC
            ],
        ];
    }


    public function test_can_see_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_redirect_authenticated_user_from_login_page()
    {
        $this->actingAs($this->user);

        $response = $this->get('/login');

        $response->assertRedirect(route('home'));
    }

    public function test_user_can_login_with_valid_credentials()
    {

        $response = $this->post('/login', [
            'name' => 'testuser',
            'password' => 'password123',
        ]);

        $response->assertRedirect('');
        $this->assertAuthenticatedAs($this->user);
    }

    public function test_user_cannot_login_with_valid_credentials()
    {
        $response = $this->post('/login', [
            'name' => 'testuser',
            'password' => 'password124',
        ]);

        $response->assertRedirectBack();
        $response->assertSessionHas('alerts', [
            [
                'type' => 'danger',
                'message' => __('auth.login_failed'),
            ]
        ]);
        $this->assertGuest();
    }

    public function test_user_can_logout()
    {
        $response = $this->actingAs($this->user)
            ->get('logout');

        $response->assertRedirect('');
        $this->assertGuest();
    }
}
