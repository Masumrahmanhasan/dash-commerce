<?php
declare(strict_types=1);
namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Product::class);
    }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, ValidationRule|array|string>
         */
        public function rules(): array
        {
            return [
                'name' => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string'],
                'price' => ['required', 'numeric'],
                'stock' => ['required', 'integer', 'min:1'],
                'category_id' => ['required', 'exists:categories,id'],
                'image' => ['nullable'], // just for demo added image as a url
                'slug' => ['nullable', 'string', Rule::unique('products', 'slug')],
            ];
        }

        protected function prepareForValidation(): void
        {
            $this->merge([
                'slug' => Str::slug($this->input('name')).' - '.Str::random(5)
            ]);
        }
}
