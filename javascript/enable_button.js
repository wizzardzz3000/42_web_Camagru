var submit_infos_button = document.getElementsByClassName('submit_infos_button')[0];

name_message = document.getElementById("name_message");
email_message = document.getElementById("email_message");
password_len_message = document.getElementById("password_len_message");
password_up_message = document.getElementById("password_up_message");
password_num_message = document.getElementById("password_num_message");
password_spe_message = document.getElementById("password_spe_message");

submit_infos_button.disabled = true;

function check_fields()
{
    if( name_message.style.color = "green" &&
        email_message.style.color == "green" &&
        password_len_message.style.color == "green" &&
        password_up_message.style.color == "green" &&
        password_num_message.style.color == "green" &&
        password_spe_message.style.color == "green")
    {
        submit_infos_button.disabled = false;
    }
}