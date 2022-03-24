# Projeto teste - Unifique

Projeto solicitado no dia 18/03/2022 com prazo de entrega definido em 24/03/2022.

Desenvolver um projeto usando docker, docker-compose, docker swarm

1 - Subir um container  hello word básico com php 5.6;

2 - Detalhar as configurações utilizadas do php.ini;

3 - Subir um container com banco mysql/mariaDB que comunique com o container php;

4 - Criar o script da  pipeline para deploy; 

5 - Fazer uma breve documentação de como usar o ambiente;

6 - Subir os arquivos do projeto em um github e nos enviar o link;

-----------------------------------------------------------------------------------

## php.ini
-- Relatar todos os erros  
error_reporting = E_ALL ^ E_NOTICE ^ E_WARNING
-- Habilita visualização de erros - Ambiente de Desenvolvimento apenas
display_errors = On
-- Habilita a gravação de logs no servidor
log_errors = On
-- Caminho fisico dos logs
error_log = /dev/stderr
-- Ajustando o limite de upload de arquivos
upload_max_filesize = 64M

-----------------------------------------------------------------------------------

## Mais Detalhes
O Projeto contempla a parte de CI (Continuous Integration) / CD (Continuous Delivery) 

As Image's do projeto se encontra-se atualmente no Container Registry do Docker Hub
https://hub.docker.com/r/sidneyevpereira/unifique/tags

Obs: 
- O projeto apresentado não contempla o CD (Continuous Deploy), pois se trata de um ambiente de teste.
- Para que o projeto contemple o CD (Continuous Deploy) primeiramente precisamos definir aonde o docker estará sendo executado (AWS, Azure , Google Cloud ou On-Premise).
- Para incrementar o swarm-ingress usar o arquivo docker-compose-ingress.yml

# Comandos para executar no servidor docker para testes da aplicação

No computador aonde o docker está instalado, executar os seguintes comandos abaixo:

git clone git@github.com:sidneyevpereira/unifique.git

cd unifique

docker-compose create

docker-compose start

# Pagina Hello World
http://endereco-url-servidor:80

# Pagina Phpmyadmin
http://endereco-url-servidor:8080


