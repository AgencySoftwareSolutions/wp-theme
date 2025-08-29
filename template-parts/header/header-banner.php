<?php
$custom_header = get_custom_header();
if ( has_post_thumbnail( get_queried_object_id() ) ) {
	$header_image 	= get_the_post_thumbnail_url( get_queried_object_id(), '2048x2048' );
	$alt_text 			= get_post_meta(get_post_thumbnail_id(get_queried_object_id()), '_wp_attachment_image_alt', true) ?: esc_attr__('Header Banner Image', 'wp-theme');

} elseif ( ! empty( $custom_header->url ) && is_object( $custom_header ) ) {
	$header_image = $custom_header->url;
	$alt_text			= wp_sprintf(__( '%s Header Image', 'wp-theme'), get_the_title() );

} else {
	return false;
}
?>

<div id="hero-banner">
	<div class="container">
		<figure class="hero-banner-image">
			<img src="<?php echo esc_url( $header_image ) ?>" alt="<?php echo esc_attr( $alt_text ) ?>"/>
		</figure>
	</div>
</div>