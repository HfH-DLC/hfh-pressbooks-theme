<?php
/**
 * The Footer template.
 *
 * @package HfH Pressbooks Theme
 */

?>
<?php if ( ! is_single() ) { ?>
	</div><!-- #content -->
<?php } ?>
</main>
<?php
global $multipage;
?>


<footer class="footer
<?php
if ( is_front_page() ) :
	echo ' footer--home';
elseif ( is_single() ) :
	echo ' footer--reading';
else :
	echo ' footer--page';
endif;
echo $multipage ? ' footer--multipage' : '';

?>
">
	<div class="footer__inner">
		<section class="footer__pressbooks">
			<div class="footer__pressbooks__links">
			<a class="footer__pressbooks__icon" href="https://pressbooks.com" title="Pressbooks">
				<svg class="icon--svg">
					<use href="#icon-pressbooks" />
				</svg>
			</a>
				<?php /* translators: %s: Pressbooks */ ?>
				<p class="footer__pressbooks__links__title"><a href="https://pressbooks.com"><?php printf( esc_html__( 'Powered by %s', 'pressbooks-book' ), '<span class="pressbooks">Pressbooks</span>' ); ?></a></p>
			</div>
		</section>
		<section class="footer-hfh">
			<?php 
			the_privacy_policy_link()
			?>
		</section>
	</div><!-- .container -->
</footer><!-- .footer -->
<?php wp_footer(); ?>
</div>
</body>
</html>
