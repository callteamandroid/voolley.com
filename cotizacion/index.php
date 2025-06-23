<?php

// index.php

// Incluir la clase Dashboard
include('./frameworkng/common.php');
require './account/auth.php';
// Datos del usuario (estos pueden ser dinámicos, por ejemplo, de una base de datos)
$user_name = "Obed Alvarado";
$user_image = "https://storage.googleapis.com/a1aa/image/0RCGnwStc3rsDNvUBPuQPCh8SlpNN0r7GnkJr4OmvkLHIj9E.jpg";

// Definir un array con las opciones del menú (opcional, si se desea personalizar)
$menu_items = [
    ["Inicio", "home", "fa-home"],
    ["Productos y Servicios", "productos", "fa-boxes"],
    ["Cotizaciones", "cotizaciones", "fa-file-invoice-dollar"],
    ["Orden de Compras", "orden", "fa-list"],
    ["Entradas", "compras", "fa-truck"],
    ["Inventario", "inventario", "fa-boxes"],
    ["Fabricantes", "fabricantes", "fa-industry"],
    ["Contactos", "contactos", "fa-address-book"],
    ["Salidas", "facturacion", "fa-file-invoice-dollar"],
    ["Reportes", "reportes", "fa-chart-line"],
    ["Configuración", "configuracion", "fa-cogs"],
    ["Administrar accesos", "accesos", "fa-user-shield"]
];

// Crear una instancia de la clase Dashboard
$dashboard = new Dashboard($user_name, $user_image, $menu_items);

// Renderizar el layout completo (excepto la parte dinámica)
$dashboard->renderLayout();

?>


<!-- Incluir jQuery (asegúrate de incluir la librería si no la tienes) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


