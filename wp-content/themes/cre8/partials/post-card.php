<article class="blog-card">
	<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail( 'large', array( 'loading' => 'lazy', 'alt' => '' ) ); ?></a>
	<?php endif; ?>
	<div class="blog-card__copy">
		<time class="blog-card__meta" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
		<a class="text-link" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php the_title_attribute( array( 'before' => 'Read ' ) ); ?>">Read article</a>
	</div>
</article>
