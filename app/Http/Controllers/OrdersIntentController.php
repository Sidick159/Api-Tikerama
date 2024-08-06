<?php

namespace App\Http\Controllers;

use App\Models\OrdersIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreOrderIntentRequest;

class OrdersIntentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Définir les règles de validation
        $rules = [
            'order_intent_price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'order_intent_type' => [
                'required',
                'string',
                // 'in:product,service,subscription',
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

        // Définir les messages d'erreur
        $messages = [
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

        // Créer un validateur
        $validator = Validator::make($request->all(), $rules, $messages);

        // Vérifier si la validation échoue

        if ($validator->fails()) {
            // Extraire les messages d'erreur
            $errors = $validator->errors()->all();

            // Retourner les messages d'erreur sous forme de tableau simple
            return response()->json([
                'errors' => $errors
            ], 422);
        }

        // Extraire les données validées
        $validatedData = $validator->validated();

        // Créer une nouvelle instance de OrdersIntent avec les données validées
        $orderIntent = OrdersIntent::create($validatedData);

        // Retourner une réponse JSON en cas de succès
        return response()->json([
            'message' => 'Réservation créée avec succès.',
            'data' => $orderIntent
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(OrdersIntent $ordersIntent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdersIntent $ordersIntent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrdersIntent $ordersIntent)
    {
        return response()->json($ordersIntent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdersIntent $ordersIntent)
    {
        //
    }
}
