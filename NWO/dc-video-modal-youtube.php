<!--
CHANGE NOTES
-- Instead of initializing iframe in dialog, setting up blank div so JS can inject iframe.
-- This allows for the browser to recognize the button click as a direct interaction and allows autoplay from the iframe.
-- Fixed blocks with broken WP from last time ...I think?
-->

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

// VIDEO VARIABLES block with WP variables
/*
$thumbnail = get_field('thumbnail');
$videoID = get_field( 'video_id' );
$autoplay = get_field( 'autoplay' ) ? 1 : 0;
$controls = get_field( 'controls' ) ? 1 : 0;
$caption = get_field( 'caption' );
*/

// VIDEO VARIABLES using placeholders because we have no WP plugins
$thumbnail = isset($thumbnail) ? $thumbnail : 'thumbnail1.png';
$videoID = isset($videoID) ? $videoID : 'wDchsz8nmbo?si=44B-z24h5YVajBLg';
$caption = isset($caption) ? $caption : '';
$autoplay = isset($autoplay) ? $autoplay : 0;
$controls = isset($controls) ? $controls : 1;
?>

<!-- FIGURE ELEMENT block with WP variables -->
 <!--
<figure <//?php echo echo esc_attr( $anchor ); ?> class="<//?php echo esc_attr( $class_name ); ?>">
    <button data-open-modal="<//?php echo esc_attr( $unique_id ); ?>">
        <//?php echo wp_get_attachment_image( $thumbnail, 'full', '', array( 'class' => 'open-modal' ) ); ?>
    </button>
    <//?php if ( $caption ): ?>
        <figcaption><//?php echo $caption; ?></figcaption>
    <//?php endif; ?>
</figure>
    -->

<!-- FIGURE ELEMENT block using placeholders because we have no WP plugins -->
<figure class="dc-video-modal-youtube">
    <button data-open-modal="<?php echo $unique_id; ?>">
        <img src="<?php echo $thumbnail; ?>" alt="Video Thumbnail" class="open-modal" />
    </button>
    <?php if( $caption ): ?>
        <figcaption><?php echo $caption; ?></figcaption>
    <?php endif; ?>
</figure>


<!-- DIALOG ELEMENT block with WP variables -->
 <!--
<dialog data-modal="<//?php echo esc_attr( $unique_id ); ?>" class="dc-modal">
    <div 
        class="iframe-container" 
        id="iframe-container-<//?php echo esc_attr( $unique_id ); ?>" 
        data-video-id="<//?php echo esc_attr( $videoID ); ?>" 
        data-controls="<//?php echo esc_attr( $controls ); ?>"
    >
        //<-- Iframe will be injected here dynamically via JavaScript --//>
    </div>

    <div class="dialog-footer">
        <button data-close-modal="<//?php echo esc_attr( $unique_id ); ?>" class="close">CLOSE</button>
    </div>
</dialog>
    -->

<!-- DIALOG ELEMENT block using placeholders because we have no WP plugins -->
<dialog data-modal="<?php echo $unique_id; ?>" class="dc-modal">
    <div class="iframe-container"
    id="iframe-container-<?php echo $unique_id; ?>"
    data-video-id="<?php echo $videoID; ?>"
    data-controls="<?php echo $controls; ?>">
        <!-- Iframe will be injected here dynamically via JavaScript -->
    </div>
    <div class="dialog-footer">
        <button data-close-modal="<?php echo $unique_id; ?>" class="close">CLOSE</button>
    </div>
</dialog>
