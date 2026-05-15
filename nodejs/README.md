# Exemplo Node.js - Integração Tracking Arco Educação

Este exemplo mostra como enviar eventos de transporte para a API da Arco usando Node.js.

## Como Usar

### 1. Configure suas informações

Abra o arquivo `example.js` e substitua os valores das variáveis no início do arquivo pelos seus dados reais:

```javascript
const ARCO_API_KEY = 'sua-chave-api-aqui'; // ← Substitua pela sua chave API
const ARCO_ENV = 'test'; // ← Use 'test' para testes ou 'prod' para produção
const TRANSPORTADORA_NOME = 'Sua Transportadora'; // ← Nome da sua transportadora
const TRANSPORTADORA_CNPJ = '12345678000190'; // ← CNPJ da transportadora (14 dígitos)
const REMETENTE_NOME = 'SAE'; // ← Nome do remetente
const REMETENTE_CNPJ = '25174365000244'; // ← CNPJ do remetente (14 dígitos)
```

**Importante:** Você precisa solicitar a chave API enviando um e-mail para `geovaneprovin@arcoeducacao.com.br` informando o ambiente desejado (`test` ou `prod`).

### 2. Execute o script

```bash
node example.js
```

### 3. Verifique o resultado

Se tudo estiver correto, você verá uma mensagem de sucesso. Se houver erro, o script mostrará qual foi o problema.

## Requisitos

- Node.js 18 ou superior instalado
- Não precisa instalar nenhuma biblioteca adicional (usa apenas bibliotecas padrão)

## Segurança em Produção

**⚠️ IMPORTANTE:** Para ambientes de produção, **não deixe a chave API diretamente no código**. Use uma das alternativas abaixo:

- **Variáveis de ambiente:** Configure as variáveis no sistema operacional ou servidor (ex: `process.env.ARCO_API_KEY`)
- **Arquivo .env:** Use bibliotecas como `dotenv` para carregar variáveis de um arquivo `.env` (não faça commit deste arquivo)
- **Gerenciadores de segredos:** Use serviços como AWS Secrets Manager, Azure Key Vault, ou similares

O exemplo atual mostra as variáveis diretamente no código apenas para facilitar os testes. Em produção, sempre use métodos seguros para armazenar credenciais.

## Problemas Comuns

**Erro: "Missing required configuration"**
- Verifique se você substituiu todos os valores no início do arquivo `example.js`

**Erro: "Unauthorized" (401)**
- Verifique se a chave API está correta
- Confirme que você solicitou a chave para o ambiente correto (`test` ou `prod`)

**Erro: "Unprocessable Entity" (422) ou outros erros**
- Verifique se os CNPJs estão no formato correto (14 dígitos, sem pontos ou traços)
- Verifique se todas as datas estão no formato ISO 8601 com timezone (ex: `2024-11-20T14:30:00-03:00`)
- Verifique se os códigos PROCEDA/OCOREN são válidos (consulte a [tabela de códigos](https://arco-cv.github.io/tracking-integration))
- Verifique se o campo `nota_fiscal` está preenchido
- Verifique se o array `events` contém pelo menos um evento
- Consulte a documentação completa: https://arco-cv.github.io/tracking-integration

## Mais Informações

- [Documentação Completa da API](https://arco-cv.github.io/tracking-integration)
- [Códigos PROCEDA/OCOREN](https://arco-cv.github.io/tracking-integration#codigos-proceda-ocoren)
