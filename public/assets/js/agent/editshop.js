$(document).ready(function () {
	let active_flg = $('input[name="active_flg"]:checked').val();

	$('input[name="active_flg"]').on("change", function (e) {
		let input = e.target;
		if (input.value == false) {
			remove_required_for_field();
		} else {
			add_required_for_field();
		}
		active_flg = input.value;
	});

	$('input[type="file"]').on("change", function (e) {
		let input = e.target;

		if (input.files && input.files[0]) {
			let url = URL.createObjectURL(input.files[0]);
			$(".job-img").attr("src", url).show();
		}
	});

	$('input[name="title"]').on("keyup", function (e) {
		var length = $(this).val().length;
		$("#js-title_character_count").text(length + "文字入力中");
	});

	$('textarea[name="job_info"]').on("keyup", function (e) {
		var length = $(this).val().length;
		$("#js-job_info_character_count").text(length + "文字入力中");
	});

	$('form[name="F1"]').on("submit", function (e) {
		if (caution_words.length > 0 && ng_words.length == 0) {
			e.preventDefault();
			let ngwords = caution_words.join(", ");
			if (
				confirm(
					"注意ワード " +
						ngwords +
						" が含まれています\nこのまま登録してよろしいですか"
				)
			) {
				$('input[name="allow_caution_words"]').val(1);
				this.submit();
			}
		}
	});
});

function remove_required_for_field() {
	$('span[class="required"]').removeClass("required").addClass("no_required");
	$('input[name="shop_name_estheone"]').removeAttr("required");
	$('input[name="file"]').removeAttr("required");
	$('input[name="title"]').removeAttr("required");
	$('textarea[name="job_info"]').removeAttr("required");
}

function add_required_for_field() {
	$('span[class="no_required"]')
		.removeClass("no_required")
		.addClass("required");
	$('input[name="shop_name_estheone"]').attr("required", true);
	$('input[name="file"]').attr("required", true);
	$('input[name="title"]').attr("required", true);
	$('textarea[name="job_info"]').attr("required", true);
}
