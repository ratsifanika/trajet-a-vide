<template>
    <div>
      <!-- Header -->
      <header class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="/">Trajet à Vide</a>
          <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="/routes/create">Créer un trajet</a>
              </li>
            </ul>
          </div>
        </div>
      </header>
  
      <!-- Main content -->
      <main class="container mt-4">
        <slot></slot>
      </main>
  
      <!-- Footer -->
      <footer class="footer bg-light mt-auto py-3">
        <div class="container">
          <span class="text-muted">© 2024 Trajet à Vide. Tous droits réservés.</span>
        </div>
      </footer>
    </div>
  </template>
  
  <script>
  export default {
    name: "BaseLayout",
  };
  </script>
  
  <style scoped>
  /* Optionally add some basic styling */
  </style>
  