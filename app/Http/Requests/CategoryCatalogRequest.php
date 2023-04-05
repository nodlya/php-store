<?php

namespace App\Http\Requests;

use App\Rules\CategoryParent;
use Illuminate\Foundation\Http\FormRequest;

class CategoryCatalogRequest extends FormRequest
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
    public function rules() {
        switch ($this->method()) {
            case 'POST':
                return [
                    'parent_id' => 'required|regex:~^[0-9]+$~',
                    'name' => 'required|max:100',
                    'slug' => 'required|max:100|unique:categories,slug|regex:~^[-_a-z0-9]+$~i',
                    'image' => 'mimes:jpeg,jpg,png|max:5000'
                ];
            case 'PUT':
            case 'PATCH':
                // получаем объект модели категории из маршрута: admin/category/{category}
                $model = $this->route('category');
                $id = $model->id;
                return [
                    // задаем правило валидации, что категорию не пытаются поместить внутрь себя
                    'parent_id' => ['required', 'regex:~^[0-9]+$~', new CategoryParent($model)],
                    'name' => 'required|max:100',
                    'slug' => 'required|max:100|unique:categories,slug,'.$id.',id|regex:~^[-_a-z0-9]+$~i',
                    'image' => 'mimes:jpeg,jpg,png|max:5000'
                ];
        }
    }
}
