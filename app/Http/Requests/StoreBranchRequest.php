<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'business_id' => 'required',
            // 'images.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048', // allow only jpeg, png, jpg, gif images with max size of 2MB
            'working_days' => 'required|array',
            // 'working_days.*.day' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            // 'working_days.*.start_time' => 'required|string|date_format:H:i',
            // 'working_days.*.end_time' => 'required|string|date_format:H:i|after:working_days.*.start_time',
        ];
    }
}
