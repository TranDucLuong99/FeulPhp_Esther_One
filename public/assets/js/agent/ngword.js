$(document).ready(function () {
	$(".delete-btn").on("click", function () {
		let ngword_id = $(this).data("id");
		let ngword = $(this).data("word");

		if (
			confirm(
				"押下で「NGワード「" + ngword + "」を削除しますか？」とポップアップ表示"
			)
		) {
			let data = { ngword_id: ngword_id };
			$.ajax({
				url: window.location.origin + "/agent/ngword/delete",
				type: "POST",
				contentType: "application/json",
				data: JSON.stringify(data),
				success: function (response) {
					if (response.result) {
						window.location.reload();
					}
				},
				error: function (error) {
					console.log(error);
				},
			});
		}
	});
	$('input[name="ngword_type_filter"]').on("click", function () {
		$('input[name="search_type"]').val($(this).val());
	});

	$("#js-ngword-detail-form").on("submit", function (e) {
		let submit_btn = $("#js-submit-ngword-btn");

		if (submit_btn.prop("disabled")) {
			e.preventDefault();
			return;
		}

		submit_btn.prop("disabled", true);
	});
});
