<?php get_header(); // add header ?>  
<?php
    // Display related articles / AD (Yes/No)
    $food_wp_display_add_relatedarticles = get_theme_mod('food_wp_display_add_relatedarticles');
    if (empty($food_wp_display_add_relatedarticles)) { $food_wp_display_add_relatedarticles = 'No'; }
    $food_wp_related_add300 = get_theme_mod('food_wp_related_add300');    

    // Display author box (Yes/No)
    $food_wp_display_author_box = get_theme_mod('food_wp_display_author_box');
    if (empty($food_wp_display_author_box)) { $food_wp_display_author_box = 'No'; }

    // Display Big Letter (Yes/No)
    $food_wp_display_bigletter = get_theme_mod('food_wp_display_bigletter');
    if (empty($food_wp_display_bigletter)) { $food_wp_display_bigletter = 'Yes'; }

    // Display Social Shre (Yes/No)
    $food_wp_display_social_share = get_theme_mod('food_wp_display_social_share');
    if (empty($food_wp_display_social_share)) { $food_wp_display_social_share = 'Yes'; }     
?>

<!-- Begin Content -->
<div class="wrap-fullwidth">

    <div class="single-content">
        <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
        <div class="entry-top">
            <h1 class="article-title entry-title"><?php the_title(); ?></h1>
            <ul class="meta-entry-top">
                <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 22 ); ?></a>
                <li><?php the_author_posts_link(); ?> <?php esc_html_e('on', 'food-wp'); ?> <?php echo get_the_date(); ?></li>
                
                <?php if ($food_wp_display_social_share == 'Yes') { ?>
                <li>
                    <ul class="single-share">
                        <li><?php $food_wp_facebooklink = 'https://www.facebook.com/sharer/sharer.php?u='; ?><a class="fbbutton" target="_blank" href="<?php echo esc_url($food_wp_facebooklink); ?><?php the_permalink(); ?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><i class="fa fa-facebook"></i></a></li>
                        <li><?php $food_wp_twitterlink = 'https://twitter.com/intent/tweet?text=Check%20out%20this%20article:%20'; ?><a class="twbutton" target="_blank" href="<?php echo esc_url($food_wp_twitterlink); ?><?php the_title(); ?>%20-%20<?php the_permalink(); ?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><i class="fa fa-twitter"></i></a></li>
                        <li><?php $food_wp_articleimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?><?php $food_wp_pinlink = 'https://pinterest.com/pin/create/button/?url='; ?><a class="pinbutton" target="_blank" href="<?php echo esc_url($food_wp_pinlink); ?><?php the_permalink(); ?>&amp;media=<?php echo esc_html($food_wp_articleimage); ?>&amp;description=<?php the_title(); ?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><i class="fa fa-pinterest"></i></a></li>
                        <li><a class="wpbutton" target="_blank" href="https://api.whatsapp.com/send?text=<?php the_title(); ?>%20-%20<?php the_permalink(); ?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><i class="fa fa-whatsapp"></i></a></li>
                    </ul><!-- end .single-share -->
                </li>
                <?php } ?>

                <li class="likes"><?php if (function_exists('thumbs_rating_getlink')) { echo thumbs_rating_getlink(); } ?></li>
                <li><?php if (function_exists('thumbs_rating_getlink')) { esc_html_e( 'Likes!', 'food-wp' ); } ?></li>           
            </ul><div class="clear"></div>
        </div><!-- end .entry-top -->
        <?php endwhile; endif; ?>


        <article>
            <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
            <div <?php post_class('post') ?> id="post-<?php the_ID(); ?>">

            <div class="media-single-content">
            <?php if ( function_exists( 'rwmb_meta' ) ) {  
            // If Meta Box plugin is activate ?>
                <?php
                $food_wp_youtube_id = rwmb_meta('food_wp_youtube', true );
                $food_wp_vimeo_id = rwmb_meta('food_wp_vimeo', true );
                $food_wp_gallery_img = rwmb_meta('food_wp_slider', true );
                $food_wp_hideimg_id = rwmb_meta('food_wp_hideimg', true );
                ?> 

                <?php if(!empty($food_wp_youtube_id)) { ?>
                    <!-- #### Youtube video #### -->
                    <iframe class="single_iframe" width="950" height="500" src="//www.youtube.com/embed/<?php echo esc_html($food_wp_youtube_id); ?>?wmode=transparent" frameborder="0" allowfullscreen></iframe>
                <?php } ?>

                <?php if(!empty($food_wp_vimeo_id)) { ?>
                    <!-- #### Vimeo video #### -->
                    <iframe class="single_iframe" src="//player.vimeo.com/video/<?php echo esc_html($food_wp_vimeo_id); ?>?portrait=0" width="950" height="500" frameborder="0" allowFullScreen></iframe>
                <?php } ?>

                <?php if(!empty($food_wp_youtube_id) || !empty($food_wp_vimeo_id)) { ?>
                <?php } elseif ( has_post_thumbnail()) { ?>
                    <?php if(!empty($food_wp_hideimg_id)) { } else { ?>
                     <?php the_post_thumbnail('food_wp_thumbnail-single-image'); ?>
                    <?php } // disable featured image ?>
                <?php } ?>

                <?php if(!empty($food_wp_gallery_img)) { ?>
                    <!-- #### Single Gallery #### -->
                    <div class="single-gallery">
                        <?php
                        $images = rwmb_meta( 'food_wp_slider', 'type=image&size=food_wp_thumbnail-widget-small' );
                        foreach($images as $key =>$food_wp_gallery_img)
                         { echo "<a href='{$food_wp_gallery_img['full_url']}' data-fslightbox='gallery1'><img src='{$food_wp_gallery_img['url']}'  alt='{$food_wp_gallery_img['alt']}' width='{$food_wp_gallery_img['width']}' height='{$food_wp_gallery_img['height']}' /></a>";
                        } ?>
                    </div><!-- end .single-gallery --> 
                <?php } ?>

            <?php } else { 
            // Meta Box Plugin ?>
                <?php the_post_thumbnail('food_wp_thumbnail-single-image'); ?>
            <?php } ?> 

            </div><!-- end .media-single-content -->

                    <div class="entry">
                        <!-- entry content -->
                        <?php if ($food_wp_display_author_box == 'Yes') { ?>
                        <div class="author-right-meta">
                            <div class="aut-img">
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?></a>
                            </div>
                            <ul class="aut-meta">
                                <li class="name"><div class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></div></li>
                                <li class="time updated"><?php echo get_the_date(); ?></li>
                            </ul><div class="clear"></div>   
                        </div><!-- end .author-right-media -->
                        <?php } ?>
                        
                        <div <?php if ($food_wp_display_bigletter == 'Yes') { ?> class="p-first-letter" <?php } ?>>
                            <!-- excerpt -->
                            <?php if ( !empty( $post->post_excerpt ) ) { ?> 
                                <?php echo the_excerpt(); ?>
                            <?php } ?>                             
                            <?php the_content(''); // content ?>
                        </div><!-- end .p-first-letter -->
                        <?php wp_link_pages(); // content pagination ?>
                        <div class="clear"></div>

                        <div class="tags-cats">
                            <!-- tags -->
                            <?php $food_wp_single_tags = get_the_tags(); 
                            if ($food_wp_single_tags): ?>
                                <div class="ct-size"><div class="entry-btn"><?php esc_html_e( 'Article Tags:', 'food-wp' ); ?></div> <?php the_tags('',' &middot; '); // tags ?></div><div class="clear"></div>
                            <?php endif; ?>

                            <!-- categories -->
                            <?php $food_wp_single_categories = get_the_category(); 
                            if ($food_wp_single_categories): ?>
                                <div class="ct-size"><div class="entry-btn"><?php esc_html_e( 'Article Categories:', 'food-wp' ); ?></div> <?php the_category(' &middot; '); // categories ?></div><div class="clear"></div>
                            <?php endif; ?>
                        </div><!-- end .tags-cats -->

                        <div class="clear"></div>                        
                    </div><!-- end .entry -->
                    <div class="clear"></div> 
            </div><!-- end #post -->
            <?php endwhile; endif; ?>
        </article><!-- end article -->


        <?php if ($food_wp_display_add_relatedarticles == 'Yes') { ?>
        <!-- Related Articles -->
        <div class="single-related">
        <div class="single-related-wrap">
            <div class="one_half_sr">
                <?php echo stripslashes($food_wp_related_add300); ?>
            </div>

            <div class="one_half_last_sr">
                <h3><?php esc_html_e( 'Related Articles', 'food-wp' ); ?></h3>
                <ul class="article_list">
                <?php $food_wp_related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'ignore_sticky_posts' => 1, 'numberposts' => esc_attr(4), 'post__not_in' => array($post->ID) ) );
                $num=1; if( $food_wp_related ) foreach( $food_wp_related as $post ) { setup_postdata($post); ?>  
                  <li>
                      <?php if ( has_post_thumbnail()) { ?><div class="post-nr"><?php echo esc_html($num++); ?></div><?php } ?>                    
                      <a href="<?php the_permalink(); ?>"> <?php echo the_post_thumbnail('food_wp_thumbnail-widget-small'); ?></a>
                      <div class="an-widget-title" <?php if ( has_post_thumbnail()) { ?> style="margin-left:105px;" <?php } ?>>
                        <h4 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>                
                        <div class="widget-likes"><?php if (function_exists('thumbs_rating_getlink')) { echo thumbs_rating_getlink(); } ?></div>
                        <div class="sleft"><?php if (function_exists('thumbs_rating_getlink')) { esc_html_e( 'Likes!', 'food-wp' ); } ?></div>
                      </div>
                  </li>
                  <?php } wp_reset_postdata(); ?>
                </ul>
            </div><div class="clear"></div>
        </div><!-- end .single-related-wrap -->
        </div><!-- end .single.related -->
        <?php } ?>

 
        <!-- Comments -->
        <div class="entry-bottom">
            <?php if (get_comments_number()==0) { } else { ?>
                <h3 class="title"> <?php esc_html_e( 'Comments', 'food-wp' ); ?></h3>
            <?php } ?>            
            
            <!-- Comments -->
            <div id="comments" class="comments">
                <?php comments_template('', true); // comments ?>
            </div>
            <div class="clear"></div>
        </div><!-- end .entry-bottom -->

    </div><!-- end .single-content -->


    <!-- Begin Sidebar (right) -->
    <?php  get_sidebar(); // add sidebar ?>
    <!-- end #sidebar  (right) -->    


    <div class="clear"></div>
</div><!-- end .wrap-fullwidth  -->
<?php get_footer(); // add footer  ?>