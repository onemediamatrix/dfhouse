<?php 
// Register widgetized areas
function food_wp_widgets_init() {

    register_sidebar( array (
		'name' => esc_html__( 'Sidebar #1 = Main Sidebar', 'food-wp' ),
		'id' => 'sidebar_main_food_wp',
		'description'   => esc_html__( 'Add widgets here to appear in the sidebar.', 'food-wp' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Sidebar #2 = Default Page', 'food-wp' ),
		'id' => 'sidebar_page_food_wp',
		'description'   => esc_html__( 'Add widgets here to appear in the sidebar.', 'food-wp' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '<div class="clear"></div></div><div class="clear"></div>',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Home Modules', 'food-wp' ),
		'description' => esc_html__('Use only the widgets that start with the name "Module".', 'food-wp'),
		'id' => 'homemodules_food_wp',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="title-module"><span>',
		'after_title' => '</span></h3><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Footer Sidebar 1', 'food-wp' ),
		'id' => 'footer1_food_wp',
		'description'   => esc_html__( 'Add widgets here to appear in the footer.', 'food-wp' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Footer Sidebar 2', 'food-wp' ),
		'id' => 'footer2_food_wp',
		'description'   => esc_html__( 'Add widgets here to appear in the footer.', 'food-wp' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Footer Sidebar 3', 'food-wp' ),
		'id' => 'footer3_food_wp',
		'description'   => esc_html__( 'Add widgets here to appear in the footer.', 'food-wp' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Footer Sidebar 4', 'food-wp' ),
		'id' => 'footer4_food_wp',
		'description'   => esc_html__( 'Add widgets here to appear in the footer.', 'food-wp' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="title"><span>',
		'after_title' => '</span></h3><div class="clear"></div>',
	) );
}

add_action( 'init', 'food_wp_widgets_init' );
?>