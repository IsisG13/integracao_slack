<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe e decodifica o corpo da requisição
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Validação básica
    if (!isset($data['message']) || !is_string($data['message'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid message']);
        exit;
    }

    $message = $data['message'];
    $webhookUrl = 'https://hooks.slack.com/services/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';

    // Inicializa o cURL
    $ch = curl_init($webhookUrl);

    // Configurações do cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['text' => $message]));

    // Executa a requisição
    $response = curl_exec($ch);

    // Verifica por erros
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Request failed', 'error' => $error]);
        exit;
    }

    // Fecha o cURL
    curl_close($ch);

    // Retorna a resposta
    http_response_code(200);
    echo json_encode(['status' => 'success']);
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
