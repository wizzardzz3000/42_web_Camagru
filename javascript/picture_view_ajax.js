var likes = document.getElementById('likes');

function changeNb(picture_id, user_id)
{   
    var num = parseInt(likes.innerHTML.replace(/\D/g,''));
    var likes_button = document.getElementById('likes_button');
    var current_state = likes_button.innerHTML

    if (likes_button.innerHTML == '(Like)')
    {
        num += 1;
        likes_button.innerHTML = '(Unlike)';
    } else {
        num -= 1;
        likes_button.innerHTML = '(Like)';
    }

    if (num < 2)
    {
        likes.innerHTML = num + ' like';
    } else {
        likes.innerHTML = num + ' likes';
    }

    const req = new XMLHttpRequest();
    req.open('POST', '../controller/likesController.php', true);
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

    req.send('picture_id=' + picture_id + '&user_id=' + user_id + '&arg=' + current_state);
}