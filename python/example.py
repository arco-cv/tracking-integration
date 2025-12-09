#!/usr/bin/env python3
"""
Exemplo de integração para envio de eventos de transporte para Arco Educação.
Usa apenas bibliotecas padrão do Python.
"""

# ============================================================================
# CONFIGURAÇÃO - Preencha com seus dados
# ============================================================================
ARCO_API_KEY = 'sua-chave-api-aqui'
ARCO_ENV = 'test'  # 'test' ou 'prod'
TRANSPORTADORA_NOME = 'Sua Transportadora'
TRANSPORTADORA_CNPJ = '12345678000190'
REMETENTE_NOME = 'SAE'
REMETENTE_CNPJ = '25174365000244'
# ============================================================================

import json
import sys
from http.client import HTTPSConnection, HTTPConnection
from urllib.parse import urlparse

# Validação
required = {
    'ARCO_API_KEY': ARCO_API_KEY,
    'ARCO_ENV': ARCO_ENV,
    'TRANSPORTADORA_NOME': TRANSPORTADORA_NOME,
    'TRANSPORTADORA_CNPJ': TRANSPORTADORA_CNPJ,
    'REMETENTE_CNPJ': REMETENTE_CNPJ,
}

missing = [key for key, value in required.items() if not value or value == 'sua-chave-api-aqui']

if missing:
    print(f"[ERROR] Missing required configuration: {', '.join(missing)}")
    print("[INFO] Please configure the variables at the top of this file.")
    sys.exit(1)

if ARCO_ENV not in ['test', 'prod']:
    print(f"[ERROR] ARCO_ENV must be 'test' or 'prod', got: {ARCO_ENV}")
    sys.exit(1)

# URL da API
API_URL = 'https://tracking.arcoeducacao.com.br/v1/tracking/events' if ARCO_ENV == 'prod' else 'http://supply-api-gw.stage.arcocv.co/v1/tracking/events'

# Payload
PAYLOAD = {
    'data_geracao_evento': '2024-11-20T14:30:00-03:00',
    'transportadora': TRANSPORTADORA_NOME,
    'cnpj_transportadora': TRANSPORTADORA_CNPJ,
    'nota_fiscal': '123456',
    'emissao_conhecimento': '2024-11-15T08:00:00-03:00',
    'remetente': {
        'nome': REMETENTE_NOME or 'SAE',
        'cnpj': REMETENTE_CNPJ,
    },
    'previsao_de_entrega': '2024-11-21T17:00:00-03:00',
    'data_de_entrega': '2024-11-20T16:45:00-03:00',
    'status': 'ENTREGA REALIZADA NORMALMENTE',
    'codigo_status': '01',
    'events': [
        {
            'data_hora': '2024-11-15T10:00:00-03:00',
            'codigo': '00',
            'descricao_codigo': 'Processo de Transporte já Iniciado',
            'descricao': 'Mercadoria coletada no remetente',
        },
        {
            'data_hora': '2024-11-20T16:45:00-03:00',
            'codigo': '01',
            'descricao_codigo': 'Entrega Realizada Normalmente',
            'descricao': 'Entrega efetuada com sucesso - Recebido por: João Silva',
        },
    ],
}

# Execução
print('[INFO] Configuration OK')
print(f'[INFO] Payload: nota_fiscal={PAYLOAD["nota_fiscal"]}, status={PAYLOAD["status"]}')
print(f'[INFO] Sending request to: {API_URL}')

parsed = urlparse(API_URL)
is_https = parsed.scheme == 'https'
host = parsed.netloc
path = parsed.path

body = json.dumps(PAYLOAD).encode('utf-8')
headers = {
    'Content-Type': 'application/json',
    'x-api-key': ARCO_API_KEY,
}

conn_class = HTTPSConnection if is_https else HTTPConnection
conn = conn_class(host)

try:
    conn.request('POST', path, body, headers)
    response = conn.getresponse()
    response_body = response.read().decode('utf-8')
    
    try:
        response_json = json.loads(response_body)
    except:
        response_json = {'raw': response_body}
    
    if response.status == 202:
        print(f'[SUCCESS] Event sent successfully! Status: {response.status}')
        print(f'[INFO] Response: {json.dumps(response_json, ensure_ascii=False, indent=2)}')
    else:
        print(f'[ERROR] Request failed with status: {response.status}')
        print(f'[INFO] Response: {json.dumps(response_json, ensure_ascii=False, indent=2)}')
        sys.exit(1)
except Exception as e:
    print(f'[ERROR] Failed to send event: {str(e)}')
    sys.exit(1)
finally:
    conn.close()

print('[INFO] Done!')
