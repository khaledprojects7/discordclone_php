<?php
require_once '../../config.php';
session_name('user_SESSID');
session_start();

$data = ['guild'=>$_SESSION['guild']['ID'],'me'=>$_SESSION['user_id']];

$query = $db->prepare("SELECT * FROM invites WHERE guildTarget = :guild AND inviterID = :me");
$query->execute($data);

$checkAlreadyHaveInvite = $query->rowCount();

if($checkAlreadyHaveInvite == 1)
{
$inviteLink = $query->fetch();
$inviteLink = $inviteLink['inviteLink'];
}else{
function checkInvite($db){
$invitelink = generateInviteLink(10);
$query = $db->prepare("SELECT * FROM invites WHERE inviteLink = :choosedinvite");
$query->execute(['choosedinvite'=>$invitelink]);
if($query->rowCount() == 1)
{
checkInvite();
}else{
return $invitelink;
}
}

$query = $db->prepare("INSERT INTO invites (guildTarget,inviteLink,inviterID) VALUES (:guild,:invitelink,:me)");
$inviteLink = checkinvite($db);
$query->execute([
'guild'=>$_SESSION['guild']['ID'],
'invitelink'=>$inviteLink,
'me'=>$_SESSION['user_id']
]);




}
function generateInviteLink($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<div class="hider1" id="inviteFluidHidingObject">
    <script defer src="js/additionnals/createInvite.js"></script>
    <div id="invite" class="createInviteContainer">
        <div class="header">
            <div class="head">
                <h1>Inviter des amis sur serveur de admin</h1>
                <svg id="closeCIC" aria-hidden="false" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z"></path></svg>
            </div>
            <div class="input">
                <input type="text" placeholder="Rechercher des amis">
                <svg class="icon-3cZ1F_ visible-3V0mGj" aria-hidden="false" width="18" height="18" viewBox="0 0 24 24"><path fill="currentColor" d="M21.707 20.293L16.314 14.9C17.403 13.504 18 11.799 18 10C18 7.863 17.167 5.854 15.656 4.344C14.146 2.832 12.137 2 10 2C7.863 2 5.854 2.832 4.344 4.344C2.833 5.854 2 7.863 2 10C2 12.137 2.833 14.146 4.344 15.656C5.854 17.168 7.863 18 10 18C11.799 18 13.504 17.404 14.9 16.314L20.293 21.706L21.707 20.293ZM10 16C8.397 16 6.891 15.376 5.758 14.243C4.624 13.11 4 11.603 4 10C4 8.398 4.624 6.891 5.758 5.758C6.891 4.624 8.397 4 10 4C11.603 4 13.109 4.624 14.242 5.758C15.376 6.891 16 8.398 16 10C16 11.603 15.376 13.11 14.242 14.243C13.109 15.376 11.603 16 10 16Z"></path></svg>
            </div>
        </div>

        <div class="bottom">
            <h1 class="ctitle">Ou envoyer un lien d'invitation à un ami</h1>
            <input type="text" class="adjustinputborder" style="width:380px;" readonly spellcheck="false" value="discordmnjumia.gg/<?php echo $inviteLink; ?>">
            <p>
                Ton lien d'invitation expire dans 7&nbsp;jours. <a style="font-size:10.5px;" role="button" tabindex="0">Modifier le lien d'invitation.</a>
            </p>
        </div>
</div>
</div>
