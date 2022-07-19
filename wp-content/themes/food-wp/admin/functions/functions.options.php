<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);

 
	
		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		$imgs_url = get_template_directory_uri().'/images/';
		$imgs_url_demo = get_template_directory_uri().'/demo';



// Set the Options Array
global $of_options;
$of_options = array();
 

 

/*-----------------------------------------------------------------------------------*/
/* General Settings */
/*-----------------------------------------------------------------------------------*/

$of_options[] = array( 	"name" 		=> esc_html__( 'General Settings', 'food-wp' ),
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-header.png"
				);


$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction_7",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('Custom Logo.', 'food-wp') ."</h3>
						". esc_html__('Upload a custom logo image for your site.', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Custom Logo.', 'food-wp' ),
						"desc" 		=> esc_html__('Upload a custom logo image for your site here. Size for height should be at least 86px or bigger for retina screens.', 'food-wp'),
						"id" 		=> "food_wp_logo",
						"std" 		=> $imgs_url.'logo.png',
						"type" 		=> "upload");


$of_options[] = array( 	"name" 		=> esc_html__( 'Top Icons', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_social",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('Top Icons.', 'food-wp') ."</h3>
						<strong>". esc_html__('Top Icons', 'food-wp') ."</strong> ". esc_html__('Featured Top Icons.', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Top Icons.', 'food-wp' ),
						"desc" 		=> "". esc_html__('Featured Top Icons: Latest / Popular / Liked / Upload', 'food-wp') ." <a href=\"https://fontawesome.com/v4.7.0/icons/\" target=\"_blank\">Font Awesome</a> ". esc_html__('for more Icons!', 'food-wp') ."",
						"id" 		=> "food_wp_top_icons",
						"std" 		=> "
<li><a href=\"#\"><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> <div>Latest</div></a></li>

<li><a href=\"#\"><i class=\"fa fa-trophy\" aria-hidden=\"true\"></i> <div>Popular</div></a></li>

<li><a href=\"#\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i> <div>Liked</div></a></li>

<li><a href=\"#\"><i class=\"fa fa-cloud-upload\" aria-hidden=\"true\"></i> <div>Upload</div></a></li>
",
						"type" 		=> "textarea");	

					

$of_options[] = array( 	"name" 		=> esc_html__( 'Header Social Icons', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_social",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('Header Social Icons.', 'food-wp') ."</h3>
						<strong>". esc_html__('Social Icons', 'food-wp') ."</strong> ". esc_html__('- Header Social Icons.', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Social Icons.', 'food-wp' ),
						"desc" 		=> "". esc_html__('You can use HTML code. For more social icons go to', 'food-wp') ." <a href=\"https://fontawesome.com/v4.7.0/icons/\" target=\"_blank\">Font Awesome</a> ". esc_html__('and at the bottom you have Brand Icons!', 'food-wp') ."",
						"id" 		=> "food_wp_top_social_icons",
						"std" 		=> "
<li><a href=\"#\"><i class=\"fa fa-facebook\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-twitter\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-instagram\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-pinterest\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-google-plus\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-youtube\"></i></a></li>
",
						"type" 		=> "textarea");	



/*-----------------------------------------------------------------------------------*/
/* Blog Settings */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> esc_html__( 'Blog Settings', 'food-wp' ),
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-home.png"
				);

$of_options[] = array( 	"name" 		=> esc_html__( 'Header Slider', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_slider",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('Slider, top liked posts.', 'food-wp') ."</h3>
						<strong>". esc_html__('Slider', 'food-wp') ."</strong> ". esc_html__(' - top liked posts.', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Display Slider?', 'food-wp' ),
						"desc" 		=> esc_html__( 'Display Slider? Top Liked Posts.', 'food-wp' ),
						"id" 		=> "food_wp_display_slider",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);



$of_options[] = array( 	"name" 		=> esc_html__( 'Don\'t Miss! Random Posts', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_random_posts",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('Don\'t Miss! Random Posts.', 'food-wp') ."</h3>
						<strong>". esc_html__('Don\'t Miss!', 'food-wp') ."</strong> ". esc_html__(' - Random Posts', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Display Random Posts?', 'food-wp' ),
						"desc" 		=> esc_html__( 'Display Random Posts?', 'food-wp' ),
						"id" 		=> "food_wp_display_random_posts",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);

$of_options[] = array( 	"name" 		=> esc_html__( 'Facebook / Instagram sections', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_fi",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('Facebook / Instagram sections', 'food-wp') ."</h3>
						". esc_html__('Facebook / Instagram sections', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Display Facebook / Instagram sections?', 'food-wp' ),
						"desc" 		=> esc_html__( 'Display Facebook / Instagram sections?', 'food-wp' ),
						"id" 		=> "food_wp_display_social_sections",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);


$of_options[] = array( 	"name" 		=> esc_html__( 'Facebook Section', 'food-wp' ),
						"desc" 		=> esc_html__( 'Facebook Section.', 'food-wp' ),
						"id" 		=> "food_wp_facebook_text",
						"std" 		=> "
<h4>Facebook</h4>
<p>Food is home to 5,000+ of the web\'s best branded recipes, plus bloggers who share their best recipes! </p>

<a href=\"#\">Follow Us <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></a>
",
						"type" 		=> "textarea");	


$of_options[] = array( 	"name" 		=> esc_html__( 'Facebook Image', 'food-wp' ),
						"desc" 		=> esc_html__('Upload a custom Facebook Image. Size for image: 320x260', 'food-wp'),
						"id" 		=> "food_wp_fb_image",
						"std" 		=> $imgs_url.'facebook-section.png',
						"type" 		=> "upload");


$of_options[] = array( 	"name" 		=> esc_html__( 'Instagram Section', 'food-wp' ),
						"desc" 		=> esc_html__( 'Instagram Section.', 'food-wp' ),
						"id" 		=> "food_wp_instagram_text",
						"std" 		=> "
<h4>Instagram</h4>
<p>Food is home to 5,000+ of the web\'s best branded recipes, plus bloggers who share their best recipes! </p>

<a href=\"#\">Follow Us <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></a>
",
						"type" 		=> "textarea");	


$of_options[] = array( 	"name" 		=> esc_html__( 'Instagram Image', 'food-wp' ),
						"desc" 		=> esc_html__('Upload a custom Instagram Image. Size for image: 320x260', 'food-wp'),
						"id" 		=> "food_wp_in_image",
						"std" 		=> $imgs_url.'instagram-section.png',
						"type" 		=> "upload");


$of_options[] = array( 	"name" 		=> esc_html__( 'Article Page: Display small author box. ', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_random_posts",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('Article Page', 'food-wp') ."</h3>
						<strong>". esc_html__('Article Page', 'food-wp') ."</strong> ". esc_html__(' - Display small author box / social share icons.', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Display social share icons?', 'food-wp' ),
						"desc" 		=> esc_html__( 'Display social share icons?', 'food-wp' ),
						"id" 		=> "food_wp_display_social_share",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);

$of_options[] = array( 	"name" 		=> esc_html__( 'Display small author box?', 'food-wp' ),
						"desc" 		=> esc_html__( 'Display small author box?', 'food-wp' ),
						"id" 		=> "food_wp_display_author_box",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);


$of_options[] = array( 	"name" 		=> esc_html__( 'Display big first capital letter from article page?', 'food-wp' ),
						"desc" 		=> esc_html__( 'Display big first capital letter from article page?', 'food-wp' ),
						"id" 		=> "food_wp_display_bigletter",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);


$of_options[] = array( 	"name" 		=> esc_html__( 'Advertisements and Related Articles', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_siglepage",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('Advertisements and Related Articles', 'food-wp') ."</h3>
						<strong>". esc_html__('Advertisements and Related Articles', 'food-wp') ."</strong> ". esc_html__('- for article pages after the content.', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");


$of_options[] = array( 	"name" 		=> esc_html__( 'Display Advertisements and Related Articles?', 'food-wp' ),
						"desc" 		=> esc_html__( 'Display Advertisements and Related Articles?', 'food-wp' ),
						"id" 		=> "food_wp_display_add_relatedarticles",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);

$of_options[] = array( 	"name" 		=> esc_html__( '300x250 Advertisements.', 'food-wp' ),
						"desc" 		=> esc_html__( 'Paste your HTML or JavaScript code here. Advertisements displayed to the left in Related Articles section.', 'food-wp' ),
						"id" 		=> "food_wp_related_add300",
						"std" 		=> "
<a href=\"#\"><img src=\"http://placehold.it/300x250\" width=\"300\" height=\"250\" alt=\"img\" /></a>

<a href=\"#\"><img src=\"http://placehold.it/300x250\" width=\"300\" height=\"250\" alt=\"img\" /></a>",
						"type" 		=> "textarea");	


/*-----------------------------------------------------------------------------------*/
/* Style Settings */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> esc_html__( 'Style Settings', 'food-wp' ),
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-paint.png");


$of_options[] = array( 	"name" 		=> esc_html__( 'Style', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_14",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".esc_html__( 'Style Settings', 'food-wp' )."</h3>
						". esc_html__( 'Use the color picker to change the main color of the site to match your brand color.', 'food-wp' ) ."",
						"icon" 		=> true,
						"type" 		=> "info");


$of_options[] = array( 	"name" 		=> esc_html__( 'Main Color (orange)', 'food-wp' ),
						"desc" 		=> esc_html__( 'Use the color picker to change the main color of the site to match your brand color.', 'food-wp' ),
						"id" 		=> "food_wp_main_color",
						"std" 		=> "#f47500",
						"type" 		=> "color"
				);


$of_options[] = array( 	"name" 		=> esc_html__( 'Style', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_11",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".esc_html__( 'Style Settings', 'food-wp' )."</h3>
						". esc_html__( 'Use the color picker to change the colors of the site to match your brand color.', 'food-wp' ) ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Header Background Color', 'food-wp' ),
						"desc" 		=> esc_html__( 'Use the color picker to change the color of the site to match your brand color.', 'food-wp' ),
						"id" 		=> "food_wp_header_bg",
						"std" 		=> "#f47500",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> esc_html__( 'Header Top Icons Color', 'food-wp' ),
						"desc" 		=> esc_html__( 'Use the color picker to change the color of the site to match your brand color.', 'food-wp' ),
						"id" 		=> "food_wp_top_icons_color",
						"std" 		=> "#FFFFFF",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> esc_html__( 'Footer Background Color', 'food-wp' ),
						"desc" 		=> esc_html__( 'Use the color picker to change the color of the site to match your brand color.', 'food-wp' ),
						"id" 		=> "food_wp_footer_bg",
						"std" 		=> "#000000",
						"type" 		=> "color"
				);


$of_options[] = array( 	"name" 		=> esc_html__( 'Entry Link Color', 'food-wp' ),
						"desc" 		=> esc_html__( 'Use the color picker to change the entry link color on article or default / full width pages.', 'food-wp' ),
						"id" 		=> "food_wp_entry_linkcolor",
						"std" 		=> "#f47500",
						"type" 		=> "color"
				);


$of_options[] = array( 	"name" 		=> esc_html__( 'Custom CSS.', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_customcss",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom CSS.</h3>
						". esc_html__( 'Enter your custom CSS code. It will be included in the head section of the page.', 'food-wp' ) ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Custom CSS.', 'food-wp' ),
						"desc" 		=> esc_html__( 'Enter your custom CSS code. It will be included in the head section of the page.', 'food-wp' ),
						"id" 		=> "food_wp_custom_css_style",
						"std" 		=> "",
						"type" 		=> "textarea");





/*-----------------------------------------------------------------------------------*/
/* Footer Settings */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> esc_html__( 'Footer Settings', 'food-wp' ),
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-settings.png");


$of_options[] = array( 	"name" 		=> esc_html__( 'Footer AD AREA', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_add",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">". esc_html__('728x90 AD AREA', 'food-wp') ."</h3>
						<strong>". esc_html__('AD AREA', 'food-wp') ."</strong> ". esc_html__('- Paste your HTML or JavaScript code here.', 'food-wp') ."",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> esc_html__( 'Display Footer AD?', 'food-wp' ),
						"desc" 		=> esc_html__( 'Display Footer AD?', 'food-wp' ),
						"id" 		=> "food_wp_display_add_footer",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);

$of_options[] = array( 	"name" 		=> esc_html__( '728x90 AD AREA.', 'food-wp' ),
						"desc" 		=> esc_html__( 'Paste your HTML or JavaScript code here. AD Area displayed in the footer.', 'food-wp' ),
						"id" 		=> "food_wp_add728",
						"std" 		=> "<a href=\"#\"><img src=\"http://placehold.it/728x90\" width=\"728\" height=\"90\" alt=\"img\" /></a>",
						"type" 		=> "textarea");	


$of_options[] = array( 	"name" 		=> esc_html__( 'Copyright', 'food-wp' ),
						"desc" 		=> "",
						"id" 		=> "introduction_copy",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Copyright.</h3>
						<strong>Copyright</strong> - Footer Copyright.",
						"icon" 		=> true,
						"type" 		=> "info");


$of_options[] = array( 	"name" 		=> esc_html__( 'Copyright', 'food-wp' ),
						"desc" 		=> "You can use HTML code.",
						"id" 		=> "food_wp_copyright",
						"std" 		=> "Food is home to 5,000+ of the web\'s best branded recipes!<br> Copyright &copy; 2021 - Theme by <a href=\"https://anthemes.com\">Anthemes.com</a>",
						"type" 		=> "textarea");	
 

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
