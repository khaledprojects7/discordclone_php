<?php
if(isset($_POST['guildID'])){
session_name('user_SESSID');
session_start();

require_once '../../config.php';
$data = [
'guildID'=> $_POST['guildID'],
'userID' => $_SESSION['user_id']
];
$query = $db->prepare("UPDATE users SET lastPage = :guildID WHERE ID = :userID");
$query->execute($data);
$data = ['guildID'=>$_POST['guildID']];

$query = $db->prepare("SELECT * FROM guilds WHERE ID = :guildID");
$query->execute($data);

$_SESSION['guild'] = $query->fetch();
$data = ['guildID'=>$_POST['guildID'],'memberID'=>$_SESSION['user_id']];
$query = $db->prepare("SELECT * FROM guildmembers WHERE guildID = :guildID AND memberID = :memberID");
$query->execute($data);
$_SESSION['guildmember'] = $query->fetch();
$data = ['guildID'=>$_POST['guildID']];
$query = $db->prepare("SELECT * FROM roles WHERE guildID = :guildID");
$query->execute($data);
$_SESSION['guildRoles'] = $query->fetch();
$query = $db->prepare("SELECT * FROM guildmemberroles WHERE guildID = :guildID");
$query->execute($data);
$_SESSION['guildmemberoles'] = $query->fetch();
$data = ['user'=>$_SESSION['user_id'],'guild'=>$_POST['guildID']];
$query = $db->prepare("SELECT * FROM guildmembers WHERE memberID = :user AND guildID = :guild");
$query->execute($data);
$memberData = $query->fetch();

$_SESSION['lastChannel'] = $memberData['lastChannel'];
$_SESSION['user']['lastPage'] = $_POST['guildID'];

$data = ['guildID'=>$_POST['guildID'],'channel'=>$memberData['lastChannel']];

$query = $db->prepare("SELECT * FROM channels WHERE guildID = :guildID AND increment = :channel");
$query->execute($data);

$_SESSION['channel'] = $query->fetch();


include_once '../body/sidebar.php';
include_once '../body/guildcontent.php';
include_once '../body/guildrightside.php';

}else{
header('location:/');
}

?>
