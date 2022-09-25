## PROJETO IMPORTA OPEN-FOOD-FACT

API para importação via scrapping de produtos da home inicial de https://br.openfoodfacts.org/

## TECNOLOGIAS USADAS

* PHP
* LARAVEL
* DOCKER
* ATLAS-MONGODB

## COMO INSTALAR E EXECUTAR O PROJETO

1º -> clone o projeto

2º -> Dentro do diretorio do projeto execute o comando
    -> [composer install --ignore-platform-reqs]

3º acessar o diretorio ./laradock e dentro dele executar os seguinte comandos para configuração devida do docker
    -> [cp .env.example .env]

4º Após feito isto executar o docker compose com o comando abaixo
    -> [sudo docker compose up -d nginx]

5º Após realizado os passos acima o projeto já estará funcionando em localhost:8000/api/
   e já será possível executa-lo em ferramentas como postman

## COMO CONFIGURAR O CRON DO PROJETO
   para funcionar o sistema de CRON deve-se configurar o container para executar o task schedule agendado

   1º Dentro do diretório ./laradock executar o comand para acessar o bash do container workspace
        -> [sudo docker compose exec -it workspace bash]

   2º Após acessar o bash 
      [cd /]
      [cd etc/]
      [vim crontab] 

    3º Depois basta colar o comando abaixo no arquivo de cron

        * * * * * root cd /var/www && php artisan schedule:run >> /dev/null 2>&1

    4º Salve o arquivo e tudo estará funcionado 