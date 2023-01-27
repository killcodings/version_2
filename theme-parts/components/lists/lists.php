<?php

$lists = $args['list'];

?>


<div class="lists">
	<?php foreach ( $lists as $key => $list ) : ?>
        <div class="list" style="--background-font-icon:#F0CFD5;">
            <h4 class="list__title"><?= $list['list_title'] ?></h4>
			<?php foreach ( $list['list_items'] as $key => $list_item ) :
				$li_icon = $list_item['list_item_li_icon'];
                ?>
                <ul class="list__items">
					<?php foreach ( $list_item['list_item_li'] as $key => $li ): ?>
                        <li class="list__item">
							<?php
							if ( $li_icon === 'plus' ) { ?>
                                <svg class="list__icon list__item-icon-pros" style="--color-icon:#12B76A;">
                                    <use xlink:href="#list__item-icon-pros-id"></use>
                                </svg>
							<?php } ?>
							<?php if ( $li_icon === 'minus' ) { ?>
                                <svg class="list__icon list__item-icon-cons" style="--color-icon:#D02E4B;">
                                    <use xlink:href="#list__item-icon-cons-id"></use>
                                </svg>
							<?php } ?>
							<?php if ( $li_icon === 'tick' ) { ?>
                                <svg class="list__icon list__item-icon-highlights" fill="none" style="--color-icon:#D02E4B;">
                                    <use xlink:href="#list__item-icon-highlights-id"></use>
                                </svg>
							<?php } ?>
							<?= $li['list_item_li_text'] ?>
                        </li>
					<?php endforeach; ?>
                </ul>
			<?php endforeach; ?>
        </div>
	<?php endforeach; ?>
</div>