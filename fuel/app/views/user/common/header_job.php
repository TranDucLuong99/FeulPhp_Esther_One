<header class="header-page list-page">
	<div class="inner-860 flex-between">
		<div class="logo-box">
			<a href="<?php echo Uri::create('/'); ?>">
				<?php echo Asset::img('user/common/logo.svg', ['alt' => 'メンズエステ求人エステワン']) ?>
			</a>
			<div class="prefecture-name"><?php echo $area['area_name_rp'] ?></div>
		</div>
		<div class="btn-box">
			<div class="icon-search"></div>
			<button class="btn-change-area" id="btnArea">
				<?php echo Asset::img('user/common/ico_locate_white.svg', ['alt' => '']) ?>
				エリアを選択
			</button>
		</div>
	</div>
</header>