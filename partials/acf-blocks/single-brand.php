<?php
$chosen_brand        = get_field( 'brand' );
$brand_setup         = get_field( 'brand_setup', $chosen_brand );
$is_enable_table     = get_field( 'is_enable_table' ) ?? false;
$is_enable_page_link = get_field( 'is_enable_page_link' ) ?? true;

acf_block_before( 'Блок одного бренда', $is_preview );
?>
    <div class="single-brand">
        <div class="single-brand__view">
            <div class="single-brand__icon" style="--background-color:<?= $brand_setup['icon_background'] ?>">
				<?= app_get_image( [ 'id' => $brand_setup['icon'] ] ) ?>
            </div>
			<?php if ( $is_enable_page_link ): ?>
                <a href="<?= get_permalink( $chosen_brand ) ?>"
                   class="single-brand__title"><?= $brand_setup['name'] ?></a>
			<?php else: ?>
                <p class="single-brand__title"><?= $brand_setup['name'] ?></p>
			<?php endif; ?>
            <div class="single-brand__rating table-rating">
                <span class="table-rating__value"><?= $brand_setup['rating'] ?></span>
                <span class="table-rating__stars"
                      style="--rating:<?= $brand_setup['rating'] ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
            </div>
            <div class="single-brand__bonus-block">
                <p class="single-brand__bonus-title"><?= $brand_setup['bonus'] ?></p>
				<?php
				$button = [
					'title' => get_field( 'button_title' )
				];
				switch ( $brand_setup['choose_link'] ) {
					case 'input_link':
						$button['url'] = $brand_setup['input_link'];
						break;
					case 'choose_link':
						$button['url'] = $brand_setup['brand_setup_choose_link'];
				}

				echo app_get_button( $button, 'site-button site-button_gradient', $brand_setup['link_relations'] );
				?>
            </div>
        </div>
        <div class="single-brand__content">
			<?php if ( $is_enable_table ):
				$table_setup = get_field( 'table_titles' );
				?>
                <div class="single-brand__table-block">
                    <table class="site-table single-brand__table">
						<?php if ( $table_setup['caption'] ): ?>
                            <caption class="site-table__caption"><?= $table_setup['caption'] ?></caption>
						<?php endif;
						if ( $table_setup['first_column_title'] && $table_setup['second_column_title'] ): ?>
                        <thead class="site-table__thead">
                        <tr>
                            <th><?= $table_setup['first_column_title'] ?></th>
                            <th><?= $table_setup['second_column_title'] ?></th>
                        </tr>
						<?php endif; ?>
                        </thead>
                        <tbody class="site-table__tbody">
						<?php foreach ( $brand_setup['table'] as $item ): ?>
                            <tr>
                                <td><?= $item['title'] ?></td>
                                <td><?= $item['value'] ?></td>
                            </tr>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
			<?php endif; ?>
            <div class="single-brand__text">
                <InnerBlocks/>
            </div>
        </div>
    </div>
<?php
acf_block_after( $is_preview );
