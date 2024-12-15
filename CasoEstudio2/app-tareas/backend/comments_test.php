
<?php

function sendRequest($method, $url, $data = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ['response' => $response, 'httpCode' => $httpCode];
}

// URL base de la API
$baseUrl = 'http://localhost:3000/practica-programada-4/app-tareas/backend/comments_test.php';

// Datos de prueba
$task_id = 1; // Asegúrate de que esta tarea exista en tu base de datos
$commentData = ['task_id' => $task_id, 'comment' => 'Este es un comentario de prueba'];

// Crear comentario
$response = sendRequest('POST', $baseUrl, $commentData);
echo "POST /comments.php\n";
echo "HTTP Code: " . $response['httpCode'] . "\n";
echo "Response: " . $response['response'] . "\n\n";

// Obtener comentarios
$response = sendRequest('GET', $baseUrl . '?task_id=' . $task_id);
echo "GET /comments.php?task_id=$task_id\n";
echo "HTTP Code: " . $response['httpCode'] . "\n";
echo "Response: " . $response['response'] . "\n\n";

// Actualizar comentario
$commentId = json_decode($response['response'], true)[0]['id']; // Obtener el ID del primer comentario
$updateData = ['comment' => 'Comentario actualizado'];
$response = sendRequest('PUT', $baseUrl . '?id=' . $commentId, $updateData);
echo "PUT /comments.php?id=$commentId\n";
echo "HTTP Code: " . $response['httpCode'] . "\n";
echo "Response: " . $response['response'] . "\n\n";

// Eliminar comentario
$response = sendRequest('DELETE', $baseUrl . '?id=' . $commentId);
echo "DELETE /comments.php?id=$commentId\n";
echo "HTTP Code: " . $response['httpCode'] . "\n";
echo "Response: " . $response['response'] . "\n\n";

?>
