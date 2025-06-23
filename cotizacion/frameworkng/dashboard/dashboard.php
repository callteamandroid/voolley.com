
<?php

class Dashboard {
    private $user_name;
    private $user_image;
    private $menu_items;

    // Definir las opciones de menú predeterminadas como constante
    private const DEFAULT_MENU_ITEMS = [
        ["Inicio", "inicio", "fa-home", []],
        [
            "Compras", "compras", "fa-truck", [
                ["Proveedores", "compras_proveedores", "fa-truck-loading"],
                ["Pedidos", "compras_pedidos", "fa-cart-plus"],
                ["Facturas", "compras_facturas", "fa-file-invoice"]
            ]
        ],
        [
            "Inventario", "productos", "fa-boxes", [
                ["Categorías", "productos_categorias", "fa-tags"],
                ["Inventario", "productos_inventario", "fa-cogs"],
                ["Descuentos", "productos_descuentos", "fa-percentage"]
            ]
        ],
        [
            "Configuración", "configuracion", "fa-cogs", [
                ["Perfil", "configuracion_perfil", "fa-user"],
                ["Seguridad", "configuracion_seguridad", "fa-lock"],
                ["Notificaciones", "configuracion_notificaciones", "fa-bell"]
            ]
        ],
        ["Fabricantes", "fabricantes", "fa-industry", []],
        ["Contactos", "contactos", "fa-address-book", []],
        ["Ventas", "facturacion", "fa-file-invoice-dollar", []],
        ["Reportes", "reportes", "fa-chart-line", []],
        ["Administrar accesos", "accesos", "fa-user-shield", []]
    ];

    public function __construct($user_name, $user_image, $menu_items = []) {
        $this->user_name = $_SESSION['username'];
        $this->user_image = $user_image;
        $this->menu_items = !empty($menu_items) ? $menu_items : self::DEFAULT_MENU_ITEMS;
    }
    

    private function getActiveSection() {
        return isset($_GET['section']) ? $_GET['section'] : 'inicio';
    }

    public function renderSidebar() {
        $active_section = $this->getActiveSection(); // Obtenemos la sección activa
        
        echo '<div class="w-64 col-12 col-md-3 col-lg-12 bg-dark text-white p-0 d-flex flex-column">';
        echo '<div class="p-4 d-flex align-items-center">';
        echo '<img alt="User avatar" class="rounded-circle me-2" height="40" src="' . $this->user_image . '" width="40"/><p class="text-success mb-0">Online</p>';
        echo '</div><p class="fw-bold p-3" style="margin-top: -2em;">' . $this->user_name . '</p>';
        
        echo '<nav class="mt-4"><ul class="list-unstyled">';

        // Renderizamos los items del menú
        foreach ($this->menu_items as $item) {
            // Clase activa si está seleccionado
            $active_class = ($active_section === $item[1]) ? "bg-gray-700 shadow-lg" : "";
            if (!empty($item[3])) {
                // Si tiene submenú, lo mostramos como un menú desplegable
                echo '<li class="accordion-item">';
                echo '<h2 class="accordion-header" id="heading' . $item[1] . '">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $item[1] . '" aria-expanded="false" aria-controls="collapse' . $item[1] . '">';
                echo '<i class="fas ' . $item[2] . ' me-2"></i>' . $item[0];
                echo '</button>';
                echo '</h2>';
                echo '<div id="collapse' . $item[1] . '" class="accordion-collapse collapse ' . $active_class . '" aria-labelledby="heading' . $item[1] . '" data-bs-parent="#accordionMenu">';
                echo '<div class="accordion-body">';
                echo '<ul class="list-unstyled">';

                // Submenú
                foreach ($item[3] as $sub_item) {
                    $sub_active_class = ($active_section === $sub_item[1]) ? "bg-gray-700 shadow-lg" : "";
                    echo '<li class="p-2 ' . $sub_active_class . '">';
                    echo '<a href="#" class="menu-item d-flex text-white" data-section="' . $sub_item[1] . '"><i class="fas ' . $sub_item[2] . ' me-2"></i>' . $sub_item[0] . '</a></li>';
                }

                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '</li>';
            } else {
                // Si no tiene submenú, lo mostramos como un ítem normal
                echo '<li class="p-2 ' . $active_class . '">';
                echo '<a href="#" class="menu-item d-flex text-white" data-section="' . $item[1] . '"><i class="fas ' . $item[2] . ' me-2"></i>';
                echo $item[0] . '</a></li>';
            }
        }

        echo '</ul></nav>';
        echo '</div>';
    }

    public function renderHeader() {
        echo '<div class="bg-success p-3 d-flex justify-content-between align-items-center">';
        echo '<div class="text-white h3">Inventario</div>';
        echo '<div class="d-flex align-items-center r-5">';
        echo '<input class="form-control me-2" placeholder="Buscar por nombre" type="text"/>';
        echo '<button class="btn btn-white"><i class="fas fa-search"></i></button>';
        echo '</div>';
        echo '<div class="d-flex align-items-center">';
        echo '<img alt="User avatar" class="rounded-circle me-2" height="40" src="' . $this->user_image . '" width="40"/>';
        echo '<p class="text-white mb-0">' . $this->user_name . '</p>';
        echo '</div>';
        echo '</div>';
    }

    // Método para renderizar el contenido dinámico de acuerdo a la sección
    public function renderDynamicContent($section) {
        // Este método se puede expandir según las necesidades de cada sección
    }

    private function renderResources() {
        // Cargar los recursos globales
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />';
        echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />';
        echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
        echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';
    }

    public function renderLayout() {
        $section = $this->getActiveSection();

        echo '<!DOCTYPE html><html lang="es"><head>';
        echo '<meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/>';
        echo '<title>Inventario</title>';
        
        // Cargar recursos solo una vez
        $this->renderResources();
        
        echo '<style>
                .menu-item {
                    text-decoration: none; /* Eliminar subrayado */
                }

                .menu-item:hover {
                    text-decoration: none; /* Asegurar que no se subraye al pasar el ratón */
                }

                .active-item {
                    background-color: #4e5d6d !important;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }
            </style>';

        echo '<script>
    $(document).ready(function() {
        // Cargar "home.php" al cargar la página
        loadContent("home");

        // Función para cargar contenido dinámico usando AJAX
        function loadContent(section) {
            $.ajax({
                url: section + ".php",  // El archivo PHP que se cargará
                method: "GET",
                success: function(response) {
                    $("#content").html(response);  // Actualizar el contenido de la página
                }
            });
        }

        // Manejar clics en los ítems del menú
        $(".menu-item").click(function(e) {
            e.preventDefault();
            var section = $(this).data("section");  // Obtener la sección a cargar

            // Cargar el contenido correspondiente
            loadContent(section);

            // Quitar la clase activa de todos los elementos
            $(".menu-item").closest("li").removeClass("active-item");

            // Agregar la clase activa al elemento clickeado
            $(this).closest("li").addClass("active-item");
        });
    });
</script>
';

        echo '</head><body class="bg-light"><div class="d-flex flex-column flex-lg-row min-vh-100">';

        // Renderizar la barra lateral
        echo '<div class="col-12 col-md-5 col-lg-2 p-0 bg-dark text-white">';
        $this->renderSidebar();
        echo '</div>';

        // Contenido principal
        echo '<div class="col-12 col-md-9 col-lg-10 p-0">';

        // Renderizar el encabezado
        $this->renderHeader();

        // Renderizar el contenido dinámico
        echo '<div id="content" class="p-4">';
        $this->renderDynamicContent($section);
        echo '</div>';

        echo '</div></div></body></html>';
    }
}

?>
