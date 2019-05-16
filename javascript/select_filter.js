document.addEventListener("click",function(e)
{
    if (!e.target.closest('.filters_list')) {
       blur();
    }
 });

function selectFilter(filter_name)
{
    var filter_name_short = filter_name.substring(0, filter_name.indexOf('.'));
    document.getElementsByClassName("filter_img")[0].src = "/pictures/filters/" + filter_name;
    document.getElementsByClassName("filter_img")[0].id = filter_name_short;
}

function blur()
{
    document.getElementsByClassName("filter_img")[0].src = ""; 
    document.getElementsByClassName("filter_img")[0].id = "";
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