// LOAD VIDEO
//------------------------------------------------------
var streaming = false,
      video        = document.querySelector('#video'),
      filter       = document.querySelector('#filter_image'),
      canvas       = document.querySelector('#snap_canvas'),
      canvas_imported = document.querySelector('#imported'),
      photo        = document.querySelector('#photo'),
      snapButton  = document.querySelector('#snap_button'),
      width = 430,
      height = 320;

if (navigator.mediaDevices.getUserMedia)
{
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (err0r) {
      console.log("Something went wrong!");
    });
}

// CHECK SNAP BUTTON STATE
//------------------------------------------------------
function checkButtonMode()
{
  var mode = document.getElementsByClassName("snap_button")[0].id;
  
  if (mode == 'snap_button')
  {
      document.getElementsByClassName("snap_button")[0].id = 'save_button';
      document.getElementsByClassName("snap_button")[0].innerHTML = 'Save picture';
      var btn = document.createElement("BUTTON");
      btn.innerHTML = "Retry";
      btn.setAttribute('onclick','retry();');
      btn.style.width = '100px'
      document.getElementsByClassName("buttons_list")[0].appendChild(btn);
      takePicture();
  }
  else
  {
      document.getElementsByClassName("snap_button")[0].id = 'snap_button';
      document.getElementsByClassName("snap_button")[0].innerHTML = 'Snap it!';
      savePicture();
  }
}

// TAKE THE PICTURE
//------------------------------------------------------
function takePicture()
{
  // webcam picture
  canvas.width = width;
  canvas.height = height;

  if (video)
  {
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
  }
  if (canvas_imported)
  {
    canvas.getContext('2d').drawImage(canvas_imported, 0, 0, width, height);
  }

  var canvasData = canvas.toDataURL('image/png');

  // + filter superposition for preview
  canvas.getContext('2d').drawImage(filter, 130, 0, 180, 180);
  var filterName = document.getElementsByClassName("filter_img")[0].id + ".png";

  // ajax post request
  const req = new XMLHttpRequest();
  req.open('POST', '../controller/pictureController.php', true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function()
  {
      if (this.readyState === XMLHttpRequest.DONE) {
          if (this.status === 200) {
              console.log("Response: %s", this.responseText);
          } else {
              console.log("Response status : %d (%s)", this.status, this.statusText);
          }
      }
  };

  req.send('img=' + canvasData + '&filterName=' + filterName);
} 

// SAVE THE PICTURE
//------------------------------------------------------
function savePicture()
{
  // ajax post request
  const req = new XMLHttpRequest();
  req.open('POST', '../controller/pictureController.php', true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function()
  {
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
          window.location.reload();
          console.log("Response: %s", this.responseText);
        } else {
          console.log("Response status : %d (%s)", this.status, this.statusText);
        }
    }
  };

  req.send('action=' + 'save');
}

// DELETE THE PICTURE AND RETRY
//------------------------------------------------------
function retry()
{
  // ajax post request
  const req = new XMLHttpRequest();
  req.open('POST', '../controller/pictureController.php', true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function()
  {
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
          window.location.reload();
          console.log("Response: %s", this.responseText);
        } else {
          console.log("Response status : %d (%s)", this.status, this.statusText);
        }
    }
  };

  req.send('action=' + 'delete');
}