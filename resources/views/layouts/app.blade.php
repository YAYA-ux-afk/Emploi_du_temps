<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .toast-notification {
            animation: slideIn 0.3s ease-out;
        }

        .toast-notification.hide {
            animation: slideOut 0.3s ease-in;
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .pulse-alert {
            animation: pulse-glow 1s infinite;
        }

        @keyframes highlight {
            0% { background-color: rgba(34, 197, 94, 0.1); }
            100% { background-color: transparent; }
        }

        .highlight-new {
            animation: highlight 2s ease-out;
        }
    </style>
</head>
<body class="bg-gray-50 p-6 font-sans">

    <!-- 🔔 Conteneur de notifications -->
    <div id="toast-container" class="fixed top-6 left-6 z-50 space-y-3 max-w-sm"></div>

    <!-- 👤 Menu utilisateur -->
    <div class="fixed top-6 right-6 z-40">
        @auth
            <div class="flex items-center gap-2 bg-white p-3 rounded-lg shadow-lg border border-gray-200">
                <span class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</span>
                @if(auth()->user()->is_admin)
                    <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded">👑 Admin</span>
                @endif
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-gray-700 font-bold">
                        🚪 Déconnexion
                    </button>
                </form>
            </div>
        @else
            <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold">
                🔐 Connexion
            </a>
        @endauth
    </div>

    @yield('content')

    <script>
        function showNotification(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            const bgColors = {
                'success': 'bg-green-500',
                'creation': 'bg-blue-500',
                'modification': 'bg-yellow-500',
                'deletion': 'bg-red-500',
                'error': 'bg-red-600'
            };

            toast.className = `toast-notification ${bgColors[type] || bgColors['success']} text-white p-4 rounded-lg shadow-lg flex items-center gap-3`;
            
            const icons = {
                'success': '✅',
                'creation': '➕',
                'modification': '✏️',
                'deletion': '🗑️',
                'error': '❌'
            };

            toast.innerHTML = `
                <span class="text-xl">${icons[type] || '✓'}</span>
                <span class="flex-1">${message}</span>
                <button onclick="this.parentElement.remove()" class="hover:opacity-80">✕</button>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // Affiche les notifications de session
        @if (session('success'))
            showNotification("{{ session('success') }}", "{{ session('alert_type', 'success') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showNotification("{{ $error }}", "error");
            @endforeach
        @endif
    </script>

</body>
</html>
