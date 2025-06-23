<?php
class Dashboard {
    private $user_name;
    private $user_image;
    private $menu_items;

    // Definir las opciones de menú predeterminadas como constante
    private const DEFAULT_MENU_ITEMS = [
        ["Inicio", "inicio", "fa-home"],
        ["Compras", "compras", "fa-truck"],
        ["Productos", "productos", "fa-boxes"],
        ["Fabricantes", "fabricantes", "fa-industry"],
        ["Contactos", "contactos", "fa-address-book"],
        ["Facturación", "facturacion", "fa-file-invoice-dollar"],
        ["Reportes", "reportes", "fa-chart-line"],
        ["Configuración", "configuracion", "fa-cogs"],
        ["Administrar accesos", "accesos", "fa-user-shield"]
    ];

    public function __construct($user_name, $user_image, $menu_items = []) {
        $this->user_name = $user_name;
        $this->user_image = $user_image;
        $this->menu_items = !empty($menu_items) ? $menu_items : self::DEFAULT_MENU_ITEMS;
    }

    private function getActiveSection() {
        return isset($_GET['section']) ? $_GET['section'] : 'inicio';
    }

    public function renderSidebar() {
        $active_section = $this->getActiveSection(); // Obtenemos la sección activa

        echo '<div class="col-3 col-md-2 bg-dark text-white h-100 flex-column">';
        echo '<div class="p-4 d-flex align-items-center">';
        echo '<img alt="User avatar" class="rounded-circle mr-2" height="40" src="' . $this->user_image . '" width="40"/>';
        echo '<div><p class="font-weight-bold">' . $this->user_name . '</p><p class="text-success">Online</p></div>';
        echo '</div>';
        echo '<nav class="mt-4"><ul class="list-unstyled">';

        // Renderizamos los items del menú
        foreach ($this->menu_items as $item) {
            $active_class = ($active_section === $item[1]) ? "bg-secondary" : "hover:bg-secondary";
            echo '<li class="p-2 ' . $active_class . '">';
            echo '<a href="#" class="menu-item d-flex text-white" data-section="' . $item[1] . '"><i class="fas ' . $item[2] . ' mr-2"></i>';
            echo $item[0] . '</a></li>';
        }

        echo '</ul></nav></div>';
    }
    

    public function renderHeader() {
        echo '<div class="bg-success p-3 d-flex justify-content-between align-items-center">';
        echo '<div class="text-white h3">Inventario</div>';
        echo '<div class="d-flex align-items-center">';
        echo '<input class="form-control me-2" placeholder="Buscar por nombre" type="text"/>';
        echo '<button class="btn btn-white"><i class="fas fa-search"></i></button>';
        echo '</div>';
        echo '<div class="d-flex align-items-center">';
        echo '<img alt="User avatar" class="rounded-circle mr-2" height="40" src="' . $this->user_image . '" width="40"/>';
        echo '<p class="text-white">' . $this->user_name . '</p>';
        echo '</div>';
        echo '</div>';
    }

    // Método para renderizar el contenido dinámico de acuerdo a la sección
    public function renderDynamicContent($section) {
        switch ($section) {
            case 'inicio':
                echo '<h2 class="h4">Bienvenido a tu Dashboard</h2><p>Selecciona una opción del menú para ver más.</p>';
                break;
            case 'compras':
                echo '<h2 class="h4">Listado de Compras</h2>';
                break;
            case 'productos':
                echo '<h2 class="h4">Listado de Productos</h2>';
                break;
            default:
                echo '<h2 class="h4">Bienvenido a Inventory Control</h2><p>Selecciona una opción del menú para ver el contenido.</p>';
                break;
        }
    }

    private function renderResources() {
        // Cargar los recursos globales
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />';
        echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />';
        echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
        echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
    }

    public function renderLayout() {
        $section = $this->getActiveSection();

        echo '<!DOCTYPE html><html lang="es"><head>';
        echo '<meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/>';
        echo '<title>Inventario</title>';
        
        // Cargar recursos solo una vez
        $this->renderResources();
        
        echo '<script>
                $(document).ready(function(){
                    $(".menu-item").click(function(e){
                        e.preventDefault();
                        var section = $(this).data("section");

                        // Cambiar el contenido de la sección sin recargar la página
                        $.ajax({
                            url: section + ".php", 
                            method: "GET",
                            success: function(response) {
                                $("#content").html(response); 
                            }
                        });
                    });
                });
              </script>';

        echo '</head><body class="bg-light"><div class="container-fluid d-flex flex-row">';

        // Renderizar la barra lateral
        echo '<div class="col-3 col-md-2 p-0" style="background-color: #212529;">';
        $this->renderSidebar();
        echo '</div>';

        // Contenido principal
        echo '<div class="col-9 col-md-10">';
        
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
