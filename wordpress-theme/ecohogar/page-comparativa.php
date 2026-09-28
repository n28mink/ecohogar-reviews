<?php
/**
 * Template Name: Comparativa
 *
 * Página de comparativa: tabla responsive con las reseñas indicadas en el
 * meta box "Comparativa EcoHogar" (slugs o IDs separados por comas).
 *
 * @package EcoHogar
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Migas de pan', 'ecohogar' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'ecohogar' ); ?></a>
		&raquo; <?php the_title(); ?>
	</nav>

	<article class="review-main" style="margin:24px 0 60px">
		<h1><?php the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="review-featured">
				<?php the_post_thumbnail( 'ecohogar-hero' ); ?>
			</figure>
		<?php endif; ?>

		<?php
		$comparadas = ecohogar_comparativa_posts();
		?>

		<?php if ( $comparadas ) : ?>
			<h2><?php esc_html_e( 'Comparativa rápida', 'ecohogar' ); ?></h2>
			<div class="compare-table-wrap">
				<table class="compare-table">
					<thead>
						<tr>
							<th scope="col"><?php esc_html_e( 'Producto', 'ecohogar' ); ?></th>
							<th scope="col"><?php esc_html_e( 'Puntuación', 'ecohogar' ); ?></th>
							<th scope="col"><?php esc_html_e( 'Precio orientativo', 'ecohogar' ); ?></th>
							<th scope="col"><?php esc_html_e( 'Veredicto', 'ecohogar' ); ?></th>
							<th scope="col"><?php esc_html_e( 'Enlace', 'ecohogar' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$mejor = 0;
						foreach ( $comparadas as $p ) {
							$mejor = max( $mejor, ecohogar_puntuacion( $p->ID ) );
						}
						foreach ( $comparadas as $p ) :
							$score     = ecohogar_puntuacion( $p->ID );
							$es_mejor  = ( $score >= $mejor && $score > 0 );
							?>
							<tr<?php echo $es_mejor ? ' class="compare-winner"' : ''; ?>>
								<th scope="row">
									<a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a>
									<?php if ( $es_mejor ) : ?>
										<br><span class="card-cat">★ <?php esc_html_e( 'Mejor puntuado', 'ecohogar' ); ?></span>
									<?php endif; ?>
								</th>
								<td>
									<span class="score-badge"><?php echo esc_html( number_format_i18n( $score, 1 ) ); ?></span>
								</td>
								<td><?php echo esc_html( ecohogar_meta( '_ecohogar_precio', $p->ID ) ); ?></td>
								<td><?php echo esc_html( ecohogar_meta( '_ecohogar_veredicto', $p->ID ) ); ?></td>
								<td><a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php esc_html_e( 'Ver reseña', 'ecohogar' ); ?> →</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<p class="precio-orientativo"><?php esc_html_e( 'Precios orientativos: pueden variar. Confirma el precio actual en la tienda antes de comprar.', 'ecohogar' ); ?></p>
		<?php else : ?>
			<p class="disclosure"><?php esc_html_e( 'Aviso: esta comparativa aún no tiene reseñas asignadas. Edita la página y completa el campo "Reseñas a comparar" en el meta box "Comparativa EcoHogar".', 'ecohogar' ); ?></p>
		<?php endif; ?>

		<div class="review-content">
			<?php the_content(); ?>
		</div>

		<?php comments_template(); ?>
	</article>
<?php endwhile; ?>

<?php
get_footer();
