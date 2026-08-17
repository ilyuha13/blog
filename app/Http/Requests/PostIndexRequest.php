<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'limit' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'offset' => ['sometimes', 'integer', 'min:0'],

            'date_from' => ['sometimes', 'date'],
            'date_to' => ['sometimes', 'date', 'after_or_equal:date_from'],

            'sort_by' => [
                'sometimes',
                'string',
                Rule::in(['created_at', 'title']),
            ],

            'sort_direction' => [
                'sometimes',
                'string',
                Rule::in(['asc', 'desc']),
            ],
        ];
    }

    public function limit(): int
    {
        return $this->validated('limit', 10);
    }

    public function offset(): int
    {
        return $this->validated('offset', 0);
    }

    public function dateFrom(): ?string
    {
        return $this->validated('date_from');
    }

    public function dateTo(): ?string
    {
        return $this->validated('date_to');
    }

    public function sortBy(): string
    {
        return $this->validated('sort_by', 'created_at');
    }

    public function sortDirection(): string
    {
        return $this->validated('sort_direction', 'desc');
    }

}
