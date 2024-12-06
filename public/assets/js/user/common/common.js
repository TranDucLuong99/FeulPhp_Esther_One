$(function () {
	$(window).scroll(function () {
		if (($(window).scrollTop() + $(window).height()) >= $('.main').height()) {
			$('.to-top-fixed').fadeOut();
			$('.to-top-default').fadeIn();
		} else {
			$('.to-top-fixed').fadeIn();
			$('.to-top-default').fadeOut();
		}

		if ($(window).scrollTop() == 0) {
			$('.to-top-fixed').fadeOut();
		}
	});

	$('.scroll-to').click(function (e) {
		e.preventDefault();
		var tab = $(this).attr('href'),
			offsetTop = $(tab).offset().top;
		window.scrollTo({
			top: offsetTop,
			behavior: 'smooth'
		});
		return false;
	});

	// accordion
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function (e) {
			if (e.target.slot == "1") {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
					panel.style.maxHeight = null;
				} else {
					panel.style.maxHeight = panel.scrollHeight + "px";
				}
			}
		});
	}

	$('.area-name').on('click', function (e) {
		if (e.target.slot == '1') {
			$('.area-item').not($(this).parent()).removeClass("active");
			$(this).parent().toggleClass("active");
			e.preventDefault();
		}
	});
});

