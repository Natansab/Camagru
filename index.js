// Ajax method refresh
function carousel_refresh_page() {
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
  // console.log('ok');
}

function carousel_select_page(page_num) {

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
  // console.log('ok');


}

// Onclick change value like + send to server
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

function prez_selected() {
  var radios = document.getElementsByName('prez');
  for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked)
    return(radios[i].value);
  }
}

(function() {

  var width = 600;    // We will scale the photo width to this
  var height = 0;     // This will be computed based on the input stream

  var streaming = false;

  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    photo = document.getElementById('photo');
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
            if (video && vendorURL)
              video.src = vendorURL.createObjectURL(stream);
          }
          if (video)
            video.play();
        },
        function(err) {
          console.log("An error occured! " + err);
        }
      );

      if (video) {
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
      }, false);}

      if (startbutton) {
      startbutton.addEventListener('click', function(ev){
        // Check if nothing selected
        if (document.forms["form1"]["prez"].value == "")
        alert ("Please select a filter 💩");
        // If filter selected, do...
        else {
          takepicture();
          uploadpicture();}
          ev.preventDefault();
        }, false);}
      }

      // If filter selectedm enable click on button
      var made_selection = document.getElementById('made_selection');
      if (made_selection) {
        document.getElementById('made_selection').addEventListener('click', function(){
          document.getElementById("startbutton").removeAttribute("disabled");
          document.getElementById("fileToUpload").removeAttribute("disabled");

        })
    }

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

      window.addEventListener('load', startup, false);

      // Upload image to sever
      function uploadpicture() {

        var prez_name = prez_selected();
        var dataUrl = canvas.toDataURL();

        // Ajax + js method
        var http = new XMLHttpRequest();
        var url = "create_from_cam.php";
        var params = "imgBase64=" + JSON.stringify({image: dataUrl}) + "&prez=" + prez_name;
        console.log(params);
        http.open("POST", url, true);
        // Send the proper header information along with the request
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.onreadystatechange = function() {//Call a function when the state changes.
          if(http.readyState == 4 && http.status == 200) {
            carousel_refresh_page();
          }
        }
        http.send(params);
      }
})();

var input = document.getElementsByTagName('input')['fileToUpload'];

if (input) {
input.onclick = function() {
  this.value = null;
}
input.onchange = function(ev) {

  var input = document.querySelector('input[type=file]');
  file = input.files[0];

  var formData = new FormData();
  formData.append("fileToUpload", file);
  formData.append("prez", prez_selected());

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./create_from_upload.php");
  ////////////// NO HEADER ////////////
  xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && xhr.status == 200) {
      console.log(xhr.response);
      if (xhr.response != "")
        alert(xhr.response);
      carousel_refresh_page();
    }
  }
  xhr.send(formData);
  ev.preventDefault();
}}
