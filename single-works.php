<?php
/*
Template Name: works
Template Post Type: post
*/
?>

<?php get_header('single') ?>

        <!-- works -->
        <section class="page__background--color">
            <div class="page__background page__background--works"></div>
            <div class="container__common">
                <div class="page__header inView">
                    <h2 class="page__title page__title--ja">works</h2>
                    <h3 class="page__title page__title--en">製作実績</h3>
                </div>
                
                <div class="section__main container__single">
                <div class="section__main--top inView">
    <!-- 記事のサムネイルを表示 -->
    <?php if (has_post_thumbnail()) : 
        // サムネイルのIDを取得
        $thumbnail_id = get_post_thumbnail_id();
        // サムネイルのaltテキストを取得
        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        ?>
        <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php echo esc_attr($alt_text); ?>" width="800" height="450" class="single__works--thumbnail" loading="lazy">
    <?php else : ?>
        <!-- サムネイルがない場合の代替画像 -->
        <img src="<?php echo esc_url(get_template_directory_uri() . '/image/no-image/no-image.webp'); ?>" alt="No Image" width="800" height="450" class="single__works--thumbnail" loading="lazy">
    <?php endif; ?>
</div>

<div class="section__main--middle inView">
    <!-- 記事タイトルを表示 -->
    <h2 class="single__works--title"><?php the_title(); ?></h2>

    <div class="single__works--category">
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

    <!-- 投稿日を表示 -->
    <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="works__info--date"><?php echo get_the_date('Y年m月d日'); ?></time>
</div>


<?php
// post_works の記事を取得
if (have_posts()) :
    while (have_posts()) : the_post(); 
        // Smart Custom Fields からフィールドデータを取得
        $work_title = SCF::get('制作物');
        $external_link = SCF::get('外部リンク');
        $work_content = SCF::get('内容');
        $production_period = SCF::get('制作期間');
        $tools_used = SCF::get('使用ツール');
        $languages_used = SCF::get('使用言語');
        $production_notes = SCF::get('制作にあたって'); // 制作にあたってのフィールドはループ
        ?>
        
        <div class="section__main--bottom">
            <div class="main__bottom--first">
                <div class="works__row inView">
                    <p class="works__row--title">制作物：</p>
                    <div class="works__unit">
                        <p class="works__title--single"><?php echo esc_html($work_title); ?></p>
                        <?php if (!empty($external_link)) : ?>
                            <a href="<?php echo esc_url($external_link); ?>" class="works__link--single color__yellow hover" target="_blank">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/target-blank.png'); ?>" alt="外部リンクに飛びます" width="18" height="18" class="works__link--icon color__yellow">
                                <p class="link__text--single color__yellow">←クリック</p>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="works__row inView">
                    <p class="works__row--title">内容：</p>
                    <div class="works__unit">
                        <p class="works__title--single"><?php echo esc_html($work_content); ?></p>
                    </div>
                </div>
                <div class="works__row inView">
                    <p class="works__row--title">制作期間：</p>
                    <div class="works__unit">
                        <p class="works__title--single"><?php echo esc_html($production_period); ?></p>
                    </div>
                </div>
                <div class="works__row inView">
                    <p class="works__row--title">使用ツール：</p>
                    <div class="works__unit">
                        <p class="works__title--single"><?php echo esc_html($tools_used); ?></p>
                    </div>
                </div>
                <div class="works__row inView">
                    <p class="works__row--title">使用言語：</p>
                    <div class="works__unit">
                        <p class="works__title--single"><?php echo esc_html($languages_used); ?></p>
                    </div>
                </div>
            </div>

            <div class="main__bottom--second">
                <p class="bottom__second--title inView">制作にあたって</p>
                <div class="bottom__second--info inView">
                    <!-- 制作にあたっての内容をループで表示 -->
                    <?php if (!empty($production_notes)) :
                        foreach ($production_notes as $note) : ?>
                            <p class="bottom__second--text"><?php echo esc_html($note); ?></p>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>

    <?php endwhile;
endif;
?>

                    <div class="btn__view btn__view--works inView">
                        <a href="<?php echo esc_url(home_url('works')); ?>" class="btn__item">一覧へ</a>
                    </div>
                </div>
            </div>
        </section>

    <?php get_footer() ?>