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
- Relatar todos os erros  
error_reporting = E_ALL ^ E_NOTICE ^ E_WARNING
- Habilita visualização de erros - Ambiente de Desenvolvimento apenas
display_errors = On
- Habilita a gravação de logs no servidor
log_errors = On
- Caminho fisico dos logs
error_log = /dev/stderr
- Ajustando o limite de upload de arquivos
upload_max_filesize = 64M

-----------------------------------------------------------------------------------

## Mais Detalhes
O Projeto contempla a parte de CI (Continuous Integration) / CD (Continuous Delivery) 

As Image's do projeto se encontra-se atualmente no Container Registry do Docker Hub
https://hub.docker.com/r/sidneyevpereira/unifique/tags

Obs: 
- O projeto apresentado não contempla o CD (Continuous Deploy), pois se trata de um ambiente de teste.
- Para que o projeto contemple o CD (Continuous Deploy) primeiramente precisamos definir aonde o docker estará sendo executado (AWS, Azure , Google Cloud ou On-Premise).
- Para incrementar o swarm-ingress segue abaixo o docker-compose.yml

------------------------------------------------------------------------------------
"version: '3'

# image dockerhub - https://hub.docker.com/_/nginx
services:
  router:
    image: nginx
    ports:
      - '80:80'
    deploy:
      mode: global
    networks:
      - unifique-net

  # image dockerhub - https://hub.docker.com/_/php
  web:
    build:
      context: .
      dockerfile: ./config/Dockerfile-web        
    image: sidneyevpereira/unifique:web        
    deploy:
      replicas: 3        
    restart: always
    hostname: cn-php
    container_name: cn-php    
    volumes:      
      - ./php-files/:/var/www/html/
      - ./config/php.ini:/usr/local/etc/php/php.ini
      - ./config/default.conf:/etc/apache2/sites-available/000-default.conf         
    depends_on:
      - database      
    networks:
      unifique-net:
        aliases:
          - unifique

  # image dockerhub - https://hub.docker.com/_/mariadb/
  database:
    build:
      context: .
      dockerfile: ./config/Dockerfile-database        
    image: sidneyevpereira/unifique:database
    restart: unless-stopped
    hostname: cn-mariadb
    container_name: cn-mariadb
    command:  "--character-set-server=utf8 --collation-server=utf8_general_ci --innodb-use-native-aio=0"
    environment:
      MYSQL_DATABASE: unifique_db
      MYSQL_ROOT_PASSWORD: unifique@2022xxx
    volumes:
      - vol_unifique:/var/lib/mysql
      - ./config/script.sql:/docker-entrypoint-initdb.d/script.sql
    ports:
      - "3306:3306"
    networks:
      - unifique-net 

  # image dockerhub - https://hub.docker.com/_/phpmyadmin
  phpmyadmin:
    build:
      context: .
      dockerfile: ./config/Dockerfile-phpmyadmin        
    image: sidneyevpereira/unifique:phpmyadmin
    restart: always
    hostname: cn-phpmyadmin
    container_name: cn-phpmyadmin    
    environment:
      PMA_HOST: cn-mariadb
      PMA_PORT: 3306
      PMA_ARBITRARY: 1   
      MYSQL_ROOT_PASSWORD: unifique@2022xxx
    # Ajustar para pegar o maximo de upload dos arquivos  
    volumes:
      - ./config/uploads.ini:/usr/local/etc/php/conf.d/php-phpmyadmin.ini
    ports:
      - "8080:80"
    depends_on:
      - database
    networks:
      unifique-net:
        aliases:
          - phpmyadmin  
  
volumes:
  vol_unifique:

networks:
  unifique-net:
    driver: overlay"

------------------------------------------------------------------------------------

# Comandos para executar no servidor docker para testes da aplicação

No computador aonde o docker está instalado, executar os seguintes comandos abaixo:

git clone git@github.com:sidneyevpereira/unifique.git

cd unifique

docker-compose create

docker-compose start

- Pagina Hello World
http://endereco-url-servidor:80

- Pagina Phpmyadmin
http://endereco-url-servidor:8080


