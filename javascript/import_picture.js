document.getElementById('import_button').onclick = function() {
    document.getElementById('imgLoader').click();
};

var fileinput = document.getElementById('imgLoader').addEventListener('change', importPicture, false);

function importPicture()
{
    var canvas = document.querySelector('#imported');
    var context = canvas.getContext("2d");
    var img = new Image();
    var file = this.files[0];
    var reader = new FileReader();
    if (file)
    {
        reader.readAsDataURL(file);
        reader.onload = function(evt)
    {
        if (evt.target.readyState == FileReader.DONE)
        {
            img.onload = function()
            {
                canvas.width = img.width;
                canvas.height = img.height;
                context.drawImage(img, 0, 0);
            }
            img.src = evt.target.result;
        }
    }
    }
  }