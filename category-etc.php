<?php
/*
Template Name: YouTube一覧
Template Post Type: page
*/
?>
<?php get_header('category') ?>

        <!-- works -->
        <section class="page__background--color">
            <div class="page__background page__background--youtube"></div>
            <div class="container__common">
                <div class="page__header inView">
                    <h2 class="page__title page__title--ja page__title--youtube">youtube</h2>
                    <h3 class="page__title page__title--en">キャンプ大好き</h3>
                </div>
                
                <div class="page__works--category">
                    <ul class="works__category">
<!-- カスタム投稿タイプ post_works の全記事へのリンク -->
<li class="works__category--list inView hover">
        <a href="<?php echo esc_url(home_url('youtube')); ?>" class="works__category--item">すべて</a>
    </li>

    <!-- カテゴリー '宿泊キャンプ' (slug: camp) を含む記事へのリンク -->
    <li class="works__category--list inView hover">
        <a href="<?php echo esc_url(get_term_link('camp', 'category')); ?>" class="works__category--item">宿泊キャンプ</a>
    </li>

    <!-- カテゴリー '施設紹介' (slug: introduction) を含む記事へのリンク -->
    <li class="works__category--list inView hover">
        <a href="<?php echo esc_url(get_term_link('introduction', 'category')); ?>" class="works__category--item">施設紹介</a>
    </li>

    <!-- カテゴリー 'その他' (slug: etc) を含む記事へのリンク -->
    <li class="works__category--list inView hover">
        <a href="<?php echo esc_url(get_term_link('etc', 'category')); ?>" class="works__category--item">その他</a>
    </li>
                    </ul>
                </div>
                <div class="youtube__wrapper">
                <?php
// クエリの設定
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post_youtube', // カスタム投稿タイプを指定
    'posts_per_page' => 10, // 1ページあたり10件表示
    'paged' => $paged, // ページ番号
    'category_name' => 'etc', // カテゴリースラッグ 'etc' の記事のみ取得
);
$youtube_query = new WP_Query($args);

if ($youtube_query->have_posts()) :
    while ($youtube_query->have_posts()) : $youtube_query->the_post(); ?>
    

            <a href="<?php the_permalink(); ?>" class="youtube__contents inView hover">
                <div class="youtube__contents--header">
                    <!-- 記事サムネイル -->
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium', array('class' => 'youtube__contents--thumbnail', 'alt' => get_the_title(), 'width' => '528', 'height' => '297')); ?>
                    <?php else : ?>
                        <!-- サムネイルがない場合の代替画像 -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/image/no-image/no-image.webp'); ?>" alt="No Image" width="528" height="297" class="youtube__contents--thumbnail" loading="lazy">
                    <?php endif; ?>
                </div>

                <div class="youtube__contents--footer">
                    <!-- 記事タイトル表示 -->
                    <h2 class="youtube__contents--title"><?php the_title(); ?></h2>

                    <!-- 投稿日表示 -->
                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="youtube__contents--date"><?php echo get_the_date('Y年m月d日'); ?></time>
                </div>
            </a>
       

    <?php endwhile; ?>

<!-- ページネーション -->
<div class="pagination inView">
    <ul class="pagination__list">
        <?php
        // paginate_links を配列で取得
        $pagination_links = paginate_links(array(
            'total' => $youtube_query->max_num_pages,
            'current' => max(1, get_query_var('paged')),
            'format' => '?paged=%#%',
            'show_all' => false,
            'type' => 'array', // 配列で取得
            'prev_text' => __('«'),
            'next_text' => __('»'),
        ));

        if ($pagination_links) :
            foreach ($pagination_links as $link) :
                // 各リンクに hover クラスを追加
                echo '<li class="pagination__item hover">' . $link . '</li>';
            endforeach;
        endif;
        ?>
    </ul>
</div>

<?php
else :
    echo '<p>記事が見つかりませんでした。</p>';
endif;

// クエリのリセット
wp_reset_postdata();
?>
 </div>

 <div class="btn__view btn__view--youtube inView">
                    <a href="https://www.youtube.com/channel/UCEbjeS64XQiB4hD_77pAtdQ" class="btn__item" target="_blank">channel</a>
                </div>
            </div>
        </section>


        <?php get_footer() ?>