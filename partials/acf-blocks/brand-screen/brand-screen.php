<?php

$brand_screen_logo = get_field('brand-screen-logo');
$brand_screen_top_title = get_field('brand-screen-top-title');
$background_brand_screen_logo = get_field('background-brand-screen-logo') ?: 'transparent';
$opacity_bg = get_field('opacity-bg') ?? 0.2;

$lists = get_field('lists');

acf_block_before( 'Блок бренда', $is_preview );

?>

<div class="brand-screen">
	<div class="brand-screen-top" style="--background-brand-screen-logo:<?=$background_brand_screen_logo?>;--opacity-bg:<?=$opacity_bg?>;--background-font-icon:#893645;--section-background:var(--accent-color);--text-color: #fff;--color-icon:#fff;">
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
                    <svg class="bonus__icon-item" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.1309 2.51042L2.50169 15.1396M6.11003 3.86355C6.11003 5.10906 5.10034 6.11875 3.85482 6.11875C2.6093 6.11875 1.59961 5.10906 1.59961 3.86355C1.59961 2.61803 2.6093 1.60834 3.85482 1.60834C5.10034 1.60834 6.11003 2.61803 6.11003 3.86355ZM16.0329 13.7865C16.0329 15.032 15.0233 16.0417 13.7777 16.0417C12.5322 16.0417 11.5225 15.032 11.5225 13.7865C11.5225 12.5409 12.5322 11.5313 13.7777 11.5313C15.0233 11.5313 16.0329 12.5409 16.0329 13.7865Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php endif;
                    if ($is_icon_bonus === 'present') : ?>
                    <svg class="bonus__icon-item" width="16" height="16" viewBox="0 0 16 16" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_5585_42168)">
                            <path d="M13.2575 7.95447V14.5833H2.65144V7.95447M7.95447 14.5833V4.64008M7.95447 4.64008H4.97152C4.532 4.64008 4.11049 4.46548 3.7997 4.1547C3.48892 3.84391 3.31432 3.4224 3.31432 2.98288C3.31432 2.54336 3.48892 2.12185 3.7997 1.81107C4.11049 1.50028 4.532 1.32568 4.97152 1.32568C7.29159 1.32568 7.95447 4.64008 7.95447 4.64008ZM7.95447 4.64008H10.9374C11.3769 4.64008 11.7985 4.46548 12.1092 4.1547C12.42 3.84391 12.5946 3.4224 12.5946 2.98288C12.5946 2.54336 12.42 2.12185 12.1092 1.81107C11.7985 1.50028 11.3769 1.32568 10.9374 1.32568C8.61735 1.32568 7.95447 4.64008 7.95447 4.64008ZM1.32568 4.64008H14.5833V7.95447H1.32568V4.64008Z"
                                  stroke="white" stroke-width="1.32841" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_5585_42168">
                                <rect width="15.9091" height="15.9091" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <?php endif; ?>
                </div>
				<div class="bonus__description"><?= $item['bonus_description'] ?></div>
			</div>
        <?php endforeach; ?>
		</div>

        <InnerBlocks/>
<!--		<div class="buttons" style="--position-btn:center">
			<button class="buttons__item button button_icon"
			        style="--button-width:294px;--buttons-padding:12px">
				Join Now
			</button>
		</div>-->
<!--		<p class="brand-screen-top__info">Bet365 is an international betting company with an office in Cyprus. It was founded in 1994 in Kyiv (Ukraine) Parimatchcompany with an office in Cyprus.Parimatch is an international be(Ukraine) Parimatchcompany with an office in Cyprus.Parimatch is an international</p>
-->

	</div>

	<div class="brand-screen-bottom">
		<div class="brand-screen-bottom__content">

			<?php
			$list_setting = [
				'list' => $lists['list']
			];

			echo get_component( 'lists/lists', $list_setting );
			?>


        </div>
    </div>

<?php acf_block_after( $is_preview );