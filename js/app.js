"use strict"


document.title = "Discord";

$('#addGuild').click(function(){
    $.ajax({
        url:'body/createServer.php',
        success:function(res)
        {
            $('body').append(res);
        }
    }) 
})

function loadsbrtt()
{


   if(document.querySelector('.container .sidebar .top .tooltip').style.display == 'none')
   {
       $('.container .sidebar .top i').removeClass('fa-chevron-down');
       $('.container .sidebar .top i').addClass('fa-times');

      $('.container .sidebar .top .tooltip').show(180);

   }else{
    $('.container .sidebar .top i').addClass('fa-chevron-down');
    $('.container .sidebar .top i').removeClass('fa-times');
      $('.container .sidebar .top .tooltip').hide(180);

   }

}
