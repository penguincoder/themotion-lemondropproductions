<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="themotion-tab-pane active">

	<div class="themotion-tab-pane-center">

		<h1 class="themotion-welcome-title"><?php esc_html_e( 'Welcome to The Motion!','themotion' ); ?><?php if ( ! empty( $themotion['Version'] ) ) :  ?> <sup id="themotion-theme-version"><?php echo esc_attr( $themotion['Version'] ); ?> </sup><?php endif; ?></h1>

		<p><?php esc_html_e( 'We want to make sure you have the best experience using TheMotion and that is why we gathered here all the necessary informations for you. We hope you will enjoy using TheMotion, as much as we enjoy creating great products.', 'themotion' ); ?>

	</div>

	<hr />

	<div class="themotion-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'themotion' ); ?></h1>

		<h4><?php esc_html_e( 'Customize everything in a single place.' ,'themotion' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'themotion' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'themotion' ); ?></a></p>

	</div>

	<hr />

	<div class="themotion-tab-pane-center">

		<h1><?php esc_html_e( 'FAQ', 'themotion' ); ?></h1>

	</div>

	<div class="themotion-tab-pane-half themotion-tab-pane-first-half">

		<h4><?php esc_html_e( 'Create a child theme', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.', 'themotion' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://docs.themeisle.com/article/14-how-to-create-a-child-theme/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'themotion' ); ?></a></p>

		<hr />
		
		<h4><?php esc_html_e( 'Build a landing page with a drag-and-drop content builder', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'In the below documentation you will find an easy way to build a great looking landing page using a drag-and-drop content builder plugin.', 'themotion' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://docs.themeisle.com/article/219-how-to-build-a-landing-page-with-a-drag-and-drop-content-builder' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'themotion' ); ?></a></p>

		<hr />
		
		<h4><?php esc_html_e( 'Translate TheMotion', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'In the below documentation you will find an easy way to translate TheMotion into your native language or any other language you need for you site.', 'themotion' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://docs.themeisle.com/article/80-how-to-translate-themotion' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'themotion' ); ?></a></p>

	</div>

	<div class="themotion-tab-pane-half">

		<h4><?php esc_html_e( 'Speed up your site', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'If you find yourself in the situation where everything on your site is running very slow, you might consider having a look at the below documentation where you will find the most common issues causing this and possible solutions for each of the issues.', 'themotion' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://docs.themeisle.com/article/63-speed-up-your-wordpress-site/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'themotion' ); ?></a></p>

		<hr />

		<h4><?php esc_html_e( '30 Experts Share: The Top *Non-Obvious* WordPress Plugins That\'ll Make You a Better Blogger', 'themotion' ); ?></h4>
		<p><?php esc_html_e( ' At the address below you will find a cool set of original WordPress plugins that can give you great benefits despite being a little lesser known out there.', 'themotion' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://www.codeinwp.com/blog/top-non-obvious-wordpress-plugins/' ); ?>" class="button"><?php esc_html_e( 'Read more', 'themotion' ); ?></a></p>

	</div>

	<div class="themotion-clear"></div>

	<hr />

	<div class="themotion-tab-pane-center">

		<h1><?php esc_html_e( 'View full documentation', 'themotion' ); ?></h1>
		<p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed information on how to use TheMotion.', 'themotion' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://docs.themeisle.com/article/385-themotion-documentation' ); ?>" class="button button-primary"><?php esc_html_e( 'Read full documentation', 'themotion' ); ?></a></p>

	</div>

	<hr />

	<div class="themotion-tab-pane-center">
		<h1><?php esc_html_e( 'Recommended plugins', 'themotion' ); ?></h1>
	</div>

	<div class="themotion-tab-pane-half themotion-tab-pane-first-half">
	
		<!-- Page Builder by SiteOrigin -->
		<h4><?php esc_html_e( 'Page Builder by SiteOrigin', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'Build responsive page layouts using the widgets you know and love using this simple drag and drop page builder.', 'themotion' ); ?></p>

		<?php if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) { ?>

				<p><span class="themotion-w-activated button"><?php esc_html_e( 'Already activated', 'themotion' ); ?></span></p>

			<?php
		} else { ?>

				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=siteorigin-panels' ), 'install-plugin_siteorigin-panels' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Page Builder by SiteOrigin', 'themotion' ); ?></a></p>

			<?php
		}

		?>

		<hr />

		<!-- WP Product Review -->
		<h4><?php esc_html_e( 'WP Product Review', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'Easily turn your basic posts into in-depth reviews with ratings, pros and cons, affiliate links, rich snippets and user reviews.', 'themotion' ); ?></p>

		<?php if ( is_plugin_active( 'wp-product-review/wp-product-review.php' ) ) { ?>

				<p><span class="themotion-w-activated button"><?php esc_html_e( 'Already activated', 'themotion' ); ?></span></p>

			<?php
		} else { ?>

				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=wp-product-review' ), 'install-plugin_wp-product-review' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WP Product Review', 'themotion' ); ?></a></p>

			<?php
		}

		?>

		<hr />

		<!-- Custom Login Customizer -->
		<h4><?php esc_html_e( 'Custom Login Customizer', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'Login Customizer plugin allows you to easily customize your login page straight from your WordPress Customizer! You can preview your changes before you save them!', 'themotion' ); ?></p>

		<?php if ( is_plugin_active( 'login-customizer/login-customizer.php' ) ) { ?>

			<p><span class="themotion-w-activated button"><?php esc_html_e( 'Already activated', 'themotion' ); ?></span></p>

			<?php
		} else { ?>

			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=login-customizer' ), 'install-plugin_login-customizer' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Custom Login Customizer', 'themotion' ); ?></a></p>

			<?php
		}
		?>
		
		<hr />
		
		<!-- Adblock Notify -->
		<h4>Adblock Notify</h4>

		<?php if ( is_plugin_active( 'adblock-notify-by-bweb/adblock-notify.php' ) ) { ?>

			<p><span class="themotion-w-activated button"><?php esc_html_e( 'Already activated', 'themotion' ); ?></span></p>

			<?php
		} else { ?>

			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=adblock-notify-by-bweb' ), 'install-plugin_adblock-notify-by-bweb' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install', 'themotion' ); ?> Adblock Notify</a></p>

			<?php
		}
		?>

	</div>

	<div class="themotion-tab-pane-half">

		<!-- Visualizer: Charts and Graphs -->
		<h4><?php esc_html_e( 'Visualizer: Charts and Graphs', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'A simple, easy to use and quite powerful chart tool to create, manage and embed interactive charts into your WordPress posts and pages.', 'themotion' ); ?></p>

		<?php if ( class_exists( 'Visualizer_Plugin' ) ) { ?>

			<p><span class="themotion-w-activated button"><?php esc_html_e( 'Already activated', 'themotion' ); ?></span></p>

			<?php
		} else { ?>

			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=visualizer' ), 'install-plugin_visualizer' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Visualizer', 'themotion' ); ?></a></p>

			<?php
		}
		?>
		
		<hr />
		
		<!-- ECPT -->
		<h4><?php esc_html_e( 'Easy Content Types', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'Custom Post Types, Taxonomies and Metaboxes in Minutes', 'themotion' ); ?></p>

		<?php if ( is_plugin_active( 'easy-content-types/easy-content-types.php' ) ) { ?>

				<p><span class="themotion-w-activated button"><?php esc_html_e( 'Already activated', 'themotion' ); ?></span></p>

			<?php
		} else { ?>

				<p><a href="<?php echo esc_url( 'http://themeisle.com/plugins/easy-content-types/' ); ?>" class="button button-primary"><?php esc_html_e( 'Download Easy Content Types', 'themotion' ); ?></a></p>

			<?php
		}
		?>
		
		<hr />
		
		<!-- Revive Old Post -->
		<h4><?php esc_html_e( 'Revive Old Post', 'themotion' ); ?></h4>
		<p><?php esc_html_e( 'A plugin to share about your old posts on twitter, facebook, linkedin to get more hits for them and keep them alive.', 'themotion' ); ?></p>

		<?php if ( is_plugin_active( 'tweet-old-post/tweet-old-post.php' ) ) { ?>

			<p><span class="themotion-w-activated button"><?php esc_html_e( 'Already activated', 'themotion' ); ?></span></p>

			<?php
		} else { ?>

			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=tweet-old-post' ), 'install-plugin_tweet-old-post' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Revive Old Post', 'themotion' ); ?></a></p>

			<?php
		}
		?>

		<hr />
		
		<!-- FEEDZY RSS Feeds -->
		<h4>FEEDZY RSS Feeds</h4>

		<?php if ( is_plugin_active( 'feedzy-rss-feeds/feedzy-rss-feed.php' ) ) { ?>

			<p><span class="themotion-w-activated button"><?php esc_html_e( 'Already activated', 'themotion' ); ?></span></p>

			<?php
		} else { ?>

			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=feedzy-rss-feeds' ), 'install-plugin_feedzy-rss-feeds' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install', 'themotion' ); ?> FEEDZY RSS Feeds</a></p>

			<?php
		}
		?>

	</div>

	<div class="themotion-clear"></div>

</div>
