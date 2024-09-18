(function() {
	// Load the YouTube iframe API if not already loaded
	if (!window.YT) {
	  var tag = document.createElement('script');
	  tag.src = 'https://www.youtube.com/iframe_api';
	  var firstScriptTag = document.getElementsByTagName('script')[0];
	  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	}
  
	var players = {};
  
	// Function to initialize a player for a given iframe ID
	function initializePlayer(uniqueId) {
		players[uniqueId] = new YT.Player(uniqueId);
	}
  
	// Initialize players when API is ready
	window.onYouTubeIframeAPIReady = function() {
	  // This needs to be here for YT API, but should be left empty as players are initialized dynamically upon iframe injection
	};
  
	// Function to open modal and play video
	function openModal(uniqueId) {
	  var modal = document.querySelector('dialog[data-modal="' + uniqueId + '"]');
	  var iframeContainer = document.getElementById('iframe-container-' + uniqueId);
	  var videoID = iframeContainer.getAttribute('data-video-id');
	  var controls = iframeContainer.getAttribute('data-controls');
  
	  if (modal && !players[uniqueId]) {
		// Create the iframe dynamically
		var iframe = document.createElement('iframe');
		iframe.id = uniqueId;
		iframe.width = '1200';
		iframe.height = '675';
		iframe.src = `https://www.youtube.com/embed/${videoID}?rel=0&autoplay=1&controls=${controls}&enablejsapi=1`;
		iframe.title = "YouTube video player";
		iframe.frameBorder = "0";
		iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope";
		iframe.referrerPolicy = "strict-origin-when-cross-origin";
		iframe.allowFullscreen = true;
  
		// Inject the iframe into the container
		iframeContainer.innerHTML = '';
		iframeContainer.appendChild(iframe);
  
		initializePlayer(uniqueId);
	  }
  
	  if (modal) {
		modal.showModal();
		var player = players[uniqueId];
		if (player && player.playVideo) {
		  player.playVideo();
		}
	  }
	}
  
	// Function to close modal and pause video
	function closeModal(uniqueId) {
	  var modal = document.querySelector('dialog[data-modal="' + uniqueId + '"]');
	  var iframeContainer = document.getElementById('iframe-container-' + uniqueId);
  
	  if (modal) {
		modal.close();
		var player = players[uniqueId];
		if (player && player.pauseVideo) {
		  player.pauseVideo();
		}
	  }
	}
  
	// Event listeners for opening modals
	document.querySelectorAll('[data-open-modal]').forEach(function(button) {
	  button.addEventListener('click', function() {
		var uniqueId = button.getAttribute('data-open-modal');
		openModal(uniqueId);
	  });
	});
  
	// Event listeners for closing modals
	document.querySelectorAll('[data-close-modal]').forEach(function(button) {
	  button.addEventListener('click', function() {
		var uniqueId = button.getAttribute('data-close-modal');
		closeModal(uniqueId);
	  });
	});
  
	// Event listeners for closing modal when clicking outside
	document.querySelectorAll('dialog[data-modal]').forEach(function(modal) {
	  modal.addEventListener('click', function(e) {
		const rect = modal.getBoundingClientRect();
		if (
		  e.clientX < rect.left ||
		  e.clientX > rect.right ||
		  e.clientY < rect.top ||
		  e.clientY > rect.bottom
		) {
		  var uniqueId = modal.getAttribute('data-modal');
		  closeModal(uniqueId);
		}
	  });
	});
})();