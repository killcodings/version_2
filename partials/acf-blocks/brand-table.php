<?php
$table_setup                = get_field( 'table_setup' );
$brand_setup                = $table_setup['brand_setup'];
$is_enable_brand_title_link = $table_setup['enable_brand_title_link'] ?? false;
$partner_link_title         = $table_setup['partner_link_title'] ?: 'Download';
$table_items                = get_field( $brand_setup );
$simple_table               = $table_setup['is_simple_table'] ?? false;
$table_arr                  = [];

if ( $brand_setup === 'custom' ) {
	foreach ( $table_items['brands'] as $index => $item ) {
		$table_item['icon']            = $item['icon'];
		$table_item['icon_background'] = $item['icon_background'] ?: 'none';
		$table_item['page_link']       = $item['page_link'] ?: false;
		$table_item['name']            = $item['name'];
		$table_item['rating']          = $item['rating'];
		$table_item['bonus']           = $item['bonus'];
		$table_item['cons']            = $item['cons'];
		if ( $item['choose_link'] === 'input_link' ) {
			$button_url = $item['input_link'];
		} else {
			$button_url = $item['custom_table_setup_choose_link'];
		}
		$button                     = app_get_button( [
			'url'   => $button_url,
			'title' => $partner_link_title
		], 'site-button_outline', $item['link_relations'] );
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
			$table_item['cons']            = $brand_setup['cons'];
			if ( $brand_setup['choose_link'] === 'input_link' ) {
				$button_url = $brand_setup['input_link'];
			} else {
				$button_url = $brand_setup['brand_setup_choose_link'];
			}
			$button                     = app_get_button(
				[ 'url' => $button_url, 'title' => $partner_link_title ],
				'site-button_outline',
				$brand_setup['link_relations']
			);
			$table_item['partner_link'] = $button;
			$table_item['counter']      = $index + 1;
			$table_arr[]                = $table_item;
		}
	}
}

acf_block_before( 'Таблица брендов', $is_preview );

if ( !$simple_table ): ?>
    <table class="brand-table">
        <thead class="brand-table__thead">
        <tr>
            <th class="brand-table__icon-block-th">Rank</th>
            <th class="brand-table__content-th">Name</th>
            <th class="brand-table__bonus-th">Bonus</th>
            <th class="brand-table__lists-th">Benefits</th>
            <th class="brand-table__button-th">Link</th>
        </tr>
        </thead>
        <tbody class="brand-table__body">
		<?php foreach ( $table_arr as $item ): ?>
            <tr class="brand-table__item">
                <td class="brand-table__icon-block"
                    style="--table-icon-background-color:<?= $item['icon_background'] ?>">
                    <span class="brand-table__number">№<?= $item['counter'] ?></span>
                    <div class="brand-table__icon">
						<?= app_get_image( [ 'id' => $item['icon'] ] ) ?>
                    </div>
                </td>
                <td class="brand-table__content">
					<?php if ( $is_enable_brand_title_link && $item['page_link'] ): ?>
                        <a href="<?= $item['page_link'] ?>" class="brand-table__page-link"><?= $item['name'] ?></a>
					<?php else: ?>
                        <span class="brand-table__page-link"><?= $item['name'] ?></span>
					<?php endif; ?>
                    <div class="brand-table__rating table-rating">
                        <span class="table-rating__value"><?= $item['rating'] ?></span>
                        <span class="table-rating__stars" style="--rating: <?= $item['rating'] ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                    </div>
                </td>
                <td class="brand-table__bonus"><?= $item['bonus'] ?></td>
				<?php if ( $item['cons'] ): ?>
                    <td class="brand-table__lists">
                        <ul class="pros-list">
							<?php foreach ( $item['cons'] as $con ): ?>
                                <li class="pros-list__item"><?= $con['item'] ?></li>
							<?php endforeach; ?>
                        </ul>
                    </td>
				<?php endif;
				if ( $item['partner_link'] ): ?>
                    <td class="brand-table__button">
						<?= $item['partner_link'] ?>
                    </td>
				<?php endif; ?>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <table class="simple-brand-table">
        <thead class="simple-brand-table__thead">
        <tr>
            <th>Rank</th>
            <th>Icon</th>
            <th>Name</th>
            <th>Bonus</th>
            <th>Link</th>
        </tr>
        </thead>
        <tbody class="simple-brand-table__body">
		<?php foreach ( $table_arr as $item ): ?>
            <tr class="simple-brand-table__item">
                <td class="simple-brand-table__counter"><?= $item['counter'] ?></td>
                <td class="simple-brand-table__icon">
                    <div class="simple-brand-table__icon-image">
		                <?= app_get_image( [ 'id' => $item['icon'] ] ) ?>
                    </div>
                </td>
                <td class="simple-brand-table__name">
					<?php if ( $is_enable_brand_title_link && $item['page_link'] ): ?>
                        <a href="<?= $item['page_link'] ?>" class="simple-brand-table__page-link"><?= $item['name'] ?></a>
					<?php else: ?>
                        <span class="simple-brand-table__page-link"><?= $item['name'] ?></span>
					<?php endif; ?>
                </td>
                <td class="simple-brand-table__bonus"><?= $item['bonus'] ?></td>
				<?php if ( $item['partner_link'] ): ?>
                    <td class="simple-brand-table__button">
						<?= $item['partner_link'] ?>
                    </td>
				<?php endif; ?>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
<?php
endif;
acf_block_after( $is_preview );
