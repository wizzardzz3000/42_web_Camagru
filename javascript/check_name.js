function checkName()
{
    name_message = document.getElementById("name_message");
    name = document.getElementById("r_name").value;

    if (name.length > 4)
    {
        name_message.innerHTML = "✓ Valid name";
        name_message.style.color = "green";  
    } else {
        name_message.innerHTML = "✗ Name is too short";
        name_message.style.color = "red";
    }
}