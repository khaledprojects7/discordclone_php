<?php

session_name('user_SESSID');
session_start();

require_once '../config.php';

$serverName = $_POST['servName'];
$data = ['name'=>$serverName];
$query = $db->prepare("INSERT INTO guilds (name) VALUES(:name)");
$query->execute($data);
$query = $db->query("SELECT max(ID) FROM guilds");
$maxID = $query->fetch();
$maxID = $maxID['max(ID)'];


$me = $_SESSION['user_id'];
$data = ['me'=>$me,'maxID'=>$maxID];
$query = $db->prepare("INSERT INTO guildmembers (memberID,isOwner,guildID) VALUES(:me,1,:maxID)");
$query->execute($data);
$query = $db->prepare("INSERT INTO channels (type,name,guildID,parent,increment) VALUES('category','SALONS TEXTUELS',:maxID,0,1)");
$data = ['maxID'=>$maxID];
$query->execute($data);
$query = $db->prepare("INSERT INTO channels (type,name,guildID,parent,increment) VALUES('text','general',:maxID,1,0)");
$query->execute($data);
$query = $db->prepare("INSERT INTO channels (type,name,guildID,parent,increment) VALUES('category','SALONS VOCAUX',:maxID,0,2)");
$query->execute($data);
$query = $db->prepare("INSERT INTO channels (type,name,guildID,parent,increment) VALUES('voice','General',:maxID,2,0)");
$query->execute($data);
$query = $db->prepare("INSERT INTO roles (name,perms,guildID,increment,separated,everyoneRole) VALUES('@everyone','010809131415161718202223242526',:maxID,1,1,1)");
$query->execute($data);
$data = ['me'=>$me,'maxID'=>$maxID];
$query = $db->prepare("INSERT INTO guildmemberroles (roleIncrement,givenTo,guildID) VALUES(1,:me,:maxID)");
$query->execute($data);
header('location:/?page=app');