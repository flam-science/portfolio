        <!-- contact -->
        <section class="contact">
            <div class="container__common">
                <div class="section__header inView">
                    <h2 class="section__title section__title--ja">contact</h2>
                    <h3 class="section__title section__title--en">お問い合わせ</h3>
                </div>
                
                <div class="contact__message inView">
                    <p class="contact__message--text">ご質問は下記のページにてお気軽にお問い合わせください。</p>
                    <p class="contact__message--text">いただきましたお問い合わせには順次対応しておりますが、内容によりお時間を頂戴する場合がございます。</p>
                </div>

                <div class="btn__view btn__view--contact inView">
                    <a href="<?php echo esc_url(home_url('contact')); ?>" class="btn__item">お問い合わせ</a>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="container__footer footer__df">
            <div class="footer__top">
                <div class="footer__left inView">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo hover">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/image/logo/header-logo.svg'); ?>" alt="yuzu designのロゴ" width="200" height="100" class="footer___logo--image" loading="lazy">
                    </a>
                </div>
                <div class="footer__right inView">
                    <ul class="footer__nav">
                        <li class="footer__nav--list">
                            <a href="<?php echo esc_url(home_url('/')); ?>#works" class="footer__nav--link hover">works</a>
                        </li>
                        <li class="footer__nav--list">
                            <a href="<?php echo esc_url(home_url('/')); ?>#skills" class="footer__nav--link hover">skills</a>
                        </li>
                        <li class="footer__nav--list">
                            <a href="<?php echo esc_url(home_url('/')); ?>#about" class="footer__nav--link hover">about</a>
                        </li>
                        <li class="footer__nav--list">
                            <a href="<?php echo esc_url(home_url('/')); ?>#youtube" class="footer__nav--link hover">youtube</a>
                        </li>
                        <li class="footer__nav--list">
                            <a href="<?php echo esc_url(home_url('contact')); ?>" class="footer__nav--link hover">contact</a>
                        </li>
                    </ul>
                    <ul class="footer__sns inView">
    <li class="footer__sns--list">
        <a href="https://www.youtube.com/channel/UCEbjeS64XQiB4hD_77pAtdQ" class="footer__sns--link hover" target="_blank">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/akar-youtube-fill.png'); ?>" alt="YouTubeはこちら" width="36" height="24" class="footer__sns--image" loading="lazy">
        </a>
    </li>
    <li class="footer__sns--list">
        <a href="https://x.com/flam0309" class="footer__sns--link hover" target="_blank">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/image/icon/simple-x.png'); ?>" alt="Xはこちら" width="36" height="24" class="footer__sns--image" loading="lazy">
        </a>
    </li>
</ul>

                </div>
            </div>

            <small class="footer__copyright inView">&copy;yuzu design portfolio All Rights Reserved.</small>
        </div>
    </footer>
    <?php wp_footer() ?>
    </body>
</html>