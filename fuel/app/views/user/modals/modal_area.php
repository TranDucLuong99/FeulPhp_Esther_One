<!-- The Modal select area-->
<div id="modalArea" class="modal modal-select-area">
	<!-- Modal content -->
	<div class="modal-content">
		<span class="close closeArea">
			<?php echo Asset::img('user/common/ico_close.svg', ['alt' => '']) ?>
		</span>

		<div class="modal-body">
			<div class="is-pc">
				<div class="modal-title">
					<?php echo Asset::img('user/modal/modal_ico_locate_pink.svg', ['alt' => '']) ?>
					<span><?php echo $prefarea['area_name_rp'] ?></span>のエリアから探す
				</div>
				<?php if (!empty($areas)) { ?>
					<ul class="provinces">
						<li><a href="<?php echo Uri::base() . $prefarea['area_name2'] ?>/"><?php echo $prefarea['area_name_rp'] ?>
								すべて</a></li>
						<?php foreach ($areas as $key => $area) : ?>
							<li slot="<?php echo $area['has_shop'] ?>">
								<?php if ($area['has_shop']) { ?>
									<a href="<?php echo Uri::create($area['url']); ?>/"><?php echo $area['area_name'] ?></a>
								<?php } else { ?>
									<span><?php echo $area['area_name'] ?></span>
								<?php } ?>
							</li>
						<?php endforeach; ?>
					</ul>
					<div class="divider"></div>
				<?php } ?>

				<div class="modal-title">
					<?php echo Asset::img('user/modal/modal_ico_locate_pink.svg', ['alt' => '']) ?>他の都道府県から探す
				</div>
				<div class="search-area">
					<?php if (!empty($prefareas)) { ?>
						<ul class="list-area">
							<?php foreach ($prefareas as $key => $area) : ?>
								<li class="<?php echo $area['area_name2'] ?> area-item">
									<div class="area-name"
										slot="<?php echo $area['has_shop'] ?>"><?php echo str_replace('/', '・', $area['area_name']) ?></div>
									<ul class="list-city">
										<?php foreach ($area['area_pref'] as $area_pref) : ?>
											<li class="city-item">
												<?php if ($area_pref['has_shop']) { ?>
													<a href="<?php echo Uri::base() . $area_pref['area_name2'] ?>/"><?php echo $area_pref['area_name'] ?></a>
												<?php } else { ?>
													<span><?php echo $area_pref['area_name'] ?></span>
												<?php } ?>
											</li>
										<?php endforeach; ?>
									</ul>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php } ?>
				</div>
			</div>
			<div class="white-box-sp is-sp">
				<div class="accordion-box accordion-box-first" slot="<?php echo $area['has_shop'] ?>">
					<button class="accordion accordion-title" slot="<?php echo $area['has_shop'] ?>">
						<?php echo Asset::img('user/modal/modal_ico_locate_pink.svg', ['alt' => '']) ?>
						<span><?php echo $prefarea['area_name_rp'] ?></span>のエリアから探す
					</button>
					<div class="panel">
						<?php if (!empty($areas)) { ?>
							<ul class="list-city">
								<li class="city-item"><a
										href="<?php echo Uri::base() . $prefarea['area_name2'] ?>/"><?php echo $prefarea['area_name_rp'] ?>
										すべて</a></li>
								<?php foreach ($areas as $key => $area) : ?>
									<li class="city-item">
										<?php if ($area['has_shop']) { ?>
											<a href="<?php echo Uri::create($area['url']); ?>/"><?php echo $area['area_name'] ?></a>
										<?php } else { ?>
											<span><?php echo $area['area_name'] ?></span>
										<?php } ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php } ?>
					</div>
				</div>
				<div class="modal-title">
					<?php echo Asset::img('user/modal/modal_ico_locate_pink.svg', ['alt' => '']) ?>他の都道府県から探す
				</div>
				<?php if (!empty($prefareas)) { ?>
					<?php foreach ($prefareas as $key => $area) : ?>
						<div class="accordion-box <?php echo $area['area_name2'] ?>" slot="<?php echo $area['has_shop'] ?>">
							<button class="accordion" slot="<?php echo $area['has_shop'] ?>"><?php echo str_replace('/', '・', $area['area_name']) ?></button>
							<div class="panel">
								<ul class="list-city">
									<?php foreach ($area['area_pref'] as $area_pref) : ?>
										<li class="city-item">
											<?php if ($area_pref['has_shop']) { ?>
												<a href="<?php echo Uri::base() . $area_pref['area_name2'] ?>/"><?php echo $area_pref['area_name'] ?></a>
											<?php } else { ?>
												<span><?php echo $area_pref['area_name'] ?></span>
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
	</div>

</div>