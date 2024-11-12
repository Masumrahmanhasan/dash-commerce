<?php
declare(strict_types=1);
namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $product = $this->route('product');
        return $this->user()->can('update', $product);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable'], // Just for demo, added image as a URL
            // Ensure that the slug is not updated, and skip validation for it
            'slug' => ['nullable', Rule::in([$product->slug])], // Ensures the slug is unchanged
        ];
    }
}
