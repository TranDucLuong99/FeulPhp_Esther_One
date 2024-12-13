<div class="main main-page">
	<?php echo View::forge("user/common/pankuzu", ['pankuzu' => $pankuzu ?? []], false)->render(); ?>
	<section class="sec-site-map">
		<div class="inner-860">
			<div class="sec-title">
				<picture>
					<source media="(max-width:450px)" srcset="/assets/img/user/site_map/site-map-SP.png">
					<?php echo Asset::img('user/site_map/site-map.svg', ['alt' => '']) ?>
				</picture>
				<h1 class="line-pink">サイトマップ</h1>
			</div>
			<h2 class="sec-sub-title">
				<?php echo Asset::img('user/site_map/ico_locate_pink.svg', ['alt' => '']) ?>全国のメンズエステ求人一覧
			</h2>
			<div class="is-pc">
				<?php if (!empty($areas)) { ?>
					<ul class="list-map">
						<?php foreach ($areas as $key => $area) : ?>
							<li>
								<div class="heading-4">
									<?php echo Asset::img('user/site_map/ico_locate_' . $area['area_name2'] . '.svg', ['alt' => '']) ?>
									<?php echo str_replace('/', '・', $area['area_name']); ?>
								</div>
								<ul>
									<?php foreach ($area['area_pref'] as $area_pref) : ?>
										<li>
											<?php if ($area_pref['has_shop']) { ?>
												<a href="<?php echo Uri::base() . $area_pref['area_name2'] ?>/"><?php echo $area_pref['area_name'] ?>のメンズエステ求人</a>
											<?php } else { ?>
												<span><?php echo $area_pref['area_name'] ?>のメンズエステ求人</span>
											<?php } ?>
										</li>
									<?php endforeach; ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php } ?>
			</div>
			<div class="white-box-sp is-sp">
				<?php if (!empty($areas)) { ?>
					<?php foreach ($areas as $key => $area) : ?>
						<div class="accordion-box <?php echo $area['area_name2'] ?>" slot="<?php echo $area['has_shop'] ?>">
							<button class="accordion"
								slot="<?php echo $area['has_shop'] ?>"><?php echo str_replace('/', '・', $area['area_name']); ?></button>
							<div class="panel">
								<ul class="list-city">
									<?php foreach ($area['area_pref'] as $area_pref) : ?>
										<li class="city-item">
											<?php if ($area_pref['has_shop']) { ?>
												<a href="<?php echo Uri::base() . $area_pref['area_name2'] ?>/"><?php echo $area_pref['area_name'] ?>のメンズエステ求人</a>
											<?php } else { ?>
												<span><?php echo $area_pref['area_name'] ?>のメンズエステ求人</span>
											<?php } ?>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php endforeach; ?>
				<?php } ?>
			</div>
		</div>
	</section>
</div>