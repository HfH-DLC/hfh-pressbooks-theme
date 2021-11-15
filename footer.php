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


<footer class="site-footer">
<div class="footer-one">
		<div class="footer-one__content">
		<img width="300" height="49" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/footer-logo-2x.png' ); ?>">
		<div class="footer-one__address">
			<p>Schaffhauserstrasse 239<br>
				Postfach 5850<br>
				CH-8050 Zürich</p>
			<p>T +41 44 317 11 11<br>
			<a href="mailto:info@hfh.ch">info@hfh.ch</a></p>
		</div>

		<div class="footer-one__social">
				<nav role="navigation" >
					<ul>
						<li>
							<a href="https://www.facebook.com/hfh.edu" target="_blank" rel="nofollow" class="facebook">facebook</a>
						</li>
						<li>
							<a href="https://www.youtube.com/user/hfhzuerich" target="_blank" rel="nofollow" class="youtube">youtube</a>
						</li>
						<li>
							<a href="https://www.linkedin.com/company/hfh.edu" target="_blank" rel="nofollow" class="linkedin">linkedin</a>
						</li>
						<li>
							<a href="https://www.instagram.com/hfh_edu/" target="_blank" rel="nofollow" class="instagram">instagram</a>
						</li>
						<li>
							<a href="https://twitter.com/hfh_edu" target="_blank" rel="nofollow" class="twitter">twitter</a>
						</li>
						<li>
							<a href="https://issuu.com/hochschule_fuer_heilpaedagogik" target="_blank" rel="nofollow" class="issuu">issuu</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="footer-two">
		<div class="footer-two__content">
			<div class="footer-two__copyright">
				<?php echo 'Copyright HfH ' . esc_html( date( 'Y' ) ); ?>
			</div>
			<div class="footer-two__pressbooks">
				<div class="footer-two__pressbooks__links">
					<a class="footer-two__pressbooks__icon" href="https://pressbooks.com" title="Pressbooks">
						<svg class="icon--svg">
							<use href="#icon-pressbooks" />
						</svg>
					</a>
					<?php /* translators: %s: Pressbooks */ ?>
					<p class="footer__pressbooks__links__title"><a href="https://pressbooks.com"><?php printf( esc_html__( 'Powered by %s', 'pressbooks-book' ), '<span class="pressbooks">Pressbooks</span>' ); ?></a></p>
				</div>
			</div>
			<div class="footer-two__privacy">
					<?php the_privacy_policy_link(); ?>
			</div>
		</div>
	</div>
</footer><!-- .footer -->
<?php wp_footer(); ?>
</div>
</body>
</html>
