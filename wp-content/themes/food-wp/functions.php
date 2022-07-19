<?php
// ------------------------------------------------ 
// ---------- Options Framework Theme -------------
// ------------------------------------------------
 include( get_template_directory() . '/admin/index.php');

// ---------------------------------------------- 
// --------------- Load Custom Widgets ----------
// ----------------------------------------------
 include( get_template_directory() . '/functions/widgets.php');
 include( get_template_directory() . '/functions/widgets/widget-top-tags.php');
 include( get_template_directory() . '/functions/widgets/widget-latest-posts.php');
 include( get_template_directory() . '/functions/widgets/widget-cat-posts.php'); 
 include( get_template_directory() . '/functions/widgets/widget-top-posts.php');
 include( get_template_directory() . '/functions/widgets/widget-feedburner.php');
 include( get_template_directory() . '/functions/widgets/widget-banner.php');
 include( get_template_directory() . '/functions/widgets/widget-module-1.php'); 
 include( get_template_directory() . '/functions/widgets/widget-module-2.php'); 
 include( get_template_directory() . '/functions/widgets/widget-module-3.php'); 
 include( get_template_directory() . '/functions/widgets/widget-module-4.php');
 include( get_template_directory() . '/functions/widgets/widget-module-5.php');

// ----------------------------------------------
// --------------- Load Custom ------------------
// ---------------------------------------------- 
 include( get_template_directory() . '/functions/custom/comments.php');
  
// ----------------------------------------------
// ------ Content width -------------------------
// ----------------------------------------------
if ( ! isset( $content_width ) ) $content_width = 950;

// ----------------------------------------------
// ------ Theme set up --------------------------
// ----------------------------------------------
add_action( 'after_setup_theme', 'food_wp_theme_setup' );
if ( !function_exists('food_wp_theme_setup') ) {

    function food_wp_theme_setup() {
    
        // Register navigation menu
        register_nav_menus(
            array(
                'food_wp_primary-menu' => esc_html__( 'Header Navigation', 'food-wp' )
            )
        );
        
        // Localization support
        load_theme_textdomain( 'food-wp', get_template_directory() . '/languages' );
        
        // Feed Links
        add_theme_support( 'automatic-feed-links' );
        
        // Title Tag
        add_theme_support( 'title-tag' );

        // Post thumbnails
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'food_wp_thumbnail-blog-grid', 250, 250, true ); // Blog thumbnails grid
        add_image_size( 'food_wp_thumbnail-blog-featured', 345, 345, true ); // Blog thumbnails home featured posts
        add_image_size( 'food_wp_thumbnail-blog-random', 320, 320, true ); // Blog thumbnails home random posts
        add_image_size( 'food_wp_thumbnail-widget-small', 90, 90, true ); // Sidebar Widget thumbnails small
        add_image_size( 'food_wp_thumbnail-single-image', 950, '', true ); // Single thumbnails

    }
}

// ----------------------------------------------
// ------------ JavaScrips Files ----------------
// ----------------------------------------------
if( !function_exists( 'food_wp_enqueue_scripts' ) ) {
    function food_wp_enqueue_scripts() {

        // Register css files
        wp_enqueue_style( 'food_wp_style', get_stylesheet_uri(), '', '3.1');
        wp_enqueue_style( 'food_wp_default', get_template_directory_uri() . '/css/colors/default.css', array( 'food_wp_style' ), '3.1' );
        wp_enqueue_style( 'food_wp_responsive', get_template_directory_uri() . '/css/responsive.css', array( 'food_wp_style' ), '3.1' );
        wp_enqueue_style( 'food_font-awesome', get_template_directory_uri() . '/css/font-awesome-4.7.0/css/font-awesome.min.css', array(), '4.7.0' );
        wp_enqueue_style( 'jquery-owl-carousel', get_template_directory_uri() . '/owl-carousel/owl.carousel.css', array(), '2.0.0' );

        // Register scripts
        wp_enqueue_script( 'food_wp_customjs', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.1', true );
        wp_enqueue_script( 'food_wp_mainfiles',  get_template_directory_uri() . '/js/jquery.main.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'jquery-owl-carousel', get_template_directory_uri() . '/owl-carousel/owl.carousel.min.js', array( 'jquery' ), '2.0', true );
        $food_wp_js_custom = array( 'template_url' => get_template_directory_uri('template_url') ); wp_localize_script( 'food_wp_customjs', 'food_wp_js_custom', $food_wp_js_custom );

        // Load Comments & .js files.
        if( is_single() ) {
            wp_enqueue_script( 'fslightbox-basic', get_template_directory_uri() . '/functions/fslightbox-basic-3.2.1/fslightbox.js', array( 'jquery' ), '3.2.1', true );  
            wp_enqueue_script( 'comment-reply' );
         }

// ----------------------------------------------
// Register Fonts: https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
// ----------------------------------------------
        function food_wp_fonts_url() {
            $food_wp_font_url_google = '';
            
            /*
            Translators: If there are characters in your language that are not supported
            by chosen font(s), translate this to 'off'. Do not translate into your own language.
             */
            if ( 'off' !== _x( 'on', 'Google font: on or off', 'food-wp' ) ) {
                $food_wp_font_url_google = add_query_arg( 'family', urlencode( 'Ruda:400,700|Covered By Your Grace' ), "//fonts.googleapis.com/css" );
            }
            return $food_wp_font_url_google;
        }
        /* -- Enqueue styles -- */
        wp_enqueue_style( 'food_wp_fonts', food_wp_fonts_url(), array(), '1.0.0' );
  

    }
    add_action('wp_enqueue_scripts', 'food_wp_enqueue_scripts');
}


// ----------------------------------------------
// ---------- excerpt length adjust -------------
// ----------------------------------------------
function food_wp_excerpt($str, $length, $minword = 3) {
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word) {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        if (strlen($word) > $minword && strlen($sub) >= $length) { break; }
    }
    return $sub . (($len < strlen($str)) ? ' ..' : '');
}
 

// ------------------------------------------------ 
// --- Characters limit for title -----------------
// ------------------------------------------------ 
function food_wp_the_title($length, $replacer = ' ..') {
    $string = get_the_title();
    if( mb_strlen( $string ) > $length ) {
        $string = mb_substr( $string, 0, $length-3 );
        echo esc_attr($string) . $replacer;
    } else echo esc_attr($string);
}


// ------------------------------------------------ 
// ------------ Notice ----------------------------
// ------------------------------------------------
function themes_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'themes.php' ) {
         echo '<div class="notice notice-info is-dismissible" style="box-shadow: 0 1px 5px rgba(0,0,0,0.2); ">
             <p><a class="button" href="https://anthemes.com/" target="_blank">Anthemes.com</a> <a class="button activate" href="https://themeforest.net/item/tasty-food-recipes-food-blog-wordpress-theme/19331908" target="_blank">Tasty Food Theme</a> <a class="button activate" href="https://themeforest.net/item/tasty-food-recipes-food-blog-wordpress-theme/19331908/support" target="_blank">Get Support</a></p>
         </div>';
    }
}
add_action('admin_notices', 'themes_admin_notice');


// ------------------------------------------------ 
// --- One Click Demo Import (Plugin) -------------
// --- You can delete this part if you wish -v3.2--
// ------------------------------------------------ 
function food_wp_plugin_intro_text( $food_wp_default_text ) {
    $food_wp_default_text =  /* https://wordpress.org/plugins/one-click-demo-import/faq/ the inline style is added for the demo import plugin, that is displayed via Dashboard > Appearance. */ '<div class="ocdi__intro-text" style="width:355px;">'. esc_html__( 'Please click "Import Demo Data" button only once and wait, it can take a couple of minutes.', 'food-wp' ) .'</div>';?><br /><img style="width:400px; margin-bottom: 20px; border-radius: 4px;" src="<?php echo get_template_directory_uri(); ?>/screenshot.png" width="400" hieght="300" alt="img" /><br /> In the meantime, you check the <a href="https://anthemes.com/docs/tasty-food/" target="_blank">help file</a> or <a href="https://anthemes.com/support/" target="_blank">get support</a>.<?php
    return $food_wp_default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'food_wp_plugin_intro_text' );

function food_wp_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'Main Demo', 'food-wp' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . '/functions/demo/food-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/functions/demo/food-widgets.wie',
        ) 
    );
}
add_filter( 'pt-ocdi/import_files', 'food_wp_import_files' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


// ------------------------------------------------ 
// ---------- TGM_Plugin_Activation -------------
// ------------------------------------------------ 
 include( get_template_directory() . '/functions/custom/class-tgm-plugin-activation.php');
 add_action( 'tgmpa_register', 'food_wp_register_required_plugins' );

function food_wp_register_required_plugins() {

    $plugins = array(
         array(
            'name'                  => esc_html__( 'Shortcodes', 'food-wp' ), // The plugin name
            'slug'                  => 'anthemes-shortcodes', // The plugin slug (typically the folder name)
            'source'                => get_template_directory() . '/plugins/anthemes-shortcodes.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),


        array(
            'name'                  => esc_html__( 'AnLikes', 'food-wp' ), // The plugin name
            'slug'                  => 'anlikes', // The plugin slug (typically the folder name)
            'source'                => get_template_directory() . '/plugins/anlikes.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => esc_html__( 'Food WP Options', 'food-wp' ), // The plugin name
            'slug'                  => 'food-wp-options', // The plugin slug (typically the folder name)
            'source'                => get_template_directory() . '/plugins/food-wp-options.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => esc_html__( 'Responsive Menu', 'food-wp' ), // The plugin name
            'slug'                  => 'responsive-menu', // The plugin slug (typically the folder name)
            'source'                => get_template_directory() . '/plugins/responsive-menu.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => esc_html__( 'Meta Box', 'food-wp' ),
            'slug'                  => 'meta-box',
            'required'              => false,
            'version'               => '',
        ),

        array(
            'name'                  => esc_html__( 'Daves WordPress Live Search', 'food-wp' ),
            'slug'                  => 'daves-wordpress-live-search',
            'required'              => false,
            'version'               => '',
        ),

        array(
            'name'                  => esc_html__( 'Multi-column Tag Map', 'food-wp' ),
            'slug'                  => 'multi-column-tag-map',
            'required'              => false,
            'version'               => '',
        ),

        array(
            'name'                  => esc_html__( 'AccessPress Anonymous Post', 'food-wp' ),
            'slug'                  => 'accesspress-anonymous-post',
            'required'              => false,
            'version'               => '',
        ),
 
        array(
            'name'                  => esc_html__( 'WP-PageNavi', 'food-wp' ),
            'slug'                  => 'wp-pagenavi',
            'required'              => false,
            'version'               => '',
        ),

        array(
            'name'                  => esc_html__( 'WP Recipe Maker', 'food-wp' ),
            'slug'                  => 'wp-recipe-maker',
            'required'              => false,
            'version'               => '',
        ),

        array(
            'name'                  => esc_html__( 'One Click Demo Import', 'food-wp' ),
            'slug'                  => 'one-click-demo-import',
            'required'              => false,
            'version'               => '',
        ),        

    );

    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );

}

?>