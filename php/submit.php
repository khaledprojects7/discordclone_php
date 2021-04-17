<?php
session_name('user_SESSID');
session_start();
require_once '../../config.php';

if(isset($_POST['login']) && !empty($_POST['login']) && $_POST['login'] == 1){

$email = $_POST['email'];
$password = $_POST['password'];
$data = [
'email'=>$email,
'password'=>$password
];
$query = $db->prepare("SELECT * FROM users WHERE email = :email AND password = BINARY :password");
$query->execute($data);
$rowCount = $query->rowCount();

if($rowCount == 1){
$user_data = $query->fetch();
$_SESSION['user_id'] = $user_data['ID'];
$_SESSION['user'] = $user_data;
exit('0');
}else{
exit('404');
}


}else if (isset($_POST['register']) && !empty($_POST['register']) && $_POST['register'] == 1){



$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$birthdate = $_POST['birthdayDate'];




$data = [
'username'=>$username,
'email'=>$email,
'password'=>$password,
'birthdate'=>$birthdate
];
$sd = [
'email'=>$email,
'password'=>$password
];
$validation = $db->prepare("SELECT * FROM users WHERE email = :email AND password = BINARY :password");
$validation->execute($sd);
$vrc = $validation->rowCount();
if($vrc == 1){
exit('401');
}

$query = $db->prepare("INSERT INTO users (username,email,password,birthdayDate) VALUES(:username,:email,:password,:birthdate)");
$query->execute($data);

$userAutoLogin = $db->prepare("SELECT * FROM users WHERE email = :email AND password = BINARY :password");
$userAutoLogin->execute($sd);

$userRowCount = $userAutoLogin->rowCount();

if($userRowCount == 0){
exit('404');
}

$userData = $userAutoLogin->fetch();

$_SESSION['user_id'] = $userData['ID'];
$_SESSION['user'] = $userData;
exit('0');


}

else{
header('location:/');
}

?>