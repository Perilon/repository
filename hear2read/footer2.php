			<footer id="footer-wrapper">
				<div id="footer" class="container">
					<div class="row">
						<!-- <div class="2u"></div> -->
						<div class="6u">
							<header>
								<h2 style="color:red;">Reach out to us. <strong></strong></h2>
							</header>
							<?php include 'h2r_sendmail.php';?>
						</div>
						<div class="6u">
							<header>
								<h2 style="color: red;">Donate</h2>
							</header>
							<section>
								<p> Hear2Read is an initiative of <a href="http://icaonline.org/hear2read" target="_blank">Indians for Collective Action</a> (ICA).  
								ICA is a registered 501(c)(3) nonprofit, nonpartisan organization (Tax ID: 23-7027461).  All contributions are used for 
								charitable purposes and are tax-deductible to the full extent of the law.</p>
								<p>Please click or touch the button below to go to the ICA site.  Once there, select Hear2Read in the 
								Project drop-down Menu.</p>
							</section>
							<div id="center">
								<a href="http://icaonline.org/donate" target="_blank">
									<img src="images/btn_donate_SM.gif" style="width: 20%;" alt="Donate"></a>
							</div>
						</div>
					</div>
				</div>
				<div id="copyright" class="container">
					<ul style="font-size: .75em; list-style: none; text-align: center; margin-left: 0; line-height: 1.4em;">
						<li>All Contents Copyright &copy; 2014 - 2015 Hear2Read.  All rights reserved.</li>
						<li>Hear2Read is a trademark of Suresh Bazaj.</li>
						<?php if ($this_page == 'solution.php')
							echo '<li>Apple&#174;, Bookshare&#174;, and Google&#174; are registered trademarks of
							Apple, Inc., Beneficent Technology, Inc., and Google, Inc., respectively.  Android is a trademark of Google, Inc. Other trademarks 
							and registered trademarks are the property of their respective owners.</li>';
						?>
						<li>Design: Timothy White (template by <a href="http://html5up.net">HTML5 UP</a>)</li>
					</ul>
				</div>
			</footer>