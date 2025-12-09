#!/usr/bin/env node
/**
 * Exemplo de integração para envio de eventos de transporte para Arco Educação.
 * Requer Node.js 18+ (fetch nativo).
 */

// ============================================================================
// CONFIGURAÇÃO - Preencha com seus dados
// ============================================================================
const ARCO_API_KEY = 'sua-chave-api-aqui';
const ARCO_ENV = 'test'; // 'test' ou 'prod'
const TRANSPORTADORA_NOME = 'Sua Transportadora';
const TRANSPORTADORA_CNPJ = '12345678000190';
const REMETENTE_NOME = 'SAE';
const REMETENTE_CNPJ = '25174365000244';
// ============================================================================

// Validação
const required = {
  'ARCO_API_KEY': ARCO_API_KEY,
  'ARCO_ENV': ARCO_ENV,
  'TRANSPORTADORA_NOME': TRANSPORTADORA_NOME,
  'TRANSPORTADORA_CNPJ': TRANSPORTADORA_CNPJ,
  'REMETENTE_CNPJ': REMETENTE_CNPJ,
};

const missing = Object.keys(required).filter(key => !required[key] || required[key] === 'sua-chave-api-aqui');

if (missing.length > 0) {
  console.error(`[ERROR] Missing required configuration: ${missing.join(', ')}`);
  console.error('[INFO] Please configure the variables at the top of this file.');
  process.exit(1);
}

if (ARCO_ENV !== 'test' && ARCO_ENV !== 'prod') {
  console.error(`[ERROR] ARCO_ENV must be 'test' or 'prod', got: ${ARCO_ENV}`);
  process.exit(1);
}

// URL da API
const API_URL = ARCO_ENV === 'prod'
  ? 'https://tracking.arcoeducacao.com.br/v1/tracking/events'
  : 'http://supply-api-gw.stage.arcocv.co/v1/tracking/events';

// Payload
const PAYLOAD = {
  data_geracao_evento: '2024-11-20T14:30:00-03:00',
  transportadora: TRANSPORTADORA_NOME,
  cnpj_transportadora: TRANSPORTADORA_CNPJ,
  nota_fiscal: '123456',
  emissao_conhecimento: '2024-11-15T08:00:00-03:00',
  remetente: {
    nome: REMETENTE_NOME || 'SAE',
    cnpj: REMETENTE_CNPJ,
  },
  previsao_de_entrega: '2024-11-21T17:00:00-03:00',
  data_de_entrega: '2024-11-20T16:45:00-03:00',
  status: 'ENTREGA REALIZADA NORMALMENTE',
  codigo_status: '01',
  events: [
    {
      data_hora: '2024-11-15T10:00:00-03:00',
      codigo: '00',
      descricao_codigo: 'Processo de Transporte já Iniciado',
      descricao: 'Mercadoria coletada no remetente',
    },
    {
      data_hora: '2024-11-20T16:45:00-03:00',
      codigo: '01',
      descricao_codigo: 'Entrega Realizada Normalmente',
      descricao: 'Entrega efetuada com sucesso - Recebido por: João Silva',
    },
  ],
};

// Execução
async function main() {
  console.log('[INFO] Configuration OK');
  console.log(`[INFO] Payload: nota_fiscal=${PAYLOAD.nota_fiscal}, status=${PAYLOAD.status}`);
  console.log(`[INFO] Sending request to: ${API_URL}`);

  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'x-api-key': ARCO_API_KEY,
      },
      body: JSON.stringify(PAYLOAD),
    });
    
    const data = await response.json().catch(async () => ({ raw: await response.text() }));
    
    if (response.status === 202) {
      console.log(`[SUCCESS] Event sent successfully! Status: ${response.status}`);
      console.log(`[INFO] Response: ${JSON.stringify(data, null, 2)}`);
    } else {
      console.error(`[ERROR] Request failed with status: ${response.status}`);
      console.error(`[INFO] Response: ${JSON.stringify(data, null, 2)}`);
      process.exit(1);
    }
  } catch (error) {
    console.error(`[ERROR] Failed to send event: ${error.message}`);
    process.exit(1);
  }
  
  console.log('[INFO] Done!');
}

main();
