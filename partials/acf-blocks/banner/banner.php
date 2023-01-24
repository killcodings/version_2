<?php

$is_badge        = get_field( 'is_badge' ) ?? false;
$position_badge  = get_field( 'position_badge' ) ?? 'auto';
$text_badge      = get_field('text_badge');
$class_name      = $block['className'] ?? '';

acf_block_before( 'Баннер', $is_preview );
?>
    <div class="banner <?= $class_name ?>" style="--color-text:#fff;">
        <?php if ($is_badge): ?>
        <p class="banner__label badge" style="--label-position:auto;--color-text:#000;">
            <?= $text_badge ?>
<!--            <i class="icon-award-empty"></i>-->
            <svg class="badge__icon" width="9" height="13" fill="none">
                <use xlink:href="#badge__icon" stroke="black"></use>
            </svg>
        </p>
        <?php endif; ?>

        <InnerBlocks/>

    </div>
<?php acf_block_after( $is_preview );
