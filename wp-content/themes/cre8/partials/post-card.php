<article class="post-card">
	<?php if ( has_post_thumbnail() ) : ?>
	<a class="post-card__media" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail( 'large', array( 'class' => 'post-card__image', 'loading' => 'lazy', 'alt' => '' ) ); ?></a>
	<?php endif; ?>
	<div class="post-card__content">
		<time class="post-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<h3 class="post-card__title"><a class="post-card__title-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
		<p class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
		<a class="post-card__link text-link" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php the_title_attribute( array( 'before' => 'Read ' ) ); ?>">Read article</a>
	</div>
</article>
