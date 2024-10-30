<?php get_header() ?>
        <!-- fv -->
        <section class="fv">
        <video src="<?php echo esc_url(get_template_directory_uri() . '/image/fv/fv-movie.mp4'); ?>" width="1440" height="810" autoplay muted playsinline loop class="fv__movie"></video>

<h1 class="fv__logo">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/image/fv/fv-main.svg'); ?>" alt="yuzu design portfolio" width="450" height="397" class="fv__logo--image inView" loading="lazy">
</h1>


                <?php
// 最新の 'post_works'の記事1件を取得
$args = array(
    'post_type' => array('post_works'), // カスタム投稿タイプ
    'posts_per_page' => 1, // 取得する記事数
    'orderby' => 'date', // 日付で並び替え
    'order' => 'DESC', // 新しいものから取得
);

$latest_post_query = new WP_Query($args);

if ($latest_post_query->have_posts()) :
    while ($latest_post_query->have_posts()) : $latest_post_query->the_post(); ?>

        <a href="<?php the_permalink(); ?>" class="section__fv--news news__fadeIn--first news__sp--fadeIn">
            <article class="news__sp--df section__fvNews">
                <!-- 記事のタイトルを表示 -->
                <h2 class="fv__News--text"><?php the_title(); ?></h2>

                <!-- 記事のカテゴリーを表示 -->
                <p class="fv__News--category">
                    <?php
                    // 記事に属するカテゴリーを取得して表示
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo esc_html($categories[0]->name); // 最初のカテゴリー名を表示
                    }
                    ?>
                </p>

                <!-- 記事の投稿日を表示 -->
                <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="fv__News--date"><?php echo get_the_date('Y年m月d日'); ?></time>
            </article>
        </a>

    <?php endwhile;
    wp_reset_postdata(); // クエリをリセット
endif;
?>

<div class="container">
  <div class="chevron"></div>
  <div class="chevron"></div>
  <div class="chevron"></div>
  <span class="text">Scroll down</span>
</div>

        </section>

        <!-- works -->
        <section class="works" id="works">
            <div class="container__common">
                <div class="section__header inView">
                    <h2 class="section__title section__title--ja">works</h2>
                    <h3 class="section__title section__title--en">製作実績</h3>
                </div>
                
                <div class="section__main">
                        <div class="works__main">
                        <?php
// 最新の 'post_works' の記事を取得するクエリ
$args = array(
    'post_type' => 'post_works',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('design', 'coding'),
        ),
    ),
);

$latest_posts_query = new WP_Query($args);

if ($latest_posts_query->have_posts()) :
    while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post(); ?>

        <a href="<?php the_permalink(); ?>" class="works__main--contents inView hover">
            <!-- サムネイル画像を表示 -->
            <?php if (has_post_thumbnail()) : 
                // サムネイル画像のIDを取得
                $thumbnail_id = get_post_thumbnail_id();
                // 画像の代替テキストを取得
                $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); ?>

                <!-- サムネイル画像を表示、代替テキストをaltに設定 -->
                <?php the_post_thumbnail('medium', array('class' => 'works__main--thumbnail', 'alt' => esc_attr($alt_text))); ?>
            
            <?php else : ?>
                <!-- 画像がない場合の代替画像 -->
                <img src="<?php echo esc_url(get_template_directory_uri() . '/image/no-image/no-image.webp'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" width="528" height="281" class="works__main--thumbnail" loading="lazy">
            <?php endif; ?>

            <div class="works__main--info">
                <div class="works__info--header">
                    <!-- カテゴリーを表示 -->
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                        foreach ($categories as $category) :
                            ?>
                            <p class="category__list"><?php echo esc_html($category->name); ?></p>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
                <div class="works__info--middle">
                    <!-- 記事のタイトルを表示 -->
                    <h2 class="works__main--title"><?php the_title(); ?></h2>
                </div>
                <div class="works__info--footer">
                    <!-- 記事の投稿日を表示 -->
                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="works__info--date"><?php echo get_the_date('Y年m月d日'); ?></time>
                </div>
            </div>
        </a>

    <?php endwhile;
    wp_reset_postdata(); // クエリをリセット
endif;
?>
                        </div>
                        <div class="btn__view btn__view--works inView">
                            <a href="<?php echo esc_url(home_url('works')); ?>" class="btn__item">view more</a>
                        </div>
                    </div>
                </div>
        </section>

        <!-- skills -->
        <section class="skills" id="skills">
            <div class="container__common">
                <div class="section__header inView">
                    <h2 class="section__title section__title--ja">skills</h2>
                    <h3 class="section__title section__title--en">できること</h3>
                </div>

                <div class="skill__area">
                    <ul class="skill__set">
                        <li class="skill__set--list inView">
                            <div class="skill__set--header">
                                <h2 class="skill__title--ja">デザイン</h2>
                                <h3 class="skill__title--en">design</h3>
                            </div>
                            <div class="skill__set--middle">
                                <div class="skill__set--image skill__set--design"></div>
                            </div>
                            <div class="skill__set--footer">
                                <div class="skill__set--message">
                                    <p class="skill__set--text">見た目の美しさと使いやすさを両立したデザインを提供します。</p>
                                    <p class="skill__set--text">色やレイアウト、フォントの選び方にこだわり、ブランドやサービスの魅力を最大限に引き出すデザインを作ります。</p>
                                    <p class="skill__set--text">お客様のご希望やビジネスの目的をしっかりとお聞きし、その内容に基づいて、最適なデザインの提案を行います。</p>
                                </div>
                            </div>
                        </li>
                        <li class="skill__set--list inView">
                            <div class="skill__set--header">
                                <h2 class="skill__title--ja">コーディング</h2>
                                <h3 class="skill__title--en">coding</h3>
                            </div>
                            <div class="skill__set--middle">
                                <div class="skill__set--image skill__set--coding"></div>
                            </div>
                            <div class="skill__set--footer">
                                <div class="skill__set--message">
                                    <p class="skill__set--text">最新のHTML、CSS、JavaScriptを使用し、あらゆるデバイスで快適に動作するWebサイトを作成します。</p>
                                    <p class="skill__set--text">タブレットやスマホでも見やすいように対応します。</p>
                                    <p class="skill__set--text">WordPressを活用した柔軟なサイト構築も可能で、クライアント様がご自身で簡単に更新できる機能を提供します。</p>
                                </div>
                            </div>
                        </li>
                        <li class="skill__set--list inView">
                            <div class="skill__set--header">
                                <h2 class="skill__title--ja">検索エンジン最適化</h2>
                                <h3 class="skill__title--en">seo</h3>
                            </div>
                            <div class="skill__set--middle">
                                <div class="skill__set--image skill__set--seo"></div>
                            </div>
                            <div class="skill__set--footer">
                                <div class="skill__set--message">
                                    <p class="skill__set--text">Googleなどの検索エンジンで上位に表示されるための工夫を取り入れたWebサイトを作ります。</p>
                                    <p class="skill__set--text">ページの内容や構造を整理し、表示速度を速くすることで、ユーザーにとっても使いやすく、検索エンジンにも評価されやすいサイトを目指し、集客力を高めるお手伝いをします。</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="about" id="about">
            <div class="container__common">
                <div class="section__header inView">
                    <h2 class="section__title section__title--ja">about</h2>
                    <h3 class="section__title section__title--en">こんな人</h3>
                </div>

                <div class="about__area inView">
                    <div class="about__left">
                        <div class="about__image"></div>
                    </div>
                    <div class="about__right">
                        <div class="about__me">
                            <p class="about__text">埼玉県にてフリーランスのWeb制作をしております。</p>
                            <p class="about__text">2023年3月まで埼玉県公立中学校教師</p>
                            <p class="about__text">2023年4月からWeb制作の道へ</p>
                            <p class="about__text">2024年10月からフリーランス</p>
                            <p class="about__text">制作会社と業務委託契約開始</p>
                        </div>
                        <div class="about__youtube">
                            <p class="about__text">YouTubeチャンネル</p>
                            <p class="about__text">yuzu camp　運営中</p>
                            <p class="about__text">毎月宿泊キャンプに赴き、自由気ままなファミリーキャンプの様子を動画にして投稿しています。</p>
                            <p class="about__text">動画内でのポジションは調達班(父)。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- youtube -->
        <section class="youtube" id="youtube">
            <div class="container__common">
                <div class="section__header inView">
                    <h2 class="section__title section__title--ja"><span class="text__big">you</span><span class="text__big">tube</span></h2>
                    <h3 class="section__title section__title--en">キャンプ大好き</h3>
                </div>

                <div class="youtube__wrapper">
                <?php
// 最新の 'post_youtube' の記事を2件取得
$args = array(
    'post_type' => 'post_youtube', // カスタム投稿タイプを指定
    'posts_per_page' => 2, // 取得する記事数
    'orderby' => 'date', // 日付で並び替え
    'order' => 'DESC', // 新しい順に取得
);

$youtube_posts_query = new WP_Query($args);

if ($youtube_posts_query->have_posts()) :
    while ($youtube_posts_query->have_posts()) : $youtube_posts_query->the_post(); ?>
        
        <a href="<?php the_permalink(); ?>" class="youtube__contents inView hover">
            <div class="youtube__contents--header">
                <!-- 記事のサムネイルを表示 -->
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium', array('class' => 'youtube__contents--thumbnail', 'alt' => get_the_title(), 'width' => '528', 'height' => '297')); ?>
                <?php else : ?>
                    <!-- サムネイルがない場合の代替画像 -->
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/image/no-image/no-image.webp'); ?>" alt="No Image" width="528" height="297" class="youtube__contents--thumbnail" loading="lazy">
                <?php endif; ?>
            </div>

            <div class="youtube__contents--footer">
                <!-- 記事のタイトルを表示 -->
                <h2 class="youtube__contents--title"><?php the_title(); ?></h2>

                <!-- 投稿日を表示 -->
                <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="youtube__contents--date"><?php echo get_the_date('Y年m月d日'); ?></time>
            </div>
        </a>

    <?php endwhile;
    wp_reset_postdata(); // クエリをリセット
endif;
?>
                </div>

                <div class="btn__view btn__view--youtube inView">
                    <a href="<?php echo esc_url(home_url('youtube')); ?>" class="btn__item">view more</a>
                    <a href="https://www.youtube.com/channel/UCEbjeS64XQiB4hD_77pAtdQ" class="btn__item" target="_blank">channel</a>
                </div>



            </div>  
            <div class="youtube__slider">
    <?php
    // 最新の7件の post_youtube を取得
    $args = array(
        'post_type' => 'post_youtube', // カスタム投稿タイプ
        'posts_per_page' => 10,         // 表示する記事数
        'orderby' => 'date',           // 日付でソート
        'order' => 'DESC'              // 新しい順に表示
    );
    $youtube_query = new WP_Query($args);

    if ($youtube_query->have_posts()) :
        while ($youtube_query->have_posts()) : $youtube_query->the_post();
            if (has_post_thumbnail()) :
                ?>
                <div class="slider__items">
                    <!-- サムネイル画像を表示 -->
                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>" class="youtube__slider--item" width="16" height="9" loading="lazy">
                </div>
                <?php
            endif;
        endwhile;
        wp_reset_postdata(); // クエリをリセット
    endif;
    ?>
</div>
        </section>

        <?php get_footer() ?>