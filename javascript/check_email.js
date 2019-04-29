email_message = document.getElementById("email_message");

function checkEmail()
{
    email = document.getElementById("r_email").value;
    var valid = 0;

    if (email.includes('@'))
            valid = 1;
    
    if (valid < 1)
    {
        email_message.innerHTML = "Wrong email format";
        email_message.style.color = "red";
    } else {
        email_message.style.display='none';
    }
}