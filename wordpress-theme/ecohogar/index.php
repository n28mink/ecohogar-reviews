<?php
/**
 * Fallback del menú + portada del theme EcoHogar.
 *
 * @package EcoHogar
 */

get_header();
?>

<section class="hero">
	<div class="wrap">
		<h1><?php bloginfo( 'name' ); ?></h1>
		<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
	</div>
</section>

<div class="wrap">
	<h2 class="section-title"><?php esc_html_e( 'Últimas reseñas', 'ecohogar' ); ?></h2>
	<?php
	$resenas = new WP_Query(
		array(
			'post_type'      => 'resena',
			'posts_per_page' => 6,
			'no_found_rows'  => true,
		)
	);
	?>
	<?php if ( $resenas->have_posts() ) : ?>
		<div class="cards">
			<?php
			$i = 0;
			while ( $resenas->have_posts() ) :
				$resenas->the_post();
				$i++;
				?>
				<?php if ( 4 === $i ) : ?>
					<?php ecohogar_ad_slot( 'ecohogar-anuncio-feed' ); ?>
				<?php endif; ?>
				<article class="card">
					<a class="card-img" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'ecohogar-card' ); ?>
						<?php endif; ?>
					</a>
					<div class="card-body">
						<?php $cats = get_the_category(); ?>
						<?php if ( $cats ) : ?>
							<span class="card-cat"><?php echo esc_html( $cats[0]->name ); ?></span>
						<?php endif; ?>
						<h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="score">
							<span class="score-badge"><?php echo esc_html( number_format_i18n( ecohogar_puntuacion(), 1 ) ); ?></span>
							<?php echo ecohogar_stars( ecohogar_puntuacion() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- ya escapado en el helper ?>
						</div>
						<p class="card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<div class="card-meta">
							<span><?php echo esc_html( get_the_date() ); ?></span>
							<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Leer reseña', 'ecohogar' ); ?> →</a>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	<?php else : ?>
		<p><?php esc_html_e( 'Aún no hay reseñas publicadas.', 'ecohogar' ); ?></p>
	<?php endif; ?>

	<h2 class="section-title"><?php esc_html_e( 'Guías y artículos', 'ecohogar' ); ?></h2>
	<?php if ( have_posts() ) : ?>
		<ul class="post-list">
			<?php while ( have_posts() ) : the_post(); ?>
				<li>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php echo esc_html( get_the_excerpt() ); ?></p>
				</li>
			<?php endwhile; ?>
		</ul>
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
		<p><?php esc_html_e( 'Aún no hay artículos publicados.', 'ecohogar' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
