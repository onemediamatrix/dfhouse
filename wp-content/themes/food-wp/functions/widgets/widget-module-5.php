<?php
// ------------------------------------------------------
// ------ Module 5: Random Posts  -------------
// ------ by AnThemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class food_wp_module5 extends WP_Widget {
     function __construct() {
	    $widget_ops = array('description' => esc_html__('Module 5: Random Posts', 'food-wp'));
        parent::__construct(false, $name = ''. esc_html__('== Module 5 == Random Posts', 'food-wp') .'',$widget_ops); 
    }

   function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
    $orangetitle = $instance['orangetitle'];
    $blacktitle = $instance['blacktitle'];
?>		
 
<?php echo $before_widget; ?>	
<?php if ( $title ) echo $before_title . esc_attr( $title ) . $after_title; ?>

    <!-- Articles Modules -->
    <h3 class="title-module"><?php echo esc_attr( $orangetitle ); ?> <span><?php echo esc_attr( $blacktitle ); ?></span></h3>
    <ul class="articles-modules">
          <?php $food_wpwidget_randomposts = new WP_Query(array('orderby' => 'rand', 'ignore_sticky_posts' => 1, 'posts_per_page' => esc_attr(5) )); ?>
          <?php while ($food_wpwidget_randomposts->have_posts()) : $food_wpwidget_randomposts->the_post(); ?> 
 
        <li>
          <?php if ( has_post_thumbnail()) { ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('food_wp_thumbnail-blog-grid', array('title' => "")); ?></a>
          <?php } else { ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="<?php esc_html_e( 'article image', 'food-wp' ); ?>" /></a>
          <?php } ?>

          <div class="title-section">
                    <div class="article-wrap">
                        <div class="article-category"><i class="fa fa-cutlery" aria-hidden="true"></i> <?php $food_wp_category = get_the_category(); if ($food_wp_category) 
                            { echo wp_kses_post('<a href="' . get_category_link( $food_wp_category[0]->term_id ) . '">' . $food_wp_category[0]->name.'</a> ');}  ?>
                        </div><!-- end .article-category -->
                    </div><!-- end .article-wrap -->    
            <a href="<?php the_permalink(); ?>"><h3><?php food_wp_the_title( 45, ' ..'); ?></h3></a>
          </div><!-- end .title-section -->
        </li>

        <?php endwhile; 
        /* Restore original Post Data */
        wp_reset_postdata(); ?>
    </ul><!-- end #top-articles-slider -->
    <div class="clear"></div>
 

  <?php echo $after_widget; ?>
  
<?php
    }

    function update($new_instance, $old_instance) {       
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['orangetitle'] = strip_tags($new_instance['orangetitle']);
    $instance['blacktitle'] = strip_tags($new_instance['blacktitle']);
     return $instance;
    }

  function form( $instance ) {
    $defaults  = array( 'title' => '', 'orangetitle' => '', 'blacktitle' => '');
    $instance  = wp_parse_args( ( array ) $instance, $defaults );
    $title     = $instance['title'];
    $orangetitle     = $instance['orangetitle'];
    $blacktitle     = $instance['blacktitle'];
?>

        <p>
          <label for="<?php echo $this->get_field_id('orangetitle'); ?>"><?php esc_html_e( '1st Title:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('orangetitle'); ?>" name="<?php echo $this->get_field_name('orangetitle'); ?>" type="text" value="<?php if( isset($instance['orangetitle']) ) echo esc_attr($instance['orangetitle']); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('blacktitle'); ?>"><?php esc_html_e( '2nd Title:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('blacktitle'); ?>" name="<?php echo $this->get_field_name('blacktitle'); ?>" type="text" value="<?php if( isset($instance['blacktitle']) ) echo esc_attr($instance['blacktitle']); ?>" />
        </p>


<?php  } }

// register widget
function food_wp_module5_init_widget () {
    return register_widget('food_wp_module5');
  }
add_action ('widgets_init', 'food_wp_module5_init_widget');
?>