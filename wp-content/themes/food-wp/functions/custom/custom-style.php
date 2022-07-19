<?php /**
 * Generate the CSS for the current custom color scheme.
 */
function food_wp_custom_colors_css() {

// Main Color (orange)
$food_wp_main_color = get_theme_mod('food_wp_main_color');
if (!empty($food_wp_main_color)) {
    // BG Color
    echo esc_html('#featured-slider .article-category i, ul.masonry_list .article-category i, .wp-pagenavi a:hover, .wp-pagenavi span.current, ul.articles-modules .article-category i, ul.articles-modules .article-category, .single-content h3.title, .entry-btn, .my-paginated-posts span, #newsletter-form input.newsletter-btn, ul.article_list li div.post-nr, .comments h3.comment-reply-title, #commentform #submit, footer .widget h3.title span, #back-top span, #random-section .article-category i, #follow-section i, input.ap-form-submit-button { background-color: '. $food_wp_main_color .' !important;} ');

    // Color
    echo esc_html('a:hover, .top-social li a, .jquerycssmenu ul li.current_page_item a, .jquerycssmenu ul li.current-menu-ancestor a, .jquerycssmenu ul li.current-menu-item a, .jquerycssmenu ul li.current-menu-parent a, .jquerycssmenu ul li ul li.current_page_item a, .jquerycssmenu ul li ul li.current-menu-ancestor a, .jquerycssmenu ul li ul li.current-menu-item a, .jquerycssmenu ul li ul li.current-menu-parent a, .jquerycssmenu ul li i, .jquerycssmenu ul li a:hover, .jquerycssmenu ul li ul li:hover a:hover, h3.title-module, ul.aut-meta li.name a, div.p-first-letter p:first-child:first-letter, div.feed-info i, .widget_anthemes_categories li, div.tagcloud span, .widget_archive li, .widget_meta li, #mcTagMap .tagindex h4, #sc_mcTagMap .tagindex h4, #random-wrap-section h3.title-section, #follow-section h4 { color: '. $food_wp_main_color .' !important;} ');

    // Border bottom 2px
    echo esc_html('.single-related h3, .sidebar h3.title { border-bottom: 2px solid '. $food_wp_main_color .' !important;} ');

    // Border left 5px
    echo esc_html('blockquote { border-left: 5px solid '. $food_wp_main_color .' !important;} ');

    // Border bottom 5px
    echo esc_html('#mcTagMap .tagindex h4, #sc_mcTagMap .tagindex h4 { border-bottom: 5px solid '. $food_wp_main_color .' !important;} ');

    // Border bottom 1px
    echo esc_html('div.feed-info strong, .copyright a { border-bottom: 1px solid '. $food_wp_main_color .' !important;} ');

    // Border color
    echo esc_html('input.ap-form-submit-button { border-color: '. $food_wp_main_color .' !important;} ');    
}
// Header Background Color
$food_wp_header_bg = get_theme_mod('food_wp_header_bg');
if (!empty($food_wp_header_bg)) {
    // Header BG Color
    echo esc_html('header, .sticky { background-color: '. $food_wp_header_bg .' !important;} ');
}
// Header Top Icons Color
$food_wp_top_icons_color = get_theme_mod('food_wp_top_icons_color');
if (!empty($food_wp_top_icons_color)) {
    // Header top icons Color
    echo esc_html('ul.top-list li a { color: '. $food_wp_top_icons_color .' !important;} ');
}
// Footer Background Color
$food_wp_footer_bg = get_theme_mod('food_wp_footer_bg');
if (!empty($food_wp_footer_bg)) {
    // Footer BG Color
    echo esc_html('footer { background-color: '. $food_wp_footer_bg .' !important;} ');
}
// Entry Link Color
$food_wp_entry_linkcolor = get_theme_mod('food_wp_entry_linkcolor');
if (!empty($food_wp_entry_linkcolor)) {
    // Entry Link Color
    echo esc_html('.entry p a { color: '. $food_wp_entry_linkcolor .' !important;} ');
}
 // Custom Style CSS.
$food_wp_custom_css_style = get_theme_mod('food_wp_custom_css_style');
if (!empty($food_wp_custom_css_style)) { 
    echo stripslashes($food_wp_custom_css_style); 
}

} ?>