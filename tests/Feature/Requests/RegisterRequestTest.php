<?php

namespace Tests\Feature\Requests;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;


class RegisterRequestTest extends TestCase
{

    public static function validationDataProvider()
    {
        return [
            'missing fields' => [
                [],
                [
                    [
                        'field' => 'name',
                        'message' => [
                            'key' => 'validation.required',
                            'parameters' => ['attribute' => 'general.name|trans'],
                        ]
                    ],
                    [
                        'field' => 'email',
                        'message' => [
                            'key' => 'validation.required',
                            'parameters' => ['attribute' => 'general.email|trans'],
                        ]
                    ],
                    [
                        'field' => 'password',
                        'message' => [
                            'key' => 'validation.required',
                            'parameters' => ['attribute' => 'general.password|trans'],
                        ]
                    ],
                    [
                        'field' => 'terms_of_service',
                        'message' => [
                            'key' => 'validation.required',
                            'parameters' => ['attribute' => 'general.terms_of_service|trans'],
                        ]
                    ]
                ]
            ],
            'email is not valid' => [
                [
                    'name' => 'Testuser',
                    'email' => 'testmail',
                    'password' => 'Password123!',
                    'terms_of_service' => true,
                ],
                [
                    [
                        'field' => 'email',
                        'message' => [
                            'key' => 'validation.email',
                            'parameters' => ['attribute' => 'general.email|trans'],
                        ]
                    ]
                ]
            ]
        ];
    }

    #[DataProvider('validationDataProvider')]
    public function test_invalid_validation(
        array $data,
        array $fields,
    ) {
        $request_class = RegisterRequest::class;

        $request = new $request_class($data);

        $validator = Validator::make(
            $request->all(),
            (new $request_class)->rules(),
            (new $request_class)->messages(),
            (new $request_class)->attributes()
        );

        foreach ($fields as $field) {
            $field_name = $field['field'];
            $message = $field['message']['key'];
            $parameters = $field['message']['parameters'];
            foreach ($parameters as $key => $value) {
                if (str_ends_with($value, '|trans')) {
                    $cleaned_value = str_replace('|trans', '', $value);
                    $parameters[$key] = __($cleaned_value);
                }
            }
            $this->assertTrue($validator->errors()->has($field_name));
            $this->assertStringContainsString(__($message, $parameters), $validator->errors()->first($field_name));
        }
    }
}
