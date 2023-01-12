<?php

namespace App\Http\Requests\Api\Vacation;

use Awesome\Rest\Requests\AbstractFormRequest;

class FindRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'active_only_employees' => 'filled|bool'
        ];
    }
}
