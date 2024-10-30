<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="format-detection" content="telephone=no,address=no,email=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php if (is_page() || is_single()) : ?>
        <?php
        // 固定ページや投稿のカスタムmeta情報を取得
        $meta_title = get_post_meta(get_the_ID(), '_custom_meta_title', true);
        $meta_description = get_post_meta(get_the_ID(), '_custom_meta_description', true);
        ?>
        <title><?php echo esc_html($meta_title ? $meta_title : wp_title( '|', false, 'right' ) . get_bloginfo( 'name' )); ?></title>
        <meta name="description" content="<?php echo esc_attr($meta_description ? $meta_description : strip_tags(get_the_excerpt())); ?>">
    
    <?php elseif (is_category()) : ?>
        <?php
        // 'works' 固定ページのIDを取得
        $works_page_id = get_page_by_path('works')->ID;
        // 'youtube' 固定ページのIDを取得
        $youtube_page_id = get_page_by_path('youtube')->ID;
        // 現在のカテゴリースラッグを取得
        $category = get_queried_object();
        $category_slug = $category->slug;
        
        // カテゴリースラッグに基づいて、どちらのページからメタ情報を取得するか決定
        if (in_array($category_slug, array('design', 'coding'))) {
            // 'works' 固定ページのメタ情報を取得
            $meta_title = get_post_meta($works_page_id, '_custom_meta_title', true);
            $meta_description = get_post_meta($works_page_id, '_custom_meta_description', true);
        } elseif (in_array($category_slug, array('camp', 'introduction', 'etc'))) {
            // 'youtube' 固定ページのメタ情報を取得
            $meta_title = get_post_meta($youtube_page_id, '_custom_meta_title', true);
            $meta_description = get_post_meta($youtube_page_id, '_custom_meta_description', true);
        }

        ?>
        <title><?php echo esc_html($meta_title ? $meta_title : wp_title( '|', false, 'right' ) . get_bloginfo( 'name' )); ?></title>
        <meta name="description" content="<?php echo esc_attr($meta_description ? $meta_description : category_description()); ?>">
    
    <?php else : ?>
        <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <?php endif; ?>
    
    <!-- カノニカルURL -->
    <link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>">

    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/image/favicon/favicon-32x32.png" sizes="any"> <!-- ファビコン -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/image/favicon/favicon.ico" sizes="any"> <!-- ICOファイル -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/image/favicon/favicon.svg" type="image/svg+xml"> <!-- モダンブラウザ用SVGアイコン -->
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/image/apple-touch-icon/apple-touch-icon.png"> <!-- スマホホーム画面ショートカット用アイコン -->
    
    <!-- OGP設定 -->
    <meta property="og:title" content="<?php echo esc_html($meta_title ? $meta_title : wp_title( '|', false, 'right' ) . get_bloginfo( 'name' )); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_description ? $meta_description : strip_tags(get_the_excerpt())); ?>">
    <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/image/ogp/ogp-image.webp"> <!-- OGP画像のパスを設定 -->
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
    <meta property="og:locale" content="ja_JP">

    <!-- Twitterカード設定 -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@flam0309"> <!-- Twitter IDを設定 -->
    <meta name="twitter:title" content="<?php if (is_front_page()) { bloginfo('name'); } else { echo esc_html($meta_title ? $meta_title : wp_title('|', false, 'right') . get_bloginfo('name')); } ?>">
    <meta name="twitter:description" content="<?php if (is_front_page()) { bloginfo('description'); } else { echo esc_attr($meta_description ? $meta_description : strip_tags(get_the_excerpt())); } ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/image/ogp/twitter-card.webp">

    <?php wp_head(); ?>
</head>


<body class="body__wrapper">
    <div id="scrool__top"></div>

    <!-- header -->
    <header class="header">
        <div class="header__wrapper">

            <a href="<?php echo esc_url(home_url('/')); ?>" class="header__left inView">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/image/logo/header-logo.svg'); ?>" alt="yuzu design" width="200" height="100" class="header__logo hover">
            </a>
            <div class="header__right">
                <nav class="header__nav">
                    <ul class="header__list">
                        <li class="header__list--item inView">
                            <a href="<?php echo esc_url(home_url('/')); ?>#works" class="header__list--link hover">works</a>
                        </li>
                        <li class="header__list--item inView">
                            <a href="<?php echo esc_url(home_url('/')); ?>#skills" class="header__list--link hover">skills</a>
                        </li>
                        <li class="header__list--item inView">
                            <a href="<?php echo esc_url(home_url('/')); ?>#about" class="header__list--link hover">about</a>
                        </li>
                        <li class="header__list--item inView">
                            <a href="<?php echo esc_url(home_url('/')); ?>#youtube" class="header__list--link hover">youtube</a>
                        </li>
                        <li class="header__list--item inView">
                            <a href="<?php echo esc_url(home_url('contact')); ?>" class="header__list--link hover">contact</a>
                        </li>
                    </ul>
                </nav>
                
                <!-- hamburger -->
                <div class="hamburger">
                    <button class="hamburger__btn">
                        <span class="hamburger__toggle"></span>
                        <span class="hamburger__toggle"></span>
                        <span class="hamburger__toggle"></span>
                    </button>
                    
                    <nav class="hamburger__area">
                        <div class="hamburger__main">
                            <ul class="hamburger__main--list">
                                <li class="hamburger__main--contents">
                                    <a href="<?php echo esc_url(home_url('/')); ?>#works" class="hamburger__main--title hover">製作実績</a>
                                    <div class="hamburger__works">
                                        <a href="<?php echo esc_url(home_url('works')); ?>" class="hamburger__main--item hover">
                                            <i class="hamburger__icon">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/material-laptop-mac.png'); ?>" alt="" class="hamburger__icon--image">
                                            </i>
                                            <p class="hamburger__icon--text">すべて</p>
                                        </a>
                                        <a href="<?php echo esc_url(get_category_link(get_category_by_slug('design')->term_id)); ?>" class="hamburger__main--item hover">
    <i class="hamburger__icon">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/core-vector.png'); ?>" alt="" class="hamburger__icon--image">
    </i>
    <p class="hamburger__icon--text">デザイン</p>
</a>
<a href="<?php echo esc_url(get_category_link(get_category_by_slug('coding')->term_id)); ?>" class="hamburger__main--item hover">
    <i class="hamburger__icon">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/material-code.png'); ?>" alt="" class="hamburger__icon--image">
    </i>
    <p class="hamburger__icon--text">コーディング</p>
</a>

                                    </div>
                                </li>
                                <li class="hamburger__main--contents">
                                    <a href="<?php echo esc_url(home_url('/')); ?>#skills" class="hamburger__main--title hover">できること</a>
                                </li>
                                <li class="hamburger__main--contents">
                                    <a href="<?php echo esc_url(home_url('/')); ?>#about" class="hamburger__main--title hover">こんな人</a>
                                </li>
                                <li class="hamburger__main--contents">
                                    <a href="<?php echo esc_url(home_url('/')); ?>#youtube" class="hamburger__main--title hover">キャンプ大好き</a>
                                    <div class="hamburger__youtube">
                                        <a href="<?php echo esc_url(home_url('youtube')); ?>" class="hamburger__main--item hover">
                                            <i class="hamburger__icon">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/core-movie.png'); ?>" alt="" class="hamburger__icon--image">
                                            </i>
                                            <p class="hamburger__icon--text">動画一覧</p>
                                        </a>
                                        <a href="https://www.youtube.com/channel/UCEbjeS64XQiB4hD_77pAtdQ" class="hamburger__main--item hover" target="_blank">
                                            <i class="hamburger__icon">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/akar-airplay-video.png'); ?>" alt="" class="hamburger__icon--image">
                                            </i>
                                            <p class="hamburger__icon--text">チャンネル</p>
                                        </a>
                                    </div>
                                </li>
                                <li class="hamburger__main--contents">
                                    <a href="<?php echo esc_url(home_url('contact')); ?>" class="hamburger__main--title hover">お問い合わせ</a>
                                </li>
                                <li class="hamburger__sns--contents">
                                    <a href="https://www.youtube.com/channel/UCEbjeS64XQiB4hD_77pAtdQ" class="hamburger__sns--item hover" target="_blank">
                                        <i class="hamburger__sns--icon">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/akar-youtube-fill.png'); ?>" alt="" class="hamburger__sns--image">
                                        </i>
                                    </a>
                                    <a href="https://x.com/flam0309" class="hamburger__sns--item hover" target="_blank">
                                        <i class="hamburger__sns--icon">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/simple-x.png'); ?>" alt="" class="hamburger__sns--image">
                                        </i>
                                    </a>
                                </li>
                            </ul>
                            <div class="hamburger__news">
                                <div class="hamburger__news--header">
                                    <img src="image/icon/material-fiber-new.png" alt="" class="hamburger__news--icon">
                                    <p class="hamburger__news--topic">製作実績</p>
                                </div>
                                <div class="hamburger__news--main">
                                <?php
// クエリの設定
$args = array(
    'post_type'      => 'post_works', // カスタム投稿タイプを指定
    'posts_per_page' => 1, // 最新記事1件を取得
    'orderby'        => 'date', // 日付で並べ替え
    'order'          => 'DESC', // 新しい順に表示
);
$latest_post_query = new WP_Query($args);

if ($latest_post_query->have_posts()) :
    while ($latest_post_query->have_posts()) : $latest_post_query->the_post(); ?>
        
        <!-- 最新記事1件へのリンクを挿入 -->
        <a href="<?php the_permalink(); ?>" class="hamburger__news--title hover">
            <?php the_title(); ?>
        </a>

    <?php endwhile;
endif;

// クエリをリセット
wp_reset_postdata();
?>

                                </div>
                            </div>
                            <div class="hamburger__news">
                                <div class="hamburger__news--header">
                                    <img src="image/icon/material-fiber-new.png" alt="" class="hamburger__news--icon">
                                    <p class="hamburger__news--topic">youtube</p>
                                </div>
                                <div class="hamburger__news--main">
                                <?php
// クエリの設定
$args = array(
    'post_type'      => 'post_youtube', // カスタム投稿タイプを指定
    'posts_per_page' => 1, // 最新記事1件を取得
    'orderby'        => 'date', // 日付で並べ替え
    'order'          => 'DESC', // 新しい順に表示
);
$latest_youtube_post_query = new WP_Query($args);

if ($latest_youtube_post_query->have_posts()) :
    while ($latest_youtube_post_query->have_posts()) : $latest_youtube_post_query->the_post(); ?>
        
        <!-- 最新記事1件へのリンクを挿入 -->
        <a href="<?php the_permalink(); ?>" class="hamburger__news--title hover">
            <?php the_title(); ?>
        </a>

    <?php endwhile;
endif;

// クエリをリセット
wp_reset_postdata();
?>

                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            
        </div>
    </header>


    <!-- ページトップへ戻るボタン -->
        <a href="#scrool__top" id="scrollTopButton" class="button__top--scroll hover" aria-label="ページトップへ戻る">
            <i class="fa-solid fa-chevron-up scroll__icon"></i>
        </a>

    <main class="main">