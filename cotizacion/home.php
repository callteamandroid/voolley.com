<?php 
// include './frameworkng/common.php'; 
?>
<!-- Cargar Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

<!-- Cargar FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

<!-- Cargar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Main Content -->
<main class="content flex-grow-1 p-4">
    <h3 class="h5 mb-4">Reporte de ventas 2024</h3>
    <div class="row">
        <div class="col-lg-8">
            <!-- Canvas para el gráfico -->
            <canvas id="salesChart" style="width: 100%; height: 400px;"></canvas>
        </div>
        <div class="col-lg-4">
            <!-- Información de inventarios y ventas -->
            <div class="card bg-primary text-white card-custom">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-tag fa-2x me-3"></i>
                    <div>
                        <p class="mb-0">INVENTARIO NETO</p>
                        <?php   
                            require './frameworkng/db/conexionmysql.php';
                            $sql = $conexion->query("SELECT SUM(precio) AS total_precio, COUNT(*) AS total_productos FROM productos WHERE planta = 'SLT'");
                            
                            // Verificar si se obtiene algún resultado de la consulta
                            if ($resultado = $sql->fetch_assoc()) {
                                // Imprimir el total de precio con formato contable
                                echo "<h4 class=\"card-title\">$" . number_format($resultado['total_precio'], 2, '.', ',')."</h4>";
                                
                                // Imprimir el total de productos en stock
                                echo "<p class=\"mb-0\">Productos en stock: " . $resultado['total_productos'] . "</p>";
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Tarjetas de ventas, compras, clientes -->
            <div class="card bg-success text-white card-custom">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-money-bill-wave fa-2x me-3"></i>
                    <div>
                        <p class="mb-0">VENTAS 2024</p>
                        <h4 class="card-title">2,877,079.06</h4>
                        <p class="mb-0">Facturas emitidas: 387</p>
                    </div>
                </div>
            </div>
            <div class="card bg-warning text-white card-custom">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-2x me-3"></i>
                    <div>
                        <p class="mb-0">COMPRAS 2024</p>
                        <h4 class="card-title">744,078.31</h4>
                        <p class="mb-0">Compras realizadas: 186</p>
                    </div>
                </div>
            </div>
            <div class="card bg-info text-white card-custom">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3"></i>
                    <div>
                        <p class="mb-0">CLIENTES</p>
                        <h4 class="card-title">7,867</h4>
                        <p class="mb-0">Clientes nuevos: 4</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Cargar Popper.js y Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

<!-- Cargar jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Gráfico con Chart.js -->
<script>
    (function() {
        // Aquí definimos el gráfico de compras y ventas.
        const chartCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(chartCtx, {
            type: 'bar',  // Definimos el tipo de gráfico como barras.
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],  // Meses
                datasets: [{
                    label: 'Compras',
                    data: [250000, 500000, 750000, 1000000, 1250000, 1500000, 1750000, 2000000, 2250000, 2500000, 2750000, 3000000],  // Datos de compras
                    backgroundColor: 'rgba(40, 167, 69, 0.5)',  // Color de las barras de compras
                    borderColor: 'rgba(40, 167, 69, 1)',  // Color del borde de las barras de compras
                    borderWidth: 1
                },
                {
                    label: 'Ventas',
                    data: [200000, 450000, 700000, 950000, 1200000, 1450000, 1700000, 1950000, 2200000, 2450000, 2700000, 2950000],  // Datos de ventas
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',  // Color de las barras de ventas
                    borderColor: 'rgba(255, 99, 132, 1)',  // Color del borde de las barras de ventas
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,  // El gráfico se ajustará al tamaño del contenedor
                scales: {
                    y: {
                        beginAtZero: true  // El eje Y comenzará desde 0
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'  // Posición de la leyenda en la parte superior
                    }
                },
                barPercentage: 0.4,  // Ajuste del espacio entre las barras
                categoryPercentage: 0.5  // Ajuste del espacio entre categorías
            }
        });
    })();
</script>
