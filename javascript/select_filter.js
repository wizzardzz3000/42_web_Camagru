// BLUR FILTER BOX WHEN CLICKED OUTSIDE
document.addEventListener("click",function(e)
{
    if (!e.target.closest('.filters_list')) {
       blur();
    }
 });

 //---------------------------------------------------------------------------------------
var snapButton = document.getElementsByClassName('snap_button')[0];

function isCanvasBlank(canvas)
{
    const context = canvas.getContext('2d');
    const pixelBuffer = new Uint32Array(
      context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
    );
    return !pixelBuffer.some(color => color !== 0);
}

function selectFilter(filter_name)
{
    var filter_name_short = filter_name.substring(0, filter_name.indexOf('.'));

    var video = document.getElementsByClassName('camera_view')[0];
    var imported = document.getElementsByClassName('imported')[0];
    const blank = isCanvasBlank(imported);

    document.getElementsByClassName("filter_img")[0].src = "/pictures/filters/" + filter_name;
    document.getElementsByClassName("filter_img")[0].id = filter_name_short;

    if (!blank || video.readyState === 4)
    {
        snapButton.disabled = false;
    }
}

function blur()
{
    document.getElementsByClassName("filter_img")[0].src = ""; 
    document.getElementsByClassName("filter_img")[0].id = "";
    
    if (document.getElementsByClassName("snap_button")[0].innerHTML != 'Save picture')
    {
        snapButton.disabled = true;
    }
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