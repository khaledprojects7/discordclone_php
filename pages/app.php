<script defer src="js/app.js"></script>
<?php
include_once 'body/appLeftBar.php';
?>
<div class="container">
<?php

if($_SESSION['user']['lastPage'] == 0){
include_once 'body/dm/sidebar.php';
echo '<div class="content">';

include_once 'body/dm/content.php';
include_once 'body/dm/rightbar.php';
echo '</div>';
}else{

$lp = $_SESSION['user']['lastPage'];
echo("<script> 

$.post({
url:\"/php/loadguild.php\",
data:{
guildID:$lp
},
success:function(res){
$(\".container\").html(res);
}
});

</script>");
}
?>
</div>