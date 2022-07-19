<?php
// ------------------------------------------------------
// ------ Module 1: Articles by Categories  -------------
// ------ by AnThemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class food_wp_module1 extends WP_Widget {
     function __construct() {
	    $widget_ops = array('description' => esc_html__('Module 1: Articles by Categories', 'food-wp'));
        parent::__construct(false, $name = ''. esc_html__('== Module 1 == Articles by Categories', 'food-wp') .'',$widget_ops); 
    }

   function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
    $orangetitle = $instance['orangetitle'];
    $blacktitle = $instance['blacktitle'];
		$category = $instance['category'];

    // Get the ID of a given category
    $category_id = $category;

    // Get the URL of this category
    $category_link = get_category_link( $category_id );    
?>		
 
<?php echo $before_widget; ?>	
<?php if ( $title ) echo $before_title . esc_attr( $title ) . $after_title; ?>

    <!-- Articles Modules -->
    <h3 class="title-module"><?php echo esc_attr( $orangetitle ); ?> <span><?php echo esc_attr( $blacktitle ); ?></span><span class="sright"><a href="<?php echo esc_url( $category_link ); ?>"><?php esc_html_e( 'more ..', 'food-wp' ); ?></a></span></h3>
    <ul class="articles-modules">
        <?php $food_wp_module_categories = new WP_Query(array('post_type' => 'post',  'ignore_sticky_posts' => 1, 'cat' => esc_attr($category), 'posts_per_page' => esc_attr(5) )); // number to display more / less ?>
        <?php while ($food_wp_module_categories->have_posts()) : $food_wp_module_categories->the_post(); ?> 
 
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
    $instance['category']  = wp_strip_all_tags( $new_instance['category'] );
     return $instance;
    }

  function form( $instance ) {
    $defaults  = array( 'title' => '', 'orangetitle' => '', 'blacktitle' => '', 'category' => '');
    $instance  = wp_parse_args( ( array ) $instance, $defaults );
    $title     = $instance['title'];
    $orangetitle     = $instance['orangetitle'];
    $blacktitle     = $instance['blacktitle'];
    $category  = $instance['category'];
?>

        <p>
          <label for="<?php echo $this->get_field_id('orangetitle'); ?>"><?php esc_html_e( '1st Title:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('orangetitle'); ?>" name="<?php echo $this->get_field_name('orangetitle'); ?>" type="text" value="<?php if( isset($instance['orangetitle']) ) echo esc_attr($instance['orangetitle']); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('blacktitle'); ?>"><?php esc_html_e( '2nd Title:', 'food-wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('blacktitle'); ?>" name="<?php echo $this->get_field_name('blacktitle'); ?>" type="text" value="<?php if( isset($instance['blacktitle']) ) echo esc_attr($instance['blacktitle']); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Category:', 'food-wp' ); ?></label>      
            <?php
            wp_dropdown_categories( array(

              'show_count' => 1,
              'orderby'    => 'title',
              'hide_empty' => false,
              'name'       => $this->get_field_name( 'category' ),
              'id'         => 'rpjc_widget_cat_recent_posts_category',
              'class'      => 'widefat',
              'selected'   => $category

            ) );
            ?>
        </p> 

<?php  } }

// register widget
function food_wp_module1_init_widget () {
    return register_widget('food_wp_module1');
  }
add_action ('widgets_init', 'food_wp_module1_init_widget');
?>