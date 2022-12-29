<?php
$matches = get_field( 'matches' );

acf_block_before( 'Карточки матчей', $is_preview );
?>
    <div class="matches-cards">
		<?php foreach ( $matches as $match ): ?>
            <article class="matches-cards__item">
                <h3 class="matches-cards__title"><?= $match['title'] ?></h3>
                <div class="matches-cards__icon">
					<?= app_get_image( [ 'id' => $match['icon'] ] ) ?>
                </div>
                <time class="matches-cards__date"><?= $match['date'] ?></time>
				<?php if ( $match['link']['url'] ): ?>
                    <a href="<?= $match['link']['url'] ?>"
                       class="matches-cards__link"><?= $match['link']['title'] ?></a>
				<?php endif; ?>
            </article>
		<?php endforeach; ?>
    </div>
<?php acf_block_after( $is_preview );
