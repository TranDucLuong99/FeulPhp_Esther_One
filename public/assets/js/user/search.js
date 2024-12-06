$(document).ready(function () {
	var page = 1;
	var base_url = '';
	var prefarea_area_name2 = $('#prefarea_area_name2').val();
	var env_img_url = '';

	// より多くのアイテムを読み込む機能
	function loadItems() {
		var remaining_shops_autonum = $('#remaining_shops_autonum').val().split(',');
		if (remaining_shops_autonum.length > 0) {
			let loaded_shops_autonum = remaining_shops_autonum.slice(0, limit_shop_per_page);
			remaining_shops_autonum = remaining_shops_autonum.slice(limit_shop_per_page);
			$('#remaining_shops_autonum').val(remaining_shops_autonum.join(','));

			$.ajax({
				url: window.location.href + "load_more/",
				type: "POST",
				contentType: 'application/json',
				data: JSON.stringify(loaded_shops_autonum),
				success: function (response) {
					base_url = response.base_url;
					env_img_url = response.env_img_url;
					
					response.shops.forEach(element => {
						html = renderItems(element);
						$(".jobs").append(html);
					});

					page++; // 次のリクエストのページ番号を増やす
					$(".lds-ring").hide();
					if (page * limit_shop_per_page <= total_shop_mains_record) {
						$(".more-btn").show();
					}
				},
			});
		}
		
	}

	function encodeHTMLEntities(str) {
		return $('<div/>').text(str).html();
	}

	function renderItems(item) {
		let title = item['title'] === null ? '' : item['title'];
		let img_src = item['img_name'] === null ? '/assets/img/user/common/noimage/img_large_pc.png' : env_img_url + item['img_name'];
		let daywage_money = item['daywage_money'] === null ? "000,000" : addCommas(item['daywage_money']);
		let backrate_money = item['backrate_money'] === null ? "000,000" : addCommas(item['backrate_money']);

		var html = '';

		html += ' <li> ';
		html += ' <a href="' + base_url + prefarea_area_name2 + '/a_' + item['group_area_id'] +'/recruit/s_' + item['shop_id'] + '/"> ';
		html += ' <h3 class="job-tit">' + encodeHTMLEntities(title) + '</h3> ';
		html += ' </a> ';
		html += ' <a href="' + base_url + prefarea_area_name2 + '/a_' + item['group_area_id'] +'/recruit/s_' + item['shop_id'] + '/"> ';
		html += ' <img src="' + img_src + '" alt="' + encodeHTMLEntities(item['shop_name_estheone']) + 'の求人画像" class="job-img"> ';
		html += ' </a> ';
		html += ' <a href="' + base_url + prefarea_area_name2 + '/a_' + item['group_area_id'] +'/recruit/s_' + item['shop_id'] + '/"> ';
		html += ' <h2 class="store-name">' + encodeHTMLEntities(item['shop_name_estheone']) + '</h2> ';
		html += ' </a> ';
		if (item['salary_type'] != 0) {
			html += ' <div class="price-box"> ';
			html += ' <div class="tit">エステワンなら</div> ';
			if (item['salary_type'] == 1) {
				html += ' <span class="fs20 bold mr10">日給</span> ';
				html += ' <span class="fs30 txt-pink bold"><span class="fs20">￥</span>' + encodeHTMLEntities(daywage_money) + '<span class="fs18">～</span></span> ';
			}
			if (item['salary_type'] == 2) {
				html += ' <span class="fs20 bold mr10">バック</span> ';
				html += ' <span class="fs30 txt-pink bold"><span class="fs20">￥</span>' + encodeHTMLEntities(backrate_money) + '<span class="fs18">～</span></span> ';
			}
			html += ' </div> ';
		}
		html += ' <div class="description-list"> ';
		if (item['saiyo'] !== null && item['saiyo'] != '') {
			html += ' <div class="item"> ';
			html += ' <div class="item-tit"><img src="/assets/img/user/job_list/ico_requirements.svg" alt=""><span>応募資格</span></div> ';
			html += ' <div class="item-content"> ' + encodeHTMLEntities(item['saiyo']) + '</div> ';
			html += ' </div> ';
		}
		if (item['work_area'] !== null && item['work_area'] != '') {
			html += ' <div class="item"> ';
			html += ' <div class="item-tit"><img src="/assets/img/user/job_list/ico_locate.svg" alt=""><span>勤務地</span></div> ';
			html += ' <div class="item-content"> ' + encodeHTMLEntities(item['work_area']) + '</div> ';
			html += ' </div> ';
		}
		if (item['work_time'] !== null && item['work_time'] != '') {
			html += ' <div class="item"> ';
			html += ' <div class="item-tit"><img src="/assets/img/user/job_list/ico_clock.svg" alt=""><span>勤務時間</span></div> ';
			html += ' <div class="item-content"> ' + encodeHTMLEntities(item['work_time']) + '</div> ';
			html += ' </div> ';
		}
		if (item['salary_type'] != 0) {
			html += ' <div class="item"> ';
			html += ' <div class="item-tit"><img src="/assets/img/user/job_list/ico_pig.svg" alt=""><span>給与</span></div> ';
			html += ' <div class="item-content"> ';
			if (item['salary_type'] == 1) {
				html += ' エステワンなら日給￥' + daywage_money + '〜 ';
			}
			if (item['salary_type'] == 2) {
				html += ' エステワンならバック￥' + backrate_money + '〜 ';
			}
			html += ' </div> ';
			html += ' </div> ';
		}
		if (item['access'] !== null && item['access'] != '') {
			html += ' <div class="item"> ';
			html += ' <div class="item-tit"><img src="/assets/img/user/job_list/ico_car.svg" alt=""><span>交通</span></div> ';
			html += ' <div class="item-content"> ' + encodeHTMLEntities(item['access']) + '</div> ';
			html += ' </div> ';
		}
		if (item['area3'] !== null && item['area3'] != '') {
			html += ' <div class="item"> ';
			html += ' <div class="item-tit"><img src="/assets/img/user/job_list/ico_building.svg" alt=""><span>所在地</span></div> ';
			html += ' <div class="item-content"> ' + encodeHTMLEntities(item['area3']) + '</div> ';
			html += ' </div> ';
		}
		html += ' <div class="btn-detail-box"> ';
		html += ' <a href="' + base_url + prefarea_area_name2 + '/a_' + item['group_area_id'] +'/recruit/s_' + item['shop_id'] + '/" class="btn-detail">詳細を見る</a> ';
		html += ' </div> ';
		html += ' </div> ';
		html += ' </li> ';

		return html;
	}

	// さらに読み込むボタンのクリックイベント
	$(".more-btn").click(function (event) {
		event.preventDefault();
		$(".more-btn").hide();
		$(".lds-ring").show();
		loadItems();
	});

	function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
});
