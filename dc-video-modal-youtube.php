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
$i = rand();
?>

<figure <?php echo $anchor; ?> class="<?php echo esc_attr( $class_name ); ?>">
	<button data-open-modal-<?php echo $i; ?>>
		<?php echo wp_get_attachment_image( $thumbnail, 'full', '', array( 'class' => 'open-modal' ) ); ?>
	</button>

	<?php if( $caption ): ?>
		<figcaption><?php echo $caption; ?></figcaption>
	<?php endif; ?>
</figure>

<dialog data-modal-<?php echo $i; ?> class="dc-modal">
	<div id="video-container-<?php echo $i; ?>"></div>
	<div class="dialog-footer">
		<button data-close-modal-<?php echo $i; ?> class="close">CLOSE</button>
	</div>

	<script type="text/javascript">
		function loadVideo() {
			const xhttp = new XMLHttpRequest();
			xhttp.onload = function() {
				document.getElementById("video-container-<?php echo $i; ?>").innerHTML = this.responseText;
			}
			xhttp.open("GET", "dc-yt-frame-container.php", true);
			xhttp.send();
		}

		const openButton<?php echo $i; ?> = document.querySelector("[data-open-modal-<?php echo $i; ?>]");
		const closeButton<?php echo $i; ?> = document.querySelector("[data-close-modal-<?php echo $i; ?>]");
		const modal<?php echo $i; ?> = document.querySelector("[data-modal-<?php echo $i; ?>]");

		openButton<?php echo $i; ?>.addEventListener("click", () => {
			loadVideo();
			modal<?php echo $i; ?>.showModal();
			player<?php echo $i; ?>.playVideo();
		})

		closeButton<?php echo $i; ?>.addEventListener("click", () => {
			modal<?php echo $i; ?>.close();
			player<?php echo $i; ?>.stopVideo();
		})

		modal<?php echo $i; ?>.addEventListener("click", e => {
			const dialogDimensions<?php echo $i; ?> = modal<?php echo $i; ?>.getBoundingClientRect();
			if (
				e.clientX < dialogDimensions<?php echo $i; ?>.left ||
				e.clientX > dialogDimensions<?php echo $i; ?>.right ||
				e.clientY < dialogDimensions<?php echo $i; ?>.top ||
				e.clientY > dialogDimensions<?php echo $i; ?>.bottom
			) {
				modal<?php echo $i; ?>.close();
				player<?php echo $i; ?>.stopVideo();
			}
		})
	</script>
</dialog>
