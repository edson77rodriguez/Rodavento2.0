<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Hotel Rodavento')</title>
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/GUI1.css') }}">
  <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>
  <header class="bg-gradient-light py-3">
    <div class="container d-flex align-items-center justify-content-between">
      <h1>Rodavento</h1>
      <nav>
        <ul class="list-unstyled d-flex mb-0">
          
          <li>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-link text-dark">Cerrar sesión</button>
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container mt-5">
    @yield('content')
  </main>
</body>
</html>
