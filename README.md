
# Documentação Técnica Tracking
> O Objetivo deste documento é ajudar tecnicamente as transportadoras na integração de envio de ocorrência de transportes para Arco.

### Especificação técnica (Payload):
[(https://integrator.qa.arcocv.co/v1/docs/tracking-external)](https://integrator.qa.arcocv.co/v1/docs/tracking-external)

###  URL do ambiente de teste
[https://integrator.qa.arcocv.co/v1/tracking/events](https://integrator.qa.arcocv.co/v1/tracking/events)

### URL do ambiente de produção
[https://tracking.arcoeducacao.com.br/v1/tracking/events](https://tracking.arcoeducacao.com.br/v1/tracking/events)

### Erros Esperados
TODO

### Chave de Acesso `x-api-key`
Envie um email para [transportes@arcoeducacao.com.br](transportes@arcoeducacao.com.br) que receberá a chave de acesso para testes

### Exemplos de Códigos
- [JavaScript](JavaScript)
- [Python](Python)
- [PHP](PHP)
- [Java](Java)
  
### Código das ocorrências
Na Arco já temos um padrão de códigos e descrições que devemos receber para melhor gestão das notas fiscais pelo time de Transporte.

Abaixo você pode ver a lista que deve ser implementada com seus significados. Nenhum código diferente desses deverá ser enviado. Esses dados devem ser usados para preencher os campos: `status`, `codigo_status`, `events.codigo` e `events.descricao_codigo`. É possível ver um exemplo [neste link](https://1ciiwix04k.execute-api.us-east-1.amazonaws.com/prod/v1/docs-tracking-external-openapi).

| Código | Descrição |
| --- | --- |
| 00 | Processo de Transporte já Iniciado |
| 01 | Entrega Realizada Normalmente |
| 02 | Recusa por Falta de Pedido de Compra |
| 03 | Recusa por Pedido de Compra Cancelado |
| 04 | Falta de Espaço Físico no Depósito do Cliente Destino |
| 05 | Endereço do Cliente Destino não Localizado |
| 06 | Devolução não Autorizada pelo Cliente |
| 07 | Preço Mercadoria em Desacordo com o Pedido Compra |
| 08 | Mercadoria em Desacordo com o Pedido Compra |
| 09 | Area de risco |
| 10 | Transportadora não Atende a Cidade do Cliente Destino |
| 11 | Mercadoria Sinistrada |
| 12 | Pedido de Compras em Duplicidade |
| 13 | Mercadorias Trocadas |
| 14 | Reentrega Solicitada pelo Cliente |
| 15 | Entrega Prejudicada por Horário/Falta de Tempo Hábil |
| 16 | Estabelecimento Fechado |
| 17 | Mercadoria Devolvida ao Cliente de Origem |
| 18 | Nota Fiscal Retida pela Fiscalização |
| 19 | Mercadoria Retida até Segunda Ordem |
| 20 | Cliente Retira Mercadoria na Transportadora |
| 21 | Problema com a Documentação (Nota Fiscal e/ou CTRC) |
| 22 | Falta com Busca/Reconferência |
| 23 | Quantidade de Produto em Desacordo (Nota Fiscal e/ou Pedido) |
| 24 | Extravio de documentos pela cia. Aérea - Cód. Transp. Aéreo |
| 25 | Extravio de carga pela cia. Aérea – Cód. Transp. Aéreo |
| 26 | Avaria de carga pela cia. Aérea – Cód. Transp. Aéreo |
| 27 | Corte de carga na pista – Cód. Transp. Aéreo |
| 28 | Aeroporto fechado na origem - Cód. Transp. Aéreo |
| 29 | Feriado Local/Nacional |
| 30 | Excesso de Veículos |
| 31 | Cliente Destino Encerrou Atividades |
| 32 | Responsável de Recebimento Ausente |
| 33 | Cliente Destino em Greve |
| 34 | Aeroporto fechado no destino - Cód. Transp. Aéreo |
| 35 | Vôo cancelado - Cód. Transp. Aéreo |
| 36 | Greve nacional (Greve Geral) |
| 37 | Mercadoria Vencida (Data de Validade Expirada) |
| 38 | Confrontos Armados |
| 39 | Mercadoria Embarcada sem Conhecimento/Conhecimento não Embarcado |
| 40 | Em Rota |
| 41 | Quebra do Veiculo de Entrega |
| 42 | Cliente sem Verba para Pagar o Frete |
| 43 | Endereço de Entrega Errado |
| 44 | Troca não Disponível |
| 45 | Sistema Fora do Ar |
| 46 | Cliente Destino não Recebe Pedido Parcial |
| 47 | Cliente Destino só Recebe Pedido Parcial |
| 48 | Em transferência filial destino |
| 49 | Mercadoria Embarcada para Rota Indevida |
| 50 | Estrada/Entrada de Acesso Interditada |
| 51 | Cliente Destino Mudou de Endereço |
| 52 | Avaria Total |
| 53 | Avaria Parcial |
| 54 | Extravio Total |
| 55 | Extravio Parcial |
| 56 | Sobra de Mercadoria sem Nota Fiscal |
| 57 | Mercadoria em poder da SUFRAMA para Internação |
| 58 | Mercadoria Retirada para Conferência |
| 59 | Apreensão Fiscal da Mercadoria |
| 60 | Férias Coletivas |
| 61 | Recusado, aguardando negociação |
| 62 | Aguardando refaturamento das mercadorias |
| 63 | Em transferência |
| 64 | Entrega Programada |
| 65 | Aguardando carta de correção |
| 66 | Recusa por divergência nas condições de pagamento |
| 67 | Carga aguardando vôo conexão - Cód. Transp. Aéreo |
| 68 | Carga sem embalagem própria para transp. Aéreo - Cód. Transp. Aéreo |
| 69 | Carga com dimensão superior ao porão da aeronave - Cód. Transp. Aéreo |
| 70 | Chegada na cidade ou filial de destino |
| 71 | Interpéries climáticas |
