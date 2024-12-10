<div class="main main-page">
	<?php echo View::forge("user/common/pankuzu", ['pankuzu' => $pankuzu ?? []], false)->render(); ?>
	<div class="apply_box_container">
		<?php echo View::forge('user/parts/apply_box', ['shop' => $shop, 'media' => $media]); ?>
	</div>
	<div class="sec-job-detail">
		<div class="inner-860">
			<div class="box-white">
				<div class="job-title"><?php echo htmlentities($shop['title']) ?></div>
				<div class="content">
					<h1 class="store-name"><?php echo htmlentities($shop['shop_name_estheone']) ?></h1>
					<div class="des"><?php echo $area['area_name'] ?>のメンズエステ求人（<?php echo $shop['shopstatus_icon_txt'] ?>）</div>
					<?php if (isset($shop['img_name'])) { ?>
						<img src="<?php echo $env_img_url ?><?php echo $shop['img_name'] ?>" alt="<?php echo htmlentities($shop['shop_name_estheone']) ?>の求人画像" class="job-img">
					<?php } else {
						echo Asset::img('user/common/noimage/img_large_pc.png', ['alt' => htmlentities($shop['shop_name_estheone']) . 'の求人画像', 'class' => 'job-img']);
					} ?>
					<?php if ($shop['job_info']) { ?>
						<h2>求人情報</h2>
						<p><?php echo htmlentities($shop['job_info']) ?></p>
					<?php } ?>

					<?php if ((int)$shop['salary_type'] == Model_Qzin_Shop_Detail::SALARY_TYPE_DAYWAGE && $shop['daywage_money'] != null) { ?>
						<div class="price-box">
							<div class="tit">エステワンなら</div>
							<span class="fs20 bold mr10">日給</span>
							<span class="fs30 txt-pink bold"><span class="fs20">￥</span><?php echo number_format($shop['daywage_money']) ?><span class="fs18">～</span></span>
						</div>
					<?php } ?>
					<?php if ((int)$shop['salary_type'] == Model_Qzin_Shop_Detail::SALARY_TYPE_BACKRATE && $shop['backrate_money'] != null) { ?>
						<div class="price-box">
							<div class="tit">エステワンなら</div>
							<span class="fs20 bold mr10">バック</span>
							<span class="fs30 txt-pink bold"><span class="fs20">￥</span><?php echo number_format($shop['backrate_money']) ?><span class="fs18">～</span></span>
						</div>
					<?php } ?>

					<h2>募集要項</h2>
					<div class="description-list">
						<?php if (($shop['provisions'] && $shop['provisions']['qualifications']) || $shop['hitoduma_flg'] != Model_Qzin_Shop_Main::HITODUMA_FLG_OFF || $shop['saiyo']) { ?>
							<div class="item">
								<div class="item-tit">
									<?php echo Asset::img('user/detail/ico_requirements.svg', ['alt' => ""]) ?>
									<span>応募資格</span>
								</div>
								<div class="item-content">
									<ul>
										<?php echo $shop['hitoduma_flg'] != Model_Qzin_Shop_Main::HITODUMA_FLG_OFF ? htmlspecialchars_decode('<li>30代・40代など幅広い年齢層が活躍</li>') : '' ?>
										<?php if ($shop['provisions'] && $shop['provisions']['qualifications']) {
											foreach ($shop['provisions']['qualifications'] as $provision) { ?>
												<li><?php echo $provision ?></li>
										<?php }
										} ?>
									</ul>
									<?php if ($shop['saiyo']) { ?>
										<span><?php echo htmlentities($shop['saiyo']) ?></span>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
						<?php if ($shop['work_area']) { ?>
							<div class="item">
								<div class="item-tit">
									<?php echo Asset::img('user/detail/ico_locate.svg', ['alt' => ""]) ?>
									<span>勤務地</span>
								</div>
								<div class="item-content">
									<?php echo htmlentities($shop['work_area']) ?>
								</div>
							</div>
						<?php } ?>
						<?php if (($shop['provisions'] && $shop['provisions']['salaries']) || $shop['salary_type'] != 0) { ?>
							<div class="item">
								<div class="item-tit">
									<?php echo Asset::img('user/detail/ico_pig.svg', ['alt' => ""]) ?>
									<span>給与</span>
								</div>
								<div class="item-content">
									<ul>
										<?php if ($shop['provisions'] && $shop['provisions']['salaries']) {
											foreach ($shop['provisions']['salaries'] as $provision) { ?>
												<li><?php echo $provision ?></li>
										<?php }
										} ?>
									</ul>
									<?php if ((int)$shop['salary_type'] == Model_Qzin_Shop_Detail::SALARY_TYPE_DAYWAGE) { ?>
										<span>
											日給<?php echo number_format($shop['daywage_money']) ?>円以上　<?php echo htmlentities($shop['daywage_text']) ?>
										</span>
									<?php } ?>
									<?php if ((int)$shop['salary_type'] == Model_Qzin_Shop_Detail::SALARY_TYPE_BACKRATE) { ?>
										<span>
											バック<?php echo number_format($shop['backrate_money']) ?>円以上　<?php echo htmlentities($shop['backrate_text']) ?>
										</span>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
						<?php if (($shop['provisions'] && $shop['provisions']['working_days']) || $shop['work_day'] || $shop['tainyu_flg'] != Model_Qzin_Shop_Main::TAINYU_FLG_OFF) { ?>
							<div class="item">
								<div class="item-tit">
									<?php echo Asset::img('user/detail/ico_calenda.svg', ['alt' => ""]) ?>
									<span>勤務日</span>
								</div>
								<div class="item-content">
									<ul>
										<?php echo $shop['tainyu_flg'] != Model_Qzin_Shop_Main::TAINYU_FLG_OFF ? htmlspecialchars_decode('<li>体験入店OK</li>') : '' ?>
										<?php if ($shop['provisions'] && $shop['provisions']['working_days']) {
											foreach ($shop['provisions']['working_days'] as $provision) { ?>
												<li><?php echo $provision ?></li>
										<?php }
										} ?>
									</ul>
									<span><?php echo htmlentities($shop['work_day']) ?></span>
								</div>
							</div>
						<?php } ?>
						<?php if (($shop['provisions'] && $shop['provisions']['working_hours']) || $shop['work_time']) { ?>
							<div class="item">
								<div class="item-tit">
									<?php echo Asset::img('user/detail/ico_clock.svg', ['alt' => ""]) ?>
									<span>勤務時間</span>
								</div>
								<div class="item-content">
									<ul>
										<?php if ($shop['provisions'] && $shop['provisions']['working_hours']) {
											foreach ($shop['provisions']['working_hours'] as $provision) { ?>
												<li><?php echo $provision ?></li>
										<?php }
										} ?>
									</ul>
									<span><?php echo htmlentities($shop['work_time']) ?></span>
								</div>
							</div>
						<?php } ?>
						<?php if (($shop['provisions'] && $shop['provisions']['reception_hours']) || $shop['saiyo_open_time'] || $shop['saiyo_close_time']) { ?>
							<div class="item">
								<div class="item-tit">
									<?php echo Asset::img('user/detail/ico_user_clock.svg', ['alt' => ""]) ?>
									<span>受付時間</span>
								</div>
								<div class="item-content">
									<ul>
										<?php if ($shop['provisions'] && $shop['provisions']['reception_hours']) {
											foreach ($shop['provisions']['reception_hours'] as $provision) { ?>
												<li><?php echo $provision ?></li>
										<?php }
										} ?>
									</ul>
									<span><?php echo mb_substr($shop['saiyo_open_time'], 0, 2) . ":" . mb_substr($shop['saiyo_open_time'], 2, 4) ?>&nbsp;～&nbsp;<?php echo mb_substr($shop['saiyo_close_time'], 0, 2) . ":" . mb_substr($shop['saiyo_close_time'], 2, 4) ?></span>
								</div>
							</div>
						<?php } ?>
						<?php if (($shop['provisions'] && $shop['provisions']['benefits']) || $shop['mikeiken_flg'] != Model_Qzin_Shop_Main::MIKEIKEN_FLG_OFF) { ?>
							<div class="item">
								<div class="item-tit">
									<?php echo Asset::img('user/detail/ico_heart.svg', ['alt' => ""]) ?>
									<span>待遇・福利厚生</span>
								</div>
								<div class="item-content">
									<ul>
										<?php echo $shop['mikeiken_flg'] != Model_Qzin_Shop_Main::MIKEIKEN_FLG_OFF ? htmlspecialchars_decode('<li>未経験者歓迎</li>') : '' ?>
										<?php if ($shop['provisions'] && $shop['provisions']['benefits']) {
											foreach ($shop['provisions']['benefits'] as $provision) { ?>
												<li><?php echo $provision ?></li>
										<?php }
										} ?>
									</ul>
								</div>
							</div>
						<?php } ?>
					</div>

					<h2>お店情報</h2>
					<div class="info-list">
						<div class="row">
							<div class="tit">店舗名</div>
							<div class="info"><?php echo htmlentities($shop['shop_name_estheone']) ?></div>
						</div>
						<div class="row">
							<div class="tit">業種</div>
							<div class="info">メンズエステ(<?php echo $shop['shopstatus_icon_txt'] ?>)</div>
						</div>
						<div class="row">
							<div class="tit">エリア</div>
							<div class="info">
								<?php $group_area_id = $area['group_area_id'] != 0 ? $area['group_area_id'] : $area['area_id']; ?>
								<a href="<?php echo Uri::base() . "{$prefarea['area_name2']}/a_{$group_area_id}" ?>/"><?php echo $shop['area2_name'] ?></a>
							</div>
						</div>
						<div class="row">
							<div class="tit">住所</div>
							<div class="info"><?php echo htmlentities($shop['area3']) ?></div>
						</div>
						<div class="row">
							<div class="tit">交通</div>
							<div class="info"><?php echo htmlentities($shop['access']) ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="sec-search-jobs-by-area">
		<div class="inner-860">
			<div class="sec-title">
				<?php echo Asset::img('user/top/ico_search.svg', ['alt' => "", 'class' => 'ico-search']) ?>
				<h2 class="line-pink">エリアからメンズエステ求人を探す</h2>
			</div>
			<?php echo View::forge('user/parts/search_area', ['areas' => $prefareas]); ?>
		</div>
	</section>
</div>
<input type="hidden" id="shop_autonum_hid" class="js-shop_autonum_hid" value="<?php echo $shop['id']; ?>">
<?php echo View::forge('user/modals/modal_area'); ?>
<?php echo View::forge('user/modals/modal_sns', ['shop' => $shop, 'datalayer_line_url' => $datalayer_line_url, 'datalayer_line_id' => $datalayer_line_id, 'media' => $media]); ?>
<?php echo View::forge('user/modals/modal_tel', ['shop' => $shop, 'datalayer_tel' => $datalayer_tel, 'media' => $media]); ?>