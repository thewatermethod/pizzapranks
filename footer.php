<footer class="site-footer">
	<div class="container-fluid">
	
		<section class="row">
			<div class="col-md-4 col-sm-12">
				<?php if ( ! dynamic_sidebar('footer-left') ) : ?>
				<ul>
					<li><strong><a href="#">Apple and Kiwi Comics</a></strong></li>
					<li class="childLink"><a href="#">Most Recent</a></li>
					<li><strong><a href="#">Andrew's Games</a></strong></li>
					<li class="childLink"><a href="#">Most Recent</a></li>		
					<li><strong><a href="#">Matt's Novel</a></strong></li>
					<li class="childLink"><a href="#">Most Recent</a></li>
					<li><strong><a href="#">Forum</a></strong></li>
					<li><strong><a href="#">Advertise</a></strong></li>
					<li><strong><a href="#">About Us</a></strong></li>		
					<?php endif; ?>			
				</ul>
				</div>

				<div class="col-md-4 col-sm-12">
					<?php if ( ! dynamic_sidebar('footer-middle') ) : ?>
				<ul>
					<li><strong><a href="#">Store</a></strong></li>
					<li class="childLink"><a href="#">Bros For Life</a></li>
					<li class="childLink"><a href="#">Book</a></li>
					<li><strong><a href="#">Perspicacity on Facebook</a></strong></li>
					<?php endif; ?>
				</ul>
				</div>	
				
				<div class="col-md-4 col-sm-12">
					<?php if ( ! dynamic_sidebar('footer-right') ) : ?>
				<ul>
					<li><strong>Sites We Likes</strong></li>
					<?php endif; ?>
				</ul>
				</div>
								
		</section>
			
		<!-- <div class="row notice ad"> <!-- Beginning of Project Wonderful ad code: -->
			<section class="col-md-offset-2 col-md-8">
			<?php if(! dynamic_sidebar('footer-ad')): ?>
			<!-- Ad box ID: 39477 -->
			<script type="text/javascript">
			
			var pw_d=document;
			pw_d.projectwonderful_adbox_id = "39477";
			pw_d.projectwonderful_adbox_type = "5";
			pw_d.projectwonderful_foreground_color = "";
			pw_d.projectwonderful_background_color = "";
			
			</script>
				<script type="text/javascript" src="http://www.projectwonderful.com/ad_display.js"></script>
				<noscript><map name="admap39477" id="admap39477"><area href="http://www.projectwonderful.com/out_nojs.php?r=0&amp;c=0&amp;id=39477&amp;type=5" shape="rect" coords="0,0,728,90" title="" alt="" target="_blank" /></map>
				<table cellpadding="0" border="0" cellspacing="0" bgcolor="#ffffff">
				<tr><td><img src="http://www.projectwonderful.com/nojs.php?id=39477&amp;type=5" width="728" height="90" usemap="#admap39477" border="0" alt="" /></td></tr><tr><td bgcolor="#ffffff" colspan="1"><center><a style="font-size:10px;color:#0000ff;text-decoration:none;line-height:1.2;font-weight:bold;font-family:Tahoma, verdana,arial,helvetica,sans-serif;text-transform: none;letter-spacing:normal;text-shadow:none;white-space:normal;word-spacing:normal;" href="http://www.projectwonderful.com/advertisehere.php?id=39477&amp;type=5" target="_blank">Ads by Project Wonderful!  Your ad here, right now: $0</a></center></td></tr><tr><td colspan=1 valign="top" bgcolor="#000000" style="height:3px;font-size:1px;padding:0px;max-height:3px;"></td></tr></table>
			</noscript>
			<?php endif;?>					
		</div> -->
		

		<div class="row notice"><p>&#169; 2009 - <?php echo date('Y'); ?>
			<?php bloginfo('name'); ?> -<em> All Rights Reserved.</em></p></div>
			<div class="notice"><p>Designed & Made with Love by <a href="https://www.twitter.com/thewatermethod" rel="designer">Matt Bevilacqua</a>, who owns <a href="https://whalingcityweb.com">Whaling City Web</a></p>
	   </div>
	</footer>	
		<?php wp_footer();?>
	
   </body>
</html>
