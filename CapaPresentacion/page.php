
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SSU</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
 
  <!--Barra de navegación -->
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="index.php">SSU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="paage.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contacto">Contacto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="login.php">Login</a>
            <a class="dropdown-item" href="index.php">Administracion</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="login.php">Cerrar Sesión</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Cabecera -->
  <header class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <h1 class="display-4"> <b>SEGURO SOCIAL UNIVERSITARIO</b></h1>
      <p class="lead">Ofrecemos servicios médicos especializados para tu bienestar</p>
    </div>
  </header>

  <!-- Sección de servicios -->
  <section id="servicios" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Servicios</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="img/cuadro1.jpg" class="card-img-top" alt="servicios">
            <div class="card-body">
              <h5 class="card-title">Consulta médica</h5>
              <p class="card-text">Ofrecemos consultas médicas personalizadas y diagnóstico preciso para una atención integral.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="img/consulta.jpg" class="card-img-top" alt="examenes">
            <div class="card-body">
              <h5 class="card-title">Exámenes médicos</h5>
              <p class="card-text">Realizamos una amplia gama de exámenes médicos para evaluar tu salud y prevenir enfermedades.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="img/tratamientos.jpg" class="card-img-top" alt="tratamientos">
            <div class="card-body">
              <h5 class="card-title">Tratamientos personalizados</h5>
              <p class="card-text">Diseñamos planes de tratamiento individualizados según tus necesidades y objetivos de salud.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección de equipo médico -->
  <section id="equipo" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-4">Nuestro Equipo</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="img/doctor1.webp" class="card-img-top" alt="Doctor 1">
            <div class="card-body">
              <h5 class="card-title">Dr. Juan Pérez</h5>
              <p class="card-text">Especialidad: Medicina Interna</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="img/doctor1.webp" class="card-img-top" alt="Doctor 2">
            <div class="card-body">
              <h5 class="card-title">Dra. Ana Gómez</h5>
              <p class="card-text">Especialidad: Pediatría</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="img/doctor1.webp" class="card-img-top" alt="Doctor 3">
            <div class="card-body">
              <h5 class="card-title">Dr. Carlos Rodríguez</h5>
              <p class="card-text">Especialidad: Dermatología</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección de contacto -->
  <section id="contacto" class="py-5">
    <div class="container" id="#contacto">
      
      <h2 class="text-center mb-4">Contacto</h2>
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Ingresa tu email">
            </div>
            <div class="form-group">
              <label for="mensaje">Mensaje</label>
              <textarea class="form-control" id="mensaje" rows="5" placeholder="Escribe tu mensaje"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Pie de página -->
  <footer class="bg-dark text-light py-3 text-center">
    <p>Seguro Social Unniversitario &copy; 2023. Todos los derechos reservados.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
