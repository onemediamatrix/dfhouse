<?php
// ------------------------------------------------------
// ------ Most used Tags  -------------------------------
// ------ by AnThemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class food_wp_toptags extends WP_Widget {
     function __construct() {
      $widget_ops = array('description' => esc_html__('Display your most used Tags.', 'food-wp'));
      parent::__construct(false, $name = ''. esc_html__('Custom: Most used Tags', 'food-wp') .'',$widget_ops); 
    }

   function widget($args, $instance) {  
		extract( $args );
		$title_tw = $instance['title_tw'];
		$number = $instance['number'];
?>		
 
<?php echo $before_widget; ?>	
<?php if ( $title_tw ) echo $before_title . esc_attr($title_tw) . $after_title; ?>

  <div class="tagcloud">
   <?php wp_tag_cloud('number='.esc_attr($number).''); ?>
   <div class="clear"></div>
  </div>

  <?php echo $after_widget; ?>
  
<?php
    }

     function update($new_instance, $old_instance) {				
			$instance = $old_instance;
			$instance['title_tw'] = strip_tags($new_instance['title_tw']);
			$instance['number'] = strip_tags($new_instance['number']);
     return $instance;
    }

 	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance );
?>


         <p>
          <label for="<?php echo $this->get_field_id('title_tw'); ?>"><?php esc_html_e( 'Title:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title_tw'); ?>" name="<?php echo $this->get_field_name('title_tw'); ?>" type="text" value="<?php if( isset($instance['title_tw']) ) echo $instance['title_tw']; ?>" />
        </p>
      

         <p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of Posts:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php if( isset($instance['number']) ) echo $instance['number']; ?>" />
        </p>

<?php  } }

// register widget
function food_wp_toptags_init_widget () {
    return register_widget('food_wp_toptags');
  }
add_action ('widgets_init', 'food_wp_toptags_init_widget');
?>