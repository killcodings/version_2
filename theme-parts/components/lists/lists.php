<?php

$lists = $args['list'];

?>

<div class="lists">
	<?php foreach ( $lists as $key => $list ) : ?>
        <div class="list" style="--color-icon:#D02E4B;--background-font-icon:#F0CFD5;">
            <h3 class="list__title"><?= $list['list_title'] ?></h3>
			<?php foreach ( $list['list_items'] as $key => $list_item ) :
				$li_icon = $list_item['list_item_li_icon'];
                ?>
                <ul class="list__items">
					<?php foreach ( $list_item['list_item_li'] as $key => $li ): ?>
                        <li class="list__item">
							<?php
							if ( $li_icon === 'plus' ) { ?>
                                <svg class="list__item_pros-icon" width="8" height="9" viewBox="0 0 8 9" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 4.01898H7" stroke="#12B76A" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M4 7.01898L4 1.01898" stroke="#12B76A" stroke-width="2"
                                          stroke-linecap="round"/>
                                </svg>
							<?php } ?>
							<?php if ( $li_icon === 'minus' ) { ?>
                                <svg class="list__item_cons" width="8" height="3" viewBox="0 0 8 3" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1.01898H7" stroke="#D02E4B" stroke-width="2" stroke-linecap="round"/>
                                </svg>
							<?php } ?>
							<?php if ( $li_icon === 'tick' ) { ?>
                                <svg class="list__item_highlights" width="9" height="7" viewBox="0 0 9 7" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.5 2.51898L4 5.01898L8 1.01898" stroke="#D02E4B" stroke-width="2"
                                          stroke-linecap="round"/>
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