<?php
/**
 * Enqueue parent and child theme styles.
 */
function the_classicpress_theme_child_enqueue_styles() {
	$parent_style = 'the-classicpress-theme-parent-style';

	wp_enqueue_style(
		$parent_style,
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	wp_enqueue_style(
		'the-classicpress-theme-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'the_classicpress_theme_child_enqueue_styles' );

<?php
/**
 * Enqueue parent and child theme styles.
 */
function the_classicpress_theme_child_enqueue_styles() {
	$parent_style = 'the-classicpress-theme-parent-style';

	wp_enqueue_style(
		$parent_style,
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	wp_enqueue_style(
		'the-classicpress-theme-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'the_classicpress_theme_child_enqueue_styles' );

/**
 * Unregister the parent theme footer widget area.
 */
function the_classicpress_theme_child_unregister_parent_sidebars() {
	unregister_sidebar( 'footer' );
}
add_action( 'widgets_init', 'the_classicpress_theme_child_unregister_parent_sidebars', 11 );

/**
 * Register footer widget areas.
 */
function the_classicpress_theme_child_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area 1', 'the-classicpress-theme-child' ),
			'id'            => 'footer-1',
			'description'   => __( 'First footer widget area.', 'the-classicpress-theme-child' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area 2', 'the-classicpress-theme-child' ),
			'id'            => 'footer-2',
			'description'   => __( 'Second footer widget area.', 'the-classicpress-theme-child' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area 3', 'the-classicpress-theme-child' ),
			'id'            => 'footer-3',
			'description'   => __( 'Third footer widget area.', 'the-classicpress-theme-child' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'the_classicpress_theme_child_widgets_init' );

/**
 * Register additional menu locations for the child theme.
 */
function the_classicpress_theme_child_register_menus() {
	register_nav_menu(
		'social-menu',
		__( 'Social Menu', 'the-classicpress-theme-child' )
	);
}
add_action( 'after_setup_theme', 'the_classicpress_theme_child_register_menus', 20 );
