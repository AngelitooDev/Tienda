<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Productos')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('products.index') }}">Productos</a>

    </div>
    <div class="container">
        <a class="navbar-brand" href="{{ route('trackings.index') }}">Comparador de Precios</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- Footer -->
<footer class="text-center py-4 mt-5 border-top">
    <p class="mb-0">&copy; {{ date('Y') }} Gestión de Productos</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
