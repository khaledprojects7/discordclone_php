<?php
session_name('user_SESSID');
session_start();
require_once '../config.php';

$data = [
'channel'=>$_SESSION['channel']['ID'],
'sender'=>$_SESSION['user_id'],
'message'=>$_POST['message']
];

$query = $db->prepare("INSERT INTO messages (channel,sender,content) VALUES (:channel,:sender,:message)");
$query->execute($data);

exit(0);