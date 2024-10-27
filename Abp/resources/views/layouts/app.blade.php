
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Pagina Principal NB')</title>
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/GUI1.css') }}">
  <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>
  <header class="bg-gradient-light py-3">
    <div class="container d-flex align-items-center justify-content-between">
      <h1>TeamLearn</h1>
      <nav>
        <ul class="list-unstyled d-flex mb-0">
          <li class="me-4"><a href="{{ url('/') }}" class="text-dark">Inicio</a></li>
          <li class="me-4"><a href="{{ url('/home') }}" class="text-dark">Regresar</a></li>

    
<li class="dropdown">
    
</li>
          <li><a href="{{ url('/carrito') }}" class="text-dark">  Carrito</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container mt-5">
    @yield('content')
  </main>
</body>
</html>