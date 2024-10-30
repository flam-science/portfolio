<?php
/*
Template Name: 制作物一覧
Template Post Type: page
*/
?>
<?php get_header('category') ?>

        <!-- works -->
        <section class="page__background--color">
            <div class="page__background page__background--works"></div>
            <div class="container__common">
                <div class="page__header inView">
                    <h2 class="page__title page__title--ja">works</h2>
                    <h3 class="page__title page__title--en">製作実績</h3>
                </div>
                
                <div class="page__works--category">
                <ul class="works__category">
 <!-- カスタム投稿タイプ post_works の全記事へのリンク -->
 <li class="inView hover">
        <a href="<?php echo esc_url(home_url('works')); ?>" class="works__category--list works__category--item">all</a>
    </li>

    <!-- カテゴリー 'design' を含む記事へのリンク -->
    <li class="inView hover">
        <a href="<?php echo esc_url(get_category_link(get_category_by_slug('design')->term_id)); ?>" class="works__category--list works__category--item">design</a>
    </li>

    <!-- カテゴリー 'coding' を含む記事へのリンク -->
    <li class="inView hover">
        <a href="<?php echo esc_url(get_category_link(get_category_by_slug('coding')->term_id)); ?>" class="works__category--list works__category--item">coding</a>
    </li>
                    </ul>
                </div>
                <div class="section__main">
                        <div class="works__main">
                            <?php
// クエリの設定
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post_works', // カスタム投稿タイプを指定
    'posts_per_page' => 10, // 1ページあたり10件表示
    'paged' => $paged, // ページ番号
    'category_name' => 'coding', // カテゴリースラッグ 'coding' の記事のみ取得
);
$works_query = new WP_Query($args);

if ($works_query->have_posts()) :
    while ($works_query->have_posts()) : $works_query->the_post(); ?>
    
        <a href="<?php the_permalink(); ?>" class="works__main--contents inView hover">
            <div class="works__main--thumbnail-wrapper">
                <!-- 記事サムネイル -->
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium', array('class' => 'works__main--thumbnail', 'alt' => get_the_title(), 'width' => '528', 'height' => '281')); ?>
                <?php else : ?>
                    <!-- サムネイルがない場合の代替画像 -->
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/image/no-image/no-image.webp'); ?>" alt="No Image" width="528" height="281" class="works__main--thumbnail" loading="lazy">
                <?php endif; ?>
            </div>

            <div class="works__main--info">
                <div class="works__info--header">
                    <!-- カテゴリー表示 -->
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                        foreach ($categories as $category) : ?>
                            <p class="category__list"><?php echo esc_html($category->name); ?></p>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
                
                <div class="works__info--middle">
                    <!-- 記事タイトル表示 -->
                    <h2 class="works__main--title"><?php the_title(); ?></h2>
                </div>

                <div class="works__info--footer">
                    <!-- 投稿日表示 -->
                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="works__info--date"><?php echo get_the_date('Y年m月d日'); ?></time>
                </div>
            </div>
        </a>

    <?php endwhile; ?>

<!-- ページネーション -->
<div class="pagination inView">
    <ul class="pagination__list">
        <?php
        // paginate_links を配列で取得
        $pagination_links = paginate_links(array(
            'total' => $works_query->max_num_pages,
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
                        <div class="btn__view btn__view--works inView">
                            <a href="#" class="btn__item">view more</a>
                        </div>
                    </div>
                </div>
        </section>
        <?php get_footer() ?>