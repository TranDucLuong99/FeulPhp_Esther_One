$(function() {
	// accordion FAQ
	var acc = document.getElementsByClassName("accordion-faq");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function(e) {
			this.classList.toggle("active");
			var panel = this.nextElementSibling;
			if (panel.style.maxHeight) {
				panel.style.maxHeight = null;
			} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
			}
		});
	}
});