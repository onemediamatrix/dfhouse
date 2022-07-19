<?php
// ------------------------------------------------------
// ------ Popular Posts by comments  --------------------
// ------ by anthemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class food_wp_topposts extends WP_Widget {
     function __construct() {
      $widget_ops = array('description' => esc_html__('Popular Posts - Display your Popular / Top Posts by comments.', 'food-wp'));
      parent::__construct(false, $name = ''. esc_html__('Custom: Top Posts', 'food-wp') .'',$widget_ops); 
    }


    function widget($args, $instance) {   
        extract( $args );
        $number = $instance['number'];
        $title = $instance['title'];
        ?>



<?php echo $before_widget; ?>
<?php if ( $title ) echo $before_title . esc_attr($title) . $after_title; ?>

<ul class="article_list">
<?php $food_wp_antop = new WP_Query(array('orderby' => 'comment_count', 'ignore_sticky_posts' => 1, 'posts_per_page' => esc_attr($number) )); // number to display more / less ?>
<?php $num=1; while ($food_wp_antop->have_posts()) : $food_wp_antop->the_post(); ?> 


  <li>
      <?php if ( has_post_thumbnail()) { ?>
      <div class="post-nr"><?php echo esc_html($num++); ?></div>
      <?php } ?>
      <a href="<?php the_permalink(); ?>"> <?php echo the_post_thumbnail('food_wp_thumbnail-widget-small'); ?></a>
      <div class="an-widget-title" <?php if ( has_post_thumbnail()) { ?> style="margin-left:105px;" <?php } ?>>
        <h4 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>                
        <div class="widget-likes"><?php if (function_exists('thumbs_rating_getlink')) { echo thumbs_rating_getlink(); } ?></div>
        <div class="sleft"><?php if (function_exists('thumbs_rating_getlink')) { esc_html_e( 'Likes!', 'food-wp' ); } ?></div>
      </div>
  </li>

<?php endwhile; 
/* Restore original Post Data */
wp_reset_postdata(); ?>
</ul><div class="clear"></div>


<?php echo $after_widget; ?> 


<?php
    }
    function update($new_instance, $old_instance) {       
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = strip_tags($new_instance['number']);
    return $instance;
    }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance );
?>


        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
        </p>

         <p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of Posts:', 'food-wp' ); ?></label>      
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php if( isset($instance['number']) ) echo $instance['number']; ?>" />
         </p> 

<?php  } }

// register widget
function food_wp_topposts_init_widget () {
    return register_widget('food_wp_topposts');
  }
add_action ('widgets_init', 'food_wp_topposts_init_widget');
?>