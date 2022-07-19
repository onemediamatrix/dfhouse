<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<?php
    // Logo
    $food_wp_logo = get_theme_mod('food_wp_logo');
    if (empty($food_wp_logo)) { $food_wp_logo = get_template_directory_uri().'/images/logo.png'; }

    // Social icons
    $food_wp_top_social_icons = get_theme_mod('food_wp_top_social_icons'); 

    // Featured icons
    $food_wp_top_icons = get_theme_mod('food_wp_top_icons');   

    // Display slider (Yes/No)
    $food_wp_display_slider = get_theme_mod('food_wp_display_slider');
    if (empty($food_wp_display_slider)) { $food_wp_display_slider = 'No'; }       
?>
    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <!-- Mobile Device Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <!-- Theme output -->
    <?php wp_head(); ?> 

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<!-- Begin Header -->
<header> 
        <div class="main-header">
            <!-- Logo -->  
            <a href="<?php echo esc_url(home_url( '/' )); ?>"><img class="logo" src="<?php echo esc_url($food_wp_logo); ?>" alt="<?php esc_attr(bloginfo('sitename')); ?>" /></a>

            <!-- search form get_search_form(); -->
            <?php get_search_form(); ?>

            <ul class="top-list">
                <?php if (!empty($food_wp_top_icons)) { ?><?php echo wp_kses_post(stripslashes($food_wp_top_icons)); ?><?php } ?>
            </ul><!-- end .top-list -->
            <div class="clear"></div>
        </div><!-- end .main-header -->
        
        <div class="bar-header">
            <div class="wrap-center">
                <!-- Navigation Menu -->
                <?php if ( has_nav_menu( 'food_wp_primary-menu' ) ) : // Check if there's a menu assigned to the 'Header Navigation' location. ?>
                    <nav id="myjquerymenu" class="jquerycssmenu">
                         <?php wp_nav_menu( array( 'container' => false, 'items_wrap' => '<ul>%3$s</ul>', 'theme_location' =>   'food_wp_primary-menu' ) ); ?>
                    </nav>
                <?php endif; // End check for menu. ?>

                <ul class="top-social">
                    <?php if (!empty($food_wp_top_social_icons)) { ?><?php echo wp_kses_post(stripslashes($food_wp_top_social_icons)); ?><?php } ?>
                </ul>          
            </div><!-- end .wrap-center -->
        </div>
</header><!-- end #header -->

<?php if ($food_wp_display_slider == 'Yes') { ?>
<?php if ( is_front_page() ) { ?>
<!-- Begin Featured Articles -->
<div id="featured-slider-wrap">
    <div id="featured-slider">

    <?php $food_wp_top_likes_slider = new WP_Query( array( 'post_type' => 'post', 'meta_key' => '_thumbs_rating_up', 'ignore_sticky_posts' => esc_attr(1), 'orderby' => 'meta_value_num', 'order' => 'DESC', 'posts_per_page' => esc_attr(12) ) );  ?> 
    <?php while ($food_wp_top_likes_slider->have_posts()) : $food_wp_top_likes_slider->the_post(); ?> 

    <div class="item">
        <?php if ( has_post_thumbnail()) { ?>        
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('food_wp_thumbnail-blog-featured', array('title' => "")); ?></a>
        <?php } else { ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/featured-img.png" alt="article image" /></a>
        <?php } ?>            
            <div class="article-wrap">
                <div class="article-category"><i class="fa fa-cutlery" aria-hidden="true"></i> <?php $food_wp_category = get_the_category(); if ($food_wp_category) 
                    { echo wp_kses_post('<a href="' . get_category_link( $food_wp_category[0]->term_id ) . '">' . $food_wp_category[0]->name.'</a> ');}  ?>
                </div><!-- end .article-category -->
            </div><!-- end .article-wrap -->
        <div class="clear"></div>
         <div class="content">
            <a href="<?php the_permalink(); ?>"><h3><?php food_wp_the_title( 55, ' ..'); ?></h3></a>
            <ul class="meta-content">
                <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 18 ); ?></a></li>
                <li class="aut-name"><?php $food_wp_fname = get_the_author_meta('first_name'); if( empty($food_wp_fname)){ echo the_author_posts_link(); } else { echo the_author_meta('first_name'); echo ('&nbsp;'); echo substr(get_the_author_meta('last_name'),0,1).'.';} ?></li>
                <li class="art-likes-text"><?php if (function_exists('thumbs_rating_getlink')) { esc_html_e( 'Likes!', 'food-wp' ); } ?></li>
                <li class="art-likes"><?php if (function_exists('thumbs_rating_getlink')) { echo thumbs_rating_getlink(); } ?></li>
            </ul><!-- end .meta-content -->
         </div><!-- end .content -->
    </div><!-- end .item -->

    <?php endwhile; 
    /* Restore original Post Data */
    wp_reset_postdata(); ?>

    </div><!-- end #featured-slider -->
</div><!-- end #featured-slider-wrap -->
<?php } } ?>