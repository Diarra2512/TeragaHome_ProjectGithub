<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    <style>
        /* Sidebar styling */
        .sidebar-custom {
            background-color:rgb(65, 94, 31); /* Vert foncé */
            color: #fff;
            width: 250px;
        }

        .sidebar-custom h4 {
            font-weight: bold;
            color: #ffffff;
        }

        .sidebar-custom .nav-link {
            color: #f1f1f1;
            font-weight: 500;
            transition: background 0.2s ease;
            border-radius: 6px;
            padding: 8px 12px;
        }

        .sidebar-custom .nav-link:hover,
        .sidebar-custom .nav-link.active {
            background-color:rgb(152, 170, 131);
            color: #ffffff;
        }

        .sidebar-custom .btn-outline-light {
            border-color: #ffffff;
            color: #ffffff;
        }

        .sidebar-custom .btn-outline-light:hover {
            background-color: #ffffff;
            color: #51653f;
        }
    </style>
</head>
<body class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar-custom vh-100 p-4">
        <h4 class="mb-4">Admin</h4>
        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="bi bi-people-fill me-2"></i> Utilisateurs
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('admin.properties.index') }}" class="nav-link">
                    <i class="bi bi-house-door-fill me-2"></i> Gérer les annonces
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('admin.requests.index') }}" class="nav-link">
                    <i class="bi bi-envelope-open me-2"></i> Demandes
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="bi bi-bar-chart me-2"></i> Statistiques
                </a>
            </li>

            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light w-100">
                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                    </button>
                </form>
            </li>

        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
