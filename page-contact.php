<?php
/*
Template Name: お問い合わせ
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
                    <p class="contact__message--text">ご質問は下記のページにてお気軽にお問い合わせください。</p>
                    <p class="contact__message--text">いただきましたお問い合わせには順次対応しておりますが、内容によりお時間を頂戴する場合がございます。</p>
                </div>
                <div class="contact__message--caution inView">
                    <p class="contact__message--text">下記項目にご入力ください。「<span class="color__yellow">※</span>」印は入力必須項目です。</p>
                </div>

                <div class="contact__form">
                <?php the_content(); ?>

                </div>
            </div>
        </section>

        <?php get_footer('contact') ?>