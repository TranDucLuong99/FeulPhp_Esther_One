<div class="main main-page">
	<?php echo View::forge("user/common/pankuzu", ['pankuzu' => $pankuzu ?? []], false)->render(); ?>
	<section class="sec-content">
		<div class="inner-860">
			<div class="sec-title">
				<picture>
					<source media="(max-width:450px)" srcset="/assets/img/user/pages/operator_infomation_SP.svg">
					<?php echo Asset::img('user/pages/operator_infomation.svg', ['alt' => '']) ?>
				</picture>
				<h1 class="line-pink">運営者情報</h1>
			</div>
			<div class="content">
				<div class="heading-4">運営者</div>
				<p>エステワン運営事務局</p>
				<hr>

				<div class="heading-4">事業内容</div>
				<p>インターネット各種情報提供サイト</p>
				<hr>

				<div class="heading-4">運営サイト</div>
				<p>メンズエステ求人「エステワン」 <br> <a href="/">https://esthe-one.jp/</a></p>
				<hr>

				<div class="heading-4">メールアドレス</div>
				<p>info@esthe-one.jp</p>
				<hr>

				<div class="heading-3">免責事項</div>
				<p>メンズエステ求人「エステワン」（以下、本サービス）では本サービスの広告主（以下、掲載店舗）自ら提供された情報を掲載しております。<br>
					掲載されている情報には掲載店舗の主観的評価や主観的表現、また、時間経過による変化が含まれることをご了承ください。<br>
					本サービスは掲載内容（リンク先ウェブサイトの内容含む）の真偽、完全性を保証するものではありません。<br>
					また、当社の提供する情報を利用したことによって生じるいかなる損害につきましても当社では一切の責任を負いかねます。<br>
					掲載情報および掲載店舗に関しましては、ユーザーご自身の判断と責任においてご利用ください。また、掲載店舗をご利用の際には料金およびサービス内容を改めて各店舗に直接ご確認くださいますようお願いいたします。
				</p>
			</div>
		</div>
	</section>
</div>