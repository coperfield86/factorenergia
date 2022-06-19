<?php

declare(strict_types=1);

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

final class SearchQuestionsLaravelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Tagged' => 'required',
            'Todate' => '',
            'Fromdate' => '',
        ];
    }

}
