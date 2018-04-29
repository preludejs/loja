<?php

// inclui o arquivo de inicialização
require '../settings/init.php';

// resgata variáveis do formulário
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($email) || empty($password))
{
    header('Location: index.php?acc=empty');
    exit;
}

// cria o hash da senha
$passwordHash = make_hash($password);
//CONEXÃO COM O BD
$PDO = db_connect();

$sql = "SELECT ID, nome, eMail, cpf FROM users WHERE eMail = :email AND passwd = :password";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $passwordHash);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0){
    //USUARIO OU SENHA INCORRETOS
    header('Location: index.php?acc=false');
    exit;
}

// pega o primeiro usuário
$user = $users[0];

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['ID'];
$_SESSION['user_name'] = $user['nome'];
if(isset($_SESSION['cart'])){
  $sql = ("UPDATE `carrinho` SET `toKen`='".md5($_SESSION['user_id'])."' WHERE toKen = '".$_SESSION['cart']."'");
  $PDO->exec($sql);
  $_SESSION['cart'] = md5($_SESSION['user_id']);
}
//USUARIO LOGADO
header('Location: logado.php');
