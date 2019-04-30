function checkEmail()
{
    email_message = document.getElementById("email_message");
    email = document.getElementById("r_email").value;
    var regex = new RegExp("/^([a-z])$/");

    if (/^[a-z0-9\_\.\-]{2,20}\@[a-z0-9\_\-]{2,20}\.[a-z]{2,9}$/.test(email))
    {
        email_message.innerHTML = "✓ Valid email";
        email_message.style.color = "green";  
    } else {
        email_message.innerHTML = "✗ Wrong email format (abc@abc.abc)";
        email_message.style.color = "red";
    }
}