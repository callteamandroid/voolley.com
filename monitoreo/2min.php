<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './vendor/autoload.php';

// Configuración
$hosts = ['201.163.89.186', '45.239.77.103', '200.57.12.18', '200.188.16.178', '8.8.8.8'];
$emailRecipients = ['soportetja@gmail.com', 'sistemas.aux2@tgramol.mx'];
$latencyThreshold = 150; // Umbral de latencia en milisegundos
$errorCountThreshold = 3; // Umbral de pérdidas de paquetes
$timeWindow = 120; // 2 minutos en segundos

// Contadores por host
$errorCounts = array_fill_keys($hosts, 0);
$packetLossTimestamps = array_fill_keys($hosts, []); // Tiempos de pérdidas de paquetes
$latencies = array_fill_keys($hosts, []); // Para almacenar las latencias
$attacks = []; // Almacenar las IPs atacantes y las IPs objetivo

// Proveer datos JSON para el frontend
if (isset($_GET['json'])) {
    foreach ($hosts as $host) {
        $pingResult = shell_exec("ping -n 1 $host");
        
        if (preg_match('/tiempo=(\d+)ms/', $pingResult, $matches)) {
            $latency = floatval($matches[1]);
            $latencies[$host][] = $latency; // Guardar latencia para este host

            // Si la latencia es mayor que el umbral, contamos como un error
            if ($latency > $latencyThreshold) {
                $errorCounts[$host]++;
                // Incrementar el contador de ataques para esta IP
                if (!isset($attacks[$host])) {
                    $attacks[$host] = [
                        'target' => 'Objetivo de ataque: ' . $host,
                        'count' => 0
                    ];
                }
                $attacks[$host]['count']++;

                if ($errorCounts[$host] >= $errorCountThreshold) {
                    sendEmailNotification($emailRecipients, $host, $latency);
                    $errorCounts[$host] = 0; // Reiniciar el contador de errores
                }
            } else {
                $errorCounts[$host] = 0; // Reiniciar el contador si la latencia está dentro del umbral
            }
        } else {
            // Si el ping no obtiene respuesta, se cuenta como una pérdida de paquete
            $currentTime = time();
            $packetLossTimestamps[$host][] = $currentTime;

            // Eliminar las marcas de tiempo fuera de la ventana de 2 minutos
            $packetLossTimestamps[$host] = array_filter($packetLossTimestamps[$host], function($timestamp) use ($currentTime, $timeWindow) {
                return ($currentTime - $timestamp) <= $timeWindow;
            });

            // Verificar si hay 3 pérdidas de paquetes en los últimos 2 minutos
            if (count($packetLossTimestamps[$host]) >= $errorCountThreshold) {
                if (!isset($attacks[$host])) {
                    $attacks[$host] = [
                        'target' => 'Objetivo de ataque: ' . $host,
                        'count' => 0
                    ];
                }
                $attacks[$host]['count']++;
                sendEmailNotification($emailRecipients, $host, 'Pérdida de paquetes');
                $packetLossTimestamps[$host] = []; // Reiniciar los registros de pérdida de paquetes
            }
        }
    }

    // Responder con los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode([
        'latencies' => $latencies,
        'packetLoss' => $errorCounts,
        'attacks' => $attacks // Enviar las IPs atacantes, los ataques y los objetivos
    ]);
    exit;
}

function sendEmailNotification($recipients, $host, $latency) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gserversalt@gmail.com';
        $mail->Password = 'utfr arsk wuxp buja'; // Asegúrate de usar un App Password o método seguro de autenticación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('gserversalt@gmail.com', 'Grupo Server');
        foreach ($recipients as $recipient) {
            $mail->addAddress($recipient);
        }

        $mail->isHTML(true);
        $mail->Subject = "Alerta: Problema con $host";
        if ($latency === 'Pérdida de paquetes') {
            $mail->Body = "Se ha detectado una pérdida de paquetes en $host. Se han perdido 3 paquetes en los últimos 2 minutos.";
        } else {
            $mail->Body = "Se han detectado problemas de latencia con $host. Latencia actual: $latency ms. Por favor, revisa la conexión.";
        }

        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar correo: {$mail->ErrorInfo}\n";
    }
}
?>
