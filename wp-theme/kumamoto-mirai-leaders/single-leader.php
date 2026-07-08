<?php
/**
 * リーダー個別ページ（インタビュー記事）
 * ヒーロー = ACFフィールド / 記事本文 = 投稿本文（エディタ）
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$uri = get_template_directory_uri();
get_header();

while ( have_posts() ) : the_post();

	$name     = get_the_title();
	$headline = kml_field( 'headline' );
	if ( ! $headline ) { $headline = $name; }
	$en       = kml_field( 'en_name' );
	$company  = kml_field( 'company' );
	$role     = kml_field( 'role' );
	$aff      = trim( $company . ( $company && $role ? ' ｜ ' : '' ) . $role );
	$lead     = kml_field( 'lead' );
	$url      = kml_field( 'url' );
	$logo     = kml_field( 'logo' );
	$person   = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	?>

	<!-- HERO -->
	<section class="ahero">
		<?php if ( $logo ) : ?><img class="co-logo-pc" src="<?php echo esc_url( $logo ); ?>" alt=""><?php endif; ?>
		<div class="ahero-inner">
			<div class="ahero-left">
				<div class="ahero-photo"><?php if ( $person ) : ?><img class="person" src="<?php echo esc_url( $person ); ?>" alt="<?php echo esc_attr( $name ); ?>"><?php endif; ?></div>
			</div>
			<div class="ahero-right">
				<div class="title"><?php echo esc_html( $headline ); ?></div>
				<?php if ( $en ) : ?><div class="en"><?php echo esc_html( $en ); ?></div><?php endif; ?>
				<div class="namebox">
					<?php if ( $logo ) : ?><img class="co-logo" src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $company ); ?>"><?php endif; ?>
					<div class="nametxt">
						<div class="jp"><?php echo esc_html( $name ); ?></div>
						<?php if ( $aff ) : ?><div class="aff"><?php echo esc_html( $aff ); ?></div><?php endif; ?>
					</div>
				</div>
				<?php if ( $lead ) : ?><p class="lead"><?php echo nl2br( esc_html( $lead ) ); ?></p><?php endif; ?>
				<?php if ( $url ) : ?><a class="co-url" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $url ); ?></a><?php endif; ?>
			</div>
		</div>
	</section>

	<!-- 記事本文（投稿本文エディタで管理） -->
	<div class="article">
		<div class="cms-body reveal"><?php the_content(); ?></div>
		<div class="backwrap reveal"><a class="backbtn" href="<?php echo esc_url( home_url( '/#leaders' ) ); ?>">← 一覧へ戻る</a></div>
	</div>

<?php endwhile; ?>

<?php get_footer(); ?>
