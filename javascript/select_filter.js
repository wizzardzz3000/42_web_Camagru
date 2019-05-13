function selectFilter(filter_name)
{

    var className = document.getElementsById("filter_box_id").className;
    alert(className);

    // if (document.getElementsByClassName(filter_name))
    // {
    //     alert("OK");
    // }

    // if (document.getElementById("filter_box_id").className == "selected_filter")
    // {
    //     document.getElementById("filter_box_id").className = "filter_box";
    // } else {
    //     document.getElementById(filter_name).className = "selected_filter";
    // }

    // var div = document.getElementsByClassName('selected_filter');
    // var img = div.getElementsByTagName('filter').src;
    // document.getElementById("filter_image").src = img;
    // filtre.src = document.getElementById('selected_filter').src
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
    // show_filter(filter_name);
    // getfiltersrc();
}

function getfiltersrc()
{
    var someimage = document.getElementsByClassName('selected_filter').getElementsByTagName('filter')[0].src;
    alert(someimage);
}
function show_filter(filter_name)
{
    var canvas = document.getElementById('filter_image');
    base_image = new Image();
    base_image.src = '/pictures/filters/' + filter_name;
    base_image.onload = function() 
    {
        canvas.getContext('2d').drawImage(base_image, 0, 0, 100, 100);
    }
}

// filtre.childElem('filter').src = document.getElementById('filtre-image-actif').src