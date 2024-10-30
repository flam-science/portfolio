<?php
/*
Template Name: youtube
Template Post Type: post
*/
?>

<?php get_header('single') ?>

        <!-- works -->
        <section class="page__background--color">
            <div class="page__background page__background--youtube"></div>
            <div class="container__common">
                <div class="page__header inView">
                    <h2 class="page__title page__title--ja page__title--youtube">youtube</h2>
                    <h3 class="page__title page__title--en">キャンプ大好き</h3>
                </div>
                
                <div class="section__main container__single">
                <?php
// SCF の YouTube フィールド '動画URL' を取得
$youtube_urls = SCF::get('動画URL'); // フィールド名を正しく指定してください

// '動画URL' が配列の場合、その最初の値を取得
if (is_array($youtube_urls)) {
    $youtube_url = $youtube_urls[0]; // 配列の最初のURLを取得
} else {
    $youtube_url = $youtube_urls; // 文字列の場合はそのまま使用
}

if (!empty($youtube_url)) {
    // YouTube動画IDを取得（短縮URLと標準URLの両方に対応）
    if (preg_match('/youtu\.be\/([^\?\/]+)/', $youtube_url, $matches)) {
        $youtube_id = $matches[1]; // 短縮URL用
    } elseif (preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $youtube_url, $matches)) {
        $youtube_id = $matches[1]; // 標準URL用
    }

    if (!empty($youtube_id)) {
        // YouTube埋め込み用のURL
        $embed_url = 'https://www.youtube.com/embed/' . $youtube_id;
    }
}
?>

<div class="section__main--top inView">
    <!-- YouTubeの埋め込み動画を表示 -->
    <?php if (!empty($embed_url)) : ?>
        <iframe width="800" height="450" src="<?php echo esc_url($embed_url); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="single__works--thumbnail" loading="lazy"></iframe>
    <?php else : ?>
        <p>動画が見つかりません。</p>
    <?php endif; ?>
</div>

<div class="section__main--middle inView">
    <!-- 記事タイトルを表示 -->
    <h2 class="single__works--title"><?php the_title(); ?></h2>

    <!-- 投稿日を表示 -->
    <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="works__info--date"><?php echo get_the_date('Y年m月d日'); ?></time>
</div>


<?php
// post_youtube の記事タイトルと概要欄を取得して表示
if (have_posts()) :
    while (have_posts()) : the_post(); 
        // SCF の YouTube フィールドの概要欄を取得
        $youtube_description = SCF::get('概要欄'); // フィールド名を正しく指定してください
        ?>
        
        <div class="section__main--bottom">
            <div class="main__bottom--youtube">
                <!-- 記事のタイトルを表示 -->
                <p class="bottom__youtube--title inView">概要欄</p>
                
                <div class="bottom__youtube--info inView">
                    <!-- SCFで取得した概要欄を表示 -->
                    <p class="bottom__youtube--text">
                        <?php echo nl2br(esc_html($youtube_description)); ?>
                    </p>
                </div>
            </div>
        </div>

    <?php endwhile;
endif;
?>

                    <div class="btn__view btn__view--works inView">
                        <a href="<?php echo esc_url(home_url('youtube')); ?>" class="btn__item">一覧へ</a>
                    </div>
                </div>
            </div>
        </section>

    <?php get_footer() ?>