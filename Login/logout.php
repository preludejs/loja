<?php
require '../settings/init.php';
// inicia a sessão
session_start();

// muda o valor de logged_in para false
$_SESSION['logged_in'] = false;

///esvazia carrinho
try {
  $PDO = db_connect();
  ///VERIFICA SE PRODUTO JÁ FOI ADICIONADO AO CARRINHO
  $sqlQuery = "SELECT toKen FROM carrinho WHERE toKen = :toKen";
  $stmt = $PDO->prepare($sqlQuery);

  $stmt->bindParam(':toKen', $toKen);

  $stmt->execute();

  $query = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if(count($query)>0){
    ///ESVAZIA O CARRINHO ONDE O TOKEN É IGUAL AO TOKENSESSION
    $sql = ("DELETE FROM `carrinho` WHERE toKen = '$toKen'");
    $PDO->exec($sql);

    $_SESSION['userId'] = array();
  }

} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  echo 'erro';
}
// finaliza a sessão
session_destroy();

// retorna para a index.php
header('Location: index.php');

?>
