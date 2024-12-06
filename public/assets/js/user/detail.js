$(function () {
	document.getElementById("copyButton").addEventListener("click", function() {
		copyToClipboard();
	});

	function copyToClipboard() {
		// Get the text field
		var copyText = document.getElementById("copyTarget");

		// Select the text field
		copyText.select();
		copyText.setSelectionRange(0, 99999); // For mobile devices

		// Copy the text inside the text field
		navigator.clipboard.writeText(copyText.value);

		document.getElementById("copy-id-text").innerHTML = "コピーしました";
		document.getElementById("copy-id-box").classList.add("copied");
	}

	$(window).scroll(function () {
		window.requestAnimationFrame(function() {
			if ($(window).scrollTop() + window.innerHeight >= $(document).height() - 120) {
				$('.apply-box').fadeOut();
			} else {
				$('.apply-box').fadeIn();
			}
		});
	});

	function tel_count_up(shop_autonum, button_action) {
		$.ajax({
			type: "POST",
			url: "/user/ajax/tel_count_up",
			async: true,
			cache: false,
			dataType: "json",
			data: {
				shop_autonum: shop_autonum,
				button_action: button_action,
			},
		});
	}

	$('.js-sp_telltap_a').click(function() {
		var shop_autonum = $('.js-shop_autonum_hid').val();
		tel_count_up(shop_autonum, "sp_telltap_a");
	});
	$('.js-sp_telltap_b').click(function() {
		var shop_autonum = $('.js-shop_autonum_hid').val();
		tel_count_up(shop_autonum, "sp_telltap_b");
	});

	function line_count_up(shop_autonum, button_action) {
		$.ajax({
			type: "POST",
			url: "/user/ajax/line_count_up",
			async: true,
			cache: false,
			dataType: "json",
			data: {
				shop_autonum: shop_autonum,
				button_action: button_action,
			},
		});
	}

	$('.js-sp_linetap_a').click(function() {
		var shop_autonum = $('.js-shop_autonum_hid').val();
		line_count_up(shop_autonum, "sp_linetap_a");
	});
	$('.js-sp_linetap_b').click(function() {
		var shop_autonum = $('.js-shop_autonum_hid').val();
		line_count_up(shop_autonum, "sp_linetap_b");
	});
});
