<?php

$settings = $args['settings'];
$deposit_methods_items = $settings['deposit-methods-items'];
$is_border = $settings['is_border'] ? ' border' : '';

?>

<div class="deposit-methods">
	<?php if ($settings['deposit-methods-text-title'] || $settings['deposit-methods-text-subtitle']) : ?>
	<div class="deposit-methods-text">
        <?php if ($settings['deposit-methods-text-title']) { ?>
		<h3 class="deposit-methods-text__title"><?= $settings['deposit-methods-text-title'] ?></h3>
        <?php } ?>
        <?php if ($settings['deposit-methods-text-subtitle']) { ?>
		<p class="deposit-methods-text__subtitle"><?= $settings['deposit-methods-text-subtitle'] ?></p>
        <?php } ?>
	</div>
	<?php endif; ?>
	<div class="deposit-methods__items">
        <?php foreach ($deposit_methods_items as $key => $deposit_methods_item) :
            ?>
            <div class="deposit-methods__item <?= $is_border ?>">
                <?= app_get_image([ 'id' => $deposit_methods_item['deposit-methods-item'] ]) ?>
            </div>
        <?php endforeach; ?>
	</div>
</div>