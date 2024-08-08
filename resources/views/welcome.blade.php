documentation<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Tikerama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#f0151f">

    <style>
        body{
            font-family: "Raleway", sans-serif;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
    </style>
</head>
<body class="bg-gray-200 flex flex-col min-h-screen">
    {{-- Header --}}
    <header class="bg-gray-100 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <img src="{{asset('logo-tikerama.png')}}" alt="logo-tikerama" style="height: 3rem;">
            {{-- <h1 class="text-2xl font-bold text-red-500">Tikerama</h1> --}}
            <nav>
                <ul class="flex space-x-4 text-red-500">
                    {{-- <li><a href="#" class="hover:underline">Accueil</a></li>
                    <li><a href="#" class="hover:underline">À propos</a></li>
                    <li><a href="#" class="hover:underline">Contact</a></li> --}}
                </ul>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow flex items-center justify-center p-4">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-xl w-full fade-in">
            <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Demande d'accès à l'Api</h2>
            <br>
            <form action="/getAccessCredentials" method="POST" class="space-y-4">
                @csrf
                <!-- Prénom -->
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="fname" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                        <input required type="text" id="fname" name="fname" placeholder="Votre prénom" value="{{ old('fname') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-transform duration-300 ease-in-out transform hover:scale-105">
                        @error('fname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label for="lname" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                        <input required type="text" id="lname" name="lname" placeholder="Votre nom" value="{{ old('lname') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-transform duration-300 ease-in-out transform hover:scale-105">
                        @error('lname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Nom de l'entreprise -->
                <div>
                    <label for="entreprise" class="block text-sm font-medium text-gray-700 mb-2">Nom de l'entreprise</label>
                    <input required type="text" id="entreprise" name="entreprise" placeholder="Votre nom d'entreprise" value="{{ old('entreprise') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-transform duration-300 ease-in-out transform hover:scale-105">
                    @error('entreprise')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Adresse email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                    <input required type="email" id="email" name="email" placeholder="Votre email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-transform duration-300 ease-in-out transform hover:scale-105">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Ville -->
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                        <input required type="text" id="city" name="city" placeholder="Votre Ville" value="{{ old('city') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-transform duration-300 ease-in-out transform hover:scale-105">
                        @error('city')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                        <input required type="text" id="address" name="address" placeholder="Votre Adresse" value="{{ old('address') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-transform duration-300 ease-in-out transform hover:scale-105">
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Bouton de soumission -->
                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-transform duration-300 ease-in-out transform hover:scale-105">
                    Demander
                </button>
            </form>

        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-950 text-white p-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 TIKERAMA. Tous droits réservés.</p>
        </div>
    </footer>

    @include('sweetalert::alert')

</body>
</html>
