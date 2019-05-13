function getFilterName(filter_id)
{
    // var filter_div = document.getElementById("filter-target");
    // var filter_name = filter_div.textContent;
    // filter_name = filter_name.substring(0, filter_name.indexOf('.')).replace(/\s/g,'');

    // const req = new XMLHttpRequest();
    // req.open('POST', '../controller/pictureController.php', true);
    // req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // req.onreadystatechange = function() {
    //     // XMLHttpRequest.DONE === 4
    //     if (this.readyState === XMLHttpRequest.DONE) {
    //         if (this.status === 200) {
    //             console.log("Response: %s", this.responseText);
    //         } else {
    //             console.log("Response status : %d (%s)", this.status, this.statusText);
    //         }
    //     }
    // };

    // req.send('filter_id' + filter_id);
    // alert(filter_id);
    make_base(filter_id);
}

var canvas = document.getElementById('filter_image'),
context = canvas.getContext('2d');

function make_base(filter_id)
{
    base_image = new Image();
    base_image.src = '/pictures/filters/' + filter_id;
    base_image.onload = function() 
    {
        context.drawImage(base_image, 0, 0, 140, 140);
    }
}