<?php
// 1. Crear un arreglo multidimensional de ventas por región y producto
$ventas = [
    "Norte" => [
        "Producto A" => [100, 120, 140, 110, 130],
        "Producto B" => [85, 95, 105, 90, 100],
        "Producto C" => [60, 55, 65, 70, 75]
    ],
    "Sur" => [
        "Producto A" => [80, 90, 100, 85, 95],
        "Producto B" => [120, 110, 115, 125, 130],
        "Producto C" => [70, 75, 80, 65, 60]
    ],
    "Este" => [
        "Producto A" => [110, 115, 120, 105, 125],
        "Producto B" => [95, 100, 90, 105, 110],
        "Producto C" => [50, 60, 55, 65, 70]
    ],
    "Oeste" => [
        "Producto A" => [90, 85, 95, 100, 105],
        "Producto B" => [105, 110, 100, 115, 120],
        "Producto C" => [80, 85, 75, 70, 90]
    ]
];

// 2. Función para calcular el promedio de ventas
function promedioVentas($ventas) {
    return array_sum($ventas) / count($ventas);
}

// 3. Calcular y mostrar el promedio de ventas por región y producto
echo "Promedio de ventas por región y producto:<br>";
foreach ($ventas as $region => $productos) {
    echo "$region:<br>";
    foreach ($productos as $producto => $ventasProducto) {
        $promedio = promedioVentas($ventasProducto);
        echo "  $producto: " . number_format($promedio, 2) . "<br>";
    }
    echo "<br>";
}

// 4. Función para encontrar el producto más vendido en una región
function productoMasVendido($productos) {
    $maxVentas = 0;
    $productoTop = '';
    foreach ($productos as $producto => $ventas) {
        $totalVentas = array_sum($ventas);
        if ($totalVentas > $maxVentas) {
            $maxVentas = $totalVentas;
            $productoTop = $producto;
        }
    }
    return [$productoTop, $maxVentas];
}

// 5. Encontrar y mostrar el producto más vendido por región
echo "Producto más vendido por región:<br>";
foreach ($ventas as $region => $productos) {
    [$productoTop, $ventasTop] = productoMasVendido($productos);
    echo "$region: $productoTop (Total: $ventasTop)<br>";
}

// 6. Calcular las ventas totales por producto
$ventasTotalesPorProducto = [];
foreach ($ventas as $region => $productos) {
    foreach ($productos as $producto => $ventasProducto) {
        if (!isset($ventasTotalesPorProducto[$producto])) {
            $ventasTotalesPorProducto[$producto] = 0;
        }
        $ventasTotalesPorProducto[$producto] += array_sum($ventasProducto);
    }
}

echo "<br>Ventas totales por producto:<br>";
arsort($ventasTotalesPorProducto);
foreach ($ventasTotalesPorProducto as $producto => $total) {
    echo "$producto: $total<br>";
}

// 7. Encontrar la región con mayores ventas totales
$ventasTotalesPorRegion = array_map(function($productos) {
    return array_sum(array_map('array_sum', $productos));
}, $ventas);

$regionTopVentas = array_keys($ventasTotalesPorRegion, max($ventasTotalesPorRegion))[0];
echo "<br>Región con mayores ventas totales: $regionTopVentas<br>";

// TAREA: Implementa una función que analice el crecimiento de ventas
// Calcula y muestra el porcentaje de crecimiento de ventas del primer al último mes
// para cada producto en cada región. Identifica el producto y la región con mayor crecimiento.
// Tu código aquí
// 8. Función para calcular el porcentaje de crecimiento de ventas
function calcularCrecimiento($ventas) {
    $primero = $ventas[0];
    $ultimo = end($ventas);
    
    if ($primero == 0) {
        return 0; // Evitar división por cero
    }
    
    return (($ultimo - $primero) / $primero) * 100;
}

$mayorCrecimiento = 0;
$productoTopCrecimiento = '';
$regionTopCrecimiento = '';

echo "<br>Porcentaje de crecimiento de ventas del primer al último mes:<br>";
foreach ($ventas as $region => $productos) {
    echo "$region:<br>";
    foreach ($productos as $producto => $ventasProducto) {
        $crecimiento = calcularCrecimiento($ventasProducto);
        echo "  $producto: " . number_format($crecimiento, 2) . "%<br>";
        
        if ($crecimiento > $mayorCrecimiento) {
            $mayorCrecimiento = $crecimiento;
            $productoTopCrecimiento = $producto;
            $regionTopCrecimiento = $region;
        }
    }
}

echo "<br>Producto con mayor crecimiento: $productoTopCrecimiento en $regionTopCrecimiento (Crecimiento: " . number_format($mayorCrecimiento, 2) . "%)<br>";

?>
    