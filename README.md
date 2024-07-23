## Inicialização do Projeto

Este projeto permite enviar notificações para um canal Slack usando uma API simples. Siga as instruções abaixo para inicializar e testar a integração.

## Pré-requisitos 
Certifique-se de que você tenha as seguintes ferramentas:

- Postman ou cURL para enviar requisições HTTP.

## Instruções para o envio das notificações para o Slack

- Usando cURL:
  
Para enviar uma notificação para o Slack, utilize o seguinte comando cURL:

→ curl -X POST://SUA-ROTA/integracao/slack/notificacao -H "Content-Type: application/json" -d '{"message": "Hello Slack!"}'

📢  Troque o nome SUA-ROTA pela rota que esta utilizando (local ou externa)!