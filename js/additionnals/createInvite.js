$('#closeCIC').click(function(){
    $('#invite').addClass('inviteClose');
    $('#inviteFluidHidingObject').addClass('CC');
    setTimeout(()=>{
        $('#inviteFluidHidingObject').remove();
    },160)
})