<?php

$is_badge        = get_field( 'is_badge' ) ?? false;
$position_badge  = get_field( 'position_badge' ) ?? 'auto';
$text_badge      = get_field('text_badge');
$class_name      = $block['className'] ?? '';

acf_block_before( 'Баннер I', $is_preview );
?>
    <div class="banner <?= $class_name ?>" style="--color-text:#fff;">
        <?php if ($is_badge): ?>
        <p class="banner__label badge" style="--label-position:auto;--color-text:#000;">
            <?= $text_badge ?>
<!--            <i class="icon-award-empty"></i>-->
            <svg class="badge__icon" width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.605 7.445L2 12L4.5 10.5L7 12L6.395 7.44M8 4.5C8 6.433 6.433 8 4.5 8C2.567 8 1 6.433 1 4.5C1 2.567 2.567 1 4.5 1C6.433 1 8 2.567 8 4.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </p>
        <?php endif; ?>

        <InnerBlocks/>

        <?php

        $buttons_main_setting = [
	        'add_buttons'            => $add_buttons,
	        'buttons_setting'        => $buttons_setting,
	        'columns'                => $columns
        ];

        echo get_component( 'buttons/buttons-main', $buttons_main_setting );

        ?>



        <!--<InnerBlocks/>-->
<!--        <div class="buttons buttons_columns-2" style="--position-btn:center">
            <button class="buttons__item button"
                    style="--buttons-color-text: #d02e4b;--buttons-background:#fff;--buttons-color-hover:#fff;--buttons-background-hover:#d02e4b;--button-width:174px;--position-btn:flex-end"">
            Button 1
            </button>
            <a class="buttons__item button" style="--button-width:174px;--position-btn:flex-start">
                Button 2
            </a>
        </div>-->
        <!-- -->
    </div>
<?php acf_block_after( $is_preview );
