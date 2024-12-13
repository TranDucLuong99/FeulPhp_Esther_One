<div class="apply-box">
	<div class="heading-3">応募・お問い合わせをする</div>
	<div class="des">
		応募の際は<br>
		<span>「エステワンを見た」</span>と<br>
		お伝えください
	</div>
	<?php
	?>
	<div class="btn-row">
		<?php if(!empty($shop['saiyo_tel'])): ?>
			<div class="btn-tel">
				<button id="btnTel" class="<?php echo $media == CONST_ENV_SP ? 'js-sp_telltap_a' : '' ?>">
					<?php echo Asset::img('user/common/ico_tel.svg', ['alt' => '']) ?>TEL
				</button>
			</div>
		<?php else: ?>
			<div class="btn-tel disabled">
				<button id="btnTel" disabled>
					<?php echo Asset::img('user/common/ico_tel.svg', ['alt' => '']) ?>TEL
				</button>
			</div>
		<?php endif; ?>

		<?php if (!empty($shop['saiyo_line_url']) || !empty($shop['saiyo_line_id'])): ?>
			<div class="btn-sns">
				<button id="btnSns" class="<?php echo $media == CONST_ENV_SP ? 'js-sp_linetap_a' : '' ?>">
					<?php echo Asset::img('user/common/ico_chat.svg', ['alt' => '']) ?>SNS
				</button>
			</div>
		<?php else: ?>
			<div class="btn-sns disabled">
				<button id="btnSns" disabled>
					<?php echo Asset::img('user/common/ico_chat.svg', ['alt' => '']) ?>SNS
				</button>
			</div>
		<?php endif; ?>
	</div>
</div>