<!-- The Modal SNS-->
<div id="modalSns" class="modal modal-sns">
	<!-- Modal content -->
	<div class="modal-content">
		<span class="close closeSns">
			<?php echo Asset::img('user/common/ico_close.svg', ['alt' => '']) ?>
		</span>
		<div class="modal-header">
			<div class="modal-header-bg">
				<picture>
					<source media="(max-width:450px)" srcset="/assets/img/user/modal/modal-header-SP.svg">
					<?php echo Asset::img('user/modal/modal-header.svg', ['alt' => '']) ?>
					</span>
				</picture>
			</div>
			<div class="modal-header-ico">
				<picture>
					<source media="(max-width:450px)" srcset="/assets/img/user/modal/ico-sns-SP.svg">
					<?php echo Asset::img('user/modal/ico-sns.svg', ['alt' => '']) ?>
				</picture>
			</div>
			<div class="tit txt-green">SNSで応募・質問する</div>
		</div>
		<div class="modal-body">
			<div class="heading-2"><?php echo $shop['shop_name_estheone'] ?></div>
			<p class="mgb35">メンズエステ(<?php echo $shop['shopstatus_icon_txt'] ?>)｜<?php echo $area['area_name'] ?></p>
			<div class="heading-3">「エステワンを見ました」</div>
			<div class="heading-4">と伝えるとスムーズにご案内できます。</div>
			<!-- add class "disabled" if disable button add friend-->
			<div class="add-friend <?php echo $shop['saiyo_line_url'] ? '' : 'disabled' ?>">
				<div class="btn-add-friend"><a href="<?php echo $shop['saiyo_line_url'] ?>" target="_blank" onmousedown="<?php echo $datalayer_line_url ?>" class="<?php echo $media == CONST_ENV_SP ? 'js-sp_linetap_b' : '' ?>">
						<?php echo Asset::img('user/modal/ico_add_friend.svg', ['alt' => '']) ?>友達追加をする</a></div>
					<small>※アカウント名が異なる場合がございます</small>
			</div>
			<!-- add class "disabled" if disable button copy ID -->
			<!-- add class "copied" if copied button copy ID, change text to コピーしました -->
			<div class="copy-id <?php echo $shop['saiyo_line_id'] ? '' : 'disabled' ?>" id="copy-id-box">
				<p>友達追加がうまくいかない時は<br class="is-sp">ID検索してみてください。</p>
				<button class="btn-copy-id <?php echo $media == CONST_ENV_SP ? 'js-sp_linetap_b' : '' ?>" id="copyButton" onmousedown="<?php echo $datalayer_line_id ?>">
					<div class="ico-copy"></div>
					<span id="copy-id-text">IDをコピーする</span>
				</button>
			</div>
			<input type="text" id="copyTarget" value="<?php echo $shop['saiyo_line_id'] ?>">
		</div>
		<div class="divider"></div>
		<div class="modal-footer">
			SNSからのご応募・ご質問を受け付けています。<br>不明な点やご質問など、お気軽にお問い合わせください。
		</div>
	</div>

</div>