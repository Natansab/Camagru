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

      // If filter selectedm enable click on button
      document.getElementById('made_selection').addEventListener('click', function(){
        document.getElementById("startbutton").removeAttribute("disabled");
      })

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
        var dataUrl = canvas.toDataURL();

        // Ajax + js method
        var http = new XMLHttpRequest();
        var url = "camsave.php";
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
      //
      // var input = document.getElementsByTagName('input')['fileToUpload'];
      //
      // input.onclick = function() {
      //   this.value = null;
      // }
      // input.onchange = function() {
      //
      //
      //   // alert (this.value);
      //
      //   var prez_name = prez_selected();
      //
      //   // Ajax + js method
      //   var http = new XMLHttpRequest();
      //   var url = "upload.php";
      //   // var params = "img_path=" + this.value + "&prez=" + prez_name;
      //   // console.log(this.value);
      //   http.open("POST", url, true);
      //   // Send the proper header information along with the request
      //   http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //   http.onreadystatechange = function() {//Call a function when the state changes.
      //     if(http.readyState == 4 && http.status == 200) {
      //       alert(this.response);
      //       carousel_refresh_page();
      //     }
      //   }
      //   var form2 = document.getElementById("form2");
      //   console.log(form2);
      //   var formData = new FormData(form2);
      //   formData.append("prez", "melenchou");
      //   console.log(formData);
      //   // formData.append("prez", prez_name);
      //   // console.log(formData);
      //   http.send(formData);
      //   // http.send(params);
      // }

    // function create_artwork_from_upload() {

    // var prez_name = prez_selected();


    // var file2Upload = document.getElementById("file2Upload");
    // file2Upload.addEventListener('click', function(ev){
    //   // // Check if nothing selected
    //   // if (document.forms["form1"]["prez"].value == "")
    //   //   alert ("Please select a filter 💩");
    //   // // If filter selected, do...
    //   // else {
    //   // create_artwork_from_upload();
    //   // alert("ok on est la");
    //   // takepicture();
    //   // uploadpicture();}
    //   ev.preventDefault();
    // }, false);



})();



///////////////// ERROR UPLOAD FILE WITH AJAX ///////////////////////


var upbut = document.getElementById("file2Upload");
upbut.addEventListener('click', function(ev){
  // alert("yo");
  // Check if nothing selected
  // if (document.forms["form1"]["prez"].value == "")
  // alert ("Please select a filter 💩");
  // If filter selected, do...
    // takepicture();
    // uploadpicture();
    //

    // Ajax + js method


    // var form = document.getElementById("form2");
    // var formData = new FormData(form);
    //
    // var http = new XMLHttpRequest();
    // var url = "upload.php";
    // // var params = "img_path=" + this.value + "&prez=" + prez_name;
    // // console.log(this.value);
    // http.open("POST", url, true);
    // // Send the proper header information along with the request
    // http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // http.onreadystatechange = function() {//Call a function when the state changes.
    //   if(http.readyState == 4 && http.status == 200) {
    //     console.log(this.response);
    //     // alert("ok?");
    //     // carousel_refresh_page();
    //   }
    // }
    // formData.append("prez", "melenchou");
    // http.send(formData);
    //
    // // alert("hello");


    var input = document.querySelector('input[type=file]');
    file = input.files[0];
    //
    var formData = new FormData();
    formData.append("file", file);
    formData.append("prez", "melenchou");

    alert("wtf");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./upload.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    alert("wtf1");
    xhr.onreadystatechange = function() {//Call a function when the state changes.
      alert("wtf2");
      if(xhr.readyState == 4 && xhr.status == 200) {
        alert(this.response);
        // alert("ok?");
        // carousel_refresh_page();
      }
    }
    ev.preventDefault();
  }, false);

  ///////////////// ERROR UPLOAD FILE WITH AJAX ///////////////////////
