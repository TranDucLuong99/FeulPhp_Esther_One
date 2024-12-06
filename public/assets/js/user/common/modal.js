// Get the modal Area
var modalArea = document.getElementById("modalArea");
var btnArea = document.getElementById("btnArea");
var closeArea = document.getElementsByClassName("closeArea")[0];
var accordionTitleButton = document.querySelector('div.accordion-box-first > button.accordion-title');
var accordionTitlePanel = accordionTitleButton.nextElementSibling;
if (btnArea && modalArea && closeArea) {
	btnArea.onclick = function () {
		modalArea.style.display = "block";
		accordionTitleButton.classList.add("active");
		accordionTitlePanel.style.maxHeight = accordionTitlePanel.scrollHeight + "px";
		accordionTitlePanel.style.transition = "none";
	}
	closeArea.onclick = function () {
		modalArea.style.display = "none";
		accordionTitleButton.classList.remove("active");
		if (accordionTitlePanel.style.maxHeight) {
			accordionTitlePanel.style.maxHeight = null;
			accordionTitlePanel.style.transition = "none";
		}
	}
	window.onclick = function (event) {
		if (event.target == modalArea) {
			modalArea.style.display = "none";
			accordionTitleButton.classList.remove("active");
			if (accordionTitlePanel.style.maxHeight) {
				accordionTitlePanel.style.maxHeight = null;
				accordionTitlePanel.style.transition = "none";
			}
		}
	}
	accordionTitleButton.onclick = function () {
		accordionTitlePanel.style.transition = "max-height 0.2s ease-out";
	}
}

// Get the modal SNS
var modalSns = document.getElementById("modalSns");
var btnSns = document.getElementById("btnSns");
var closeSns = document.getElementsByClassName("closeSns")[0];
if (modalSns && btnSns && closeSns) {
	btnSns.onclick = function () {
		modalSns.style.display = "block";
	}
	closeSns.onclick = function () {
		modalSns.style.display = "none";
	}
	window.onclick = function (event) {
		if (event.target == modalSns) {
			modalSns.style.display = "none";
		}
	}
}


// Get the modal Tel
var modalTel = document.getElementById("modalTel");
var btnTel = document.getElementById("btnTel");
var closeTel = document.getElementsByClassName("closeTel")[0];
if (modalTel && btnTel && closeTel) {
	btnTel.onclick = function () {
		modalTel.style.display = "block";
	}
	closeTel.onclick = function () {
		modalTel.style.display = "none";
	}
	window.onclick = function (event) {
		if (event.target == modalTel) {
			modalTel.style.display = "none";
		}
	}
}
