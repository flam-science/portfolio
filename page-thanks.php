<?php
/*
Template Name: サンクスページ
Template Post Type: page
*/
?>
<?php get_header('page') ?>


        <!-- works -->
        <section class="page__background--color">
            <div class="page__background page__background--contact"></div>
            <div class="container__common">
                <div class="page__header inView">
                    <h2 class="page__title page__title--ja page__title--contact">contact</h2>
                    <h3 class="page__title page__title--en">お問い合わせ</h3>
                </div>
                
                <div class="contact__message contact__message--page inView">
                    <p class="contact__message--text thanks__message--big">お問い合わせ<br class="sp__block">ありがとうございます。</p>
                    <p class="contact__message--text thanks__message--small">内容を確認させていただき、<br class="sp__block">３営業日以内に返信いたします。</p>
                    <p class="contact__message--text thanks__message--small">少々お待ちください。</p>
                </div>

                <div class="btn__view btn__view--works inView">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn__item">topへ戻る</a>
                </div>
            </div>
        </section>

        <?php get_footer('contact') ?>