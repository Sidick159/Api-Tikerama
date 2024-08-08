<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AccessTokenMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/getAccessCredentials', function (Request $request) {
    $validated = $request->validate([
        'fname' => 'required|string|max:255',
        'lname' => 'required|string|max:255',
        'entreprise' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'city' => 'required|string|max:255',
        'address' => 'required|string|max:255',
    ], [
        'lname.required' => 'Le prénom est obligatoire.',
        'lname.string' => 'Le prénom doit être une chaîne de caractères.',
        'lname.max' => 'Le prénom ne peut pas dépasser 255 caractères.',
        'fname.required' => 'Le nom est obligatoire.',
        'fname.string' => 'Le nom doit être une chaîne de caractères.',
        'fname.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        'entreprise.required' => 'Le nom de l\'entreprise est obligatoire.',
        'entreprise.string' => 'Le nom de l\'entreprise doit être une chaîne de caractères.',
        'entreprise.max' => 'Le nom de l\'entreprise ne peut pas dépasser 255 caractères.',
        'email.required' => 'L\'adresse email est obligatoire.',
        'email.email' => 'L\'adresse email doit être une adresse email valide.',
        'email.unique' => 'Cette adresse email est déjà utilisée.',
        'city.required' => 'La ville est obligatoire.',
        'city.string' => 'La ville doit être une chaîne de caractères.',
        'city.max' => 'La ville ne peut pas dépasser 255 caractères.',
        'address.required' => 'L\'adresse est obligatoire.',
        'address.string' => 'L\'adresse doit être une chaîne de caractères.',
        'address.max' => 'L\'adresse ne peut pas dépasser 255 caractères.',
    ]);

    // Créer un utilsiateur
    $user = User::create([
        'fname' => $request->input('fname'),
        'lname' => $request->input('lname'),
        'entreprise' => $request->input('entreprise'),
        'email' => $request->input('email'),
        'city' => $request->input('city'),
        'address' => $request->input('address'),
        // 'addressIP' => $request->ip(),
        // On pourrait ajouter ce champ pour verifier qu'un utilisateur à déjà fait une demande d'accès et ç reçu un token
    ]);

    // Créer un token d'accès
    $token = $user->createToken('ApiAccessToken')->plainTextToken;

    // Envoie de l'email à l'utilisateur
    Mail::to($user->email)->send(new AccessTokenMail($token, $user));

    Alert::success('Votre demande à bien été pris en compte un email vous à été envoyé avec le token d\'utilisation de l\'api');
    return view('documentation');
});
