<?php



function pizzapranks_customizer( $wp_customize ) {


    /** All our settings */

    $wp_customize->add_setting( 'google_fonts_api_key' , array(
        'default'   => ''       
    ) );

    $wp_customize->add_setting( 'fonts_heading_fonts' , array(
        'default'   => 'VT323'       
    ) );

    $wp_customize->add_setting( 'fonts_body_fonts' , array(
        'default'   => ''       
    ) );

    $wp_customize->add_setting( 'background-color' , array(
        'default'   => '#d9d5c5'       
    ) );

    $wp_customize->add_setting( 'title-color' , array(
        'default'   => '#66507f'       
    ) );
    

    /** Fonts Section */

    $wp_customize->add_section( 'pizzapranks_fonts' , array(
        'title'      => 'Fonts',
        'priority'   => 30,
    ) );
    
    $wp_customize->add_control( 'google_fonts_api_key', array(
		'label'    => 'Google Fonts API Key',
		'section'  => 'pizzapranks_fonts',
		'type'     => 'text',
		'priority' => 1
     ) );


    if( get_theme_mod( 'google_fonts_api_key' ) != "" ) {
        $wp_customize->add_control( 'fonts_heading_fonts', array(
            'label'    => 'Heading Font',
            'section'  => 'pizzapranks_fonts',
            'type'     => 'select',
            'priority' => 2,
            'choices'  => get_google_fonts()
         ) );
         $wp_customize->add_control( 'fonts_body_fonts', array(
            'label'    => 'Body Font',
            'section'  => 'pizzapranks_fonts',
            'type'     => 'select',
            'priority' => 3,
            'choices'  => get_google_fonts()
         ) );
    }


    /** Colors section */

    $wp_customize->add_section( 'pizzapranks_colors' , array(
        'title'      => 'Colors',
        'priority'   => 30,
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( 
        $wp_customize, 
        'title-color', 
        array(
            'label'      => "Title Color",
            'section'    => 'pizzapranks_colors',
            'settings'   => 'title-color',
            'priority'   => 2
        )
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'background-color', 
        array(
            'label'      => 'Background Color',
            'section'    => 'pizzapranks_colors',
            'settings'   => 'background-color',
            'priority'   => 1
        ) ) 
    );

 }



add_action( 'customize_register', 'pizzapranks_customizer' );

function get_google_fonts() {

    $fonts = [];

    $api_key = get_theme_mod( 'google_fonts_api_key' );

    if( $api_key != "") {       

        if ( false === ( $response_body = get_transient( 'pizzapranks_google_fonts' ) ) ) {
            $response = wp_remote_get("https://www.googleapis.com/webfonts/v1/webfonts?key=" . $api_key);
            $response_body = wp_remote_retrieve_body( $response );
            set_transient( 'pizzapranks_google_fonts', $response_body );
        }

        $response_body = json_decode($response_body);
        $items = $response_body->items;
        

        $fonts[0] = "Basic";

        foreach ( $items as $key => $font) {
            $fonts[$font->family] = $font->family;
        }
    }

    
    return $fonts;
}