<?php
// Generate a unique ID for each video instance
$unique_id = 'dc-video-' . uniqid();

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'dc-video-modal-youtube';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$thumbnail = get_field('thumbnail');
$videoID = get_field( 'video_id' );
$autoplay = get_field( 'autoplay' ) ? 1 : 0;
$controls = get_field( 'controls' ) ? 1 : 0;
$caption = get_field( 'caption' );
?>
 
<figure <?php echo echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>">
    <button data-open-modal="<?php echo esc_attr( $unique_id ); ?>">
        <?php echo wp_get_attachment_image( $thumbnail, 'full', '', array( 'class' => 'open-modal' ) ); ?>
    </button>
    <?php if ( $caption ): ?>
        <figcaption><?php echo $caption; ?></figcaption>
    <?php endif; ?>
</figure>

 <dialog data-modal="<?php echo esc_attr( $unique_id ); ?>" class="dc-modal">
    <div 
        class="iframe-container" 
        id="iframe-container-<?php echo esc_attr( $unique_id ); ?>" 
        data-video-id="<?php echo esc_attr( $videoID ); ?>" 
        data-controls="<?php echo esc_attr( $controls ); ?>"
    >
        <!-- Iframe will be injected here dynamically via JavaScript -->
    </div>

    <div class="dialog-footer">
        <button data-close-modal="<?php echo esc_attr( $unique_id ); ?>" class="close">CLOSE</button>
    </div>
</dialog>