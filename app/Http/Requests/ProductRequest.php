<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'product' => 'required|string',
            'brand' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ];
    }


    protected function prepareForValidation(): void
    {
        if ($this->has('price')) {
            $price = str_replace('.', '', $this->price); // elimina puntos de miles
            $price = str_replace(',', '.', $price); // cambia coma por punto decimal

            $this->merge([
                'price' => $price,
            ]);
        }
    }
}
