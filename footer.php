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
	<div class="footer-one">
		<div class="footer-inside">
			<div class="footer-grid">
			<div class="footer__address">
				<img class="footer__hfh-logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/footer-logo-2x.png' ); ?>" alt="Logo: HfH - Interkantonale Hochschule für Heilpädagogik" >
				<div class="footer__keywords">wissenschaftsbasiert, praxisorientiert, breit verankert</div>
				<p>Schaffhauserstrasse 239<br>
				Postfach 5850<br>
				CH-8050 Zürich</p>
				<p>T +41 44 317 11 11<br>
				info@hfh.ch</p>
			</div>
			<div class="footer__social">
				<nav role="navigation" >
					<ul>
						<li >
							<a href="https://www.facebook.com/hfh.edu" target="_blank" rel="nofollow" class="facebook">facebook</a>
						</li>
						<li class="menu-item menu-item--link menu-item--level-1">
							<a href="https://www.youtube.com/user/hfhzuerich" target="_blank" rel="nofollow" class="youtube">youtube</a>
						</li>
						<li class="menu-item menu-item--link menu-item--level-1">
							<a href="https://www.linkedin.com/company/hfh.edu" target="_blank" rel="nofollow" class="linkedin">linkedin</a>
						</li>
						<li class="menu-item menu-item--link menu-item--level-1">
							<a href="https://www.instagram.com/hfh_edu/" target="_blank" rel="nofollow" class="instagram">instagram</a>
						</li>
						<li class="menu-item menu-item--link menu-item--level-1">
							<a href="https://twitter.com/hfh_edu" target="_blank" rel="nofollow" class="twitter">twitter</a>
						</li>
						<li class="menu-item menu-item--link menu-item--level-1">
							<a href="https://issuu.com/hochschule_fuer_heilpaedagogik" target="_blank" rel="nofollow" class="issuu">issuu</a>
						</li>
					</ul>
				</nav>
			</div>
</div>
			</div>
	</div>
	</div>
	<div class="footer-two">
		<div class="footer-inside">
			<div class="footer-flex">
				<section class="footer__copyright">© Copyright 2021 HfH</section>
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
				<section class="footer__privacy">
					<?php 
					the_privacy_policy_link()
					?>
				</section>
			</div>
		</div>
	</div>
</footer><!-- .footer -->
<?php wp_footer(); ?>
</div>
</body>
</html>
