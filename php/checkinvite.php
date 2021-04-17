<?php

require_once '../../config.php';

session_name('user_SESSID');
session_start();

if(isset($_POST['invite']))
{
   
   $query = $db->prepare("SELECT * FROM invites WHERE inviteLink = :invite");
   $query->execute(['invite'=>$_POST['invite']]);
   $rowCount = $query->rowCount();
   
   if($rowCount == 1)
   {
   $guildData = $query->fetch();
   $query = $db->prepare("SELECT * FROM guildmembers WHERE memberID = :me AND guildID = :guild AND banned = 0");
   $query->execute(['me'=>$_SESSION['user_id'],'guild'=>$guildData['guildTarget']]);
   
   $rowCount = $query->rowCount();
   
   if($rowCount >= 1)
   {
   $query = $db->prepare("UPDATE users SET lastPage = :guild WHERE ID = :me");
   $query->execute(['guild'=>$guildData['guildTarget'],'me'=>$_SESSION['user_id']]);
   exit(htmlspecialchars(1));
   }else{
   $query = $db->prepare("INSERT INTO guildmembers (memberID,guildID) VALUES(:me,:guild)");
   $query->execute(['me'=>$_SESSION['user_id'],'guild'=>$guildData['guildTarget']]);
   $gei = $db->prepare("SELECT * FROM roles WHERE guildID = :guild AND everyoneRole = 1");
   $gei->execute(['guild'=>$guildData['guildTarget']]);
   $gei = $gei->fetch();
   $gei = $gei['increment'];
   $query = $db->prepare("INSERT INTO guildmemberroles (roleIncrement,givenTo,guildID) VALUES(:everyone,:me,:guild)");
   $query->execute([
   'everyone'=>$gei,
   'me'=>$_SESSION['user_id'],
   'guild'=>$guildData['guildTarget']
   ]);
   
    exit(htmlspecialchars(1));
   }
   
   }else{
   exit(htmlspecialchars(0));
   }
   
   
}else{
header('Location:/');
}