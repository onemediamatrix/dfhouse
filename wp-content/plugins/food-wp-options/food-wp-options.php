<?php
/*
Plugin Name: Food WP Options
Plugin URL: https://www.anthemes.com
Description: Theme Functionality: Custom Style, Theme core, etc.
Version: 1.1
Author: An-Themes
Author URI: http://themeforest.net/user/An-Themes/portfolio
*/


// ------------------------------------------------ 
// ---- Display custom color CSS ------------------
// ------------------------------------------------ 
function food_wp_colors_css_wrap() {
    include( get_template_directory() . '/functions/custom/custom-style.php');
?>
<style type="text/css"><?php echo food_wp_custom_colors_css(); ?></style>
<?php }
add_action( 'wp_head', 'food_wp_colors_css_wrap' );


// ------------------------------------------------
// ---- Add  rel attributes to embedded images ----
// ------------------------------------------------ 
function insert_rel_food_wp($content) {
    $pattern ='/<a(.*?)href=("|")(.*?).(bmp|gif|jpeg|jpg|png)("|")(.*?)>/i';
    $replacement = '<a$1href=$2$3.$4$5 data-fslightbox="gallery1">';
    $content = preg_replace( $pattern, $replacement, $content );
    return $content;
}
add_filter( 'the_content', 'insert_rel_food_wp' );


// ------------------------------------------------ 
// --- Pagination class/style for entry articles --
// ------------------------------------------------ 
function custom_nextpage_links_food_wp($defaults) {
$args = array(
'before' => '<div class="my-paginated-posts"><p>' . '<span>',
'after' => '</span></p></div>',
);
$r = wp_parse_args($args, $defaults);
return $r;
}
add_filter('wp_link_pages_args','custom_nextpage_links_food_wp');


// ------------------------------------------------ 
// ------------ Nr of Topics for Tags -------------
// ------------------------------------------------  
add_filter ( 'wp_tag_cloud', 'tag_cloud_count_food_wp' );
function tag_cloud_count_food_wp( $return ) {
return preg_replace('#(<a[^>]+\')(\d+)( topics?\'[^>]*>)([^<]*)<#imsU','$1$2$3$4 <span>($2)</span><',$return);
}


// ------------------------------------------------ 
// ------------ Meta Box --------------------------
// ------------------------------------------------
$prefix = 'food_wp_';
global $meta_boxes;
$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
    'id' => 'standard',
    'title' => __( 'Article Page Options', 'food-wp' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,

    // Youtube
    'fields' => array(
        // TEXT
        array(
            // Field name - Will be used as label
            'name'  => __( 'Video Youtube', 'food-wp' ),
            // Field ID, i.e. the meta key
            'id'    => "{$prefix}youtube",
            // Field description (optional)
            'desc'  => __( 'Add Youtube code ex: HIrMIeN5ttE', 'food-wp' ),
            'type'  => 'text',
            // Default value (optional)
            'std'   => __( '', 'food-wp' ),
            // CLONES: Add to make the field cloneable (i.e. have multiple value)
            'clone' => false,
        ),


    // Vimeo
        // TEXT
        array(
            // Field name - Will be used as label
            'name'  => __( 'Video Vimeo', 'food-wp' ),
            // Field ID, i.e. the meta key
            'id'    => "{$prefix}vimeo",
            // Field description (optional)
            'desc'  => __( 'Add Vimeo code ex: 7449107', 'food-wp' ),
            'type'  => 'text',
            // Default value (optional)
            'std'   => __( '', 'food-wp' ),
            // CLONES: Add to make the field cloneable (i.e. have multiple value)
            'clone' => false,
        ),

    // Gallery
        // IMAGE UPLOAD
        array(
            'name' => __( 'Gallery', 'food-wp' ),
            'id'   => "{$prefix}slider",
            // Field description (optional)
            'desc'  => __( 'Image with any size!', 'food-wp' ),            
            'type' => 'image_advanced',
        ),

    // Hide Featured Image
        // CheckBox
        array(
            'name' => __( 'Featured Image', 'food-wp' ),
            'id'   => "{$prefix}hideimg",
            'desc'  => __( 'Hide Featured Image on single page for this article', 'food-wp' ),
            'type' => 'checkbox',
        ),


    ),

);



/**
 * Register meta boxes
 *
 * @return void
 */
function food_wp_register_meta_boxes()
{
    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;

    global $meta_boxes;
    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'food_wp_register_meta_boxes' );


?>