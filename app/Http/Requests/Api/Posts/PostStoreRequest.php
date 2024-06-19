<?php

namespace App\Http\Requests\Api\Posts;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'desc.required' => 'The description field is required.',
            // Add other custom messages as needed
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        $response = response()->json([
            'status' => 400,
            'message' => 'Validation errors',
            'errors' => $errors,
        ], 400);

        throw new HttpResponseException($response);
    }
}
