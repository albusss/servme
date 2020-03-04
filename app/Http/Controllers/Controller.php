<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Factory;
use KamranAhmed\Faulty\Exceptions\BadRequestException;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $validator;

    /**
     * TodoController constructor.
     *
     * @param \Illuminate\Contracts\Validation\Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validate given data with rules.
     *
     * @param mixed[] $data
     * @param mixed[] $rules
     *
     * @return void
     *
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     */
    protected function validateRequest(array $data, array $rules): void
    {
        $validator = $this->validator->make($data, $rules);

        if ($validator->fails()) {
            throw new BadRequestException($validator->errors(), 'Given data is invalid', 422);
        }
    }
}
