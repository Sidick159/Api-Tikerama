<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'order_intent_id' => 'required',
            'order_number' => 'required|string|max:50',
            'order_event_id' => 'required|integer|exists:events,id',
            'order_payment' => 'required|string|max:100',
            'order_info' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'order_intent_id.required' => 'L\'id de l\'intention de commande est requis.',

            'order_number.required' => 'Le numéro de commande est requis.',
            'order_number.string' => 'Le numéro de commande doit être une chaîne de caractères.',
            'order_number.max' => 'Le numéro de commande ne peut pas dépasser 50 caractères.',

            'order_event_id.required' => 'L\'ID de l\'événement est requis.',
            'order_event_id.integer' => 'L\'ID de l\'événement doit être un entier.',
            'order_event_id.exists' => 'L\'ID de l\'événement doit exister dans la table des événements.',

            'order_price.required' => 'Le prix de la commande est requis.',
            'order_price.numeric' => 'Le prix de la commande doit être un nombre.',
            'order_price.min' => 'Le prix de la commande ne peut pas être négatif.',
            'order_price.max' => 'Le prix de la commande ne peut pas dépasser 10 chiffres.',

            'order_type.required' => 'Le type de commande est requis.',
            'order_type.string' => 'Le type de commande doit être une chaîne de caractères.',
            'order_type.max' => 'Le type de commande ne peut pas dépasser 50 caractères.',

            'order_payment.required' => 'Le mode de paiement est requis.',
            'order_payment.string' => 'Le mode de paiement doit être une chaîne de caractères.',
            'order_payment.max' => 'Le mode de paiement ne peut pas dépasser 100 caractères.',

            'order_info.string' => 'Les informations de la commande doivent être une chaîne de caractères.',

            'order_created_on.required' => 'La date et l\'heure de création de la commande sont requises.',
            'order_created_on.date_format' => 'La date et l\'heure de création doivent être au format YYYY-MM-DD HH:MM:SS.',
        ];
    }
}
