<?php 
/* 
Template Name: Template - Home
*/ 
?>
<?php get_header(); // add header  ?>


<!-- Begin Wrap Content -->
<div class="wrap-fullwidth">

        <?php if (have_posts()) : while (have_posts()) : the_post(); 
            $thecontent = get_the_content();
            if(!empty($thecontent)) { ?>        
                <div class="home-content">
                    <div class="entry"><?php the_content(''); // content ?></div>
                </div>
            <?php } ?>
        <?php endwhile; endif; ?>
        
    <!-- Home Modules (Widgets) -->
    <?php if ( is_active_sidebar( 'homemodules_food_wp' ) ) { ?>
        <?php dynamic_sidebar( 'homemodules_food_wp' ); ?>
    <?php } ?> 
    <!-- End. Home Modules --> 

    <!-- Begin Main Home Content -->
    <div class="wrap-content">
        <h3 class="title-module"><?php esc_html_e( 'Don\'t Miss!', 'food-wp' ); ?> <span><?php esc_html_e( 'latest posts ..', 'food-wp' ); ?></span> <span class="sright"><?php echo wp_count_posts()->publish; ?> <?php esc_html_e( 'posts ..', 'food-wp' ); ?></span></h3>
        <ul id="infinite-articles" class="masonry_list js-masonry">

        <?php
            if ( get_query_var('paged') )  {  $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1;  }
            // The Query
            query_posts( array( 'post_type' => 'post', 'paged' => $paged ) );
            if (have_posts()) : while (have_posts()) : the_post();
        ?>

            <li <?php post_class('ex34') ?> id="post-<?php the_ID(); ?>">

                <?php if ( has_post_thumbnail()) { ?>        
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('food_wp_thumbnail-blog-grid', array('title' => "")); ?></a>
                    <div class="article-wrap">
                        <div class="article-category"><i class="fa fa-cutlery" aria-hidden="true"></i> <?php $food_wp_category = get_the_category(); if ($food_wp_category) 
                            { echo wp_kses_post('<a href="' . get_category_link( $food_wp_category[0]->term_id ) . '">' . $food_wp_category[0]->name.'</a> ');}  ?>
                        </div><!-- end .article-category -->
                    </div><!-- end .article-wrap -->
                <?php } else { ?> 
                    <div class="article-wrap mtop">
                        <div class="article-category"><i class="fa fa-cutlery" aria-hidden="true"></i> <?php $food_wp_category = get_the_category(); if ($food_wp_category) 
                            { echo wp_kses_post('<a href="' . get_category_link( $food_wp_category[0]->term_id ) . '">' . $food_wp_category[0]->name.'</a> ');}  ?>
                        </div><!-- end .article-category -->
                    </div><!-- end .article-wrap -->    
                <?php } // Post Thumbnail ?> 
                <div class="clear"></div>

                <div class="content-masonry">
                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                    <ul class="meta-content">
                        <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 18 ); ?></a></li>
                        <li class="aut-name"><?php $food_wp_fname = get_the_author_meta('first_name'); if( empty($food_wp_fname)){ echo the_author_posts_link(); } else { echo the_author_meta('first_name'); echo ('&nbsp;'); echo substr(get_the_author_meta('last_name'),0,1).'.';} ?></li>
                        <li class="art-likes-text"><?php if (function_exists('thumbs_rating_getlink')) { esc_html_e( 'Likes!', 'food-wp' ); } ?></li>
                        <li class="art-likes"><?php if (function_exists('thumbs_rating_getlink')) { echo thumbs_rating_getlink(); } ?></li>
                    </ul><!-- end .meta-content -->
                </div><!-- end .content-masonry -->
            </li>
        <?php endwhile; ?>
        </ul>  


         <!-- Pagination -->
        <?php if(function_exists('wp_pagenavi')) { ?>
            <?php wp_pagenavi(); ?>
            <?php } else { ?>
            <div class="defaultpag">
                    <div class="sright"><?php next_posts_link('' . esc_html__('Older Entries', 'food-wp') . ' &rsaquo;'); ?></div>
                    <div class="sleft"><?php previous_posts_link('&lsaquo; ' . esc_html__('Newer Entries', 'food-wp') . ''); ?></div>
            </div>
        <?php } // Default Pagination ?>
        <!-- pagination -->

        <?php endif; ?>
    </div><!-- end .home-content -->



    <!-- Begin Sidebar (default right) -->
    <?php get_sidebar(); // add sidebar ?>
    <!-- end #sidebar (default right) --> 

        
<div class="clear"></div>
</div><!-- end .wrap-fullwidth -->

<?php get_footer(); // add footer  ?>