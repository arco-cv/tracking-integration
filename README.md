
# Documentação Técnica Tracking
> O Objetivo deste documento é ajudar tecnicamente as transportadoras na integração de envio de ocorrência de transportes para Arco.

### Especificação técnica (Payload):
[https://arco-cv.github.io/tracking-integration](https://arco-cv.github.io/tracking-integration/)

###  URL do ambiente de teste
[http://supply-api-gw.stage.arcocv.co/v2/tracking/events](http://supply-api-gw.stage.arcocv.co/v2/tracking/events)

### URL do ambiente de produção
[https://tracking.arcoeducacao.com.br/v2/tracking/events](https://tracking.arcoeducacao.com.br/v2/tracking/events)

### ⚠️ Aviso de Deprecação
O endpoint `/v1/tracking/events` está depreciado. Utilize `/v2/tracking/events`. Integrações existentes em v1 continuam funcionando, mas novas devem usar v2.

### Erros Esperados
TODO

### Chave de Acesso `x-api-key`
Enviar e-mail solicitando a chave de acesso para geovaneprovin@arcoeducacao.com.br e especificar o ambiente `testes ou produção`

### Exemplos de Códigos
- [Node.js](nodejs/)
- [Python](python/)
- [PHP](php/)

### Códigos PROCEDA/OCOREN
A v2 utiliza o padrão de mercado brasileiro **PROCEDA/OCOREN** (códigos 00–99) para eventos logísticos. A tabela completa de códigos está na [documentação técnica](https://arco-cv.github.io/tracking-integration).
