<!-- The Modal tel-->
<div id="modalTel" class="modal modal-tel">
	<!-- Modal content -->
	<div class="modal-content">
		<span class="close closeTel">
			<?php echo Asset::img('user/common/ico_close.svg', ['alt' => '']) ?>
		</span>
		<div class="modal-header">
			<div class="modal-header-bg">
				<picture>
					<source media="(max-width:450px)" srcset="/assets/img/user/modal/modal-header-SP.svg">
					<?php echo Asset::img('user/modal/modal-header.svg', ['alt' => '']) ?>
				</picture>
			</div>
			<div class="modal-header-ico">
				<picture>
					<source media="(max-width:450px)" srcset="/assets/img/user/modal/ico_tel_SP.svg">
					<?php echo Asset::img('user/modal/ico_tel.svg', ['alt' => '']) ?>
				</picture>
			</div>
			<div class="tit">電話で応募・質問する</div>
		</div>
		<div class="modal-body">
			<div class="heading-2"><?php echo $shop['shop_name_estheone'] ?></div>
			<p class="mgb35">メンズエステ(<?php echo $shop['shopstatus_icon_txt'] ?>)｜<?php echo $area['area_name'] ?></p>
			<div class="heading-3">「エステワンを見ました」</div>
			<div class="heading-4 <?php echo (int)$shop['salary_type'] == Model_Qzin_Shop_Detail::SALARY_TYPE_NO ? 'no-price-box' : '' ?>">と伝えるとスムーズにご案内できます。</div>
			<?php if ((int)$shop['salary_type'] == Model_Qzin_Shop_Detail::SALARY_TYPE_DAYWAGE) { ?>
				<div class="price-box">
					<div class="tit">エステワンなら</div>
					<span class="fs20 bold mr10">日給</span>
					<span class="fs20 txt-pink bold">￥</span>
					<span class="fs30 txt-pink bold"><?php echo number_format($shop['daywage_money']) ?></span>
					<span class="fs18 txt-pink bold">～</span>
				</div>
			<?php } ?>
			<?php if ((int)$shop['salary_type'] == Model_Qzin_Shop_Detail::SALARY_TYPE_BACKRATE) { ?>
				<div class="price-box">
					<div class="tit">エステワンなら</div>
					<span class="fs20 bold mr10">バック</span>
					<span class="fs20 txt-pink bold">￥</span>
					<span class="fs30 txt-pink bold"><?php echo number_format($shop['backrate_money']) ?></span>
					<span class="fs18 txt-pink bold">～</span>
				</div>
			<?php } ?>
			<div class="is-pc"><a href="" class="phone-num"><?php echo $shop['saiyo_tel'] ?></a></div>
			<div class="time">受付時間
				<span><?php echo mb_substr($shop['saiyo_open_time'], 0, 2) . ":" . mb_substr($shop['saiyo_open_time'], 2, 4) ?>&nbsp;～&nbsp;<?php echo mb_substr($shop['saiyo_close_time'], 0, 2) . ":" . mb_substr($shop['saiyo_close_time'], 2, 4) ?></span>
			</div>
			<div class="is-sp">
				<div class="phone-num-sp"><a href="tel:<?php echo $shop['saiyo_tel'] ?>"
						onmousedown="<?php echo $datalayer_tel ?>" class="<?php echo $media == CONST_ENV_SP ? 'js-sp_telltap_b' : '' ?>"><?php echo Asset::img('user/modal/ico_tel_white.svg', ['alt' => '']) ?> 電話をかける</a></div>
			</div>
		</div>
	</div>

</div>