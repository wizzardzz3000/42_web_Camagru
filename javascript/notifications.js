(function()
{
    var div = document.getElementById("dom-target");
    var notifications = div.textContent;

    notifications_tag = document.getElementById("notifications_tag");

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
})();

function refreshPage(user_id, notification_value)
{   
    if (notification_value == "Turn notifications on")
    {
        var data = 1;
    }
    else if (notification_value == "Turn notifications off")
    {
        var data = 0;
    }

    const req = new XMLHttpRequest();
    req.open('POST', '../controller/userController.php', true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    req.onreadystatechange = function() {
        // XMLHttpRequest.DONE === 4
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                console.log("Response: %s", this.responseText);
            } else {
                console.log("Response status : %d (%s)", this.status, this.statusText);
            }
        }
    };

    if (data == 0)
    {
        req.send('user_id=' + user_id + '&bool=' + data);
    }
    else if (data == 1)
    {
        req.send('user_id=' + user_id + '&bool=' + data);
    }

    // document.location.reload(true);
}