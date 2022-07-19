<?php
    // Display random posts (Yes/No)
    $food_wp_display_random_posts = get_theme_mod('food_wp_display_random_posts');
    if (empty($food_wp_display_random_posts)) { $food_wp_display_random_posts = 'No'; }

    // Facebook / Instagram sections (Yes/No)
    $food_wp_display_social_sections = get_theme_mod('food_wp_display_social_sections');
    if (empty($food_wp_display_social_sections)) { $food_wp_display_social_sections = 'No'; }

    // Facebook Section Text
    $food_wp_facebook_text = get_theme_mod('food_wp_facebook_text'); 

    // Instagram Section Text
    $food_wp_instagram_text = get_theme_mod('food_wp_instagram_text'); 

    // Facebook / Instagram image
    $food_wp_fb_image = get_theme_mod('food_wp_fb_image'); 
    $food_wp_in_image = get_theme_mod('food_wp_in_image');  

    // Copyright Section
    $food_wp_copyright = get_theme_mod('food_wp_copyright');

    // Ad Area
    $food_wp_display_add_footer = get_theme_mod('food_wp_display_add_footer');
    if (empty($food_wp_display_add_footer)) { $food_wp_display_add_footer = 'No'; }    
    $food_wp_add728 = get_theme_mod('food_wp_add728');       
?>

<?php if ($food_wp_display_random_posts == 'Yes') { ?>
	<div id="random-wrap-section">
		<h3 class="title-section"><?php esc_html_e( 'Don\'t Miss!', 'food-wp' ); ?> <span><?php esc_html_e( 'random posts ..', 'food-wp' ); ?></span></h3>
	 	<ul id="random-section">
	        <?php $food_wp_randomposts = new WP_Query(array('orderby' => 'rand', 'ignore_sticky_posts' => 1, 'posts_per_page' => esc_attr(4) )); ?>
	        <?php while ($food_wp_randomposts->have_posts()) : $food_wp_randomposts->the_post(); ?> 

		    <li class="item">
		        <?php if ( has_post_thumbnail()) { ?>        
		            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('food_wp_thumbnail-blog-random', array('title' => "")); ?></a>
		        <?php } else { ?>
		        	<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/random-img.png" alt="article image" /></a>
		        <?php } ?>
		            <div class="article-wrap">
		                <div class="article-category"><i class="fa fa-cutlery" aria-hidden="true"></i> <?php $category = get_the_category(); if ($category) 
		                    { echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a> ';}  ?>
		                </div><!-- end .article-category -->
		            </div><!-- end .article-wrap -->
		        <div class="clear"></div>
		         <div class="content">
		            <a href="<?php the_permalink(); ?>"><h3><?php food_wp_the_title( 50, ' ..'); ?></h3></a>
		            <ul class="meta-content">
		                <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 18 ); ?></a></li>
		                <li class="aut-name"><?php $food_wp_fname = get_the_author_meta('first_name'); if( empty($food_wp_fname)){ echo the_author_posts_link(); } else { echo the_author_meta('first_name'); echo ('&nbsp;'); echo substr(get_the_author_meta('last_name'),0,1).'.';} ?></li>
                        <li class="art-likes-text"><?php if (function_exists('thumbs_rating_getlink')) { esc_html_e( 'Likes!', 'food-wp' ); } ?></li>
                        <li class="art-likes"><?php if (function_exists('thumbs_rating_getlink')) { echo thumbs_rating_getlink(); } ?></li>
		            </ul><!-- end .meta-content -->
		         </div><!-- end .content -->
		    </li><!-- end .item -->

			<?php endwhile; 
			/* Restore original Post Data */
			wp_reset_postdata(); ?>
		</ul><div class="clear"></div>
	</div>
<?php } ?>

<?php if ($food_wp_display_social_sections == 'Yes') { ?>
	<div id="follow-section">
		<div class="wrap-center">
			<div class="follow-left">
				<div class="one_half">
					<div class="follow-content">
						<?php if (!empty($food_wp_facebook_text)) { ?><?php echo wp_kses_post(stripslashes($food_wp_facebook_text)); ?><?php } ?>
					</div><!-- end .follow-content -->
				</div>

				<div class="one_half_last">
					<img src="<?php echo esc_url($food_wp_fb_image); ?>" alt="<?php esc_attr(bloginfo('sitename')); ?>" />
				</div><div class="clear"></div>			
			</div><!-- end .follow-left -->

			<div class="follow-right">
				<div class="one_half">
					<div class="follow-content">
						<?php if (!empty($food_wp_instagram_text)) { ?><?php echo wp_kses_post(stripslashes($food_wp_instagram_text)); ?><?php } ?>
					</div><!-- end .follow-content -->
				</div>

				<div class="one_half_last">
					<img src="<?php echo esc_url($food_wp_in_image); ?>" alt="<?php esc_attr(bloginfo('sitename')); ?>" />
				</div><div class="clear"></div>	
			</div><!-- end .follow-right -->
			<div class="clear"></div>
		</div><!-- end .wrap-center -->
	</div><!-- end .follow-section -->
<?php } ?>


<!-- Begin Footer -->
<footer> 
	<div class="wrap-center">
        <?php if ($food_wp_display_add_footer == 'Yes') { ?>
        <?php if (!empty($food_wp_add728)) { ?>
            <div class="footer-img">
                <?php echo stripslashes($food_wp_add728); ?>
            </div>
        <?php } } ?>

        <div class="one_fourth">
            <?php if ( is_active_sidebar( 'footer1_food_wp' ) ) { ?> <?php dynamic_sidebar( 'footer1_food_wp' ); ?> <?php } ?> 
        </div>
        <div class="one_fourth">
            <?php if ( is_active_sidebar( 'footer2_food_wp' ) ) { ?> <?php dynamic_sidebar( 'footer2_food_wp' ); ?> <?php } ?> 
        </div>
        <div class="one_fourth">
            <?php if ( is_active_sidebar( 'footer3_food_wp' ) ) { ?> <?php dynamic_sidebar( 'footer3_food_wp' ); ?> <?php } ?> 
        </div>
        <div class="one_fourth_last">
            <?php if ( is_active_sidebar( 'footer4_food_wp' ) ) { ?> <?php dynamic_sidebar( 'footer4_food_wp' ); ?> <?php } ?> 
        </div><div class="clear"></div>

        <div class="copyright">
          <?php if (!empty($food_wp_copyright)) { ?>
          	<?php echo wp_kses_post(stripslashes($food_wp_copyright)); ?>
          <?php } ?>  
        </div>      
    </div><!-- end .wrap-center -->

	<p id="back-top"><a href="#top">
      <span><i class="fa fa-chevron-up"></i></span></a>
    </p><!-- end #back-top -->
</footer><!-- end #footer -->

<!-- Footer Theme output -->
<?php wp_footer();?>
</body>
</html>