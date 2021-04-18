<div class="guildContentR right scrollbarA" style="width: 250px;overflow: auto;overflow-x: hidden;">
<?php 

$getroles = $db->prepare("SELECT * FROM roles WHERE guildID = :guildID AND separated = 1 ORDER BY increment ASC");
$getroles->execute(['guildID'=>$_SESSION['guild']['ID']]);

while($role = $getroles->fetch())
{

$validated = 0;
$hrolemembers = [];
$op1 = $db->prepare("SELECT * FROM guildmemberroles WHERE roleIncrement = :increment AND guildID = :guild");

$op1->execute(['increment'=>$role['increment'],'guild'=>$_SESSION['guild']['ID']]);

if($op1->rowCount() >= 1)
{

while($validation_opperation1 = $op1->fetch())
{

$op2 = $db->prepare("SELECT min(roleIncrement) FROM guildmemberroles WHERE guildID = :guild AND givenTo = :member");
$op2->execute(['guild'=>$_SESSION['guild']['ID'],'member'=>$validation_opperation1['givenTo']]);
$op2_fetch = $op2->fetch();

if($op2_fetch['min(roleIncrement)'] == $role['increment']){
$validated = 1;
array_push($hrolemembers,[
'ID'=>$validation_opperation1['givenTo']
]);

}
}


}


if($validated == 1){
echo ("<div class='categoryContainer' target='".$role['increment']."'>");
if($role['everyoneRole'] == 1)
{
echo ("<h1 class='category'>En ligne</h1>");
}else{
echo ("<h1 class='category'>".$role['name']."</h1>");
}
for($i = 0;$i< sizeof($hrolemembers);$i++)
{
  $query = $db->prepare("SELECT * FROM users WHERE ID = :memberID");
  $query->execute(['memberID'=>$hrolemembers[$i]['ID']]);
  $member = $query->fetch();
    $username = $member['username'];
   if($member['pfp'] == 0){
  $pfpSrc = 'images/pfp.png';
  }else{
  $pfpSrc = 'images/profile_pictures/'.$member['ID'].'.png';
  }
  
  $query = $db->prepare("SELECT * FROM guildmembers WHERE memberID = :member AND guildID = :guild");
  $query->execute(['member'=>$member['ID'],'guild'=>$_SESSION['guild']['ID']]);
  $cimio = $query->fetch();
  $getColor = 0;
  $getColoredRole = $db->prepare("SELECT * FROM guildmemberroles WHERE givenTo = :member AND guildID = :guild");
   $getColoredRole->execute(['member'=>$message_user['ID'],'guild'=>$_SESSION['guild']['ID']]);
   $getColoredRole_rowCount = $getColoredRole->rowCount();
   $gcrfa = $getColoredRole->fetchAll();
   $color = '';

   for($i = $getColoredRole_rowCount - 1;$i=0;$i--){
   $grc = $db->prepare("SELECT * FROM roles WHERE increment = :inc AND guildID = :guild ORDER BY increment ASC");
   $grc->execute(['inc'=>$gcrfa[$i]['roleIncrement'],'guild'=>$_SESSION['guild']['ID']]);
   $grc = $grc->fetch();
  
       if($grc['color']){
       $color = '#'.$grc['color'];
      $getColor = 1;
       
       }
   }
  if($getColor == 0)
  {
    
  echo ("<div class='user noColor'><img src='$pfpSrc'><div class='block'><div style='display:flex;justify-content:space-between;'><h1>$username</h1>"); 
  if($cimio['isOwner'] == 1) { echo('<svg aria-label="Propriétaire du serveur" class="ownerIcon-2NH9FM icon-1A2_vz" aria-hidden="false" width="14" height="14" viewBox="0 0 14 14"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.6572 5.42868C13.8879 5.29002 14.1806 5.30402 14.3973 5.46468C14.6133 5.62602 14.7119 5.90068 14.6473 6.16202L13.3139 11.4954C13.2393 11.7927 12.9726 12.0007 12.6666 12.0007H3.33325C3.02725 12.0007 2.76058 11.792 2.68592 11.4954L1.35258 6.16202C1.28792 5.90068 1.38658 5.62602 1.60258 5.46468C1.81992 5.30468 2.11192 5.29068 2.34325 5.42868L5.13192 7.10202L7.44592 3.63068C7.46173 3.60697 7.48377 3.5913 7.50588 3.57559C7.5192 3.56612 7.53255 3.55663 7.54458 3.54535L6.90258 2.90268C6.77325 2.77335 6.77325 2.56068 6.90258 2.43135L7.76458 1.56935C7.89392 1.44002 8.10658 1.44002 8.23592 1.56935L9.09792 2.43135C9.22725 2.56068 9.22725 2.77335 9.09792 2.90268L8.45592 3.54535C8.46794 3.55686 8.48154 3.56651 8.49516 3.57618C8.51703 3.5917 8.53897 3.60727 8.55458 3.63068L10.8686 7.10202L13.6572 5.42868ZM2.66667 12.6673H13.3333V14.0007H2.66667V12.6673Z" fill="#faa61a" aria-hidden="true"></path></svg>');}
  echo("</div></div></div>");
  }else{
  
 
  $color = '#'.$role['color'];
 
  echo ("<div class='user'><img src='$pfpSrc'><div class='block'><div style='display:flex;justify-content:space-between;'><h1 style='color:$color;'>$username</h1>");
    if($cimio['isOwner'] == 1) { echo('<svg aria-label="Propriétaire du serveur" class="ownerIcon-2NH9FM icon-1A2_vz" aria-hidden="false" width="14" height="14" viewBox="0 0 14 14"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.6572 5.42868C13.8879 5.29002 14.1806 5.30402 14.3973 5.46468C14.6133 5.62602 14.7119 5.90068 14.6473 6.16202L13.3139 11.4954C13.2393 11.7927 12.9726 12.0007 12.6666 12.0007H3.33325C3.02725 12.0007 2.76058 11.792 2.68592 11.4954L1.35258 6.16202C1.28792 5.90068 1.38658 5.62602 1.60258 5.46468C1.81992 5.30468 2.11192 5.29068 2.34325 5.42868L5.13192 7.10202L7.44592 3.63068C7.46173 3.60697 7.48377 3.5913 7.50588 3.57559C7.5192 3.56612 7.53255 3.55663 7.54458 3.54535L6.90258 2.90268C6.77325 2.77335 6.77325 2.56068 6.90258 2.43135L7.76458 1.56935C7.89392 1.44002 8.10658 1.44002 8.23592 1.56935L9.09792 2.43135C9.22725 2.56068 9.22725 2.77335 9.09792 2.90268L8.45592 3.54535C8.46794 3.55686 8.48154 3.56651 8.49516 3.57618C8.51703 3.5917 8.53897 3.60727 8.55458 3.63068L10.8686 7.10202L13.6572 5.42868ZM2.66667 12.6673H13.3333V14.0007H2.66667V12.6673Z" fill="#faa61a" aria-hidden="true"></path></svg>');}
  echo("</div></div></div>");
  }
}
echo "</div>";
}

}


?>

        
     


</div>

</div>