<?php

namespace App\Http\Requests;

use App\Support\Cart;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Controle van het aantal bij "In winkelwagen" en bij het aanpassen van het aantal in de winkelwagen.
 * Bij toevoegen moet het aantal minstens 1 zijn; bij aanpassen mag 0 (dan gaat het product eruit).
 */
class CartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $minimum = $this->isMethod('patch') ? 0 : 1;

        return [
            'aantal' => ['required', 'integer', 'min:'.$minimum, 'max:'.Cart::MAX_QUANTITY],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'aantal.required' => 'Vul een aantal in.',
            'aantal.integer' => 'Het aantal moet een heel getal zijn.',
            'aantal.min' => 'Het aantal moet minstens :min zijn.',
            'aantal.max' => 'U kunt maximaal :max stuks van één product bestellen.',
        ];
    }

    /** Zonder aantal (bijvoorbeeld de knop op een productkaart) voegen we er 1 toe. */
    protected function prepareForValidation(): void
    {
        if (! $this->has('aantal') && $this->isMethod('post')) {
            $this->merge(['aantal' => 1]);
        }
    }
}
