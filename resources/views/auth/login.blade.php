@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="max-w-md mx-auto mt-20">
    <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">🔐 Connexion Admin</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="admin@example.com" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                    required
                >
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Mot de passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Votre mot de passe" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                    required
                >
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition">
                Se connecter 🚀
            </button>
        </form>

        <div class="mt-6 p-4 bg-gray-100 rounded-lg text-center text-sm text-gray-600">
            <p class="font-bold mb-2">📝 Compte de test :</p>
            <p>Email: <span class="font-mono">admin@example.com</span></p>
            <p>Pass: <span class="font-mono">password123</span></p>
        </div>
    </div>
</div>
@endsection
