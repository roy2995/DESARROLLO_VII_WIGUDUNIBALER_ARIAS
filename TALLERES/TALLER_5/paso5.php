
<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electrónica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electrónica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electrónica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electrónica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electrónica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana López", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gómez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "María Rodríguez", "email": "maria@example.com"}
    ]
}
';

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos) {
    foreach ($productos as $producto) {
        echo "{$producto['nombre']} - {$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "<br>";
    }
}

echo "Productos de {$tiendaData['tienda']}:<br>";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "<br>Valor total del inventario: $$valorTotal<br>";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);

echo "<br>Producto más caro: {$productoMasCaro['nombre']} ({$productoMasCaro['precio']})<br>";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, function($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "<br>Productos en la categoría 'computadoras':<br>";
imprimirProductos($productosDeComputadoras);

// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electrónica", "accesorios", "wearables"]
];
$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT);
echo "<br>Datos actualizados de la tienda (JSON):<br>$jsonActualizado<br>";

// TAREA: Implementa una función que genere un resumen de ventas
// Crea un arreglo de ventas (producto_id, cliente_id, cantidad, fecha)
// y genera un informe que muestre:
// - Total de ventas
// - Producto más vendido
// - Cliente que más ha comprado
// Tu código aquí


$ventas = [
    [
        "producto_id" => 1,  
        "cliente_id" => 101, 
        "cantidad" => 1,
        "fecha" => "2024-09-01"
    ],
    [
        "producto_id" => 3,  
        "cliente_id" => 102, 
        "cantidad" => 2,
        "fecha" => "2024-09-02"
    ],
    [
        "producto_id" => 2,  
        "cliente_id" => 103, 
        "cantidad" => 1,
        "fecha" => "2024-09-03"
    ],
    [
        "producto_id" => 5,  
        "cliente_id" => 101, 
        "cantidad" => 1,
        "fecha" => "2024-09-04"
    ],
    [
        "producto_id" => 4,  
        "cliente_id" => 102, 
        "cantidad" => 1,
        "fecha" => "2024-09-05"
    ],
    [
        "producto_id" => 1,  // Laptop Gamer
        "cliente_id" => 103, // María Rodríguez
        "cantidad" => 1,
        "fecha" => "2024-09-06"
    ],
    [
        "producto_id" => 2,  // Smartphone 5G
        "cliente_id" => 102, // Carlos Gómez
        "cantidad" => 2,
        "fecha" => "2024-09-07"
    ],
    [
        "producto_id" => 3,  // Auriculares Bluetooth
        "cliente_id" => 101, // Ana López
        "cantidad" => 3,
        "fecha" => "2024-09-08"
    ],
    [
        "producto_id" => 4,  // Smart TV 4K
        "cliente_id" => 103, // María Rodríguez
        "cantidad" => 1,
        "fecha" => "2024-09-09"
    ],
    [
        "producto_id" => 5,  // Tablet
        "cliente_id" => 101, // Ana López
        "cantidad" => 2,
        "fecha" => "2024-09-10"
    ],
    [
        "producto_id" => 2,  // Smartphone 5G
        "cliente_id" => 102, // Carlos Gómez
        "cantidad" => 1,
        "fecha" => "2024-09-11"
    ]
];

function generarResumenVentas($productos, $clientes, $ventas) {
    $totalVentas = 0;
    $productosVendidos = [];
    $clientesCompras = [];

    foreach ($ventas as $venta) {

        $producto = array_filter($productos, function($prod) use ($venta) {
            return $prod['id'] == $venta['producto_id'];
        });
        $producto = array_values($producto)[0]; // Obtener el primer resultado
        
        $ventaTotal = $producto['precio'] * $venta['cantidad'];
        $totalVentas += $ventaTotal;

        if (isset($productosVendidos[$producto['nombre']])) {
            $productosVendidos[$producto['nombre']] += $venta['cantidad'];
        } else {
            $productosVendidos[$producto['nombre']] = $venta['cantidad'];
        }

        if (isset($clientesCompras[$venta['cliente_id']])) {
            $clientesCompras[$venta['cliente_id']] += $ventaTotal;
        } else {
            $clientesCompras[$venta['cliente_id']] = $ventaTotal;
        }
    }

    $productoMasVendido = array_search(max($productosVendidos), $productosVendidos);

    $clienteMasComprasID = array_search(max($clientesCompras), $clientesCompras);
    $clienteMasCompras = array_filter($clientes, function($cli) use ($clienteMasComprasID) {
        return $cli['id'] == $clienteMasComprasID;
    });
    $clienteMasCompras = array_values($clienteMasCompras)[0]['nombre'];

    return [
        "total_ventas" => $totalVentas,
        "producto_mas_vendido" => $productoMasVendido,
        "cliente_mas_compras" => $clienteMasCompras
    ];
}

$resumen = generarResumenVentas($tiendaData['productos'], $tiendaData['clientes'], $ventas);

echo "Total de ventas: $" . $resumen['total_ventas'] . "<br>";
echo "Producto más vendido: " . $resumen['producto_mas_vendido'] . "<br>";
echo "Cliente que más ha comprado: " . $resumen['cliente_mas_compras'] . "<br>";


?>