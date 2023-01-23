<?php
$images        = get_field( 'images' );
//$columns       = get_field( 'columns' ) ?? '5'; Range 1-5
//$columns_class = " gallery__item_col-$columns";

acf_block_before( 'Галерея', $is_preview );
?>
    <div class="gallery">
        <ul class="gallery__items">
            <?php foreach ( $images as $image ): ?>
                <li class="gallery__item <?= $columns_class ?>">
                    <?= app_get_image( [ 'id' => $image['image'] ] ) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php acf_block_after( $is_preview );
