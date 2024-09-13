/* CHANGE NOTES
	-- Moved JS to initialize the iframe API from php file to here
	-- Added players object to store multiple player instances based on unique ID
	-- onYouTubeIframeAPIReady loops through all iframes and initializes a player for each (stores in players object)
	-- Added event listeners for better maintainability
*/

(function() {
	// Load the YouTube iframe API if not already loaded
	if (!window.YT) {
	  var tag = document.createElement('script');
	  tag.src = 'https://www.youtube.com/iframe_api';
	  var firstScriptTag = document.getElementsByTagName('script')[0];
	  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	}
  
	var players = {};
  
	// Initialize players when API is ready
	window.onYouTubeIframeAPIReady = function() {
	  var iframes = document.querySelectorAll('iframe[data-youtube-iframe]');
	  iframes.forEach(function(iframe) {
		var uniqueId = iframe.id;
		players[uniqueId] = new YT.Player(uniqueId);
	  });
	};
  
	// Function to open modal and play video
	function openModal(uniqueId) {
	  var modal = document.querySelector('dialog[data-modal="' + uniqueId + '"]');
	  if (modal) {
		modal.showModal(); // Open the modal
		var player = players[uniqueId];
		if (player && player.playVideo) {
		  player.playVideo();
		}
	  }
	}
  
	// Function to close modal and pause video
	function closeModal(uniqueId) {
	  var modal = document.querySelector('dialog[data-modal="' + uniqueId + '"]');
	  if (modal) {
		modal.close(); // Close the modal
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