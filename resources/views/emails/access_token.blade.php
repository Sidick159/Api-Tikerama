<x-mail::message>

<p>Bonjour {{ $user->fname }} {{ $user->lname }},</p>

<p>Vous pouvez maintenant utiliser notre API avec le token d'accès suivant :</p>

<p><strong>{{ $token }}</strong></p>

<p>Pour utiliser l'API, ajoutez ce token dans l'en-tête `Authorization` de vos requêtes HTTP comme suit :</p>

<pre>Authorization: Bearer {{ $token }}</pre>

<p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>

Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>
