<div class="white-box is-pc">
    <?php if (!empty($areas)) { ?>
        <?php foreach ($areas as $key => $area) : ?>
            <div class="row">
                <div class="area">
                    <?php echo Asset::img('user/top/ico_locate_' . $area['area_name2'] . '.svg', ['alt' => '']) ?>
                    <?php $area['area_name'] = str_replace('/', '・', $area['area_name']); ?>
                    <?php echo $area['area_name'] ?>
                </div>
                <ul class="list-city">
                    <?php foreach ($area['area_pref'] as $area_pref) : ?>
                        <?php if ($area_pref['has_shop']) { ?>
                            <li class="city-item"><a
                                    href="<?php echo Uri::base() . $area_pref['area_name2'] ?>/"><?php echo $area_pref['area_name'] ?></a>
                            </li>
                        <?php } else { ?>
                            <li class="city-item"><span><?php echo $area_pref['area_name'] ?></span></li>
                        <?php } ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php } ?>
</div>
<div class="white-box-sp is-sp">
    <?php if (!empty($areas)) { ?>
        <?php foreach ($areas as $key => $area) : ?>
            <div class="accordion-box <?php echo $area['area_name2'] ?>" slot="<?php echo $area['has_shop'] ?>">
                <button class="accordion" slot="<?php echo $area['has_shop'] ?>">
                    <?php $area['area_name'] = str_replace('/', '・', $area['area_name']); ?>
                    <?php echo $area['area_name'] ?>
                </button>
                <div class="panel">
                    <ul class="list-city">
                        <?php foreach ($area['area_pref'] as $area_pref) : ?>
                            <?php if ($area_pref['has_shop']) { ?>
                                <li class="city-item"><a
                                        href="<?php echo Uri::base() . $area_pref['area_name2'] ?>/"><?php echo $area_pref['area_name'] ?></a>
                                </li>
                            <?php } else { ?>
                                <li class="city-item"><span><?php echo $area_pref['area_name'] ?></span></li>
                            <?php } ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } ?>
</div>