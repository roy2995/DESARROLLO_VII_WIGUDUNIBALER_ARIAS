<?php
function obtenerLibros(){
    $catalogo_libros = [
    [
        'titulo' => 'El Quijote',
        'autor' => 'Miguel de Cervantes',
        'anio_publicacion' => 1605,
        'genero' => 'Novela',
        'descripcion' => 'La historia del ingenioso hidalgo Don Quijote de la Mancha.'
    ],
    [
        'titulo' => 'Cien Años de Soledad',
        'autor' => 'Gabriel García Márquez',
        'anio_publicacion' => 1967,
        'genero' => 'Realismo mágico',
        'descripcion' => 'Una obra maestra de la literatura, que narra la historia de la familia Buendía en el mítico pueblo de Macondo.'
    ],
    [
        'titulo' => '1984',
        'autor' => 'George Orwell',
        'anio_publicacion' => 1949,
        'genero' => 'Distopía',
        'descripcion' => 'Una novela distópica sobre un régimen totalitario que controla todos los aspectos de la vida.'
    ],
    [
        'titulo' => 'Matar a un ruiseñor',
        'autor' => 'Harper Lee',
        'anio_publicacion' => 1960,
        'genero' => 'Ficción',
        'descripcion' => 'Una poderosa historia sobre la injusticia racial y la pérdida de la inocencia en el sur de los Estados Unidos.'
    ],
    [
        'titulo' => 'La Odisea',
        'autor' => 'Homero',
        'anio_publicacion' => 'Siglo VIII a.C.',
        'genero' => 'Épica',
        'descripcion' => 'La epopeya clásica que narra el largo y peligroso viaje de regreso a casa del héroe griego Odiseo.'
    ]
];

  return $catalogo_libros;

  } 

  function mostrarDetallesLibro($libro){

    $html = '<ul>';
    foreach ($libro as $clave => $valor) {
        $html .= "<li> <strong> $clave :</strong> $valor</li>";
    }

    $html .= '</ul>';
    return $html;

  }

?>