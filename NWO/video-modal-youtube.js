const openButton = document.querySelector("[data-open-modal]")
const closeButton = document.querySelector("[data-close-modal]")
const modal = document.querySelector("[data-modal]")

openButton.addEventListener("click", () => {
	modal.showModal()
	// player.playVideo()
})

closeButton.addEventListener("click", () => {
	modal.close()
	player.pauseVideo()
})

modal.addEventListener("click", e => {
	const dialogDimensions = modal.getBoundingClientRect()
	if (
		e.clientX < dialogDimensions.left ||
		e.clientX > dialogDimensions.right ||
		e.clientY < dialogDimensions.top ||
		e.clientY > dialogDimensions.bottom
	) {
		modal.close()
		player.pauseVideo()
	}
})
