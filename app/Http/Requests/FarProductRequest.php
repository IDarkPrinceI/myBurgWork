<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FarProductRequest extends FormRequest
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
            'title' => 'min:5|required|unique:products,title,' . $this->route('product'),
            'img' => 'image|image|mimes:jpeg,png,jpg|max:2024',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'old_price' => 'integer|nullable'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Название - обязательная графа',
            'title.unique' => 'Такое название уже используется',
            'title.min' => 'Название должно быть не короче 5 символов',
            'img.mimes' => 'Изображение должно иметь формат jpeg, png, jpg',
            'img.image' => 'Загружаемый файл должен быть изображением',
            'img.max' => 'Загружаемое изображение должно быть меньшего размера',
            'category_id.required' => 'Категория - обязательная графа',
            'description.required' => 'Описание - обязательная графа',
            'price.integer' => 'Поле "цена" должно быть числом',
            'price.required' => 'Цена - обязательная графа',
            'old_price.integer' => 'Поле "старая цена" должно быть числом'
        ];
    }
}
