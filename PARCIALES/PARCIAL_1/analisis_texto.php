<?php require("utilidades_texto.php");
  $frases = ["hola mi nombre es wigudunibaler", "Megusta comer mucha comida", "Quiero compar un auto nuevo"];

?>

 <h2>Problema 1</h2>
    <table>
        <tr>
            <th>Frases</th>
            <th>cantidad de palabras</th>
            <th>Cantidad de palabras</th>
            <th>Frase Invertido</th>
        </tr>
        <?php foreach($frases as $clave => $frase): ?>
            <tr>
                <td> <?= $frase  ?></td>
                    <td><?= contar_palabras($frase) ?></td>
                    <td><?= contar_vocales($frase) ?></td>
                    <td><?= invertir_palabras($frase) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
