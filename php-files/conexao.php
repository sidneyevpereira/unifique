<?php
      $usuario_mysql="root";
      $senha_mysql="unifique@2022xxx"; 
      $conteiner_name="cn-mariadb";
      $nome_banco="unifique_db";   
       
      $con = mysqli_connect($conteiner_name,$usuario_mysql,$senha_mysql,$nome_banco);    
      mysqli_select_db($nome_banco, $con);
  ?>