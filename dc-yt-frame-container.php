<div class="iframe-container">
	<iframe id="dc-video-iframe-<?php echo $i; ?>" width="1200" height="675" src="https://www.youtube.com/embed/<?php echo $videoID; ?>?rel=0&amp;autoplay=<?php echo $autoplay; ?>&amp;controls=<?php echo $controls; ?>&amp;enablejsapi=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope" referrerpolicy="no-referrer" allowfullscreen></iframe>
	<script>
		var tag = document.createElement('script');
		tag.id = 'iframe-<?php echo $i; ?>';
		tag.src = 'https://www.youtube.com/iframe_api';
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

		var player<?php echo $i; ?>;
		function onYouTubeIframeAPIReady() {
		player<?php echo $i; ?> = new YT.Player('dc-video-iframe-<?php echo $i; ?>', {
			events: {
				// 'onReady' : onPlayerReady,
				// 'onStateChange': onPlayerStateChange
			}
		});
		}
		// function onPlayerReady(event){
		//     event.target.playVideo();
		// }
		// function onPlayerStateChange(event) {
		// }
	</script>
</div>
