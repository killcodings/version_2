<?php
$chosen_brand        = get_field( 'is_brand' );
$brand_setup         = get_field( 'brand_setup', $chosen_brand );

$brand_screen_logo = $brand_setup['icon'];
$background_brand_screen_logo = $brand_setup['icon_background'] ?: 'transparent';
$brand_screen_top_title = $brand_setup['name'];

//$brand_screen_logo = get_field('brand-screen-logo');
//$brand_screen_top_title = get_field('brand-screen-top-title');
//$background_brand_screen_logo = get_field('background-brand-screen-logo') ?: 'transparent';

$opacity_bg = get_field('opacity-bg') ?? 0.2;
$lists = get_field('lists');
$brand_screen_color = get_field('brand-screen-color') ? "color:" . get_field('brand-screen-color') : 'color:#000';
$brand_screen_bottom_media = get_field('brand-screen-bottom-media');

acf_block_before( 'Блок бренда', $is_preview );

?>

<div class="brand-screen">
	<div class="brand-screen-top" style="--background-brand-screen-logo:<?=$background_brand_screen_logo?>;--opacity-bg:<?=$opacity_bg?>;<?= $brand_screen_color ?>;">
		<div class="brand-screen-top__logo">
            <?= app_get_image( [ 'id' => $brand_screen_logo ] ) ?>
		</div>
		<h2 class="brand-screen-top__title"><?= $brand_screen_top_title ?></h2>
		<div class="block-bonuses">
            <?php
            $bonus = get_field('bonus');
            foreach ( $bonus as $key => $item ): ?>
                <div class="bonus">
                    <div class="bonus__icon">
                        <?php $is_icon_bonus = $item['is_icon_bonus'];
                        if ($is_icon_bonus === 'percent') : ?>
                        <svg class="bonus__icon-item" width="18" height="18" fill="none">
                            <use xlink:href="#bonus__icon-item-percent"></use>
                        </svg>
                        <?php endif;
                        if ($is_icon_bonus === 'present') : ?>
                        <svg class="bonus__icon-item" width="16" height="16" fill="none">
                            <use xlink:href="#bonus__icon-item-present"></use>
                        </svg>
                        <?php endif; ?>
                    </div>
                    <div class="bonus__description"><?= $item['bonus_description'] ?></div>
                </div>
            <?php endforeach; ?>
		</div>
        <InnerBlocks/>
	</div>

    <?php if (get_field('brand_screen_bottom')) : ?>
	<div class="brand-screen-bottom">
		<div class="brand-screen-bottom__content">

			<?php
			$list_setting = [
				'list' => $lists['list']
			];

			echo get_component( 'lists/lists', $list_setting );

            $settings = get_field('settings');

            $deposit_methods_setting = [
            'settings' => $settings
            ];

            echo get_component( 'deposit-methods/deposit-methods', $deposit_methods_setting );
			?>

        </div>
        <div class="brand-screen-bottom__media">
            <?=

            app_get_image(['id' => $brand_screen_bottom_media]);

            ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php
acf_block_after( $is_preview );