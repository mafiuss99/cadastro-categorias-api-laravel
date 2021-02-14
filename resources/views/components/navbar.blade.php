
<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <div class="container">
    <div class="row">
      <div class="col">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar">
    <a class="navbar-brand" href="#">Hidden brand</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item @if($current=='home')active @endif">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item @if($current=='produtos')active @endif">
        <a class="nav-link" href="/produtos">Produtos</a>
      </li>
      <li class="nav-item @if($current=='categorias')active @endif">
        <a class="nav-link" href="/categorias">Categorias</a>
      </li>
      
    </ul>
  </div>
      </div>
    </div>
  </div>
</nav>