<div class="main">
    <section class="sec-search-area">
        <div class="inner-860">
            <div class="sec-title">
                <?php echo Asset::img('user/top/ico_search.svg', ['alt' => '', 'class' => 'ico-search']) ?>
                <h2 class="line-pink">エリアから探す</h2>
            </div>
            <div class="search-area">
                <?php if (!empty($areas)) { ?>
                    <ul class="list-area">
                        <?php foreach ($areas as $key => $area) : ?>
                            <li class="<?php echo $area['area_name2'] ?> area-item">
                                <div class="area-name" slot="<?php echo $area['has_shop'] ?>">
                                    <?php if ($media == 'pc') {
                                        $area['area_name'] = str_replace('/', '・', $area['area_name']); ?>
                                        <?php echo $area['area_name'] ?>
                                    <?php } ?>
                                    <?php if ($media == 'sp') {
                                        if (strpos($area['area_name'], '/')) {
                                            $area_name = explode('/', $area['area_name']);
                                            ?>
                                            <?php echo $area_name[0] ?><br><?php echo $area_name[1] ?>
                                        <?php } else { ?>
                                            <?php echo $area['area_name'] ?>
                                        <?php }
                                    } ?>
                                </div>
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
            <div class="pickup">
                <picture>
                    <source media="(max-width:450px)" srcset="/assets/img/user/top/pickup_bg_SP.svg">
                    <?php echo Asset::img('user/top/pickup_bg.svg', ['alt' => '', 'class' => 'pickup-bg']) ?>
                </picture>
                <div class="pickup-content">
                    <div class="sec-title">
                        <?php echo Asset::img('user/top/ico_pickup.svg', ['alt' => '', 'class' => 'ico-search']) ?>
                        <h2 class="line-white">人気エリア</h2>
                    </div>
                    <?php if (!empty($popular_areas)) { ?>
                        <ul>
                            <?php foreach ($popular_areas as $key => $area) : ?>
                                <li><a href="<?php echo Uri::base() . $area['url']; ?>/"><span><?php echo $area['area_name'] ?></span></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <section class="sec-what-estheone">
        <div class="inner-860">
            <div class="sec-title">
                <picture>
                    <source media="(max-width:450px)" srcset="/assets/img/user/top/what_esthe_one_SP.svg">
                    <?php echo Asset::img('user/top/what_esthe_one.svg', ['alt' => '']) ?>
                </picture>
                <h2 class="line-pink long-line">メンズエステ求人「エステワン」とは？</h2>
            </div>
            <div class="content">
                <p>「今のアルバイトじゃ好きなことに使えるお金が少ない…」<br>
                    「スキマ時間を活かして稼げるアルバイトが見つからない…」 </p>

                <p>そんなお悩みを持っている方、いらっしゃいませんか？<br>
                    実は、「メンズエステ」なら空いた時間でしっかり高収入を目指せるんです！<br>
                    他のアルバイトより高時給だから、1日数時間だけの出勤でも目標金額を達成する女の子が続出中！</p>

                <p>当サイト「エステワン」では、そんな稼げるおしごとのメンズエステ求人を多数掲載しています。<br>
                    働きたいエリアに絞って求人を検索したり、一覧ページでお給料や待遇を比較したり、便利な使い方が盛りだくさん！<br>
                    セラピストになって高収入をゲットしたい女性は、ぜひ「エステワン」で優良メンズエステを見つけてくださいね。
                </p>
            </div>
        </div>
    </section>
    <section class="sec-search-jobs-by-area">
        <div class="inner-860">
            <div class="sec-title">
                <?php echo Asset::img('user/top/ico_search.svg', ['alt' => '', 'class' => 'ico-search']) ?>
                <h2 class="line-pink">エリアからメンズエステ求人を探す</h2>
            </div>
            <?php echo View::forge('user/parts/search_area', ['areas' => $areas]); ?>
        </div>
    </section>
</div>