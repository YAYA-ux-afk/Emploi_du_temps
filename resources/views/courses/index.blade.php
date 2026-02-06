@extends('layouts.app')

@section('title', 'Gestion des Cours')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex justify-between items-center bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-600">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📚 Gestion des Cours</h1>
            <p class="text-gray-500 font-medium">Créer, modifier ou supprimer les cours</p>
        </div>
        <a href="/courses/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold transition">
            ➕ Nouveau Cours
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-800 text-white text-xs uppercase tracking-widest">
                    <th class="p-4 font-bold">ID</th>
                    <th class="p-4 font-bold">Nom du Cours</th>
                    <th class="p-4 font-bold">Salle</th>
                    <th class="p-4 font-bold text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($courses as $course)
                <tr class="hover:bg-blue-50 transition-colors highlight-new">
                    <td class="p-4 text-sm text-gray-600 font-bold">{{ $course->id }}</td>
                    <td class="p-4 text-sm font-medium text-gray-800">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full">{{ $course->name }}</span>
                    </td>
                    <td class="p-4 text-sm text-gray-600">
                        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full">{{ $course->room }}</span>
                    </td>
                    <td class="p-4 text-center">
                        <a href="/courses/{{ $course->id }}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm font-bold mr-2 inline-block transition">
                            ✏️ Modifier
                        </a>
                        <form action="/courses/{{ $course->id }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-bold transition">
                                🗑️ Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-20 text-center text-gray-400 italic">
                        Aucun cours n'existe. Créez-en un !
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex gap-4">
        <a href="/" class="text-blue-600 hover:text-blue-800 font-bold">
            ← Voir l'historique des modifications
        </a>
    </div>
</div>
@endsection
