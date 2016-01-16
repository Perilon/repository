// Common Variables

function disableButton(object) {
	if (x = document.getElementById(object) ) {
		x.disabled=true;
		x.style.opacity = "0.5";
	}
	return;
};

function enableButton(object) {
	if (x = document.getElementById(object) ) {
		x.disabled=false;
		x.style.opacity = "1";		
	}
	return;	
};

function startProject(lang_dir, user_dir, started) {
	if (!isRecorderWorking()) {
		document.getElementById('mediaerrormsg').innerHTML = "<h2>ERROR failure to connect to speaker and microphone.</h2>"+
								"<p style='text-align: center; margin: 0 0 1em 0;'>allow uses of the microphone and try again...</p>";
	} else {	
		document.getElementById('mediaerrormsg').innerHTML = "";
		document.getElementById('start_project').style.display = 'block';
		// create XMLHttpRequest object, adding few event listeners, and POSTing our data
		var oXHR = new XMLHttpRequest();        
		//oXHR.upload.addEventListener('progress', uploadProgress, false);
		//oXHR.addEventListener('load', uploadFinish, false);
		//oXHR.addEventListener('error', uploadError, false);
		//oXHR.addEventListener('abort', uploadAbort, false);
		oXHR.open("POST", "project.php", true);
		oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		oXHR.onreadystatechange = function() {
	    if(oXHR.readyState == 4 && oXHR.status == 200) {
		    var return_data = oXHR.responseText;
			document.getElementById('projectselect').style.display = 'none';
			document.getElementById('start_project').innerHTML = return_data;
			enableButton('record_btn');
			disableButton('play_btn');
			disableButton('cont_btn');
			disableButton('stop_btn');
			if ( !started )disableButton('rerec_btn');else enableButton('rerec_btn');
			}
		}
		// extract values from onclick call
		var vars ="call_id=start&lang_dir="+lang_dir+"&user_dir="+user_dir;
		oXHR.send(vars);
		document.getElementById("start_project").innerHTML = "processing...";
	}
	return;
};

function stop_it(lang_dir, user_dir, cur_index, last_recorded_index) {
	__log("stop_it: "+lang_dir+"  "+user_dir+"  "+cur_index+"  "+last_recorded_index);
	// First find if we are stopping playback or recording
	//stop Recording
	//Advance one Prompt need to do this in php
	// create XMLHttpRequest object, adding few event listeners, and POSTing our data
	document.getElementById("stop_btn").style.backgroundImage = "url('/prompts/images/stop-on.png')";
//	var oXHR = new XMLHttpRequest();        
//     oXHR.open("POST", "project.php", true);
//	 oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//	 oXHR.onreadystatechange = function() {
//	    if(oXHR.readyState == 4 && oXHR.status == 200) {
//		    var return_data = oXHR.responseText;
//			document.getElementById('projectselect').style.display = 'none';
//			document.getElementById('start_project').innerHTML = return_data;
//		disableButton('play_btn');
//		disableButton('cont_btn');
//		disableButton('rerec_btn');
//		disableButton('record_btn');
//		disableButton('stop_btn');
//		document.getElementById('progress_msg').innerHTML = "processing prompt file...";
//	    }
//		// save the recorded file locally (allow drag and drop)
//   }
	// turn off buttons
	disableButton('play_btn');
	disableButton('cont_btn');
	disableButton('rerec_btn');
	disableButton('record_btn');
	document.getElementById('progress_msg').innerHTML = "processing prompt file...";
	// stop recording and save file
	recorder && recorder.stop();
	__log('stop_it: Stopped recording.');
	// upload file to server
	// postToServer(lang_dir, user_dir, cur_index, last_recorded_index);  // no longer saving file on server
	// create WAV download link using audio data blob
	// make the file name <language>_<prompt index>.wav  <prompt index> = cur_index
	// <language> = last directory name in lang_dir
	var lang = lang_dir.split("/");
	lang= lang[lang.length-2];
	var file_name = lang+"_"+cur_index+".wav";
	recorder && recorder.exportWAV(function(blob) {
		var url = URL.createObjectURL(blob);
		var html_code ="<div style='width:100%;'>"+
							"<audio controls src='"+url+"'></audio>"+
						"</div>"+
						"<a href='"+url+"' download='"+file_name+"' "+
								"onclick=\x22cont_it('"+lang_dir+"','"+user_dir+"','"+cur_index+"','"+last_recorded_index+"')\x22>"+
							"<img src='images/Save-icon.png' style='width:64px;'>"+
						"</a>";
		document.getElementById('audio_div').innerHTML= html_code;
		}
	);
	recorder.clear();	

//	var vars ="call_id=recstop&lang_dir="+lang_dir+"&user_dir="+user_dir+"&cur_index="+cur_index+"&last_index="+last_recorded_index;
//   oXHR.send(vars);
};

function contProject() {
		document.getElementById('conterror').style.display = 'block';
		return;
};

function session_stop() {
	document.getElementById("start_project").style.display = 'none';
	document.getElementById("projectselect").style.display = 'block';
	var oXHR = new XMLHttpRequest();        
     oXHR.open("POST", "app.php", true);
	 oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 oXHR.onreadystatechange = function() {
		__log("session_stop: called.");
	 }
	// turn off buttons
	var vars ="call_id=session_stop";
	__log("session_stop: sending event to app.php");
     oXHR.send(vars);
	return;
};

function record_start() {
	document.getElementById("record_btn").click = "record_stop()";
	document.getElementById("record_btn").style.backgroundImage = "url('/prompts/images/sound-on.png')";
	enableButton('stop_btn');
	disableButton('record_btn');
	disableButton('play_btn');
	disableButton('rerec_btn');
	disableButton('cont_btn');
	// start recording
	recorder && recorder.record();
    __log('Started recording.');
};

function play_it(lang_dir, user_dir, cur_index, last_recorded_index) {
//	document.getElementById("play_btn").style.backgroundImage = "url('/prompts/images/play-on.png')";
	disableButton('stop_btn');
	enableButton('record_btn');
	if (cur_index != 1) {
		enableButton('rerec_btn');
	} else {
		disableButton('rerec_btn');
	}
	disableButton('play_btn');
	enableButton('cont_btn');
	// start playback
	fileName = lang_dir.substring(0,lang_dir.length - 1);									   // remove the / at the end of the directory
	fileName = fileName.substring(fileName.lastIndexOf('/')+1, fileName.length)+"_"+cur_index; // grab the last dir name and append _<index>
	document.getElementById('audio_div').innerHTML = "<audio autoplay='autoplay' controls='controls'><source src='"+user_dir+fileName+".wav' />Your browser does not support wav file playback</audio>";
};
	
function cont_it(lang_dir, user_dir, cur_index, last_recorded_index) {
//	document.getElementById("cont_btn").style.backgroundImage = "url('/prompts/images/forward-on.png')";
	console.log("in function cont_it");
	var oXHR = new XMLHttpRequest();
	oXHR.open("POST", "project.php", true);
	 oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 oXHR.onreadystatechange = function() {
	    if(oXHR.readyState == 4 && oXHR.status == 200) {
			console.log("in readyState handler for cont_it");
		    var return_data = oXHR.responseText;
			document.getElementById('projectselect').style.display = 'none';
			document.getElementById('start_project').innerHTML = return_data;
			disableButton('stop_btn');
			enableButton('record_btn');
			enableButton('rerec_btn');
			console.log("cont_it: checking position if files cur_index %s, last_recorded_index %s",cur_index, last_recorded_index);
			if ( Number(cur_index) >= last_recorded_index) {
				disableButton('play_btn');
				disableButton('cont_btn');
			} 
//			document.getElementById("cont_btn").style.backgroundImage = "url('/prompts/images/forward.png')";
	    }
    }
	var vars ="call_id=recstop&lang_dir="+lang_dir+"&user_dir="+user_dir+"&cur_index="+cur_index+"&last_index="+last_recorded_index;
	oXHR.send(vars);
};

function back_up(lang_dir, user_dir, cur_index, last_recorded_index) {
	document.getElementById("rerec_btn").style.backgroundImage = "url('/prompts/images/rewind-on.png')";
		var oXHR = new XMLHttpRequest();
	oXHR.open("POST", "project.php", true);
	 oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 oXHR.onreadystatechange = function() {
	    if(oXHR.readyState == 4 && oXHR.status == 200) {
		    var return_data = oXHR.responseText;
			document.getElementById('projectselect').style.display = 'none';
			document.getElementById('start_project').innerHTML = return_data;
			enableButton('record_btn');
			enableButton('play_btn');
			enableButton('rerec_btn');
			enableButton('cont_btn');
			disableButton('stop_btn');
	    }
    }
	var vars ="call_id=prev&lang_dir="+lang_dir+"&user_dir="+user_dir+"&cur_index="+cur_index+"&last_index="+last_recorded_index;
	oXHR.send(vars);
};

function to_last(lang_dir, user_dir, cur_index, last_recorded_index) {
	// handle all of the buttons
	var oXHR = new XMLHttpRequest();
	__log('to_last: '+lang_dir+', '+user_dir);
	oXHR.open("POST", "project.php", true);
	 oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 oXHR.onreadystatechange = function() {
	    if(oXHR.readyState == 4 && oXHR.status == 200) {
		    var return_data = oXHR.responseText;
			document.getElementById('projectselect').style.display = 'none';
			document.getElementById('start_project').innerHTML = return_data;
			enableButton('record_btn');
			enableButton('rerec_btn');
			disableButton('play_btn');
			disableButton('cont_btn');
			disableButton('stop_btn');
	    }
    }
	var vars ="call_id=tolast&lang_dir="+lang_dir+"&user_dir="+user_dir+"&cur_index="+cur_index+"&last_index="+last_recorded_index;
	oXHR.send(vars);
};

function to_prompt_nbr(lang_dir, user_dir, cur_index, last_recorded_index) {
	var oXHR = new XMLHttpRequest();
	__log('to_last: '+lang_dir+', '+user_dir);
	oXHR.open("POST", "project.php", true);
	 oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 oXHR.onreadystatechange = function() {
	    if(oXHR.readyState == 4 && oXHR.status == 200) {
		    var return_data = oXHR.responseText;
			document.getElementById('projectselect').style.display = 'none';
			document.getElementById('start_project').innerHTML = return_data;
			enableButton('record_btn');
			enableButton('play_btn');
			enableButton('cont_btn');
			disableButton('stop_btn');
			if (cur_index > 1) {
				enableButton('rerec_btn'); 
			} else { 
				disableButton('rerec_btn');
			}
	    }
    }
	// Get prompt to go to
	cur_index = document.getElementById('p_num').value;
	// console.log(temp);
	var vars = "call_id=tonum&lang_dir="+lang_dir+"&user_dir="+user_dir+"&cur_index="+cur_index+"&last_index="+last_recorded_index;
	oXHR.send(vars);
};