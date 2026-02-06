@extends('layouts.app')

@section('title', isset($course) ? 'Modifier le cours' : 'Créer un cours')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8 bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-600">
        <h1 class="text-2xl font-bold text-gray-800">{{ isset($course) ? '✏️ Modifier le cours' : '➕ Créer un nouveau cours' }}</h1>
        <p class="text-gray-500 font-medium mt-1">Remplissez les informations ci-dessous</p>
    </div>

    <form action="{{ isset($course) ? '/courses/' . $course->id : '/courses' }}" method="POST" class="bg-white rounded-xl shadow-lg p-8 border border-gray-200">
        @csrf
        @if(isset($course))
            @method('PUT')
        @endif

        <div class="mb-6">
            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nom du Cours</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ isset($course) ? $course->name : old('name') }}"
                placeholder="Ex: Mathématiques" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                required
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="room" class="block text-sm font-bold text-gray-700 mb-2">Salle</label>
            <input 
                type="text" 
                id="room" 
                name="room" 
                value="{{ isset($course) ? $course->room : old('room') }}"
                placeholder="Ex: Salle A101" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                required
            >
            @error('room')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition">
                {{ isset($course) ? '✅ Mettre à jour' : '✅ Créer' }}
            </button>
            <a href="/courses" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-bold transition">
                ❌ Annuler
            </a>
        </div>
    </form>

    <div class="mt-6">
        <a href="/" class="text-blue-600 hover:text-blue-800 font-bold">
            ← Voir l'historique des modifications
        </a>
    </div>
</div>
@endsection
