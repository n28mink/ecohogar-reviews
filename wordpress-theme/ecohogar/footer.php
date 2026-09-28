<?php
/**
 * Pie del theme EcoHogar.
 *
 * @package EcoHogar
 */
?>
</div><!-- .wrap -->
</main><!-- .site-main -->

<footer class="site-footer">
	<div class="wrap">
		<div class="footer-grid">
			<div>
				<h3><?php bloginfo( 'name' ); ?></h3>
				<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
			</div>
			<div>
				<h3><?php esc_html_e( 'Secciones', 'ecohogar' ); ?></h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'menu',
						'fallback_cb'    => false,
						'depth'          => 1,
					)
				);
				?>
			</div>
			<div>
				<h3><?php esc_html_e( 'Legal', 'ecohogar' ); ?></h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'menu',
						'fallback_cb'    => false,
					)
				);
				?>
			</div>
			<div>
				<h3><?php esc_html_e( 'Transparencia', 'ecohogar' ); ?></h3>
				<p><?php esc_html_e( 'EcoHogar participa en programas de afiliados. Algunos enlaces son de afiliado y pueden generar una comisión sin coste adicional para ti.', 'ecohogar' ); ?></p>
			</div>
		</div>
		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Todos los derechos reservados.', 'ecohogar' ); ?></span>
			<span><?php esc_html_e( 'Hecho con WordPress y el theme EcoHogar.', 'ecohogar' ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
