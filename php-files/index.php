<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Docker | Teste DevOps/SRE - Mouts</title>
  <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css" />
</head>
<body class="text-center">
  <?php
    echo "<p class='h1'>TESTE - Olá Mundo com conexão ao Mariadb</p><br/>";
    include 'conexao.php';   
    $query = sprintf("SELECT * FROM teste"); 
    $result = $con->query($query);   
    
  ?>  
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>Nro</th>
          <th>Descricao</th>
        </tr>
      </thead>
      <tbody>        
        <?php while ($dados = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $dados['teste_nro']; ?></td>
            <td><?php echo $dados['teste_descricao']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>  
  <?php    
    $query = sprintf("select version()"); 
    $result = $con->query($query);              
    while ($dados =  mysqli_fetch_array($result)) 
    {
      $versao = $dados[0];
    }    
    echo "Versão do Mariadb: " . $versao;
    mysqli_close($con);
    echo "<br />";      
    echo 'Versão do PHP: ' . phpversion();   
    echo "<br />";
    echo "Hostname: " . gethostname();     
  ?>
</body>
</html>