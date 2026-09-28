<?php
/**
 * Ficha de reseña individual (CPT "resena").
 *
 * Muestra: veredicto, puntuación, pros/contras, CTA de afiliado
 * (rel="sponsored nofollow"), tabla de especificaciones, precio
 * orientativo, contenido, FAQ y reseñas relacionadas.
 *
 * @package EcoHogar
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Migas de pan', 'ecohogar' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'ecohogar' ); ?></a>
		&raquo; <a href="<?php echo esc_url( get_post_type_archive_link( 'resena' ) ); ?>"><?php esc_html_e( 'Reseñas', 'ecohogar' ); ?></a>
		&raquo; <?php the_title(); ?>
	</nav>

	<div class="review-layout">
		<article class="review-main">
			<?php $cats = get_the_category(); ?>
			<?php if ( $cats ) : ?>
				<span class="card-cat"><?php echo esc_html( $cats[0]->name ); ?></span>
			<?php endif; ?>

			<h1><?php the_title(); ?></h1>
			<p class="card-meta">
				<?php esc_html_e( 'Actualizado:', 'ecohogar' ); ?> <?php echo esc_html( get_the_modified_date() ); ?>
			</p>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="review-featured">
					<?php the_post_thumbnail( 'ecohogar-hero' ); ?>
				</figure>
			<?php endif; ?>

			<?php $veredicto = ecohogar_meta( '_ecohogar_veredicto' ); ?>
			<?php if ( $veredicto ) : ?>
				<div class="veredicto">
					<div class="score">
						<span class="score-badge"><?php echo esc_html( number_format_i18n( ecohogar_puntuacion(), 1 ) ); ?>/10</span>
						<?php echo ecohogar_stars( ecohogar_puntuacion() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapado en el helper ?>
						<strong><?php esc_html_e( 'Veredicto EcoHogar', 'ecohogar' ); ?></strong>
					</div>
					<p><?php echo esc_html( $veredicto ); ?></p>
				</div>
			<?php endif; ?>

			<?php $pros = ecohogar_meta( '_ecohogar_pros' ); ?>
			<?php $contras = ecohogar_meta( '_ecohogar_contras' ); ?>
			<?php if ( $pros || $contras ) : ?>
				<div class="pros-contras">
					<div class="pros">
						<h3><?php esc_html_e( 'Pros', 'ecohogar' ); ?></h3>
						<?php echo ecohogar_lines_list( $pros ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapado en el helper ?>
					</div>
					<div class="contras">
						<h3><?php esc_html_e( 'Contras', 'ecohogar' ); ?></h3>
						<?php echo ecohogar_lines_list( $contras ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapado en el helper ?>
					</div>
				</div>
			<?php endif; ?>

			<?php echo ecohogar_affiliate_cta(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapado en el helper ?>

			<?php $precio = ecohogar_meta( '_ecohogar_precio' ); ?>
			<?php if ( $precio ) : ?>
				<p class="precio-orientativo">
					<?php
					printf(
						/* translators: %s: precio orientativo */
						esc_html__( 'Precio orientativo: %s (puede variar; confirma el precio actual en la tienda).', 'ecohogar' ),
						'<strong>' . esc_html( $precio ) . '</strong>'
					);
					?>
				</p>
			<?php endif; ?>

			<div class="review-content">
				<?php the_content(); ?>
			</div>

			<?php $specs = ecohogar_meta( '_ecohogar_specs' ); ?>
			<?php if ( $specs ) : ?>
				<h2><?php esc_html_e( 'Especificaciones clave', 'ecohogar' ); ?></h2>
				<?php echo ecohogar_specs_table( $specs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapado en el helper ?>
			<?php endif; ?>

			<?php $faqs = ecohogar_faq_data( ecohogar_meta( '_ecohogar_faq' ) ); ?>
			<?php if ( $faqs ) : ?>
				<div class="faq">
					<h2><?php esc_html_e( 'Preguntas frecuentes', 'ecohogar' ); ?></h2>
					<?php foreach ( $faqs as $faq ) : ?>
						<div class="faq-item">
							<h3><?php echo esc_html( $faq['q'] ); ?></h3>
							<p><?php echo esc_html( $faq['a'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php
			comments_template();
			?>
		</article>

		<aside class="sidebar">
			<?php ecohogar_ad_slot( 'ecohogar-anuncio-sidebar' ); ?>
			<?php if ( is_active_sidebar( 'ecohogar-sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'ecohogar-sidebar' ); ?>
			<?php endif; ?>

			<?php
			$relacionadas = new WP_Query(
				array(
					'post_type'      => 'resena',
					'posts_per_page' => 4,
					'post__not_in'   => array( get_the_ID() ),
					'no_found_rows'  => true,
				)
			);
			?>
			<?php if ( $relacionadas->have_posts() ) : ?>
				<div class="widget">
					<h3 class="widget-title"><?php esc_html_e( 'Reseñas relacionadas', 'ecohogar' ); ?></h3>
					<ul>
						<?php while ( $relacionadas->have_posts() ) : $relacionadas->the_post(); ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</ul>
				</div>
			<?php endif; ?>
		</aside>
	</div>
<?php endwhile; ?>

<?php
get_footer();
