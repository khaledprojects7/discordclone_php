function showGuild(elem){
       
    if(elem.classList.contains('selected')) return;
      $('.leftBar .selected').removeClass('selected');
    elem.classList.add('selected');
    $.post({
    url:'../php/loadguild.php',
    data:{
    guildID:elem.getAttribute('guildtarget')
    },
    success:function(res){
   
    $('.container').html(res);
    }
    })
    
}
