<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Modifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 font-sans">

    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex justify-between items-center bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-600">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Historique des Changements</h1>
                <p class="text-gray-500 font-medium">Suivi détaillé des ressources et salles</p>
            </div>
            <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-bold">
                {{ $logs->count() }} modification(s)
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-800 text-white text-xs uppercase tracking-widest">
                        <th class="p-4 font-bold">Horodatage</th>
                        <th class="p-4 font-bold">Action réalisée</th>
                        <th class="p-4 font-bold">Ancien État</th>
                        <th class="p-4 font-bold">Nouvel État</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($logs as $log)
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="p-4 text-sm text-gray-600 border-r border-gray-100">
                            <span class="block font-bold text-gray-800">{{ $log->created_at->format('d/m/Y') }}</span>
                            <span class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="px-2 py-1 rounded text-[10px] font-black border
                                {{ $log->action == 'CREATE' ? 'bg-green-50 border-green-200 text-green-700' : 'bg-amber-50 border-amber-200 text-amber-700' }}">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="p-4 text-sm bg-red-50/30">
                            @php 
                                $old = is_array($log->old_values) ? $log->old_values : json_decode($log->old_values, true); 
                            @endphp
                            @forelse($old ?? [] as $key => $value)
                                <div class="mb-1 text-xs"><span class="font-bold text-red-600 capitalize">{{ $key }} :</span> {{ $value }}</div>
                            @empty
                                <span class="text-gray-300 italic text-xs">Aucune valeur précédente</span>
                            @endforelse
                        </td>
                        <td class="p-4 text-sm bg-green-50/30">
                            @php 
                                $new = is_array($log->new_values) ? $log->new_values : json_decode($log->new_values, true); 
                            @endphp
                            @forelse($new ?? [] as $key => $value)
                                <div class="mb-1 text-xs"><span class="font-bold text-green-600 capitalize">{{ $key }} :</span> {{ $value }}</div>
                            @empty
                                <span class="text-gray-400 italic text-xs font-medium">Données initiales</span>
                            @endforelse
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-20 text-center">
                            <div class="text-gray-300 text-5xl mb-4 text-center italic">0</div>
                            <p class="text-gray-400 font-medium italic text-lg text-center w-full">Aucun changement n'a été détecté dans l'emploi