<div class="main main-page">
	<?php echo View::forge("user/common/pankuzu", ['pankuzu' => $pankuzu ?? []], false)->render(); ?>
	<section class="sec-list-job">
		<div class="inner-860">
			<h1 class="sec-title">
				<?php echo Asset::img('user/job_list/ico_locate_pink.svg', ['alt' => '']) ?>
				<span><?php echo $area['area_name_rp'] ?></span>のメンズエステ求人
			</h1>
			<div class="result-cnt">
				全<span><?php echo $total_shop_mains_record ?></span>件
			</div>
			<ul class="jobs">
				<?php foreach ($shops as $shop) { ?>
					<li>
						<a href="<?php echo Uri::base() . "{$prefarea['area_name2']}/a_{$shop['group_area_id']}/recruit/s_{$shop['shop_id']}" ?>/">
							<div class="job-tit">
								<?php echo htmlentities($shop['title']) ?>
							</div>
						</a>
						<a href="<?php echo Uri::base() . "{$prefarea['area_name2']}/a_{$shop['group_area_id']}/recruit/s_{$shop['shop_id']}" ?>/">
<!--							--><?php //if (isset($shop['img_name'])) { ?>
<!--								<img src="--><?php //echo $env_img_url ?><!----><?php //echo $shop['img_nameimg_name'] ?><!--" alt="--><?php //echo htmlentities($shop['shop_name_estheone']) ?><!--の求人画像" class="job-img">-->
<!--							--><?php //} else {
//								echo Asset::img('user/common/noimage/img_large_pc.png', ['alt' => htmlentities($shop['shop_name_estheone']) . 'の求人画像', 'class' => 'job-img']);
//							} ?>
                            <img src="https://d2mo334kw8autn.cloudfront.net/shop_img/34257.jpg" alt="">
						</a>
						<a href="<?php echo Uri::base() . "{$prefarea['area_name2']}/a_{$shop['group_area_id']}/recruit/s_{$shop['shop_id']}" ?>/">
							<h2 class="store-name">
								<?php echo htmlentities($shop['shop_name_estheone']) ?>
							</h2>
						</a>
						<?php if (intval($shop['salary_type']) == 0) { ?>
						<?php } else if (intval($shop['salary_type']) == 1) { ?>
							<div class="price-box">
								<div class="tit">エステワンなら</div>
								<span class="fs20 bold mr10">日給</span>
								<span class="fs20 txt-pink bold">￥</span>
								<span class="fs30 txt-pink bold">
									<?php echo number_format($shop['daywage_money']) ?><span class="fs18">～</span>
								</span>
							</div>
						<?php } else if (intval($shop['salary_type']) == 2) { ?>
							<div class="price-box">
								<div class="tit">エステワンなら</div>
								<span class="fs20 bold">バック</span>
								<span class="fs20 txt-pink bold">￥</span>
								<span class="fs30 txt-pink bold">
									<?php echo number_format($shop['backrate_money']) ?><span class="fs18">～</span>
								</span>
							</div>
						<?php } ?>
						<div class="description-list">
							<?php if ($shop['saiyo'] != null && $shop['saiyo'] != '') { ?>
								<div class="item">
									<div class="item-tit">
										<?php echo Asset::img('user/job_list/ico_requirements.svg', ['alt' => '']) ?>
										<span>応募資格</span>
									</div>
									<div class="item-content">
										<?php echo htmlentities($shop['saiyo']) ?>
									</div>
								</div>
							<?php } ?>
							<?php if ($shop['work_area'] != null && $shop['work_area'] != '') { ?>
								<div class="item">
									<div class="item-tit">
										<?php echo Asset::img('user/job_list/ico_locate.svg', ['alt' => '']) ?>
										<span>勤務地</span>
									</div>
									<div class="item-content">
										<?php echo htmlentities($shop['work_area']) ?>
									</div>
								</div>
							<?php } ?>
							<?php if ($shop['work_time'] != null && $shop['work_time'] != '') { ?>
								<div class="item">
									<div class="item-tit">
										<?php echo Asset::img('user/job_list/ico_clock.svg', ['alt' => '']) ?>
										<span>勤務時間</span>
									</div>
									<div class="item-content">
										<?php echo htmlentities($shop['work_time']) ?>
									</div>
								</div>
							<?php } ?>
							<?php if (intval($shop['salary_type']) != 0) { ?>
								<div class="item">
									<div class="item-tit">
										<?php echo Asset::img('user/job_list/ico_pig.svg', ['alt' => '']) ?>
										<span>給与</span>
									</div>
									<div class="item-content">
										<?php if (intval($shop['salary_type']) == 1) { ?>
											エステワンなら日給￥<?php echo $shop['daywage_money'] != null ? number_format($shop['daywage_money']) : "000,000" ?>〜
										<?php } else if (intval($shop['salary_type']) == 2) { ?>
											エステワンならバック￥<?php echo $shop['backrate_money'] != null ? number_format($shop['backrate_money']) : "000,000" ?>〜
										<?php } ?>
									</div>
								</div>
							<?php } ?>
							<?php if ($shop['access'] != null && $shop['access'] != '') { ?>
								<div class="item">
									<div class="item-tit">
										<?php echo Asset::img('user/job_list/ico_car.svg', ['alt' => '']) ?>
										<span>交通</span>
									</div>
									<div class="item-content">
										<?php echo htmlentities($shop['access']) ?>
									</div>
								</div>
							<?php } ?>
							<?php if ($shop['area3'] != null && $shop['area3'] != '') { ?>
								<div class="item">
									<div class="item-tit">
										<?php echo Asset::img('user/job_list/ico_building.svg', ['alt' => '']) ?>
										<span>所在地</span>
									</div>
									<div class="item-content">
										<?php echo htmlentities($shop['area3']) ?>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="btn-detail-box">
							<a href="<?php echo Uri::base() . "{$prefarea['area_name2']}/a_{$shop['group_area_id']}/recruit/s_{$shop['shop_id']}" ?>/" class="btn-detail">詳細を見る</a>
						</div>
					</li>

				<?php } ?>
			</ul>

			<!-- 読み込みインジケーター -->
			<div class="lds-ring">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>

			<?php if ($total_shop_mains_record > $limit_shop_per_page) { ?>
				<input id="remaining_shops_autonum" type="hidden" value="<?php echo $remaining_shops_autonum ?>" />
				<input id="prefarea_area_name2" type="hidden" value="<?php echo $prefarea['area_name2'] ?>" />
				<a href="" class="more-btn">もっと見る</a>
			<?php } ?>
		</div>
	</section>
	<section class="sec-search-jobs-by-area">
		<div class="inner-860">
			<div class="sec-title">
				<?php echo Asset::img('user/top/ico_search.svg', ['alt' => '', 'class' => 'ico-search']) ?>
				<h2 class="line-pink">エリアからメンズエステ求人を探す</h2>
			</div>
			<?php echo View::forge('user/parts/search_area', ['areas' => $prefareas]); ?>
		</div>
	</section>
</div>

<!-- JS で使用される変数 -->
<script>
	let total_shop_mains_record = <?php echo $total_shop_mains_record ?>;
	let limit_shop_per_page = <?php echo $limit_shop_per_page ?>;
</script>

<?php echo View::forge('user/modals/modal_area'); ?>