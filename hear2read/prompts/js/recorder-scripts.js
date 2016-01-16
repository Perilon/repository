  function __log(e, data) {
    // log.innerHTML += "\n" + e + " " + (data || '');
  }

  var audio_context;
  var recorder;

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    __log('Media stream created.');

    // Uncomment if you want the audio to feedback directly
    //input.connect(audio_context.destination);
    //__log('Input connected to audio context destination.');
    
    recorder = new Recorder(input);
    __log('Recorder initialised.');
  }

  function isRecorderWorking() {
	  return(recorder);
  }
  
  function startRecording(button) {
    recorder && recorder.record();
    button.disabled = true;
    button.nextElementSibling.disabled = false;
    __log('Recording...');
  }

  function stopRecording(button) {
    recorder && recorder.stop();
    button.disabled = true;
    button.previousElementSibling.disabled = false;
    __log('stopRecording: Stopped recording.');
    
    // create WAV download link using audio data blob
    // createDownloadLink();
	
	// upload file to server
	postToServer();
    
    recorder.clear();
  }

  function postToServer(lang_dir, user_dir, cur_index, last_recorded_index) {
    recorder && recorder.exportWAV(function(blob) {
		var xhr=new XMLHttpRequest();
		xhr.onload=function(e) {
			if(this.readyState === 4) {
				// 	console.log("Server returned: ",e.target.responseText);
				__log("onload function handler:");
				document.getElementById("stop_btn").style.backgroundImage =   "url('/prompts/images/stop.png')";
				document.getElementById("record_btn").style.backgroundImage = "url('/prompts/images/sound.png')";
				document.getElementById("play_btn").style.backgroundImage =   "url('/prompts/images/play-button.png')";
				disableButton('stop_btn');
				enableButton('record_btn');
				enableButton('rerec_btn');
				console.log("stop_it: checking position if files cur_index %s, last_recorded_index %s",cur_index, last_recorded_index);
				if ( Number(cur_index) >= last_recorded_index) {
					console.log("should disable continue button and play button");
					disableButton('play_btn');
					disableButton('cont_btn');
				} else {
					console.log("enabled continue button; more prompts to play");
					enableButton('play_btn');
					enableButton('cont_btn');
				}	
				document.getElementById('progress_msg').innerHTML = "";
			}
		}
		fileName = lang_dir.substring(0,lang_dir.length - 1);// remove the / at the end of the directory
		fileName = fileName.substring(fileName.lastIndexOf('/')+1, fileName.length)+"_"+cur_index;
		__log('stop_it: fileName = '+fileName);
		
		var fd=new FormData();
		fd.append("user_dir", user_dir);
		fd.append("file_name", fileName);
		fd.append("prompt.wav",blob, "prompt.wav");
		xhr.open("POST","project.php",true);
		xhr.send(fd);
		__log("postToServer: posted blob to prompt.wav");
	});
  }
  
  function createDownloadLink(file_name,html_code) {
	  __log("createDownloadLink:");
    recorder && recorder.exportWAV(function(blob) {
      var url = URL.createObjectURL(blob);
      document.getElementById('audio_div').innerHTML= html_code;
    });
  }
  
window.onload = function init() {
	try {
		// webkit shim
		window.AudioContext = window.AudioContext || window.webkitAudioContext;
		// navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
	  
		navigator.getUserMedia = navigator.getUserMedia ||
							navigator.webkitGetUserMedia ||
							navigator.mozGetUserMedia;
	  
		window.URL = window.URL || window.webkitURL;

		audio_context = new AudioContext;
		__log('Audio context set up.');
		__log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
		} catch (e) {
		alert('No web audio support in this browser!');
		}
   
		navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
		__log('No live audio input: ' + e);
		document.getElementById('mediaerrormsg').innerHTML = "<h2>ERROR failure to connect to speaker and microphone.</h2>";
		});
  }
