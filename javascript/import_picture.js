document.getElementById('import_button').onclick = function() {
    document.getElementById('imgLoader').click();
};

document.getElementById('imgLoader').addEventListener('change', importPicture, false);

function importPicture()
{
    var canvas = document.querySelector('#imported');
    var context = canvas.getContext("2d"); 
    var fileinput = document.getElementById('imgLoader');
    var img = new Image();

    var file = document.getElementById('imgLoader').files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);

    alert("HERE");

    reader.onload = function(evt)
    {
        alert("THERE");
        if( evt.target.readyState == FileReader.DONE)
        {
            alert("AGAIN");
            img.src = evt.target.result;
            context.drawImage(img, 200, 200);
        }
    }  
}