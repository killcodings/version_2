<?php
$howto_items         = get_field( 'items' );
$title_level         = get_field( 'title_level' ) ?? 'h2';
$is_enable_microdata = get_field( 'is_enable_microdata' ) ?? false;
$howto_steps         = [];

$is_colors_btn       = get_field('is_colors_btn');
$colors_btn          = get_field('colors_btn');
$colors_btn          = $is_colors_btn ? $colors_btn : '';

acf_block_before( 'How To', $is_preview );
?>
    <div class="howto">
<?php foreach ( $howto_items as $index => $item ):
	$howto_step = [
		"@type" => 'HowToStep',
		"name"  => str_replace( [ '"', '\'' ], '', $item['title'] ),
		"text"  => str_replace( [ '"', '\'' ], '', strip_tags( $item['text'] ) ),
		"image" => app_get_image_url( wp_get_attachment_image_url( $item['image'], 'full' ) )
	];

	$howto_steps[] = $howto_step;
	?>
        <div class="howto__item">
            <div class="howto__content">
                <span class="howto__counter"><?= $index + 1 ?></span>
                <<?= $title_level ?> class="howto__title"><?= $item['title'] ?></<?= $title_level ?>>
            <div class="howto__text"><?= $item['text'] ?></div>
            <? if ( $item['add_button'] ):?>
                <div class="howto__button">
	                <?= app_get_button( $item['add_button'], '', null, $colors_btn); ?>
                </div>
            <? endif; ?>
        </div>
        <div class="howto__image">
            <?= app_get_image( [ 'id' => $item['image'] ] ) ?>
        </div>
        </div>
<?php endforeach; ?>
    </div>
<?php
if ( $is_enable_microdata ) {
	$howto_microdata = [
		"@context" => "https://schema.org",
		"@type"    => "HowTo",
		"name"     => get_field('microdata_title') ?? "Title",
		"step"     => [ $howto_steps ]
	];
	echo "<script type='application/ld+json'>" . json_encode( app_array_filter_recursive( $howto_microdata ), JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
}
acf_block_after( $is_preview );
