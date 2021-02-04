<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FarCategoryRequest extends FormRequest
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
            'title' => 'required|unique:categories,title,' . $this->route('category'),
            'img' => 'image|image|mimes:jpeg,png,jpg|max:2024'
                ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Название обязательная графа',
            'title.unique' => 'Такое название уже используется',
            'title.min' => 'Название должно быть не короче 4 символов',
            'img.mimes' => 'Изображение должно иметь формат jpeg, png, jpg',
            'img.image' => 'Загружаемый файл должен быть изображением',
            'img.max' => 'Загружаемое изображение должно быть меньшего размера'
        ];
    }
}
