<div class="sidebar-wrapper">
<aside class="sidebar">
<?php if ( is_page() ) { ?>
	<?php if ( is_active_sidebar( 'sidebar_page_food_wp' ) ) { ?>
	    <?php dynamic_sidebar( 'sidebar_page_food_wp' ); ?>
	<?php } ?> 

<?php } else { ?>
	<?php if ( is_active_sidebar( 'sidebar_main_food_wp' ) ) { ?>
	    <?php dynamic_sidebar( 'sidebar_main_food_wp' ); ?>
	<?php } ?> 
<?php } ?>
</aside>
</div>