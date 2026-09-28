<?php
/**
 * Cabecera del theme EcoHogar.
 *
 * @package EcoHogar
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#contenido"><?php esc_html_e( 'Saltar al contenido', 'ecohogar' ); ?></a>

<header class="site-header">
	<div class="wrap header-inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
				<?php $tagline = get_bloginfo( 'description' ); ?>
				<?php if ( $tagline ) : ?>
					<p class="site-tagline"><?php echo esc_html( $tagline ); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<nav class="main-nav" aria-label="<?php esc_attr_e( 'Navegación principal', 'ecohogar' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'menu',
					'fallback_cb'    => 'ecohogar_menu_fallback',
				)
			);
			?>
		</nav>
	</div>
	<?php ecohogar_ad_slot( 'ecohogar-anuncio-header' ); ?>
</header>

<main id="contenido" class="site-main">
<div class="wrap">
