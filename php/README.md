# Exemplo PHP - Integração Tracking Arco Educação

Este exemplo mostra como enviar eventos de transporte para a API da Arco usando PHP.

## Como Usar

### 1. Configure suas informações

Abra o arquivo `example.php` e substitua os valores das variáveis no início do arquivo pelos seus dados reais:

```php
$ARCO_API_KEY = 'sua-chave-api-aqui'; // ← Substitua pela sua chave API
$ARCO_ENV = 'test'; // ← Use 'test' para testes ou 'prod' para produção
$TRANSPORTADORA_NOME = 'Sua Transportadora'; // ← Nome da sua transportadora
$TRANSPORTADORA_CNPJ = '12345678000190'; // ← CNPJ da transportadora (14 dígitos)
$REMETENTE_NOME = 'SAE'; // ← Nome do remetente
$REMETENTE_CNPJ = '25174365000244'; // ← CNPJ do remetente (14 dígitos)
```

**Importante:** Você precisa solicitar a chave API enviando um e-mail para `geovaneprovin@arcoeducacao.com.br` informando o ambiente desejado (`test` ou `prod`).

### 2. Execute o script

```bash
php example.php
```

### 3. Verifique o resultado

Se tudo estiver correto, você verá uma mensagem de sucesso. Se houver erro, o script mostrará qual foi o problema.

## Requisitos

- PHP 7.4 ou superior instalado
- Extensão `curl` habilitada (geralmente já vem habilitada)
- Não precisa instalar nenhuma biblioteca adicional

## Segurança em Produção

**⚠️ IMPORTANTE:** Para ambientes de produção, **não deixe a chave API diretamente no código**. Use uma das alternativas abaixo:

- **Variáveis de ambiente:** Configure as variáveis no sistema operacional ou servidor (ex: `getenv('ARCO_API_KEY')`)
- **Arquivo .env:** Use bibliotecas como `vlucas/phpdotenv` para carregar variáveis de um arquivo `.env` (não faça commit deste arquivo)
- **Gerenciadores de segredos:** Use serviços como AWS Secrets Manager, Azure Key Vault, ou similares

O exemplo atual mostra as variáveis diretamente no código apenas para facilitar os testes. Em produção, sempre use métodos seguros para armazenar credenciais.

## Problemas Comuns

**Erro: "Missing required configuration"**
- Verifique se você substituiu todos os valores no início do arquivo `example.php`

**Erro: "Unauthorized" (401)**
- Verifique se a chave API está correta
- Confirme que você solicitou a chave para o ambiente correto (`test` ou `prod`)

**Erro: "Bad Request" (400) ou outros erros**
- Verifique se os CNPJs estão no formato correto (14 dígitos, sem pontos ou traços)
- Verifique se todas as datas estão no formato ISO 8601 com timezone (ex: `2024-11-20T14:30:00-03:00`)
- Verifique se os códigos de ocorrência são válidos (consulte `../codigos_ocorrencia.json`)
- Verifique se o campo `nota_fiscal` está preenchido
- Verifique se o array `events` contém pelo menos um evento
- Consulte a documentação completa: https://tracking.arcoeducacao.com.br/v1/docs

## Mais Informações

- [Documentação Completa da API](https://tracking.arcoeducacao.com.br/v1/docs)
- [Códigos de Ocorrência](../codigos_ocorrencia.json)
