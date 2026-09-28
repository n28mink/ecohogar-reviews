<?php
/**
 * EcoHogar — functions.php
 *
 * Registra el CPT "resena", sus campos (veredicto, pros/contras, puntuación,
 * especificaciones, FAQ, CTA de afiliado), los slots de anuncios, el JSON-LD
 * (Review, ItemList, FAQ) y las etiquetas Open Graph.
 *
 * Seguridad: toda salida se escapa (esc_html/esc_url/esc_attr), los meta boxes
 * usan nonce y comprobación de capabilities, sin eval ni consultas directas.
 *
 * @package EcoHogar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ECOHOGAR_VERSION', '1.0.0' );
define( 'ECOHOGAR_NONCE', 'ecohogar_meta_nonce' );

/* ============================================================
 * 1. Configuración base del theme
 * ============================================================ */
function ecohogar_setup() {
	load_theme_textdomain( 'ecohogar', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 220,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menú principal', 'ecohogar' ),
			'footer'  => __( 'Menú pie de página', 'ecohogar' ),
		)
	);

	add_image_size( 'ecohogar-card', 640, 400, true );
	add_image_size( 'ecohogar-hero', 1200, 630, true );
}
add_action( 'after_setup_theme', 'ecohogar_setup' );

function ecohogar_scripts() {
	wp_enqueue_style( 'ecohogar-style', get_stylesheet_uri(), array(), ECOHOGAR_VERSION );
}
add_action( 'wp_enqueue_scripts', 'ecohogar_scripts' );

/* ============================================================
 * 2. Custom Post Type: Reseña
 * ============================================================ */
function ecohogar_register_cpt() {
	$labels = array(
		'name'               => __( 'Reseñas', 'ecohogar' ),
		'singular_name'      => __( 'Reseña', 'ecohogar' ),
		'add_new'            => __( 'Añadir reseña', 'ecohogar' ),
		'add_new_item'       => __( 'Añadir nueva reseña', 'ecohogar' ),
		'edit_item'          => __( 'Editar reseña', 'ecohogar' ),
		'new_item'           => __( 'Nueva reseña', 'ecohogar' ),
		'view_item'          => __( 'Ver reseña', 'ecohogar' ),
		'search_items'       => __( 'Buscar reseñas', 'ecohogar' ),
		'not_found'          => __( 'No se encontraron reseñas', 'ecohogar' ),
		'all_items'          => __( 'Todas las reseñas', 'ecohogar' ),
	);

	register_post_type(
		'resena',
		array(
			'labels'       => $labels,
			'public'       => true,
			'has_archive'  => 'resenas',
			'rewrite'      => array( 'slug' => 'resenas' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
			'taxonomies'   => array( 'category', 'post_tag' ),
			'menu_icon'    => 'dashicons-star-filled',
			'menu_position'=> 5,
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'ecohogar_register_cpt' );

/* ============================================================
 * 3. Meta boxes: ficha de reseña + comparativa
 * ============================================================ */
function ecohogar_resena_fields() {
	return array(
		'_ecohogar_veredicto'     => array( 'label' => 'Veredicto (1-2 frases)', 'type' => 'text' ),
		'_ecohogar_puntuacion'    => array( 'label' => 'Puntuación (0 a 10, ej. 8.5)', 'type' => 'number' ),
		'_ecohogar_pros'          => array( 'label' => 'Pros (uno por línea)', 'type' => 'textarea' ),
		'_ecohogar_contras'       => array( 'label' => 'Contras (uno por línea)', 'type' => 'textarea' ),
		'_ecohogar_precio'        => array( 'label' => 'Precio orientativo (ej. "≈ 899 €, sep 2026")', 'type' => 'text' ),
		'_ecohogar_url_afiliado'  => array( 'label' => 'URL de afiliado (con tu ID)', 'type' => 'url' ),
		'_ecohogar_texto_cta'     => array( 'label' => 'Texto del botón CTA', 'type' => 'text' ),
		'_ecohogar_specs'         => array( 'label' => 'Especificaciones (una por línea, formato "Etiqueta: valor")', 'type' => 'textarea' ),
		'_ecohogar_faq'           => array( 'label' => 'FAQ (una por línea, formato "Pregunta || Respuesta")', 'type' => 'textarea' ),
	);
}

function ecohogar_add_meta_boxes() {
	add_meta_box(
		'ecohogar_ficha',
		__( 'Ficha de reseña EcoHogar', 'ecohogar' ),
		'ecohogar_render_resena_box',
		'resena',
		'normal',
		'high'
	);
	add_meta_box(
		'ecohogar_comparativa',
		__( 'Comparativa EcoHogar', 'ecohogar' ),
		'ecohogar_render_comparativa_box',
		'page',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'ecohogar_add_meta_boxes' );

function ecohogar_render_resena_box( $post ) {
	wp_nonce_field( 'ecohogar_save_meta', ECOHOGAR_NONCE );
	foreach ( ecohogar_resena_fields() as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		echo '<p><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $field['label'] ) . '</strong></label><br>';
		if ( 'textarea' === $field['type'] ) {
			echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="4" style="width:100%">' . esc_textarea( $value ) . '</textarea>';
		} elseif ( 'number' === $field['type'] ) {
			echo '<input type="number" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" min="0" max="10" step="0.1" style="width:120px">';
		} else {
			$input_type = ( 'url' === $field['type'] ) ? 'url' : 'text';
			echo '<input type="' . esc_attr( $input_type ) . '" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="width:100%">';
		}
		echo '</p>';
	}
	echo '<p class="description">' . esc_html__( 'El CTA de afiliado se muestra con rel="sponsored nofollow" automáticamente.', 'ecohogar' ) . '</p>';
}

function ecohogar_render_comparativa_box( $post ) {
	wp_nonce_field( 'ecohogar_save_meta', ECOHOGAR_NONCE );
	$value = get_post_meta( $post->ID, '_ecohogar_comparativa_ids', true );
	echo '<p><label for="_ecohogar_comparativa_ids"><strong>' . esc_html__( 'Reseñas a comparar (slugs o IDs separados por comas)', 'ecohogar' ) . '</strong></label><br>';
	echo '<input type="text" id="_ecohogar_comparativa_ids" name="_ecohogar_comparativa_ids" value="' . esc_attr( $value ) . '" style="width:100%"></p>';
	echo '<p class="description">' . esc_html__( 'Solo se usa con la plantilla "Comparativa".', 'ecohogar' ) . '</p>';
}

function ecohogar_save_meta( $post_id ) {
	if ( ! isset( $_POST[ ECOHOGAR_NONCE ] ) || ! wp_verify_nonce( sanitize_key( $_POST[ ECOHOGAR_NONCE ] ), 'ecohogar_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( ecohogar_resena_fields() as $key => $field ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		$raw = wp_unslash( $_POST[ $key ] );
		if ( 'url' === $field['type'] ) {
			$value = esc_url_raw( $raw );
		} elseif ( 'number' === $field['type'] ) {
			$value = (string) min( 10, max( 0, (float) $raw ) );
		} elseif ( 'textarea' === $field['type'] ) {
			$value = sanitize_textarea_field( $raw );
		} else {
			$value = sanitize_text_field( $raw );
		}
		update_post_meta( $post_id, $key, $value );
	}

	if ( isset( $_POST['_ecohogar_comparativa_ids'] ) ) {
		update_post_meta( $post_id, '_ecohogar_comparativa_ids', sanitize_text_field( wp_unslash( $_POST['_ecohogar_comparativa_ids'] ) ) );
	}
}
add_action( 'save_post', 'ecohogar_save_meta' );

/* ============================================================
 * 4. Widgets: sidebar + slots de anuncios (AdSense)
 * ============================================================ */
function ecohogar_widgets() {
	$sidebars = array(
		'ecohogar-sidebar'           => __( 'Barra lateral', 'ecohogar' ),
		'ecohogar-anuncio-header'    => __( 'Anuncio: cabecera (banner 728×90 / responsive)', 'ecohogar' ),
		'ecohogar-anuncio-articulo'  => __( 'Anuncio: dentro del artículo', 'ecohogar' ),
		'ecohogar-anuncio-sidebar'   => __( 'Anuncio: barra lateral (300×250 / 336×280)', 'ecohogar' ),
		'ecohogar-anuncio-feed'      => __( 'Anuncio: in-feed (entre tarjetas)', 'ecohogar' ),
	);
	foreach ( $sidebars as $id => $name ) {
		register_sidebar(
			array(
				'name'          => $name,
				'id'            => $id,
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'ecohogar_widgets' );

/**
 * Muestra un slot de anuncio si tiene widgets activos.
 *
 * @param string $slot_id ID del sidebar.
 */
function ecohogar_ad_slot( $slot_id ) {
	if ( ! is_active_sidebar( $slot_id ) ) {
		return;
	}
	echo '<div class="ad-slot ad-' . esc_attr( str_replace( 'ecohogar-anuncio-', '', $slot_id ) ) . '" role="complementary" aria-label="' . esc_attr__( 'Publicidad', 'ecohogar' ) . '">';
	dynamic_sidebar( $slot_id );
	echo '</div>';
}

/**
 * Inserta el anuncio in-article después del segundo párrafo en reseñas.
 */
function ecohogar_inject_in_article_ad( $content ) {
	if ( ! is_singular( 'resena' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	if ( ! is_active_sidebar( 'ecohogar-anuncio-articulo' ) ) {
		return $content;
	}
	ob_start();
	dynamic_sidebar( 'ecohogar-anuncio-articulo' );
	$ad = ob_get_clean();
	if ( '' === trim( $ad ) ) {
		return $content;
	}
	$ad_html = '<div class="ad-slot ad-in-article" role="complementary" aria-label="' . esc_attr__( 'Publicidad', 'ecohogar' ) . '">' . $ad . '</div>';
	$parts   = explode( '</p>', $content );
	if ( count( $parts ) > 2 ) {
		$parts[1] .= $ad_html;
		return implode( '</p>', $parts );
	}
	return $content . $ad_html;
}
add_filter( 'the_content', 'ecohogar_inject_in_article_ad', 20 );

/**
 * Disclosure automático de afiliado al inicio de las reseñas que tengan URL de afiliado.
 */
function ecohogar_affiliate_disclosure( $content ) {
	if ( ! is_singular( 'resena' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$url = get_post_meta( get_the_ID(), '_ecohogar_url_afiliado', true );
	if ( '' === $url ) {
		return $content;
	}
	$notice = '<p class="disclosure">' . esc_html__( 'Divulgación: este artículo contiene enlaces de afiliado. Si compras a través de ellos, EcoHogar puede recibir una comisión sin coste adicional para ti.', 'ecohogar' ) . '</p>';
	return $notice . $content;
}
add_filter( 'the_content', 'ecohogar_affiliate_disclosure', 5 );

/* ============================================================
 * 5. Helpers de la ficha de reseña
 * ============================================================ */
function ecohogar_meta( $key, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	return get_post_meta( $post_id, $key, true );
}

function ecohogar_puntuacion( $post_id = null ) {
	$score = (float) ecohogar_meta( '_ecohogar_puntuacion', $post_id );
	return min( 10, max( 0, $score ) );
}

function ecohogar_stars( $score ) {
	$full  = (int) floor( $score / 2 );
	$half  = ( ( $score / 2 ) - $full ) >= 0.5 ? 1 : 0;
	$empty = 5 - $full - $half;
	$out   = str_repeat( '★', $full ) . ( $half ? '⯪' : '' ) . str_repeat( '☆', $empty );
	return '<span class="stars" aria-label="' . esc_attr( sprintf( __( 'Puntuación: %s de 10', 'ecohogar' ), number_format_i18n( $score, 1 ) ) ) . '">' . esc_html( $out ) . '</span>';
}

function ecohogar_lines_list( $text ) {
	$lines = array_filter( array_map( 'trim', explode( "\n", (string) $text ) ) );
	if ( empty( $lines ) ) {
		return '';
	}
	$out = '<ul>';
	foreach ( $lines as $line ) {
		$out .= '<li>' . esc_html( $line ) . '</li>';
	}
	return $out . '</ul>';
}

function ecohogar_specs_table( $text ) {
	$lines = array_filter( array_map( 'trim', explode( "\n", (string) $text ) ) );
	if ( empty( $lines ) ) {
		return '';
	}
	$out = '<table class="specs-table"><tbody>';
	foreach ( $lines as $line ) {
		$parts = explode( ':', $line, 2 );
		$label = trim( $parts[0] );
		$value = isset( $parts[1] ) ? trim( $parts[1] ) : '';
		$out  .= '<tr><th scope="row">' . esc_html( $label ) . '</th><td>' . esc_html( $value ) . '</td></tr>';
	}
	return $out . '</tbody></table>';
}

function ecohogar_faq_data( $text ) {
	$faqs  = array();
	$lines = array_filter( array_map( 'trim', explode( "\n", (string) $text ) ) );
	foreach ( $lines as $line ) {
		$parts = explode( '||', $line, 2 );
		if ( count( $parts ) === 2 ) {
			$faqs[] = array( 'q' => trim( $parts[0] ), 'a' => trim( $parts[1] ) );
		}
	}
	return $faqs;
}

/**
 * CTA de afiliado con rel="sponsored nofollow".
 */
function ecohogar_affiliate_cta( $post_id = null ) {
	$url   = ecohogar_meta( '_ecohogar_url_afiliado', $post_id );
	$texto = ecohogar_meta( '_ecohogar_texto_cta', $post_id );
	if ( '' === $url ) {
		return '';
	}
	if ( '' === $texto ) {
		$texto = __( 'Ver precio y disponibilidad', 'ecohogar' );
	}
	return '<div class="cta-box"><p>' . esc_html__( 'Enlace de afiliado: apoyas a EcoHogar sin pagar más.', 'ecohogar' ) . '</p>'
		. '<a class="btn-afiliado" href="' . esc_url( $url ) . '" rel="sponsored nofollow" target="_blank">'
		. esc_html( $texto ) . '</a></div>';
}

/**
 * Resuelve la lista de reseñas de una comparativa (slugs o IDs).
 *
 * @return WP_Post[]
 */
function ecohogar_comparativa_posts( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$raw     = ecohogar_meta( '_ecohogar_comparativa_ids', $post_id );
	$posts   = array();
	foreach ( array_filter( array_map( 'trim', explode( ',', (string) $raw ) ) ) as $token ) {
		if ( ctype_digit( $token ) ) {
			$p = get_post( (int) $token );
		} else {
			$p = get_page_by_path( sanitize_title( $token ), OBJECT, 'resena' );
		}
		if ( $p && 'publish' === $p->post_status ) {
			$posts[] = $p;
		}
	}
	return $posts;
}

/* ============================================================
 * 6. Open Graph
 * ============================================================ */
function ecohogar_open_graph() {
	if ( is_front_page() ) {
		$title = get_bloginfo( 'name' ) . ' — ' . get_bloginfo( 'description' );
		$desc  = get_bloginfo( 'description' );
		$type  = 'website';
	} elseif ( is_singular() ) {
		$title = get_the_title() . ' — ' . get_bloginfo( 'name' );
		$desc  = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
		$type  = 'article';
	} else {
		$title = wp_get_document_title();
		$desc  = get_bloginfo( 'description' );
		$type  = 'website';
	}

	$image = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( get_the_ID(), 'ecohogar-hero' );
	} elseif ( has_custom_logo() ) {
		$logo_id = get_theme_mod( 'custom_logo' );
		$image   = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';
	}

	echo "\n<!-- Open Graph: EcoHogar -->\n";
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( wp_strip_all_tags( $title ) ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( wp_strip_all_tags( $desc ) ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ? get_permalink() : home_url( '/' ) ) . '">' . "\n";
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action( 'wp_head', 'ecohogar_open_graph', 5 );

/* ============================================================
 * 7. JSON-LD (schema.org): Organization, WebSite, Review, ItemList, FAQ
 * ============================================================ */
function ecohogar_json_ld() {
	$site_name = get_bloginfo( 'name' );
	$site_url  = home_url( '/' );
	$graphs    = array();

	$graphs[] = array(
		'@type' => 'Organization',
		'@id'   => $site_url . '#organizacion',
		'name'  => $site_name,
		'url'   => $site_url,
	);
	$graphs[] = array(
		'@type' => 'WebSite',
		'@id'   => $site_url . '#sitio',
		'name'  => $site_name,
		'url'   => $site_url,
		'publisher' => array( '@id' => $site_url . '#organizacion' ),
	);

	if ( is_singular( 'resena' ) ) {
		$post_id = get_the_ID();
		$score   = ecohogar_puntuacion( $post_id );
		$pros    = array_filter( array_map( 'trim', explode( "\n", (string) ecohogar_meta( '_ecohogar_pros', $post_id ) ) ) );
		$contras = array_filter( array_map( 'trim', explode( "\n", (string) ecohogar_meta( '_ecohogar_contras', $post_id ) ) ) );

		$review = array(
			'@type'         => 'Review',
			'@id'           => get_permalink( $post_id ) . '#resena',
			'itemReviewed'  => array(
				'@type' => 'Product',
				'name'  => get_the_title( $post_id ),
			),
			'reviewRating'  => array(
				'@type'       => 'Rating',
				'ratingValue' => $score,
				'bestRating'  => 10,
				'worstRating' => 0,
			),
			'author'        => array( '@id' => $site_url . '#organizacion' ),
			'publisher'     => array( '@id' => $site_url . '#organizacion' ),
			'datePublished' => get_the_date( 'c', $post_id ),
			'dateModified'  => get_the_modified_date( 'c', $post_id ),
			'name'          => get_the_title( $post_id ),
		);
		if ( $pros ) {
			$review['positiveNotes'] = array(
				'@type'           => 'ItemList',
				'itemListElement' => array_values( $pros ),
			);
		}
		if ( $contras ) {
			$review['negativeNotes'] = array(
				'@type'           => 'ItemList',
				'itemListElement' => array_values( $contras ),
			);
		}
		$graphs[] = $review;

		// BreadcrumbList para la ficha de reseña.
		$cat       = get_the_category( $post_id );
		$cat_item  = $cat ? array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => $cat[0]->name,
			'item'     => get_category_link( $cat[0] ),
		) : null;
		$crumbs    = array(
			array(
				'@type'    => 'ListItem',
				'position' => 1,
				'name'     => __( 'Inicio', 'ecohogar' ),
				'item'     => $site_url,
			),
		);
		if ( $cat_item ) {
			$crumbs[] = $cat_item;
		}
		$crumbs[] = array(
			'@type'    => 'ListItem',
			'position' => count( $crumbs ) + 1,
			'name'     => get_the_title( $post_id ),
			'item'     => get_permalink( $post_id ),
		);
		$graphs[] = array(
			'@type'           => 'BreadcrumbList',
			'@id'             => get_permalink( $post_id ) . '#migas',
			'itemListElement' => $crumbs,
		);

		$faqs = ecohogar_faq_data( ecohogar_meta( '_ecohogar_faq', $post_id ) );
		if ( $faqs ) {
			$questions = array();
			foreach ( $faqs as $faq ) {
				$questions[] = array(
					'@type'          => 'Question',
					'name'           => $faq['q'],
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => $faq['a'],
					),
				);
			}
			$graphs[] = array(
				'@type'      => 'FAQPage',
				'@id'        => get_permalink( $post_id ) . '#faq',
				'mainEntity' => $questions,
			);
		}
	}

	if ( is_page_template( 'page-comparativa.php' ) ) {
		$items = array();
		$pos   = 1;
		foreach ( ecohogar_comparativa_posts() as $p ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $pos++,
				'name'     => get_the_title( $p ),
				'url'      => get_permalink( $p ),
			);
		}
		if ( $items ) {
			$graphs[] = array(
				'@type'           => 'ItemList',
				'@id'             => get_permalink() . '#comparativa',
				'itemListElement' => $items,
			);
		}
		$graphs[] = array(
			'@type'           => 'BreadcrumbList',
			'@id'             => get_permalink() . '#migas',
			'itemListElement' => array(
				array(
					'@type'    => 'ListItem',
					'position' => 1,
					'name'     => __( 'Inicio', 'ecohogar' ),
					'item'     => $site_url,
				),
				array(
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => get_the_title(),
					'item'     => get_permalink(),
				),
			),
		);
	}

	echo "\n<script type=\"application/ld+json\">\n"
		. wp_json_encode(
			array(
				'@context' => 'https://schema.org',
				'@graph'   => $graphs,
			),
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		)
		. "\n</script>\n";
}
add_action( 'wp_head', 'ecohogar_json_ld', 10 );

/* ============================================================
 * 8. Ajustes menores
 * ============================================================ */
function ecohogar_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'ecohogar_excerpt_length' );

/**
 * Menú de respaldo: muestra las 6 categorías con más contenido.
 */
function ecohogar_menu_fallback() {
	$cats = get_categories(
		array(
			'number'  => 6,
			'orderby' => 'count',
			'order'   => 'DESC',
		)
	);
	if ( empty( $cats ) || is_wp_error( $cats ) ) {
		return;
	}
	echo '<ul class="menu">';
	foreach ( $cats as $cat ) {
		echo '<li><a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
	}
	echo '</ul>';
}
