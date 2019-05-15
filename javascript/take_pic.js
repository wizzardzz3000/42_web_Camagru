(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      filter       = document.querySelector('#filter_image'),
      canvas       = document.querySelector('#snap_canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
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

    startbutton.addEventListener('click', function(ev)
    {
      takepicture();
      ev.preventDefault();
    }, false);

    function takepicture()
    {
      canvas.width = width;
      canvas.height = height;
      canvas.getContext('2d').drawImage(video, 0, 0, width, height);
      var canvasData = canvas.toDataURL('image/png');
      canvas.getContext('2d').drawImage(filter, 130, 0, 200, 200);
      var filterName = document.getElementsByClassName("filter_img")[0].id + ".png";

      const req = new XMLHttpRequest();
      req.open('POST', '../controller/pictureController.php', true);
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

      req.send('img=' + canvasData + '&filterName=' + filterName);
      // document.location.reload(true);
    }

  })();  