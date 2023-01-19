<?php

$lists = $args['list'];

?>

<svg display="none">
    <symbol id="list__item-icon-pros-id" viewBox="0 0 8 9">
        <path d="M1 4.01898H7" stroke="var(--color-icon)" stroke-width="2" stroke-linecap="round"/>
        <path d="M4 7.01898L4 1.01898" stroke="var(--color-icon)" stroke-width="2" stroke-linecap="round"/>
    </symbol>
    <symbol id="list__item-icon-cons-id" viewBox="0 0 8 3">
        <path d="M1 1.01898H7" stroke="var(--color-icon)" stroke-width="2" stroke-linecap="round"/>
    </symbol>
    <symbol id="list__item-icon-highlights-id" viewBox="0 0 9 7">
        <path d="M1.5 2.51898L4 5.01898L8 1.01898" stroke="var(--color-icon)" stroke-width="2" stroke-linecap="round"/>
    </symbol>
</svg>

<div class="lists">
	<?php foreach ( $lists as $key => $list ) : ?>
        <div class="list" style="--background-font-icon:#F0CFD5;">
            <h3 class="list__title"><?= $list['list_title'] ?></h3>
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