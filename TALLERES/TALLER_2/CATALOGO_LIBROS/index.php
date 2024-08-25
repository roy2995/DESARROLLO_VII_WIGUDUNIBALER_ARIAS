<?php
  include 'includes/header.php';
?>

<main>

  <h2>Lista de libros</h2>
  <p>El atalogo de libros tiene los detalles de cada libro</p>
  <?php
    require_once 'includes/funciones.php';

    $libros = obtenerLibros();
    foreach ($libros as $libro) {
      echo mostrarDetallesLibro($libro);
    }
  ?>
</main>

<?php

  require_once 'includes/funciones.php';

  $libros = obtenerLibros();
  foreach ($libros as $libro) {
    echo mostrarDetallesLibro($libro);
  }

  include 'includes/footer.php';
?>