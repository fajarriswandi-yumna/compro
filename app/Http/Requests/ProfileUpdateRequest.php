<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check(); // Hanya user yang login yang boleh update profile
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'], // Validasi nama (wajib, string, maks 255 karakter)
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)], // Validasi email (wajib, email, maks 255, unik di tabel users kecuali email user ini sendiri)
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar profil (opsional, image, tipe mimes, maks 2MB)
        ];
    }
}