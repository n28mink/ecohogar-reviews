<?php
/**
 * Archivo (categorías, etiquetas, archivo de reseñas).
 *
 * @package EcoHogar
 */

get_header();
?>

<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Migas de pan', 'ecohogar' ); ?>">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'ecohogar' ); ?></a>
	&raquo; <?php echo esc_html( single_term_title( '', false ) ? single_term_title( '', false ) : __( 'Archivo', 'ecohogar' ) ); ?>
</nav>

<header class="archive-header">
	<h1><?php the_archive_title(); ?></h1>
	<?php the_archive_description( '<p>', '</p>' ); ?>
</header>

<?php if ( have_posts() ) : ?>
	<div class="cards">
		<?php
		$i = 0;
		while ( have_posts() ) :
			the_post();
			$i++;
			?>
			<?php if ( 0 === $i % 4 ) : ?>
				<?php ecohogar_ad_slot( 'ecohogar-anuncio-feed' ); ?>
			<?php endif; ?>
			<article class="card">
				<a class="card-img" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'ecohogar-card' ); ?>
					<?php endif; ?>
				</a>
				<div class="card-body">
					<?php if ( 'resena' === get_post_type() ) : ?>
						<span class="card-cat"><?php esc_html_e( 'Reseña', 'ecohogar' ); ?></span>
					<?php else : ?>
						<?php $cats = get_the_category(); ?>
						<?php if ( $cats ) : ?>
							<span class="card-cat"><?php echo esc_html( $cats[0]->name ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
					<h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if ( 'resena' === get_post_type() ) : ?>
						<div class="score">
							<span class="score-badge"><?php echo esc_html( number_format_i18n( ecohogar_puntuacion(), 1 ) ); ?></span>
							<?php echo ecohogar_stars( ecohogar_puntuacion() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapado en el helper ?>
						</div>
					<?php endif; ?>
					<p class="card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<div class="card-meta">
						<span><?php echo esc_html( get_the_date() ); ?></span>
						<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Leer más', 'ecohogar' ); ?> →</a>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
	<div class="pagination">
		<?php
		the_posts_pagination(
			array(
				'prev_text' => __( '← Anterior', 'ecohogar' ),
				'next_text' => __( 'Siguiente →', 'ecohogar' ),
			)
		);
		?>
	</div>
<?php else : ?>
	<p><?php esc_html_e( 'No hay contenido en esta sección todavía.', 'ecohogar' ); ?></p>
<?php endif; ?>

<?php
get_footer();
