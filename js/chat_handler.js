function sendMessage(elem)
{

if(elem.value.trim() == '') return;
var value = elem.value.trim();

elem.value = '';

$.post({
url:'../php/sendmessage.php',
data:{
message:value
},
success:function(res){
   console.log(res);
}
})

}

function loadinvite()
{
        $.post({
            url:'../php/loadinvite.php',
            data:{
                target:'createInvite'

            },
            success:function(res)
            {
                $('body').append(res);
            }
        })


}