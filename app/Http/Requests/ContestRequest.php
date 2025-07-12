<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categories_id' => 'required',
            'sub_categories' => 'nullable',
            'post_title' => 'required|max:255',
            'post_teaser' => 'required',
            'post_content' => 'required',
            'slug' => 'unique:posts',
            'level' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'price' => 'nullable',
            'organizer' => 'nullable',
            'status' => 'nullable',
            'location' => 'nullable',
            'payment' => 'nullable',
            'post_image' => 'nullable|image|file|max:1024',
            'post_image_description' => 'nullable',
        ];
    }
}
