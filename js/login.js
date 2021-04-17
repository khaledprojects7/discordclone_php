"use strict"
document.title = "Discord - Login";
document.querySelector('#loginForm').submit.onclick = function(){
    var email = document.querySelector('#loginForm').email;
    var password = document.querySelector('#loginForm').password;
    var submitBTNVAL = document.querySelector('#loginForm').submit.innerHTML;
    email.style.borderColor = '';
    password.style.borderColor = '';
    var done = true;
    if(email.value.trim() == '') {done=false; email.style.borderColor = '#F04747'};
    if(password.value.trim() == ''){done = false; password.style.borderColor = '#F04747'};
    if(done == false) return;
    $.post({
        url:"../php/submit.php",
        data:{login:1,email:email.value.trim(),password:password.value.trim()},
        beforeSend:function()
        {
            document.querySelector('#loginForm').submit.innerHTML = '...';
        },
        success:function(res)
        {
      
            document.querySelector('#loginForm').submit.innerHTML = submitBTNVAL;
         
            if(res == '0')
            {
                window.location.replace('?page=app');
            }
            if(res == '404')
            {
                var fieldLabels = document.querySelectorAll('#loginForm .field label');
                
                    
                    fieldLabels[0].innerHTML = "E-mail ou numéro de téléphone  - <i style='text-transform:normal;'>Identifiant ou mot de passe invalide.<i>";
                    fieldLabels[0].style.color = '#F04747';
                    fieldLabels[1].innerHTML = "Mot de passe  - <i>Identifiant ou mot de passe invalide.<i>";
                    fieldLabels[1].style.color = '#F04747'
            }
        }
    })
}