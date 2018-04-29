<?php
require '../settings/init.php';

if ($_GET['cat'] == 'cel') {
  $idCat = 1;
}elseif ($_GET['cat'] == 'eletro') {
  $idCat = 2;
}
//CONEXÃO COM O BD
$PDO = db_connect();
///busca produtos
$sql = "SELECT ID, categoria FROM categorias WHERE ID = '$idCat'";
$prod = $PDO->query($sql);

while ($item = $prod->fetch()) {
  $cat = $item['categoria'];
} $prod->closeCursor();


?>
