<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<!-- Head -->
	<?php include 'head.php';?>
	
<script type="text/javascript">
  $(document).ready(function(){
    
$('.bxslider').bxSlider({
  pagerCustom: '#bx-pager',
  auto: true,
  captions: true
});
  });
</script>	
						
	<?php $this_page = "videos.php";?>
		<!-- Feature -->
		<div id="features-wrapper">
				<section id="features" class="container">
					<div class="row">
						<div class="2u"></div>
						<div class="8u">
							<header>
								<h3>Quality education has enabled many people with visual impairment to achieve Success</h3>
							</header>
							<div style="width: 75%; margin: 0 0 0 12.5%;">
								<iframe src="http://player.vimeo.com/video/133859987?byline=0&color=a8a8a8" width="500" height="281" frameborder="0"></iframe>
						</div>
						</div>
						<div class="2u"></div>
					</div> 
				</section>
			</div>
		<!-- Footer -->
		<?php include 'footer.php';?>
	</body>
</html>