<?php

$settings = $args['settings'];
$deposit_methods_items = $settings['deposit-methods-items'];


?>


<div class="deposit-methods">
	<div class="deposit-methods-text">
		<h3 class="deposit-methods-text__title"><?= $settings['deposit-methods-text-title'] ?>  Parimatch Deposit Methods</h3>
		<p class="deposit-methods-text__subtitle"><?= $settings['deposit-methods-text-subtitle'] ?> Parimatch supports the following payment systems:</p>
	</div>
	<div class="deposit-methods__items">
        <?php foreach ($deposit_methods_items as $key => $deposit_methods_item) :
            ?>
            <div class="deposit-methods__item border">
                <?= app_get_image([ 'id' => $deposit_methods_item['deposit-methods-item'] ]) ?>
            </div>
        <?php endforeach; ?>
	</div>
</div>