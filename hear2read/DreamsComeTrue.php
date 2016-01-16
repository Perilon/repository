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
						
	<?php $this_page = "DreamsComeTrue.php";?>
		<!-- Feature -->
		<div id="features-wrapper">
				<section id="features" class="container">
					<div class="row">
						<div class="2u"></div>
						<div class="8u">
							<header>
								<h3>Quality education has enabled many people with visual impairment to achieve Success</h3>
							</header>
							<p style="text-align: center;">(Click on the pictures to read the fabulous stories of these amazing people.)</p>
						<div style="width: 75%; margin: 0 0 0 12.5%;">

							<ul class="bxslider">
  								<li>
  									<a href="http://en.wikipedia.org/wiki/T._V._Raman" target="_blank">
  										<img src="images/TV_Raman.jpg" alt title="Dr. TV Ramin: World renowned mathematician and computer scientist currently 
											at Google Research.">
									</a>
								</li>
								<li> 
									<a href="http://www.daisy.org/stories/dipendra-manocha" target="_blank">
										<img src="images/manocha2.png" alt title="Dipendra Manocha: Ashoka Fellow recognized as a Social Entrepreneur.">
									</a>
								</li>
								<li> 
									<a href="http://www.thebetterindia.com/6609/tbi-this-ability-uncle-sams-battles-for-the-visually-impaired/" target="_blank">
										<img src="images/Sam_T.jpg" alt title="Dr. Sam Taraporevala: Head of the Department of Sociology, St. Xavier's College, Mumbai">
									</a>
								</li>
								<li> 
									<a href="http://www.huffingtonpost.com/2013/05/28/kartik-sawhney_n_3348284.html" target="_blank">
										<img src="images/KartikPic.png" alt title="Kartik Sawhney: Studying Computer Science at Stanford University on full Scholarship">
									</a>
								</li>
							</ul>
							<div id="bx-pager">
  								<a data-slide-index="0" href=""><img src="/images/TV_Raman_Thumb.jpg" style="width: initial;" /></a>
  								<a data-slide-index="1" href=""><img src="/images/manocha2_Thumb.png" style="width: initial;" /></a>
  								<a data-slide-index="2" href=""><img src="/images/Sam_T_Thumb.jpg" style="width: initial;" /></a>
  								<a data-slide-index="3" href=""><img src="/images/KartikPic_Thumb.png" style="width: initial;" /></a>
							</div>
							
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