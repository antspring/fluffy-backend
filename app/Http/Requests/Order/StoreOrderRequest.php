<?php

namespace App\Http\Requests\Order;

use App\Models\Product\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
            'completion_datetime' => [
                'nullable',
                'date_format:Y-m-d H:i',
                Rule::date()->after(now()),
            ],
            'products' => 'required|array',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $productIds = collect($this->products)->pluck('id')->all();

            $products = Product::whereIn('id', $productIds)->pluck('amount', 'id');

            foreach ($this->products as $item) {
                $quantity = $products[$item['id']] ?? null;
                if ($quantity !== null && $item['quantity'] > $quantity) {
                    $validator->errors()->add(
                        "products.{$item['id']}.quantity",
                        "The product {$item['id']} quantity must be less than or equal to {$quantity}"
                    );
                }
            }
        });
    }
}
