"use strict"
document.title = "Discord - Register"
const submitRBTNVAL = document.querySelector('#registerForm').submit.innerHTML;
let dateDropdown = document.querySelector('#registerForm').year;


    let earliestYear = 1920;

    for (var currentYear = new Date().getFullYear();currentYear >= earliestYear;currentYear--) {
      let dateOption = document.createElement('option');
      dateOption.text = currentYear;
      dateOption.value = currentYear;
      dateDropdown.add(dateOption);
    
    }


document.querySelector('#registerForm').submit.onclick = function()
{
    var email = document.querySelector('#registerForm').email.value.trim();
    var pseudo = document.querySelector('#registerForm').pseudo.value.trim();
    var password = document.querySelector('#registerForm').password.value.trim();
    var done = true;

    document.querySelectorAll('#registerForm *').forEach((all)=>{
        all.style.borderColor = '';
    })

    if(email == '')
    {
        done = false; document.querySelector('#registerForm').email.style.borderColor = '#F04747';
    }
    if(password == '')
    {
        done = false; document.querySelector('#registerForm').password.style.borderColor = '#F04747';
    }
    if(pseudo == '')
    {
        done = false; document.querySelector('#registerForm').pseudo.style.borderColor = '#F04747';
    }
    if(document.querySelector('#registerForm').year.value == 'none')
    {
        done = false; document.querySelector('#registerForm').year.style.borderColor = '#F04747';
    }
    if(document.querySelector('#registerForm').month.value == 'none')
    {
        done = false; document.querySelector('#registerForm').month.style.borderColor = '#F04747';
    }
    if(document.querySelector('#registerForm').day.value == 'none')
    {
        done = false; document.querySelector('#registerForm').day.style.borderColor = '#F04747';
    }
    if(done == false) return;

    var birthdayDate = document.querySelector('#registerForm').year.value+"-"+document.querySelector('#registerForm').month.value+"-"+document.querySelector('#registerForm').day.value;


    $.ajax({
        url:'../php/submit.php',
        method:'post',
        data:{
            register:1,
            email:email,
            username:pseudo,
            password:password,
            birthdayDate:birthdayDate
        },
        withCredentials: true,
        beforeSend:function()
        {
            document.querySelector('#registerForm').submit.innerHTML = "...";
        }
        
    }).done(function(res)
        {
            document.querySelector('#registerForm').submit.innerHTML = submitRBTNVAL;
           
           window.location.reload();
        })
  
}
