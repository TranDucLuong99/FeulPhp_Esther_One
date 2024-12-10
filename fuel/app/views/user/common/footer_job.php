<footer>
	<div class="footer-icon-pc-mv">
		<picture>
			<source media="(max-width:450px)" srcset="/assets/img/user/common/SP_footer.gif">
			<?php echo Asset::img('user/common/PC_footer.gif', ['alt' => '']) ?>
		</picture>
	</div>
	<picture>
		<source media="(max-width:450px)" srcset="/assets/img/user/top/ico_wave_footer_SP.svg">
		<?php echo Asset::img('user/top/ico_wave_footer.svg', ['alt' => '', 'class' => 'ico-wave']) ?>
	</picture>
	<?php echo View::forge('user/common/parts/footer_menu'); ?>
	<div class="footer-logo">
		<a href="<?php echo Uri::create('/'); ?>">
			<?php echo Asset::img('user/common/logo-white.svg', ['alt' => 'エステワン']) ?>
		</a>
	</div>
	<p class="copy-right">Copyright© メンズエステ専門求人エステワン All rights reserved.</p>

	<div class="to-top-default">
		<a href="#to-top" class="to-top-de scroll-to"></a>
	</div>
</footer>
<div class="to-top-fixed <?php echo $is_detail ? 'page-detail' : '' ?>">
	<a href="#to-top" class="to-top scroll-to"></a>
</div>