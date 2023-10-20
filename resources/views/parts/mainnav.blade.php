<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="/">Hot Wheels</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('order.index') }}">Bestellungen</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('order.create') }}">Neue Bestellung</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('vehicle.create') }}">Neues Fahrzeug</a>
        </li>
        @can('isAdmin')
        <li class="nav-item">
        <a class="nav-link" href="{{ route('user.display') }}">Benutzer</a>
        </li>
        @endcan
      </ul>
    </div>
  </div>
</nav>