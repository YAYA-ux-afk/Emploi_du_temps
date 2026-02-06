<tbody>
    @forelse($logs as $log)
    <tr class="border-b hover:bg-gray-50">
        <td class="p-3">{{ $log->created_at->format('d/m/Y H:i') }}</td>
        <td class="p-3 uppercase font-semibold text-sm">{{ $log->action }}</td>
        
        <td class="p-3 text-red-600">
            @php 
                $old = is_array($log->old_values) ? $log->old_values : json_decode($log->old_values, true); 
            @endphp
            @foreach($old ?? [] as $key => $value)
                <strong>{{ $key }}:</strong> {{ $value }}<br>
            @endforeach
        </td>

        <td class="p-3 text-green-600">
            @php 
                $new = is_array($log->new_values) ? $log->new_values : json_decode($log->new_values, true); 
            @endphp
            @foreach($new ?? [] as $key => $value)
                <strong>{{ $key }}:</strong> {{ $value }}<br>
            @endforeach
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="p-5 text-center text-gray-500">Aucune modification enregistrée.</td>
    </tr>
    @endforelse
</tbody>