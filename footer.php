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
