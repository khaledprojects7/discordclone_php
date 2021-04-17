<div class="content">
<script src="js/chat_handler.js"></script>
<div class="top">
<svg width="24" height="24" viewBox="0 0 24 24" class="icon-22AiRD"><path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M5.88657 21C5.57547 21 5.3399 20.7189 5.39427 20.4126L6.00001 17H2.59511C2.28449 17 2.04905 16.7198 2.10259 16.4138L2.27759 15.4138C2.31946 15.1746 2.52722 15 2.77011 15H6.35001L7.41001 9H4.00511C3.69449 9 3.45905 8.71977 3.51259 8.41381L3.68759 7.41381C3.72946 7.17456 3.93722 7 4.18011 7H7.76001L8.39677 3.41262C8.43914 3.17391 8.64664 3 8.88907 3H9.87344C10.1845 3 10.4201 3.28107 10.3657 3.58738L9.76001 7H15.76L16.3968 3.41262C16.4391 3.17391 16.6466 3 16.8891 3H17.8734C18.1845 3 18.4201 3.28107 18.3657 3.58738L17.76 7H21.1649C21.4755 7 21.711 7.28023 21.6574 7.58619L21.4824 8.58619C21.4406 8.82544 21.2328 9 20.9899 9H17.41L16.35 15H19.7549C20.0655 15 20.301 15.2802 20.2474 15.5862L20.0724 16.5862C20.0306 16.8254 19.8228 17 19.5799 17H16L15.3632 20.5874C15.3209 20.8261 15.1134 21 14.8709 21H13.8866C13.5755 21 13.3399 20.7189 13.3943 20.4126L14 17H8.00001L7.36325 20.5874C7.32088 20.8261 7.11337 21 6.87094 21H5.88657ZM9.41045 9L8.35045 15H14.3504L15.4104 9H9.41045Z"></path></svg>
<h1><?php echo($_SESSION['channel']['name']);?></h1>
<hr>
</div>

<div class="contentBase" style="width: calc(100% - 250px);padding:20px;">
<div class="messages scrollbarA">
<?php
if($_SESSION['guildmember']['isOwner'] == 1)
   {
   $channel_name = $_SESSION['channel']['name'];
   $paragraphe = 'Voilà ton nouveau serveur, tout beau tout propre. Tu peux voir ici quelques étapes pour t\'aider dans tes débuts. Pour en savoir plus, va jeter un œil à notre <a class="anchor-3Z-8Bb anchorUnderlineOnHover-2ESHQB" href="https://support.discord.com/hc/fr/articles/360045138571?utm_source=discord&amp;utm_medium=blog&amp;utm_campaign=2020-06_help-new-user&amp;utm_content=--t%3Apm" rel="noreferrer noopener" target="_blank">Guide des premiers pas</a>';
   echo("<div class='heading'><div class='title'><h1>Bienvenue sur</h1><h1>$channel_name</h1></div><p>$paragraphe</p></div>");
   }
   
?>
<div class="msgLOB" style="position: relative;top:92%;">

   <?php
   $data = ['channel'=>$_SESSION['channel']['ID']];
   $cquery = $db->prepare("SELECT * FROM messages WHERE channel = :channel");
   $cquery->execute($data);
   $msgIndex = 0;
   $currentUser = 0;
   
   
   while($message = $cquery->fetch())
   {
     
   
      
   if($currentUser != $message['sender'] || $msgIndex == 5) {$msgIndex = 0;$currentUser = $message['sender'];};
   
   $data = ['sender'=>$message['sender']];
   $query = $db->prepare("SELECT * FROM users WHERE ID = :sender");
   $query->execute($data);
   $message_user = $query->fetch();
   $msgContent = $message['content'];
   if($msgIndex == 0){
   if($message_user['pfp'] == 0){
   $imgSrc = 'images/pfp.png';
   }else{
   $imgSrc = 'images/profile_pictures/'.$message_user['ID'].'.png';
   }
   $username = $message_user['username'];
   

   
   $getColoredRole = $db->prepare("SELECT * FROM guildmemberroles WHERE givenTo = :member AND guildID = :guild");
   $getColoredRole->execute(['member'=>$message_user['ID'],'guild'=>$_SESSION['guild']['ID']]);
   $getColoredRole_rowCount = $getColoredRole->rowCount();
   $gcrfa = $getColoredRole->fetchAll();
   $color = '';

   for($i = $getColoredRole_rowCount - 1;$i>=0;$i--){
   $grc = $db->prepare("SELECT * FROM roles WHERE increment = :inc AND guildID = :guild ORDER BY increment ASC");
   $grc->execute(['inc'=>$gcrfa[$i]['roleIncrement'],'guild'=>$_SESSION['guild']['ID']]);
   $grc = $grc->fetch();
  
       if($grc['color']){
       $color = '#'.$grc['color'];
      
       
       }
   }

   echo("<div class='msg msgA'><div class='header'><img width='45px' height='45px' src='$imgSrc'><h1 style='color:$color;'>$username</h1></div><p class='msgContent'>$msgContent</p></div>");

   }else{
      echo("<div class='msg'><p class='msgContent'>$msgContent</p></div>");
   }

    $msgIndex += 1;
   }
   echo '<script>document.querySelector(".container .content .messages").scrollTop = document.querySelector(".container .content .messages").scrollHeight;</script>'
   ?>
</div>
</div>
<div class="msgContainer">
            <div class="separator">

            </div>
            <div class="input">
                <svg class="f" width="24" height="24" viewBox="0 0 24 24"><path class="attachButtonPlus-jWVFah" fill="currentColor" d="M12 2.00098C6.486 2.00098 2 6.48698 2 12.001C2 17.515 6.486 22.001 12 22.001C17.514 22.001 22 17.515 22 12.001C22 6.48698 17.514 2.00098 12 2.00098ZM17 13.001H13V17.001H11V13.001H7V11.001H11V7.00098H13V11.001H17V13.001Z"></path></svg>
                <input onkeydown="if(event.keyCode == 13){event.preventDefault();sendMessage(this);}" autocomplete="off" type="text" id="msger" placeholder="Envoyer un message à #<?php echo($_SESSION['channel']['name']);?>">
                <div class="rightSide">
                    <svg width="24" height="24" aria-hidden="false" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M16.886 7.999H20C21.104 7.999 22 8.896 22 9.999V11.999H2V9.999C2 8.896 2.897 7.999 4 7.999H7.114C6.663 7.764 6.236 7.477 5.879 7.121C4.709 5.951 4.709 4.048 5.879 2.879C7.012 1.746 8.986 1.746 10.121 2.877C11.758 4.514 11.979 7.595 11.998 7.941C11.9991 7.9525 11.9966 7.96279 11.9941 7.97304C11.992 7.98151 11.99 7.98995 11.99 7.999H12.01C12.01 7.98986 12.0079 7.98134 12.0058 7.97287C12.0034 7.96282 12.0009 7.95286 12.002 7.942C12.022 7.596 12.242 4.515 13.879 2.878C15.014 1.745 16.986 1.746 18.121 2.877C19.29 4.049 19.29 5.952 18.121 7.121C17.764 7.477 17.337 7.764 16.886 7.999ZM7.293 5.707C6.903 5.316 6.903 4.682 7.293 4.292C7.481 4.103 7.732 4 8 4C8.268 4 8.519 4.103 8.707 4.292C9.297 4.882 9.641 5.94 9.825 6.822C8.945 6.639 7.879 6.293 7.293 5.707ZM14.174 6.824C14.359 5.941 14.702 4.883 15.293 4.293C15.481 4.103 15.732 4 16 4C16.268 4 16.519 4.103 16.706 4.291C17.096 4.682 17.097 5.316 16.707 5.707C16.116 6.298 15.057 6.642 14.174 6.824ZM3 13.999V19.999C3 21.102 3.897 21.999 5 21.999H11V13.999H3ZM13 13.999V21.999H19C20.104 21.999 21 21.102 21 19.999V13.999H13Z"></path></svg>
                    <svg width="24" height="24" class="icon-3D60ES" aria-hidden="false" viewBox="0 0 24 24"><path fill="currentColor" d="M2 2C0.895431 2 0 2.89543 0 4V20C0 21.1046 0.89543 22 2 22H22C23.1046 22 24 21.1046 24 20V4C24 2.89543 23.1046 2 22 2H2ZM9.76445 11.448V15.48C8.90045 16.044 7.88045 16.356 6.74045 16.356C4.11245 16.356 2.66045 14.628 2.66045 12.072C2.66045 9.504 4.23245 7.764 6.78845 7.764C7.80845 7.764 8.66045 8.004 9.32045 8.376L9.04445 10.164C8.42045 9.768 7.68845 9.456 6.83645 9.456C5.40845 9.456 4.71245 10.512 4.71245 12.06C4.71245 13.62 5.43245 14.712 6.86045 14.712C7.31645 14.712 7.64045 14.616 7.97645 14.448V12.972H6.42845V11.448H9.76445ZM11.5481 7.92H13.6001V16.2H11.5481V7.92ZM20.4724 7.92V9.636H17.5564V11.328H19.8604V13.044H17.5564V16.2H15.5164V7.92H20.4724Z"></path></svg>                    
                </div>
            </div>
        </div>
    </div>
    
            




