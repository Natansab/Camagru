// Onclick call function carousel page

// function refresh_div_with_url(parentDiv, old_elem, new_elem,)
function carousel_page(page_num) {

  // JS method to refresh div with carousel
    // img carousel is inside side
    var side = document.getElementById('side');

    // Prepare remove old div
    var old_elem = document.getElementById('img_carousel');

    // Prepare new div
     var new_elem = document.createElement('div');
     new_elem.id = 'img_carousel';

     // Remove & add
     old_elem.parentNode.removeChild(old_elem);
     side.appendChild(new_elem);

     var xhr = new XMLHttpRequest();

     xhr.onload = function () {
         document.getElementById('img_carousel').innerHTML = this.response;
     };

     xhr.open('GET', 'http://localhost:8080/Camagru/side_section.php?page_num=' + page_num, true);
     xhr.send();
     console.log('ok');


}

// Onclick call function carousel page
function like_image(img_name) {
  var http = new XMLHttpRequest();
  var url = "like_image.php";
  var params = "img_name=" + img_name;
  // console.log(params);
  http.open("POST", url, true);
  // Send the proper header information along with the request
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http.onreadystatechange = function() {//Call a function when the state changes.
      if(http.readyState == 4 && http.status == 200) {
        document.getElementById("like_image_" + img_name).innerHTML = http.responseText;
      }
  }
  http.send(params);
  // console.log('ok' + img_name);
}

(function() {
  // The width and height of the captured photo. We will set the
  // width to the value defined here, but the height will be
  // calculated based on the aspect ratio of the input stream.

  var width = 600;    // We will scale the photo width to this
  var height = 0;     // This will be computed based on the input stream

  // |streaming| indicates whether or not we're currently streaming
  // video from the camera. Obviously, we start at false.

  var streaming = false;

  // The various HTML elements we need to configure or control. These
  // will be set by the startup() function.

  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    photo = document.getElementById('photo');
    // Possibilite de submit sans selection au prealable...
    startbutton = document.getElementById('startbutton');

    navigator.getMedia = ( navigator.getUserMedia ||
                           navigator.webkitGetUserMedia ||
                           navigator.mozGetUserMedia ||
                           navigator.msGetUserMedia);

    navigator.getMedia(
      {
        video: true,
        audio: false
      },
      function(stream) {
        if (navigator.mozGetUserMedia) {
          video.mozSrcObject = stream;
        } else {
          var vendorURL = window.URL || window.webkitURL;
          video.src = vendorURL.createObjectURL(stream);
        }
        video.play();
      },
      function(err) {
        console.log("An error occured! " + err);
      }
    );

    video.addEventListener('canplay', function(ev){
      if (!streaming) {
        height = video.videoHeight / (video.videoWidth/width);

        // Firefox currently has a bug where the height can't be read from
        // the video, so we will make assumptions if this happens.

        if (isNaN(height)) {
          height = width / (4/3);
        }

        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
      }
    }, false);

    startbutton.addEventListener('click', function(ev){
      // Check if nothing selected
      if (document.forms["form1"]["prez"].value == "")
        alert ("Please select a filter 💩");
      // If filter selected, do...
      else {
      takepicture();
      uploadpicture();}
      ev.preventDefault();
    }, false);
  }

  document.getElementById('made_selection').addEventListener('click', function(){
    document.getElementById("startbutton").removeAttribute("disabled");
  })


  // Capture a photo by fetching the current contents of the video
  // and drawing it into a canvas, then converting that to a PNG
  // format data URL. By drawing it on an offscreen canvas and then
  // drawing that to the screen, we can change its size and/or apply
  // other changes before drawing it.

  function takepicture() {
    var context = canvas.getContext('2d');
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      ctx = canvas.getContext('2d')
      ctx.drawImage(video, 0, 0, width, height);
      var data = canvas.toDataURL('image/png');
    }
  }

  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener('load', startup, false);

  function prez_selected() {
    var radios = document.getElementsByName('prez');
    for (var i = 0, length = radios.length; i < length; i++) {
      if (radios[i].checked)
        return(radios[i].value);
    }
  }


// Upload image to sever
	function uploadpicture() {

    var prez_name = prez_selected();

    // Base64 image
		var dataUrl = canvas.toDataURL();

    // Ajax + js method NOT WORKING
    var http = new XMLHttpRequest();
    var url = "camsave.php";
    var params = "imgBase64=" + JSON.stringify({image: dataUrl}) + "&prez=" + prez_name;
    console.log(params);
    http.open("POST", url, true);
    // Send the proper header information along with the request
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
          //   // Once callback, refresh carousel on the right
            refresh_carousel();

            // alert(http.responseText);
        }
    }
    http.send(params);
	};

  // Ajax method refresh
  function refresh_carousel() {

  // JS method to refresh div with carousel
    // img carousel is inside side
    var side = document.getElementById('side');

    // Prepare remove old div
    var old_elem = document.getElementById('img_carousel');

    // Prepare new div
     var new_elem = document.createElement('div');
     new_elem.id = 'img_carousel';

     // Remove & add
     old_elem.parentNode.removeChild(old_elem);
     side.appendChild(new_elem);

     var xhr = new XMLHttpRequest();

     xhr.onload = function () {
         document.getElementById('img_carousel').innerHTML = this.response;
     };

     xhr.open('GET', 'http://localhost:8080/Camagru/side_section.php', true);
     xhr.send();
     console.log('ok');
  }
})();
