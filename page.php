<?php
	get_header();
?>	

  <?php if (have_posts()) : while (have_posts()) : the_post();?>
    <main class="site-main">
		<div class="articles">
        <h2 id="post-<?php the_ID(); ?>"><?php the_title();?></h2>
        <div class="entrytext">
            <?php the_content('<p class="serif">Read the rest of this page �</p>'); ?>
        </div>
	</div>
    </main>
    <?php endwhile; endif; ?>

</div>
<?php
	get_footer();
?>	