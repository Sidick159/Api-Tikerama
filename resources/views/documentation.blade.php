<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation API Tikerama</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .code-block {
            background-color: #f7f7f7;
            border: 1px solid #e1e1e1;
            border-radius: 4px;
            padding: 1rem;
            font-family: 'Courier New', Courier, monospace;
        }
        .code-block pre {
            margin: 0;
            padding: 0;
        }
        .example-request, .example-response {
            border-radius: 0.375rem;
        }
        .example-request {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
        }
        .example-response {
            background-color: #f0fdfa;
            border-left: 4px solid #34d399;
        }
        .section-title {
            border-bottom: 2px solid #e5e7eb;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="container mx-auto p-8 max-w-4xl">
        <!-- Header -->
        <img src="{{asset('logo-tikerama.png')}}" alt="logo-tikerama" style="height: 3rem;">
        <header class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-900">Documentation API Tikerama</h1>
            <p class="mt-2 text-xl text-gray-600">Découvrez toutes les fonctionnalités de notre API pour la gestion des événements et des commandes.</p>
        </header>

        <!-- Introduction Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-4 section-title pb-2">Introduction</h2>
            <p class="text-gray-700 mb-4">L'API TIKERAMA permet de :</p>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>Consulter la liste des événements en cours : Pagination incluse.</li>
                <li>Consulter la liste des types de tickets disponibles pour un événement donné.</li>
                <li>Créer une intention de commande.</li>
                <li>Valider une intention de commande : avec une URL pour télécharger les tickets de la commande.</li>
                <li>Consulter toutes les commandes effectuées par le client (utilisateur de l’API).</li>
            </ul>
        </section>

        <!-- Utilisation Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-4 section-title pb-2">Utilisation</h2>
            <p class="text-gray-700 mb-4">Pour utiliser cette API :</p>
            <ol class="list-decimal list-inside text-gray-600 mb-4">
                <li>Faire une demande d'accès : Accédez à la page web d'accueil pour faire une demande d'accès.</li>
                <li>Recevoir un Token Bearer : Vous recevrez un token Bearer par email après votre demande d'accès.</li>
                <li>Utiliser le Token Bearer : Incluez ce token Bearer dans l'en-tête de vos requêtes API pour l'authentification.</li>
            </ol>
            <p class="mt-4 text-gray-600"><strong>Remarque :</strong> Assurez-vous que la configuration du serveur de messagerie est correcte pour permettre l'envoi des emails par l'application.</p>
        </section>

        <!-- Points à Vérifier Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-4 section-title pb-2">Points à Vérifier</h2>
            <p class="text-gray-700 mb-4">Envoi d'Emails : Vérifiez que la configuration du serveur de mail est fonctionnelle pour l'envoi de tokens par email. Cela inclut la configuration des paramètres SMTP dans .env et la vérification des logs pour les erreurs potentielles d'envoi d'email.</p>
        </section>

        <!-- Endpoints Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-4 section-title pb-2">Endpoints</h2>

            <!-- GET Liste des évènements en cours -->
            <div class="mb-8 p-6 bg-white shadow rounded-lg">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">GET Liste des évènements en cours</h3>
                <p class="text-gray-600 mb-2"><strong>URL:</strong> <a href="http://127.0.0.1:8200/api/events" class="text-blue-600 hover:underline">http://127.0.0.1:8200/api/events</a></p>
                <p class="text-gray-600 mb-4"><strong>Description:</strong> Consulte la liste des événements en cours.</p>
                <div class="example-request p-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Request</h4>
                    <pre class="code-block"><code>curl --location 'http://127.0.0.1:8200/api/events'</code></pre>
                </div>
                <div class="example-response p-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Response</h4>
                    <pre class="code-block"><code>Réponse : Pas de corps de réponse</code></pre>
                </div>
            </div>

            <!-- GET Liste des types de tickets disponibles pour un évènement -->
            <div class="mb-8 p-6 bg-white shadow rounded-lg">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">GET Liste des types de tickets disponibles pour un évènement</h3>
                <p class="text-gray-600 mb-2"><strong>URL:</strong> <a href="http://127.0.0.1:8200/api/ticket-types/2" class="text-blue-600 hover:underline">http://127.0.0.1:8200/api/ticket-types/2</a></p>
                <p class="text-gray-600 mb-4"><strong>Description:</strong> Consulte la liste des types de tickets pour un événement donné.</p>
                <p class="text-gray-600 mb-4"><strong>AUTHORIZATION:</strong> Bearer Token</p>
                <div class="example-request p-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Request</h4>
                    <pre class="code-block"><code>curl --location 'http://127.0.0.1:8200/api/ticket-types/2' \
--header 'Authorization: Bearer &lt;token&gt;'</code></pre>
                </div>
                <div class="example-response p-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Response</h4>
                    <pre class="code-block"><code>Réponse : Pas de corps de réponse</code></pre>
                </div>
            </div>

            <!-- POST Créer une intention de commande -->
            <div class="mb-8 p-6 bg-white shadow rounded-lg">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">POST Créer une intention de commande</h3>
                <p class="text-gray-600 mb-2"><strong>URL:</strong> <a href="http://127.0.0.1:8200/api/orders-intents" class="text-blue-600 hover:underline">http://127.0.0.1:8200/api/orders-intents</a></p>
                <p class="text-gray-600 mb-4"><strong>Description:</strong> Créer une intention de commande représentant des réservations temporaires de tickets effectuées par les utilisateurs avant la confirmation finale de la commande.</p>
                <p class="text-gray-600 mb-4"><strong>AUTHORIZATION:</strong> Bearer Token</p>
                <div class="example-request p-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Request</h4>
                    <pre class="code-block"><code>curl --location 'http://127.0.0.1:8200/api/orders-intents' \
--form 'order_intent_price="6000"' \
--form 'order_intent_type="possimus"' \
--form 'user_email="hshobbes7@gmail.com"' \
--form 'user_phone="+2250768250147"' \
--form 'expiration_date="2024-08-31 18:44:37"' \
--header 'Authorization: Bearer &lt;token&gt;'</code></pre>
                </div>
                <div class="example-response p-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Response</h4>
                    <pre class="code-block"><code>Réponse : Pas de corps de réponse</code></pre>
                </div>
            </div>

            <!-- POST Valider une intention de commande -->
            <div class="mb-8 p-6 bg-white shadow rounded-lg">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">POST Valider une intention de commande</h3>
                <p class="text-gray-600 mb-2"><strong>URL:</strong> <a href="http://127.0.0.1:8200/api/orders" class="text-blue-600 hover:underline">http://127.0.0.1:8200/api/orders</a></p>
                <p class="text-gray-600 mb-4"><strong>Description:</strong> Validation finale des commandes.</p>
                <div class="example-request p-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Request</h4>
                    <pre class="code-block"><code>curl --location 'http://127.0.0.1:8200/api/orders' \
--data '[
    {"key":"order_payment","value":"mobile money","type":"text","enabled":true},
    {"key":"order_info","value":"eubydy ud ehd ehdedhne deude hd ebduen dh ","description":"","type":"text","enabled":true},
    {"key":"order_created_on","value":"2024-08-31 18:44:37","description":"","type":"text","enabled":true},
    {"key":"order_intent_id","value":"1","type":"text","enabled":true},
    {"key":"order_number","value":"15","type":"text","enabled":true},
    {"key":"order_event_id","value":"1","type":"text","enabled":true}
]'</code></pre>
                </div>
                <div class="example-response p-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Response</h4>
                    <pre class="code-block"><code>Réponse : Pas de corps de réponse</code></pre>
                </div>
            </div>

            <!-- GET Liste des commandes par utilisateur -->
            <div class="mb-8 p-6 bg-white shadow rounded-lg">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">GET Liste des commandes par utilisateur</h3>
                <p class="text-gray-600 mb-2"><strong>URL:</strong> <a href="http://127.0.0.1:8200/api/orders/1" class="text-blue-600 hover:underline">http://127.0.0.1:8200/api/orders/1</a></p>
                <p class="text-gray-600 mb-4"><strong>Description:</strong> Liste de toutes les commandes effectuées par le client.</p>
                <p class="text-gray-600 mb-4"><strong>AUTHORIZATION:</strong> Bearer Token</p>
                <div class="example-request p-4 mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Request</h4>
                    <pre class="code-block"><code>curl --location 'http://127.0.0.1:8200/api/orders/1' \
--header 'Authorization: Bearer &lt;token&gt;'</code></pre>
                </div>
                <div class="example-response p-4">
                    <h4 class="text-lg font-semibold text-gray-800">Example Response</h4>
                    <pre class="code-block"><code>Réponse : Pas de corps de réponse</code></pre>
                </div>
            </div>
        </section>
    </div>

    {{-- Footer --}}
    <footer class="bg-black text-white p-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 TIKERAMA. Tous droits réservés.</p>
        </div>
    </footer>

    @include('sweetalert::alert')
</body>
</html>
