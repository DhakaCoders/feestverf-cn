<?php 

function deploy_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar Widget', 'demula' ),
		'id'            => 'shop-widget',
		'description'   => __( 'Add widgets here to appear in your shop page.', 'demula' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'deploy_widgets_init' );
