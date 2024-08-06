<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderIntentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Assure-toi que la logique d'autorisation est appropriée
    }

    public function rules(): array
    {
        return [
            'order_intent_price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'order_intent_type' => [
                'required',
                'string',
                'in:product,service,subscription', // Ajoute les types acceptables
            ],
            'user_email' => [
                'required',
                'email',
                'max:255',
            ],
            'user_phone' => [
                'required',
                'string',
                'regex:/^\+?[1-9]\d{1,14}$/',
            ],
            'expiration_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ];
    }

    public function messages()
    {
        return [
            'order_intent_price.required' => "Le prix de l'ordre est requis.",
            'order_intent_price.numeric' => "Le prix de l'ordre doit être un nombre valide.",
            'order_intent_price.min' => "Le prix de l'ordre doit être zéro ou un montant positif.",

            'order_intent_type.required' => "Le type d'intention de commande est requis.",
            'order_intent_type.string' => "Le type d'intention de commande doit être une chaîne de caractères valide.",
            'order_intent_type.in' => "Le type d'intention de commande doit être l'un des suivants : produit, service, abonnement.",

            'user_email.required' => "L'adresse e-mail est requise.",
            'user_email.email' => "L'adresse e-mail doit être valide.",
            'user_email.max' => "L'adresse e-mail ne peut pas dépasser 255 caractères.",

            'user_phone.required' => "Le numéro de téléphone est requis.",
            'user_phone.string' => "Le numéro de téléphone doit être une chaîne de caractères.",
            'user_phone.regex' => "Le numéro de téléphone doit être au format international valide.",

            'expiration_date.required' => "La date d'expiration est requise.",
            'expiration_date.date' => "La date d'expiration doit être une date valide.",
            'expiration_date.after_or_equal' => "La date d'expiration doit être aujourd'hui ou dans le futur.",
        ];
    }
}
