<?php

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

// Load values and assign defaults
$thumbnail = get_field('thumbnail');
$videoID = get_field( 'video_id' );
$autoplay = get_field( 'autoplay' ) ? 1 : 0;
$controls = get_field( 'controls' ) ? 1 : 0;
$caption = get_field( 'caption' );
?>

<figure <?php echo $anchor; ?> class="<?php echo esc_attr( $class_name ); ?>">
	<button data-open-modal>
		<?php echo wp_get_attachment_image( $thumbnail, 'full', '', array( 'class' => 'open-modal' ) ); ?>
	</button>

	<?php if( $caption ): ?>
		<figcaption><?php echo $caption; ?></figcaption>
	<?php endif; ?>
</figure>

<dialog data-modal class="dc-modal">
	<div class="iframe-container">
		<iframe id="dc-video-iframe"
			width="1200"
			height="675"
			src="https://www.youtube.com/embed/<?php echo $videoID; ?>?rel=0&amp;autoplay=<?php echo $autoplay; ?>&amp;controls=<?php echo $controls; ?>&amp;enablejsapi=1"
			title="YouTube video player"
			frameborder="0"
			allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope"
			referrerpolicy="strict-origin-when-cross-origin"\
			allowfullscreen>
		</iframe>
	</div>

	<div class="dialog-footer">
		<button data-close-modal class="close">CLOSE</button>
	</div>
</dialog>

<script type="text/javascript">
	var tag = document.createElement('script');
	tag.id = 'iframe-demo';
	tag.src = 'https://www.youtube.com/iframe_api';
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	var player;
	function onYouTubeIframeAPIReady() {
	player = new YT.Player('dc-video-iframe', {
		events: {
			// 'onStateChange': onPlayerStateChange
		}
	});
	}
	// function onPlayerStateChange(event) {
	// }
</script>
