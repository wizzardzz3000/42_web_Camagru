(function() {

    var streaming = false,
      video        = document.querySelector('#video'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 400,
      height = 0;

    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
          .then(function (stream) {
            video.srcObject = stream;
          })
          .catch(function (err0r) {
            console.log("Something went wrong!");
          });
      }

      video.addEventListener('canplay', function(ev){
        if (!streaming) {
          height = video.videoHeight / (video.videoWidth/width);
          video.setAttribute('width', width);
          video.setAttribute('height', height);
          canvas.setAttribute('width', width);
          canvas.setAttribute('height', height);
          streaming = true;
        }
      }, false);

      startbutton.addEventListener('click', function(ev){
        takepicture();
         ev.preventDefault();
         }, false);

    function takepicture()
    {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var canvasData = canvas.toDataURL("image/png");

        const req = new XMLHttpRequest();

        req.onreadystatechange = function(ev) {
            // XMLHttpRequest.DONE === 4
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    // console.log("Réponse reçue: %s", this.responseText);
                    console.log("Success");
                } else {
                    console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
                }
            }
        };

        req.open('POST', 'pictureController.php', true);
        req.send({ canvasData });

      //   $.ajax({
      //     method: "POST",
      //     url: "pictureController.php",
      //     data: { canvasData : canvasData }
      //       }).done(function(data){
      //         console.log("Success");
      //       }).fail(function(html){
      //         console.log("Fail");
      //  });
    }

      


  })();  