@extends('layouts.app')

@section('title', 'Historique des Modifications')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Navigation Onglets -->
    <div class="mb-8 flex gap-4 border-b-2 border-gray-200">
        <a href="/" class="pb-4 px-4 font-bold text-blue-600 border-b-2 border-blue-600">
            📊 Historique des modifications
        </a>
        <a href="/courses-list" class="pb-4 px-4 font-bold text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-200">
            📚 Liste des cours
        </a>
    </div>

    <div class="mb-8 flex justify-between items-center bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-600">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📊 Historique des Changements</h1>
            <p class="text-gray-500 font-medium">Suivi détaillé des ressources et salles</p>
        </div>
        <div class="flex gap-4 items-center">
            <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-bold">
                📌 {{ $logs->count() }} modification(s)
            </div>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="/courses" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-bold transition">
                        ✏️ Gérer les cours
                    </a>
                @else
                    <span class="text-gray-500 text-sm italic">👤 Utilisateur</span>
                @endif
            @else
                <span class="text-gray-500 text-sm italic">👤 Mode public</span>
            @endauth
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-800 text-white text-xs uppercase tracking-widest">
                    <th class="p-4 font-bold">⏰ Horodatage</th>
                    <th class="p-4 font-bold">⚡ Action réalisée</th>
                    <th class="p-4 font-bold">❌ Ancien État</th>
                    <th class="p-4 font-bold">✅ Nouvel État</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($logs as $log)
                <tr class="hover:bg-blue-50 transition-colors {{ $loop->first ? 'highlight-new' : '' }}">
                    <td class="p-4 text-sm text-gray-600 border-r border-gray-100">
                        <span class="block font-bold text-gray-800">{{ $log->created_at->format('d/m/Y') }}</span>
                        <span class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</span>
                    </td>
                    <td class="p-4 text-center">
                        @php
                            $actionIcons = [
                                'CREATE' => '➕',
                                'modification' => '✏️',
                                'UPDATE' => '✏️',
                                'DELETE' => '🗑️',
                            ];
                            $actionIcon = $actionIcons[$log->action] ?? '•';
                            $actionColors = [
                                'CREATE' => 'bg-green-50 border-green-200 text-green-700',
                                'modification' => 'bg-blue-50 border-blue-200 text-blue-700',
                                'UPDATE' => 'bg-blue-50 border-blue-200 text-blue-700',
                                'DELETE' => 'bg-red-50 border-red-200 text-red-700',
                            ];
                            $colors = $actionColors[$log->action] ?? 'bg-gray-50 border-gray-200 text-gray-700';
                        @endphp
                        <span class="px-3 py-1 rounded text-[11px] font-black border {{ $colors }} pulse-alert">
                            {{ $actionIcon }} {{ strtoupper($log->action) }}
                        </span>
                    </td>
                    <td class="p-4 text-sm bg-red-50/30">
                        @php 
                            $old = is_array($log->old_values) ? $log->old_values : json_decode($log->old_values, true); 
                        @endphp
                        @forelse($old ?? [] as $key => $value)
                            <div class="mb-1 text-xs"><span class="font-bold text-red-600 capitalize">{{ $key }} :</span> <span class="line-through">{{ $value }}</span></div>
                        @empty
                            <span class="text-gray-300 italic text-xs">➖ Aucune valeur précédente</span>
                        @endforelse
                    </td>
                    <td class="p-4 text-sm bg-green-50/30">
                        @php 
                            $new = is_array($log->new_values) ? $log->new_values : json_decode($log->new_values, true); 
                        @endphp
                        @forelse($new ?? [] as $key => $value)
                            <div class="mb-1 text-xs"><span class="font-bold text-green-600 capitalize">{{ $key }} :</span> <span class="font-semibold">{{ $value }}</span></div>
                        @empty
                            <span class="text-gray-400 italic text-xs font-medium">📋 Données initiales</span>
                        @endforelse
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-20 text-center">
                        <div class="text-gray-300 text-5xl mb-4 text-center italic">0</div>
                        <p class="text-gray-400 font-medium italic text-lg text-center w-full">Aucun changement n'a été détecté dans l'emploi du temps</p>
                        <p class="text-gray-400 mt-2">
                            <a href="/courses-list" class="text-blue-600 hover:text-blue-800 font-bold">Voir les cours →</a>
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection