<?php

namespace Tests\Feature;

use App\DTO\RegisterUserDTO;
use App\Events\UserRegistered;
use App\Listeners\SendVerificationEmail;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Services\Auth\RegisterService;
use App\Services\Auth\VerificationLinkGenerator;
use App\Services\EventDispatchService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use ReflectionMethod;
use Tests\Interface\MethodsInterfaceTest;
use Tests\TestCase;
use Tests\Traits\MethodsTestTrait;

class RegisterServiceTest extends TestCase implements MethodsInterfaceTest
{
    use MethodsTestTrait;
    public $class_name = RegisterService::class;

    protected RegisterUserDTO $user_data;
    protected string $expected_link;
    protected $verification_link_generator;
    protected EventDispatchService $event_dispatcher;
    protected $user_service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user_data = new RegisterUserDTO(
            'Rainer Zufall',
            'rainer.zufall@example.com',
            '12345678',
        );

        $this->expected_link = 'http://example.com/verify/unit-test';

        $this->verification_link_generator = $this->createMock(VerificationLinkGenerator::class);
        $this->verification_link_generator->method('forUser')
            ->willReturnCallback(function ($user_id) {
                $this->assertIsInt($user_id);
                return $this->expected_link;
            });

        $this->event_dispatcher = app()->make(EventDispatchService::class);

        $this->user_service = app()->make(\App\Services\UserService::class);
    }

    protected function tearDown(): void
    {
        User::truncate();
        parent::tearDown();
    }

    public static function methodsDataProvider()
    {
        return [
            'register' => [
                'register',
                ReflectionMethod::IS_PUBLIC
            ],
        ];
    }

    public function testRegisterCreatesUserWithCorrectData()
    {
        $service = new RegisterService(
            $this->verification_link_generator,
            $this->event_dispatcher,
            $this->user_service
        );
        $user = $service->register($this->user_data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertIsInt($user->id);
        $this->assertEquals($this->user_data->name, $user->name);
        $this->assertEquals($this->user_data->email, $user->email);
        $this->assertTrue(Hash::check($this->user_data->password, $user->password));
    }

    public function testRegisterDispatchesUserRegisteredEvent()
    {
        $service = new RegisterService(
            $this->verification_link_generator,
            $this->event_dispatcher,
            $this->user_service
        );
        Event::fake(UserRegistered::class);
        $user = $service->register($this->user_data);

        Event::assertDispatched(UserRegistered::class, function ($event) use ($user) {
            return $event->user->id === $user->id
                && $event->url === $this->expected_link;
        });

        Event::assertListening(UserRegistered::class, SendVerificationEmail::class);
    }

    public function testUserRegisteredEventTriggersVerificationEmail()
    {
        Mail::fake();

        $user = new User($this->user_data->toArray());
        $user->id = 1;

        $event = new UserRegistered($user, $this->expected_link);
        $listener = new SendVerificationEmail();

        $listener->handle($event);

        Mail::assertSent(VerifyMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email) &&
                $mail->user->id === $user->id &&
                $mail->url === $this->expected_link;
        });

        Mail::assertSent(VerifyMail::class, 1);
    }
}
