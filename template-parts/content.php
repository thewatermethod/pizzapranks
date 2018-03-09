<?php 
    $post_image = get_post_image();					
    $post_classes = array( 'bg-light' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif; ?>
    </header><!-- .entry-header -->					

    <div class="entry-content">										
        <?php if($post_image): echo $post_image; endif; ?>
            <?php the_excerpt(); ?>
    </div><!-- .entry-content -->

    
    <a class="btn btn-dark" href="<?php the_permalink(); ?>">Find out more</a>
    
</article><!-- #post-<?php the_ID(); ?> -->