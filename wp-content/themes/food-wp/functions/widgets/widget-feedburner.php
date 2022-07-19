<?php
// ------------------------------------------------------
// ------ Subscribe widget  -----------------------------
// ------ Feedburner subscribe --------------------------
// ------ by AnThemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class food_wp_subscribe extends WP_Widget {
     function __construct() {
	    $widget_ops = array('description' => esc_html__('Feedburner subscribe widget.', 'food-wp'));
        parent::__construct(false, $name = ''. esc_html__('Custom: Feedburner Subscribe', 'food-wp') .'',$widget_ops); 
    }

   function widget($args, $instance) {  
		extract( $args );
    $title = $instance['title'];
    $feedid = $instance['feedid'];
    $text = $instance['text'];
?>		
 
<?php echo $before_widget; ?>
<?php if ( $title ) echo $before_title . esc_attr($title) . $after_title; ?>
    
    <div class="feed-info"><?php echo stripslashes_deep($text); ?></div>

    <form action="//feedburner.google.com/fb/a/mailverify" method="get" target="popupwindow" onsubmit="window.open('<?php echo esc_attr($feedid); ?>', 'popupwindow', 'scrollbars=yes,width=600,height=560');return true" id="newsletter-form">
      <input name="email" class="newsletter" placeholder="<?php esc_html_e('Enter your e-mail address', 'food-wp'); ?>" type="text">
      <input type="hidden" value="<?php echo esc_attr($feedid); ?>" name="uri"/>
      <input class="newsletter-btn" value="<?php esc_html_e('Subscribe', 'food-wp'); ?>" type="submit">
    </form>


  <?php echo $after_widget; ?>
  
<?php
    }

     function update($new_instance, $old_instance) {				
			$instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
			$instance['feedid'] = strip_tags($new_instance['feedid']);
      $instance['text'] = stripslashes($new_instance['text']);
     return $instance;
    }

 	function form( $instance ) {

  // Set up some default widget settings
  $defaults = array(
    'title' => 'Feedburner',
    'text' => stripslashes('Food is home to 5,000+ of the web\'s <strong>best branded recipes</strong>! We cover everything.
<i class="fa fa-cutlery" aria-hidden="true"></i>'),
  );

  $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Widget Title:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('feedid'); ?>"><?php esc_html_e( 'Feedburner ID:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('feedid'); ?>" name="<?php echo $this->get_field_name('feedid'); ?>" type="text" value="<?php if( isset($instance['feedid']) ) echo $instance['feedid']; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('text'); ?>"><?php esc_html_e( 'Description:', 'food-wp' ); ?></label>      
          <textarea style="height:100px;" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" ><?php if( isset($instance['text']) ) echo stripslashes($instance['text']); ?></textarea>
        </p> 

<?php  } }

// register widget
function food_wp_subscribe_init_widget () {
    return register_widget('food_wp_subscribe');
  }
add_action ('widgets_init', 'food_wp_subscribe_init_widget');
?>