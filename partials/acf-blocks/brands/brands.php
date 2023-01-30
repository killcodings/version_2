<?php
$table_setup                = get_field( 'table_setup' );
$brand_setup                = $table_setup['brand_setup'];
//$background_font_icon     = $brand_setup['background-font-icon'] ?: 'var(--accent-color)';
$is_enable_brand_title_link = $table_setup['enable_brand_title_link'] ?? false;
$partner_link_title         = $table_setup['partner_link_title'] ?: 'Download';
$table_items                = get_field( $brand_setup );
//$simple_table             = $table_setup['is_simple_table'] ?? false;

$table_arr   = [];

if ( $brand_setup === 'custom' ) {
	foreach ( $table_items['brands'] as $index => $item ) {
		$table_item['icon']            = $item['icon'];
		$table_item['icon_background'] = $item['icon_background'] ?: 'none';
		$table_item['page_link']       = $item['page_link'] ?: false;
		$table_item['name']            = $item['name'];
		$table_item['rating']          = $item['rating'];
		$table_item['bonus']           = $item['bonus'];
		$table_item['cons']            = $item['cons'];
		$table_item['brands-bonus-title']       = $item['brands-bonus-title'];
		$table_item['brands-bonus-description'] = $item['brands-bonus-description'];
		$table_item['button_icon']     = $item['button_icon'] ? $item['button_icon_use'] : false;


		if ( $item['choose_link'] === 'input_link' ) {
			$button_url = $item['input_link'];
		} else {
			$button_url = $item['custom_table_setup_choose_link'];
		}
		$button                     = app_get_button( [
			'url'   => $button_url,
			'title' => $partner_link_title
		], 'button_outline', $item['link_relations'], $custom_colors = null, $button_image = false, $button_icon = $table_item['button_icon'] );

		$table_item['partner_link'] = $button ?? false;
		$table_item['counter']      = $index + 1;
		$table_arr[]                = $table_item;
	}
} else {
	if ( $brand_setup === 'choose_posts' ) {
		$chosen_brands       = get_field( 'choose_posts' );
		$chosen_brands_pages = $chosen_brands['posts'];
	} elseif ( $brand_setup === 'global' ) {
		$brand_table_global_setup = get_field( 'brand_table_global_setup', 'options' );
		$chosen_brands_pages      = $brand_table_global_setup['posts'];
	}
	if ( $chosen_brands_pages ) {
		foreach ( $chosen_brands_pages as $index => $brand_page_id ) {
			$brand_setup                   = get_field( 'brand_setup', $brand_page_id );
			$table_item['icon']            = $brand_setup['icon'];
			$table_item['icon_background'] = $brand_setup['icon_background'] ?: 'none';
			$table_item['page_link']       = get_permalink( $brand_page_id );
			$table_item['name']            = $brand_setup['name'];
			$table_item['rating']          = $brand_setup['rating'];
			$table_item['bonus']           = $brand_setup['bonus'];
			$table_item['brands-bonus-title']       = $brand_setup['brands-bonus-title'];
			$table_item['brands-bonus-description'] = $brand_setup['brands-bonus-description'];
			$table_item['button_icon']     = $brand_setup['button_icon'] ? $brand_setup['button_icon_use'] : false;

			$table_item['cons'] = $brand_setup['cons'];
			if ( $brand_setup['choose_link'] === 'input_link' ) {
				$button_url = $brand_setup['input_link'];
			} else {
				$button_url = $brand_setup['brand_setup_choose_link'];
			}
			$button                     = app_get_button(
				[ 'url' => $button_url, 'title' => $partner_link_title ],
				'button_outline',
				$brand_setup['link_relations'], $custom_colors = null, $button_image = false, $button_icon = $table_item['button_icon']
			);

			$table_item['partner_link'] = $button;
			$table_item['counter']      = $index + 1;
			$table_arr[]                = $table_item;
		}
	}
}

acf_block_before( 'Таблица брендов', $is_preview );

if ( $table_arr ): ?>
    <div class="filters" style="display: none">
        <select class="filter">
            <option class="filter__option">Filter 1</option>
            <option class="filter__option">Filter 2</option>
        </select>
        <select class="filter">
            <option class="filter__option">Filter 1</option>
            <option class="filter__option">Filter 2</option>
        </select>
        <select class="filter">
            <option class="filter__option">List item and 5 more</option>
            <option class="filter__option">List item and 4 more</option>
        </select>
        <select class="filter">
            <option class="filter__option">List item and 1 more</option>
            <option class="filter__option">List item and 2 more</option>
        </select>
    </div>
    <table class="brands">
        <thead class="brands-head">
            <tr class="brands-head__row">
                <th class="brands__icon brands-head__icon">Brand</th>
                <th class="brands__highlights brands-head__highlights">Highlights</th>
                <th class="brands__bonus brands-head__bonus">Bonus</th>
                <th class="brands__rating brands-head__rating">Rating</th>
                <th class="brands__download brands-head__download">Link</th>
            </tr>
        </thead>
        <tbody class="brands__body">
		<?php foreach ( $table_arr as $item ): ?>
            <tr class="brands__row" style="">
                <td class="brands__icon">
                    <div class="brands__counter">
                        <?= $item['counter'] ?>
                        <svg class="brands__counter-icon" width="9" height="13" fill="none">
                            <use xlink:href="#badge__icon"></use>
                        </svg>
                    </div>
                    <div class="brands__icon-image"
                         style="--brands-icon-background-color:<?= $item['icon_background'] ?>">
						<?= app_get_image( [ 'id' => $item['icon'] ] ) ?>
                    </div>
					<?php if ( $is_enable_brand_title_link && $item['page_link'] ): ?>
                        <a href="<?= $item['page_link'] ?>" class="brands__icon-title"><?= $item['name'] ?></a>
					<?php else: ?>
                        <span class="brands__icon-title"><?= $item['name'] ?></span>
					<?php endif; ?>
                </td>
                <td class="brands__highlights">
                    <div class="list">
                        <h3 class="brands__highlights-title list__title"><?= $item['name'] ?> Highlights</h3>
						<?php if ( $item['cons'] ): ?>
                            <ul class="brands__highlights-lists list__items">
								<?php foreach ( $item['cons'] as $con ): ?>
                                    <li class="list__item">
                                        <svg class="list__icon list__item-icon-highlights" fill="none">
                                            <use xlink:href="#list__item-icon-highlights-id"></use>
                                        </svg>
										<?= $con['item'] ?>
                                    </li>
								<?php endforeach; ?>
                            </ul>
						<?php endif; ?>
                    </div>
                </td>
                <td class="brands__bonus">
					<?php if ( $item['brands-bonus-title'] ) : ?>
                        <h3 class="brands__bonus-title"><?= $item['brands-bonus-title'] ?></h3>
					<?php endif; ?>

					<?php if ( $item['bonus'] ) : ?>
                        <div class="brands__bonus-value">
                            <div class="brands__bonus-icon">
                                <svg class="brands__bonus-resize" fill="none">
                                    <use xlink:href="#bonus__icon-item-present"></use>
                                </svg>
                            </div>
							<?= $item['bonus'] ?>
                        </div>
					<?php endif; ?>
					<?php if ( $item['brands-bonus-description'] ) : ?>
                        <p class="brands__bonus-description"> <?= $item['brands-bonus-description'] ?></p>
					<?php endif; ?>
                </td>
                <td class="brands__rating">
                    <div class="brands__rating-top">
                        <div class="brands__rating-value"><?= $item['rating'] ?></div>
                        <div class="brands__rating-stars" style="--rating: <?= $item['rating'] ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                    </div>
                    <a href="<?= $item['page_link'] ?>" class="brands__rating-title">Read review</a>
                </td>
				<?php
				if ( $item['partner_link'] ): ?>
                    <td class="brands__download">
						<?= $item['partner_link'] ?>
                    </td>
				<?php endif; ?>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
<?php endif;
acf_block_after( $is_preview );
