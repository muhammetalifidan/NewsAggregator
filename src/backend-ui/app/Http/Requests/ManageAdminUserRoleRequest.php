<?php

namespace App\Http\Requests;

use App\Enum\RoleType;
use Illuminate\Foundation\Http\FormRequest;

class ManageAdminUserRoleRequest extends FormRequest
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
            'role' => ['required', 'in:' . implode(',', array_column(RoleType::cases(), 'value'))]
        ];
    }
}
