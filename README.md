# The ClassicPress Theme Child

A child theme for **The ClassicPress Theme** that adds:

- a custom footer layout
- three footer widget areas
- a separate social menu location
- a full-width page template with no sidebar and a centered content container

This child theme was built to replace the parent theme's hardcoded ClassicPress-specific footer content with a more reusable and editable structure.

## What this child theme changes

The child theme keeps the parent theme as the base and overrides only the files needed for the customization.

### Included files

- `style.css`
- `functions.php`
- `footer.php`
- `page-full-width.php`

### Features

- Loads parent and child theme styles correctly.[cite:20][cite:30]
- Registers three custom footer widget areas using `register_sidebar()`.[cite:48]
- Registers a `social-menu` location in addition to the parent theme menu locations.[cite:72][cite:79]
- Unregisters the parent theme's old `footer` sidebar so users do not see an unused widget area in admin.[cite:94]
- Replaces the original hardcoded footer links with editable menus and widget areas.[cite:5][cite:21]
- Adds a selectable full-width page template while keeping header, footer, Loop, featured image, and comments support.[cite:154][cite:161]

## Folder name

Create a child theme folder inside `wp-content/themes/` or `cp-content/themes/` named:

```text
the-classicpress-theme-child
```

The folder name can vary, but the `Template` value inside `style.css` must match the **parent theme folder name exactly**.[cite:20][cite:34]

## 1. style.css

Create `style.css` in the child theme folder.

```css
/*!
Theme Name: The ClassicPress Theme Child
Theme URI: https://directory.classicpress.net/themes/the-classicpress-theme/
Description: Child theme for The ClassicPress Theme. Adds a full-width page template and a custom footer with three widget areas.
Author: Your Name
Author URI: https://your-site.example
Template: the-classicpress-theme
Version: 1.0.0
Requires PHP: 8.0
Requires CP: 2.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
Text Domain: the-classicpress-theme-child
*/
```

### Important notes

- `Theme Name` is the name shown in the admin.[cite:20][cite:30]
- `Template` must be the parent theme's folder name, not its display name.[cite:20][cite:34]
- If this value is wrong, ClassicPress will report that the parent theme is missing.[cite:20]

## 2. functions.php

Create `functions.php` in the child theme folder.

```php
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

/**
 * Unregister the parent theme footer widget area.
 */
function the_classicpress_theme_child_unregister_parent_sidebars() {
	unregister_sidebar( 'footer' );
}
add_action( 'widgets_init', 'the_classicpress_theme_child_unregister_parent_sidebars', 11 );
```

### What this file does

- Loads the parent stylesheet first and the child stylesheet after it.[cite:20][cite:30]
- Registers three separate footer widget areas.[cite:48]
- Adds a new `social-menu` location.[cite:72][cite:79]
- Removes the old parent footer sidebar after the parent theme registers it.[cite:94][cite:97]

## 3. footer.php

Create `footer.php` in the child theme folder.

```php
<?php
/**
 * The template for displaying the footer
 *
 * @package The_ClassicPress_Theme_Child
 */
?>

	</div>

	<?php if ( has_nav_menu( 'footer-menu' ) || has_nav_menu( 'social-menu' ) ) : ?>
		<div id="prefooter">
			<div class="classic prefooter-inner">
				<div class="prefooter-left">
					<?php
					if ( has_nav_menu( 'footer-menu' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'depth'          => 1,
								'menu_id'        => 'footmenu',
								'menu_class'     => 'nav footer-nav',
								'container'      => 'nav',
								'container_class'=> 'footer-menu-nav',
								'fallback_cb'    => false,
							)
						);
					}
					?>
				</div>

				<div class="prefooter-right">
					<?php
					if ( has_nav_menu( 'social-menu' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'social-menu',
								'depth'          => 1,
								'menu_id'        => 'socialmenu',
								'menu_class'     => 'nav social-nav',
								'container'      => 'nav',
								'container_class'=> 'social-menu-nav',
								'fallback_cb'    => false,
							)
						);
					}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<footer id="colophon">
		<div class="classic">
			<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="footer-widgets footer-widgets-3">
					<div class="footer-widget-column footer-widget-column-1">
						<?php
						if ( is_active_sidebar( 'footer-1' ) ) {
							dynamic_sidebar( 'footer-1' );
						}
						?>
					</div>

					<div class="footer-widget-column footer-widget-column-2">
						<?php
						if ( is_active_sidebar( 'footer-2' ) ) {
							dynamic_sidebar( 'footer-2' );
						}
						?>
					</div>

					<div class="footer-widget-column footer-widget-column-3">
						<?php
						if ( is_active_sidebar( 'footer-3' ) ) {
							dynamic_sidebar( 'footer-3' );
						}
						?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</footer>

	<footer id="legal">
		<div class="cplegal">
			<div class="cpcopyright">
				<p>
					<?php
					printf(
						esc_html__( '© %1$s %2$s. All rights reserved.', 'the-classicpress-theme-child' ),
						esc_html( gmdate( 'Y' ) ),
						esc_html( get_bloginfo( 'name' ) )
					);
					?>
				</p>
			</div>

			<div class="cppolicy">
				<p>
					<?php esc_html_e( 'The ClassicPress Theme Child', 'the-classicpress-theme-child' ); ?>
					<span class="sep"> | </span>
					<?php esc_html_e( 'Made with love with', 'the-classicpress-theme-child' ); ?>
					<a href="<?php echo esc_url( 'https://www.classicpress.net/' ); ?>" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'ClassicPress', 'the-classicpress-theme-child' ); ?>
					</a>
				</p>
			</div>
		</div>
	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
```

### Footer behavior

The child footer removes the parent theme's hardcoded ClassicPress-specific footer content and replaces it with:

- a prefooter row with the existing `footer-menu` on the left and the new `social-menu` on the right.[cite:72][cite:79]
- a widget row with three widget columns using `footer-1`, `footer-2`, and `footer-3`.[cite:48]
- a credits row with child-theme-specific text and a link back to ClassicPress.[cite:21][cite:132]

## 4. page-full-width.php

Create `page-full-width.php` in the child theme folder.

```php
<?php
/**
 * Template Name: Full-width Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_ClassicPress_Theme_Child
 */

get_header();
?>

	<div id="primary" class="full-width-primary">
		<main id="main" class="page-main page-full-width">

		<?php
		susty_wp_post_thumbnail();

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
```

### Why this works

This template removes the sidebar structure but still keeps the normal header, footer, Loop, featured image, page content template part, and comments support.[cite:154][cite:161][cite:157]

It is usually better to override `page.php` behavior with a dedicated page template than to override `content-page.php`, because `page.php` controls the page layout while `content-page.php` focuses on the content markup inside the Loop.[cite:27][cite:161]

## 5. Footer CSS

Append the following to `style.css` under the metadata block.

```css
/* ==========================
   Child theme footer
   ========================== */

#prefooter {
	padding: 1.5rem 0;
	border-top: 1px solid #d9d9d9;
	border-bottom: 1px solid #d9d9d9;
	background: #f7f7f7;
}

.prefooter-inner {
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
	gap: 1rem 2rem;
}

.prefooter-left,
.prefooter-right {
	flex: 1 1 300px;
}

.prefooter-right {
	text-align: right;
}

.footer-menu-nav .nav,
.social-menu-nav .nav {
	list-style: none;
	margin: 0;
	padding: 0;
	display: flex;
	flex-wrap: wrap;
	gap: 0.75rem 1.25rem;
}

.prefooter-right .social-nav {
	justify-content: flex-end;
}

.footer-menu-nav .nav li,
.social-menu-nav .nav li {
	margin: 0;
	padding: 0;
}

.footer-menu-nav .nav a,
.social-menu-nav .nav a {
	text-decoration: none;
}

#colophon {
	padding: 2.5rem 0;
	background: #ffffff;
}

.footer-widgets {
	display: grid;
	grid-template-columns: repeat(3, minmax(0, 1fr));
	gap: 2rem;
}

.footer-widget-column {
	min-width: 0;
}

.footer-widget-column .widget {
	margin-bottom: 1.5rem;
}

.footer-widget-column .widget:last-child {
	margin-bottom: 0;
}

.footer-widget-title {
	margin: 0 0 0.75rem;
	font-size: 1.1rem;
	line-height: 1.3;
}

.footer-widget-column ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

.footer-widget-column li {
	margin-bottom: 0.5rem;
}

.footer-widget-column a {
	text-decoration: none;
}

#legal {
	padding: 1rem 0;
	border-top: 1px solid #d9d9d9;
	background: #f7f7f7;
	font-size: 0.95rem;
}

.cplegal {
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
	gap: 0.75rem 1.5rem;
}

.cpcopyright,
.cppolicy {
	flex: 1 1 280px;
}

.cppolicy {
	text-align: right;
}

.cppolicy .sep {
	display: inline-block;
	margin: 0 0.35rem;
}

.cpcopyright p,
.cppolicy p {
	margin: 0;
}

#prefooter a,
#colophon a,
#legal a {
	text-decoration: none;
}

#prefooter a:hover,
#prefooter a:focus,
#colophon a:hover,
#colophon a:focus,
#legal a:hover,
#legal a:focus {
	text-decoration: underline;
}

@media screen and (max-width: 900px) {
	.footer-widgets {
		grid-template-columns: repeat(2, minmax(0, 1fr));
	}
}

@media screen and (max-width: 640px) {
	.prefooter-inner,
	.cplegal {
		flex-direction: column;
		align-items: flex-start;
	}

	.prefooter-right,
	.cppolicy {
		text-align: left;
	}

	.prefooter-right .social-nav {
		justify-content: flex-start;
	}

	.footer-widgets {
		grid-template-columns: 1fr;
	}
}
```

## 6. Full-width page CSS

Append the following to `style.css` after the footer styles.

```css
/* ==========================
   Full-width page template
   No sidebar, centered container
   ========================== */

.full-width-primary {
	width: 100%;
	margin: 0;
	padding: 0 1.5rem;
	box-sizing: border-box;
}

.page-full-width {
	width: 100%;
	max-width: 1200px;
	margin: 0 auto;
	padding: 0;
	box-sizing: border-box;
}

.page-full-width .entry-header,
.page-full-width .entry-content,
.page-full-width .post-thumbnail,
.page-full-width .comments-area {
	width: 100%;
	max-width: 100%;
	margin-left: auto;
	margin-right: auto;
}

.full-width-primary article,
.full-width-primary .hentry,
.full-width-primary .page {
	width: 100%;
	max-width: 100%;
	margin-left: auto;
	margin-right: auto;
}

.page-full-width img {
	max-width: 100%;
	height: auto;
	display: block;
}

.page-full-width iframe,
.page-full-width embed,
.page-full-width object {
	max-width: 100%;
}

@media screen and (max-width: 900px) {
	.full-width-primary {
		padding-left: 1.25rem;
		padding-right: 1.25rem;
	}
}

@media screen and (max-width: 640px) {
	.full-width-primary {
		padding-left: 1rem;
		padding-right: 1rem;
	}

	.page-full-width {
		max-width: 100%;
	}
}
```

## 7. Activation and testing

After creating the files, activate the child theme in the admin.[cite:20]

Then verify the following:

1. The child theme appears in Appearance > Themes and activates without errors.[cite:20]
2. The three footer widget areas appear in Appearance > Widgets.[cite:48]
3. The old parent `footer` widget area no longer appears.[cite:94]
4. The `social-menu` location appears in the menu location settings.[cite:72][cite:79]
5. The footer shows the prefooter menus, the three widget columns, and the custom credits line.
6. The Full-width Page template appears in the page editor template dropdown and works without a sidebar.[cite:161][cite:154]

## 8. Troubleshooting

### The child theme does not appear in Themes

Possible causes:

- `style.css` metadata is missing or malformed.[cite:20][cite:34]
- The child theme folder is in the wrong location.[cite:20]

### The child theme says the parent theme is missing

Possible cause:

- The `Template` value in `style.css` does not exactly match the parent theme folder name.[cite:20][cite:34]

### The child theme activates but looks broken

Possible cause:

- The parent stylesheet is not enqueued correctly in `functions.php`.[cite:30]

### The three footer widget areas do not appear in admin

Possible causes:

- There is a PHP error in `functions.php`.
- The `widgets_init` hook was not added correctly.[cite:48]

### The old footer widget area is still visible

Possible causes:

- `unregister_sidebar( 'footer' )` was not added.
- The unregister function is not hooked to `widgets_init` with a later priority such as `11`.[cite:94][cite:97]

### The social menu does not show on the site

Possible causes:

- The `social-menu` location was not registered.[cite:72]
- No menu has been assigned to that location in the admin.[cite:79]

### The full-width page still looks narrow

Possible cause:

- The parent theme is applying `max-width` or other layout constraints to inner content selectors that need to be overridden in the child stylesheet.[cite:150][cite:177]

## 9. Summary

This child theme customizes The ClassicPress Theme by overriding only the files needed for the footer and page layout. That makes the customization easier to maintain and keeps the parent theme updates separate from the child theme changes.[cite:20][cite:3]
