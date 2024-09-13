
<!-- CHANGE NOTES
 -- data-open-modal and data-close-modal now include the unique ID so the JS controller can identify based on which video
 -- data-modal added to DIALOG element with the unique ID so it corresponds with the right button
 -- iframe id set to the unique ID so that each instance is individually controlled
 -- Javascript moved to the video-modal-youtube.js file
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
<figure <//?php echo $anchor; ?> class="<//?php echo esc_attr( $class_name ); ?>">
    <button data-open-modal>
	<//?php echo wp_get_attachment_image( $thumbnail, 'full', '', array( 'class' => 'open-modal' ) ); ?>
    </button>

    <//?php if( $caption ): ?>
        <figcaption><//?php echo $caption; ?></figcaption>
    <//?php endif; ?>
</figure>
	-->

<!-- DIALOG ELEMENT block with WP variables -->
 <!--
<dialog data-modal class="dc-modal">
    <div class="iframe-container">
        <iframe id="dc-video-iframe" width="1200" height="675" src="https://www.youtube.com/embed/<?php echo $videoID; ?>?rel=0&amp;autoplay=<?php echo $autoplay; ?>&amp;controls=<?php echo $controls; ?>&amp;enablejsapi=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

    <div class="dialog-footer">
        <button data-close-modal class="close">CLOSE</button>
    </div>
</dialog>
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

<!-- DIALOG ELEMENT block using placeholders because we have no WP plugins -->
<dialog data-modal="<?php echo $unique_id; ?>" class="dc-modal">
    <div class="iframe-container">
        <iframe id="<?php echo $unique_id; ?>" data-youtube-iframe width="1200" height="675" src="https://www.youtube.com/embed/<?php echo $videoID; ?>?rel=0&amp;autoplay=<?php echo $autoplay; ?>&amp;controls=<?php echo $controls; ?>&amp;enablejsapi=1" title="YouTube video player" allowfullscreen></iframe>
    </div>
    <div class="dialog-footer">
        <button data-close-modal="<?php echo $unique_id; ?>" class="close">CLOSE</button>
    </div>
</dialog>