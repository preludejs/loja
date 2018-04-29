<?php
require_once '../settings/init.php';

$id = $_POST['idProd'];
$idCat = $_POST['Cat'];

$items = $_SERVER['REMOTE_ADDR'];;

if ($_SESSION['logged_in']==false) {
  $_SESSION['cart'] = serialize($items);
  $sessionCart = $_SESSION['cart'];
}else {
  $sessionCart = md5($_SESSION['user_id']);
}


try {
  $PDO = db_connect();
  ///VERIFICA SE PRODUTO JÁ FOI ADICIONADO AO CARRINHO
  $sqlQuery = "SELECT idProd, toKen, quant FROM carrinho WHERE idProd = :id AND toKen = :toKen";
  $stmt = $PDO->prepare($sqlQuery);

  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':toKen', $sessionCart);

  $stmt->execute();

  $query = $stmt->fetchAll(PDO::FETCH_ASSOC);

  ///SE FALSE ADICIONA ITEM AO CARRINHO
  if(count($query)<=0){
    $sql = ("INSERT INTO `carrinho`(`ID`, `idProd`, `idCat`, `toKen`, `quant`) VALUES (null,'$id','$idCat', '$sessionCart', 1)");
    $PDO->exec($sql);
  }else{
    ///SE TRUE, ADICIONA MAIS UM ITEM  AO CARRINHO
    $quant = $query[0];
    $i = $quant['quant'] + 1;
    $sql = ("UPDATE `carrinho` SET `quant`='$i' WHERE `toKen` = '$sessionCart'");
    $PDO->exec($sql);
  }

} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  echo 'erro';
}
?>
