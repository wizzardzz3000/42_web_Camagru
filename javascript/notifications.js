(function()
{
    var notif_div = document.getElementById("notification-target");
    var account_div = document.getElementById("account-target");
    var email_div = document.getElementById("email-target");
    var notifications = notif_div.textContent;
    var account_valid = account_div.textContent;
    var email = email_div.textContent;

    notifications_tag = document.getElementById("notifications_tag");
    account_tag = document.getElementById("email_tag");

    if (notifications == 0)
    {
        notifications_tag.innerHTML = "✗ Notifications turned off";
        notifications_tag.style.color = "red"; 
    }
    if (notifications == 1)
    {
        notifications_tag.innerHTML = "✓ Notifications turned on";
        notifications_tag.style.color = "green"; 
    }

    if (account_valid == 0)
    {
        account_tag.innerHTML = "✗ " +  email + "not validated";
        account_tag.style.color = "red"; 
    }
    if (account_valid == 1)
    {
        account_tag.innerHTML = "✓ " + email + "validated";
        account_tag.style.color = "green"; 
    }
})();

function refreshPage(user_id)
{   
    var notifications_button = document.getElementById('notifications_button');

    if (notifications_button.value == "Turn notifications on")
    {
        var data = 1;
        notifications_button.value = "Turn notifications off";
        notifications_tag.innerHTML = "✓ Notifications turned on";
        notifications_tag.style.color = "green"; 
    }
    else if (notifications_button.value == "Turn notifications off")
    {
        var data = 0;
        notifications_button.value = "Turn notifications on";
        notifications_tag.innerHTML = "✗ Notifications turned off";
        notifications_tag.style.color = "red"; 
    }

    const req = new XMLHttpRequest();
    req.open('POST', '../controller/userController.php', true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    req.onreadystatechange = function() {
        // XMLHttpRequest.DONE === 4
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                // window.location.reload(); 
                console.log("Response: %s", this.responseText);
            } else {
                console.log("Response status : %d (%s)", this.status, this.statusText);
            }
        }
    };

    if (data == 0 || data == 1)
    {
        req.send('user_id=' + user_id + '&bool=' + data);
    }
}