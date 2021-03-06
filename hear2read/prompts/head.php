<?php
session_save_path("/home/users/web/b1234/ipg.hear2readcom/cgi-bin/tmp"); 
session_start(); 
$messages = "Website updated 10/25 @ 5:37pm PST.";
?>
	<head>
		<title>Hear2Read</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="TextToSpeech Indian Languages Adroid TTS" />
        <meta name="description" content="Android Text To Speech (TTS) App for Indian languages">
		
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/script.js"></script>
		<script src="js/project.js"></script>
		<script src="js/recorder.js"></script>
		<script src = "js/recorder-scripts.js"></script>

		
		<!-- jQuery library (served from Google) -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<!-- bxSlider Javascript file -->
		<script src="js/jquery.bxslider.min.js"></script>
		<!-- bxSlider CSS file -->
		<link href="css/jquery.bxslider.css" rel="stylesheet" />
		<link href="css/upload-form.css" rel="stylesheet" />
		<link href="css/project.css" rel="stylesheet" />
		
		<!-- <script src="js/responsiveslides.min.js"></script> -->
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<link rel="stylesheet" type="text/css" href="usrtempl/style.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!-- <script>
  			$(function() {
				$(".rslides").responsiveSlides({
  					auto: true,             // Boolean: Animate automatically, true or false
  					speed: 500,            // Integer: Speed of the transition, in milliseconds
  					timeout: 5000,          // Integer: Time between slide transitions, in milliseconds
  					pager: false,           // Boolean: Show pager, true or false
  					nav: true,             // Boolean: Show navigation, true or false
  					random: false,          // Boolean: Randomize the order of the slides, true or false
  					pause: false,           // Boolean: Pause on hover, true or false
  					pauseControls: true,    // Boolean: Pause when hovering controls, true or false
  					prevText: "Previous",   // String: Text for the "previous" button
  					nextText: "Next",       // String: Text for the "next" button
  					maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
  					navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
  					manualControls: "",     // Selector: Declare custom pager navigation
  					namespace: "rslides",   // String: Change the default namespace used
  					before: function(){},   // Function: Before callback
  					after: function(){}     // Function: After callback
				});  			
			});
		</script> -->
	</head>
	<!-- body -->
	<body class="homepage">
		<!-- Header -->
		<div id="header-wrapper">
				<div id="header" class="container">
				    <div class="row">
					    <div class="4u importat(collapse)">
							<!-- Logo -->
							<h3 id="logo"><a href="app.php"><img src="images/logo.png" alt="Hear2Read Logo" style="width: 88%;max-width: 20em;"></a><sup>TM</sup></h3>
						</div>
					    <div class="8u important(collapse)">
					<!-- Nav -->
					<!--		<nav id="nav">
								<ul>
									<li><a class="icon fa-home" href="index.php"><span>Home</span></a></li>
									<li><a class="icon fa-cog" href="solution.php"><span>Solution</span></a></li>
									<li><a class="icon fa-cog" href="partners.php"><span>Partners</span></a></li>
									<li><a class="icon fa-cog" href="join.php"><span>Join Us</span></a></li>
								</ul>
							</nav> -->
							<div>
								<h1 style='margin-bottom:0;'>Record Speech Prompts</h1>
								<?php if ($messages) { ?>
								<div id='messages'>
									<h2 style="margin: 0 0 0 1em;font-size:1.2em;">IMPORTANT MESSAGE</h2>
									<p style="margin: -0.5em 0 0 2em; color: #00548b;"><?php echo $messages; ?></p>
								</div>
								<?php } ?>
							</div>
						</div>
				    </div>
				</div>
			</div>

