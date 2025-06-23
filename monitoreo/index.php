<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './vendor/autoload.php';

// Configuración
$hosts = ['201.163.89.186', '45.239.77.103', '200.57.12.18', '200.188.16.178', '8.8.8.8'];
$emailRecipients = ['soportetja@gmail.com', 'sistemas.aux2@tgramol.mx'];
$latencyThreshold = 150;
$errorCountThreshold = 3;

// Contadores por host
$errorCounts = array_fill_keys($hosts, 0);
$latencies = array_fill_keys($hosts, []); // Para almacenar las latencias

// Proveer datos JSON para el frontend
if (isset($_GET['json'])) {
    foreach ($hosts as $host) {
        $pingResult = shell_exec("ping -n 1 $host");
        
        if (preg_match('/tiempo=(\d+)ms/', $pingResult, $matches)) {
            $latency = floatval($matches[1]);
            $latencies[$host][] = $latency; 
            
            if ($latency > $latencyThreshold) {
                $errorCounts[$host]++;
                if ($errorCounts[$host] >= $errorCountThreshold) {
                    sendEmailNotification($emailRecipients, $host, $latency);
                    $errorCounts[$host] = 0;
                }
            } else {
                $errorCounts[$host] = 0;
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode([
        'latencies' => $latencies,
        'packetLoss' => $errorCounts
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
        $mail->Password = 'utfr arsk wuxp buja';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('gserversalt@gmail.com', 'Grupo Server');
        foreach ($recipients as $recipient) {
            $mail->addAddress($recipient);
        }

        $mail->isHTML(true);
        $mail->Subject = "Alerta: Latencia alta en $host";
        $mail->Body = "Se han detectado problemas de latencia con $host. Latencia actual: $latency ms. Por favor, revisa la conexión.";

        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar correo: {$mail->ErrorInfo}\n";
    }
}
?>
