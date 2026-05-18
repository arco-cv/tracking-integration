#!/usr/bin/env php
<?php
/**
 * Exemplo de integração para envio de eventos de transporte para a API de Rastreamento.
 * Usa apenas bibliotecas padrão do PHP.
 */

// ============================================================================
// CONFIGURAÇÃO - Preencha com seus dados
// ============================================================================
$ARCO_API_KEY = 'sua-chave-api-aqui';
$ARCO_ENV = 'test'; // 'test' ou 'prod'
$TRANSPORTADORA_NOME = 'Sua Transportadora';
$TRANSPORTADORA_CNPJ = '12345678000190';
$REMETENTE_NOME = 'SAE';
$REMETENTE_CNPJ = '25174365000244';
// ============================================================================

// Validação
$required = [
    'ARCO_API_KEY' => $ARCO_API_KEY,
    'ARCO_ENV' => $ARCO_ENV,
    'TRANSPORTADORA_NOME' => $TRANSPORTADORA_NOME,
    'TRANSPORTADORA_CNPJ' => $TRANSPORTADORA_CNPJ,
    'REMETENTE_CNPJ' => $REMETENTE_CNPJ,
];

$missing = [];
foreach ($required as $key => $value) {
    if (empty($value) || $value === 'sua-chave-api-aqui') {
        $missing[] = $key;
    }
}

if (!empty($missing)) {
    echo "[ERROR] Missing required configuration: " . implode(', ', $missing) . "\n";
    echo "[INFO] Please configure the variables at the top of this file.\n";
    exit(1);
}

if ($ARCO_ENV !== 'test' && $ARCO_ENV !== 'prod') {
    echo "[ERROR] ARCO_ENV must be 'test' or 'prod', got: $ARCO_ENV\n";
    exit(1);
}

// URL da API
$API_URL = $ARCO_ENV === 'prod'
    ? 'https://tracking.arcoeducacao.com.br/v2/tracking/events'
    : 'http://supply-api-gw.stage.arcocv.co/v2/tracking/events';

// Payload
$PAYLOAD = [
    'data_geracao_evento' => '2024-11-20T14:30:00-03:00',
    'transportadora' => $TRANSPORTADORA_NOME,
    'cnpj_transportadora' => $TRANSPORTADORA_CNPJ,
    'nota_fiscal' => '123456',
    'emissao_conhecimento' => '2024-11-15T08:00:00-03:00',
    'remetente' => [
        'nome' => $REMETENTE_NOME ?: 'SAE',
        'cnpj' => $REMETENTE_CNPJ,
    ],
    'previsao_de_entrega' => '2024-11-21T17:00:00-03:00',
    'data_de_entrega' => '2024-11-20T16:45:00-03:00',
    'status' => 'ENTREGA REALIZADA NORMALMENTE',
    'codigo_status' => '01',
    'events' => [
        [
            'data_hora' => '2024-11-15T10:00:00-03:00',
            'codigo' => '00',
            'descricao_codigo' => 'Processo de Transporte já Iniciado',
            'descricao' => 'Mercadoria coletada no remetente',
        ],
        [
            'data_hora' => '2024-11-20T16:45:00-03:00',
            'codigo' => '01',
            'descricao_codigo' => 'Entrega Realizada Normalmente',
            'descricao' => 'Entrega efetuada com sucesso - Recebido por: João Silva',
        ],
    ],
];

// Execução
echo "[INFO] Configuration OK\n";
echo "[INFO] Payload: nota_fiscal={$PAYLOAD['nota_fiscal']}, status={$PAYLOAD['status']}\n";
echo "[INFO] Sending request to: $API_URL\n";

$ch = curl_init($API_URL);

$body = json_encode($PAYLOAD);
$headers = [
    'Content-Type: application/json',
    'x-api-key: ' . $ARCO_API_KEY,
];

curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $body,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
]);

$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo "[ERROR] Failed to send event: cURL error: $error\n";
    exit(1);
}

$responseJson = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    $responseJson = ['raw' => $response];
}

if ($status === 202) {
    echo "[SUCCESS] Event sent successfully! Status: $status\n";
    echo "[INFO] Response: " . json_encode($responseJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
} else {
    echo "[ERROR] Request failed with status: $status\n";
    echo "[INFO] Response: " . json_encode($responseJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    exit(1);
}

echo "[INFO] Done!\n";
