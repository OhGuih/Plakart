<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PLAKART')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #00008B !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }
        .nav-link {
            color: white !important;
            background-color: #1E90FF;
            padding: 8px 15px;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s ease;
        }
        .nav-link:hover {
            background-color: #104E8B;
            color: #f8f9fa !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('visao.geral') }}">PLAKART</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('visao.geral') }}">Visão Geral</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('campeonatos.index') }}">Campeonatos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('equipes.index') }}">Equipes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
