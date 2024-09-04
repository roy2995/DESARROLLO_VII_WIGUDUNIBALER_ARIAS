<?php

  #Recibe una cadena de texto y devuelve el número de palabras en el texto.
  function contar_palabras($texto){
    $palabras =  explode(" ",$texto);
    $cantPalabras = count($palabras);
    return $cantPalabras;
  }

  #Recibe una cadena de texto y devuelve el número de vocales (a, e, i, o, u, sin distinguir entre mayúsculas y minúsculas).
  function contar_vocales($texto){
    str_replace("","",$texto);
  }


  # Recibe una cadena de texto y devuelve una nueva cadena con el orden de las palabras invertido.
  function invertir_palabras($texto){
    $listPalabras =  explode(" ",$texto);
    krsort($listPalabras);
    $nuevoTexto = implode(" ",$listPalabras);
    return $nuevoTexto;
  }


?>