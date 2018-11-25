<?php

class PizzaPranksPostMeta {

    public function __construct() {

        if ( is_admin() ) {
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
        }

    }

    public function init_metabox() {

        add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
        add_action( 'save_post',             array( $this, 'save_metabox' ), 10, 2 );

    }

    public function add_metabox() {

        global $post;

        add_meta_box(
            'pp-games-meta',
            'Games Info',
            array( $this, 'render_pizzapranks_metabox' ),
            'post',
            'normal',
            'low'
        );

        $selected_template =  get_page_templates( $post );

        if( $selected_template["Pixel Dailies Calendar"] == 'tmpl-calendar.php') {
            add_meta_box(
                'pp-calendar-meta',
                'Setup Calendar',
                array( $this, 'render_pizzapranks_calendar_metabox' ),
                'page',
                'normal',
                'low'
            );
        }


    }

    public function render_pizzapranks_calendar_metabox( $post ){ 

        // Add nonce for security and authentication.
        wp_nonce_field( 'pizza_pranks_save_meta_action', 'pizza_pranks_save_meta_action_nonce' );
        $calendar_category = get_post_meta( $post->ID, 'calendar_category', true ); 

        ?>
        
        <p><label for="calendar_category">Select category of posts to populate the calendar</label></p>
        <?php wp_dropdown_categories( array( 'name' => 'calendar_category', 'selected' => $calendar_category, 'hide_empty' => 0 ) ); 
        
    }

    public function render_pizzapranks_metabox( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'pizza_pranks_save_meta_action', 'pizza_pranks_save_meta_action_nonce' );

        // Retrieve an existing value from the database.
        $download_link = get_post_meta( $post->ID, 'download_link', true );
        $game_price = get_post_meta( $post->ID, 'game_price', true );

        // Form fields. ?>
        <table class="form-table">

            <tr>
                <th><label for="download_link" class="download_link_label">Download Link</label></th>
                <td>
                    <input type="text" id="download_link" name="download_link" class="download_link_field" value="<?php echo esc_attr( $download_link ); ?>">
                </td>
            </tr>

            <tr>
                <th><label for="game_price" class="game_price_label">Game Price</label></th>
                <td>
                    <input type="text" id="game_price" name="game_price" class="game_price_field"  value="<?php echo esc_attr( $game_price );?>">
                </td>
            </tr>


        </table>
        <?php


    }

    public function save_metabox( $post_id, $post ) {

        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['pizza_pranks_save_meta_action_nonce'] ) ? $_POST['pizza_pranks_save_meta_action_nonce'] : '';
        $nonce_action = 'pizza_pranks_save_meta_action';

        // Check if a nonce is set.
        if ( ! isset( $nonce_name ) )
            return;

        // Check if a nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
            return;

        // Sanitize user input.
        $download_linknew_ = isset( $_POST[ 'download_link' ] ) ? sanitize_text_field( $_POST[ 'download_link' ] ) : '';
        $game_pricenew_ = isset( $_POST[ 'game_price' ] ) ? sanitize_text_field( $_POST[ 'game_price' ] ) : '';
        $calendar_categorynew_ = isset( $_POST[ 'calendar_category' ] ) ? sanitize_text_field( $_POST[ 'calendar_category' ] ) : '';

        // Update the meta field in the database.
        update_post_meta( $post_id, 'download_link', $download_linknew_ );
        update_post_meta( $post_id, 'game_price', $game_pricenew_ );
        update_post_meta( $post_id, 'calendar_category', $calendar_categorynew_ );

    }

}

new PizzaPranksPostMeta;