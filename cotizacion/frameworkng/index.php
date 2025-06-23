<?php

// Incluir la clase Layout
include('./dashboard/dashboard.php');

// Datos del usuario (estos pueden ser dinámicos, por ejemplo, de una base de datos)
$user_name = "Obed Alvarado";
$user_image = "https://storage.googleapis.com/a1aa/image/0RCGnwStc3rsDNvUBPuQPCh8SlpNN0r7GnkJr4OmvkLHIj9E.jpg";
$active_menu_item = "productos"; // Este sería el elemento del menú activo

// Definir un array con las opciones del menú
$menu_items = [
    ["Inicio", "home", "fa-home"],
    ["Compras", "compras", "fa-truck"],
    ["Productos", "productos", "fa-boxes"],
    ["Fabricantes", "fabricantes", "fa-industry"],
    ["Contactos", "contactos", "fa-address-book"],
    ["Facturación", "facturacion", "fa-file-invoice-dollar"],
    ["Reportes", "reportes", "fa-chart-line"],
    ["Configuración", "configuracion", "fa-cogs"],
    ["Administrar accesos", "accesos", "fa-user-shield"]
];

// Crear una instancia de la clase Layout con las opciones del menú personalizadas
$layout = new Layout($user_name, $user_image, $active_menu_item, $menu_items);

// Llamar al método que genera el diseño completo
$layout->renderLayout();

?>
