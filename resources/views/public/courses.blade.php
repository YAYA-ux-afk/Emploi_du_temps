@extends('layouts.app')

@section('title', 'Cours')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Navigation Onglets -->
    <div class="mb-8 flex gap-4 border-b-2 border-gray-200">
        <a href="/" class="pb-4 px-4 font-bold text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-200">
            📊 Historique des modifications
        </a>
        <a href="/courses-list" class="pb-4 px-4 font-bold text-blue-600 border-b-2 border-blue-600">
            📚 Liste des cours
        </a>
    </div>

    <div class="mb-8 bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-600">
        <h1 class="text-2xl font-bold text-gray-800">📚 Liste des Cours</h1>
        <p class="text-gray-500 font-medium">État actuel des ressources et salles</p>
    </div>

    @if($courses->isEmpty())
        <div class="bg-white rounded-xl shadow-lg p-20 border border-gray-200 text-center">
            <div class="text-gray-300 text-5xl mb-4">📭</div>
            <p class="text-gray-400 font-medium italic text-lg">Aucun cours n'a été créé pour le moment</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($courses as $course)
            <div class="bg-white rounded-lg shadow-md border-l-4 border-blue-600 p-6 hover:shadow-lg transition">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-gray-800">{{ $course->name }}</h2>
                    <p class="text-sm text-gray-500">ID: #{{ $course->id }}</p>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-gray-600">📍 Salle:</span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full font-bold">{{ $course->room }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-gray-600">📅 Créé:</span>
                        <span class="text-xs text-gray-500">{{ $course->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-gray-700 text-sm">
            💡 <span class="font-bold">Conseil:</span> 
            <a href="/" class="text-blue-600 hover:text-blue-800 font-bold">Voir l'historique des modifications →</a>
            pour suivre tous les changements apportés aux cours.
        </p>
    </div>
</div>
@endsection
