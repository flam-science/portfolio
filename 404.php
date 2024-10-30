<?php
/*
Template Name: 404
Template Post Type: page
*/
?>
<?php get_header('page') ?>

        <!-- works -->
        <section class="page__background--color">
            <div class="page__background"></div>
            <div class="container__common">
                <div class="page__header inView">
                    <h2 class="page__title page__title--ja">404 not found</h2>
                    <h3 class="page__title page__title--en">お探しのページはみつかりませんでした</h3>
                </div>
                
                <div class="contact__message contact__message--page inView">
                    <p class="contact__message--text message__404">恐れ入りますが、<br class="sp__block">TOPページよりお進みください</p>
                </div>
            </div>

            <div class="btn__view btn__view--works inView">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn__item">topへ戻る</a>
            </div>
        </section>


        <?php get_footer() ?>