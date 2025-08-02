<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $isUpdate = $this->routeIs('posts.update') ? 'nullable' : 'required|mimes:jpg,jpeg,png,gif,webp|max:2048';
        return [
            'title' => 'required',
            'content' => 'required',
            'image' => $isUpdate,
            'status'=> ['required',Rule::in(array_column(PostStatus::cases(), 'value'))],
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'content.required' => 'The content field is required.',
            'image.required' => 'The image field is required.',
            'category_id.required' => 'The category field is required.',
            'tag_id.required' => 'The tag field is required.',
        ];
    }
}
