jQuery(document).ready(function($) {
    // fv newsのフェードインとフェードアウト
    var sectionNews = $('.section__fv--news');
    var sectionTopButton = $('.button__top--scroll');
    var $elements = $('.inView'); // アニメーションを適用する要素
    var $otherElements = $('.inView').not('.inside__slider--item'); // スライダー以外の要素を取得

    // ハンバーガーメニューの初期設定
    var headerNav = $('.header__nav');
    var hamburgerBtn = $('.hamburger__btn');
    var hamburgerArea = $('.hamburger__area');
    var focusableMenuItems = hamburgerArea.find('a, button, input, [tabindex]');
    var flg = false; // ハンバーガーが開いているかどうかを示すフラグ

    // スクロールイベントをまとめて処理
    $(window).on('scroll', function() {
        var scrollTop = $(this).scrollTop();
        var windowHeight = $(this).height();
        var windowWidth = $(this).width();

        // fv newsのフェードインとフェードアウト
        if (windowWidth <= 768) {
            sectionNews.toggleClass('news__fadeOut--right', scrollTop > 300);
            sectionNews.toggleClass('news__fadeIn--right', scrollTop <= 300);
        } else {
            sectionNews.toggleClass('news__fadeOut--right', scrollTop >= 200);
            sectionNews.toggleClass('news__fadeIn--right', scrollTop < 200);
        }

        // スクロールアニメーション
        $elements.each(function() {
            var $element = $(this);
            var elementTop = $element.offset().top;
            if (scrollTop + windowHeight > elementTop) {
                setTimeout(function() {
                    $element.addClass('isShow');
                }, 500); // 500msの遅延でクラスを追加
            }
        });

        // スクロールトップボタン
        sectionTopButton.toggleClass('show', scrollTop >= 600);
    });
    
    $(window).trigger('scroll'); // 初回ロード時にもチェック

    // ハンバーガーメニューの開閉
    hamburgerBtn.on('click', function() {
        $(this).toggleClass('open');
        hamburgerArea.toggleClass('open');
        headerNav.toggleClass('open');

        if ($(this).hasClass('open')) {
            $("body").css({ height: "100%", overflow: "hidden" });
            $(this).attr("aria-expanded", "true");
            flg = true;

            // メニューが開いた時、最初のリンクに確実にフォーカスを当てる
            setTimeout(function() {
                focusableMenuItems.first().focus();
            }, 100);
        } else {
            $("body").css({ height: "", overflow: "" });
            $(this).attr("aria-expanded", "false");
            flg = false;
            hamburgerBtn.focus();
        }
    });

    // フォーカストラップ制御（メニュー内でフォーカスがループするように）
    hamburgerArea.on('keydown', function(event) {
        var firstFocusableElement = focusableMenuItems.first();
        var lastFocusableElement = focusableMenuItems.last();

        if (event.key === 'Tab' && flg) {
            if (event.shiftKey) { // Shift + Tab の場合
                if ($(document.activeElement).is(firstFocusableElement)) {
                    lastFocusableElement.focus();
                    event.preventDefault();
                }
            } else { // Tab の場合
                if ($(document.activeElement).is(lastFocusableElement)) {
                    firstFocusableElement.focus();
                    event.preventDefault();
                }
            }
        }
    });

    // ESCキーでメニューを閉じる
    $(window).on('keydown', function(event) {
        if (event.key === "Escape" && flg) {
            closeMenu();
        }
    });

    // メニューを閉じる共通処理
    function closeMenu() {
        headerNav.removeClass('open');
        hamburgerBtn.removeClass('open');
        hamburgerArea.removeClass('open');
        $("body").css({ height: "", overflow: "" });
        hamburgerBtn.attr("aria-expanded", "false");
        hamburgerBtn.focus(); // 閉じた後にボタンにフォーカスを戻す
        flg = false;
    }

    // メニュー外をタップしたときにメニューを閉じる
    $(document).on('click', function(event) {
        if (flg && !$(event.target).closest('.hamburger__btn, .hamburger__area').length) {
            closeMenu();
        }
    });

    $(document).on('click', '.hamburger__main--title', function(e) {
        var href = $(this).attr('href'); // クリックされたリンクのhref属性を取得
        var isAnchorLink = href.charAt(0) === '#'; // 先頭が#ならIDリンクとみなす
    
        // アンカーリンクの場合
        if (isAnchorLink && window.location.pathname === '/') {  // トップページか確認
            e.preventDefault(); // デフォルトのリンク動作を無効化
            var target = $(href); // ターゲット要素を取得
            
            if (target.length) {
                // スクロールしてターゲットへ移動
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 500);
    
                // メニューを閉じる処理
                closeMenu();
            }
        } else {
            // トップページ以外のリンクは通常通り処理
            closeMenu();
        }
    });
    
    // ハンバーガーメニューの開閉処理を調整
    function closeMenu() {
        headerNav.removeClass('open');
        hamburgerBtn.removeClass('open');
        hamburgerArea.removeClass('open');
        $("body").css({ height: "", overflow: "" });
        hamburgerBtn.attr("aria-expanded", "false");
        flg = false;
    }
    

    // スライダー
    $('.youtube__slider').on('init', function() {
        $('.youtube__slider--item').each(function() {
            $(this).addClass('isShow');
        });
    });

    $('.youtube__slider').slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 8000,
        cssEase: 'linear',
        slidesToShow: 1,
        variableWidth: true,
        pauseOnFocus: false,
        pauseOnHover: false,
        swipe: false,
        touchMove: false
    });

    // 送信ボタンを押した時のみバリデーションメッセージ表示
    $(".form__submit").click(function () {
        $(".wpcf7-form-control-wrap").addClass("is-show"),
        $(".wpcf7-not-valid").addClass("is-show");
    });

    // ラジオボタン＆チェックボックスでテキスト改行
    if ($('.input__confirm').length > 0) {
        $('.input__confirm').each(function () {
            var text = $(this).html();
            $(this).html(text.replace('<br>', '<br>'));
        });
    }

    // ラジオボタンのキーボード操作
    $('input[type="radio"]').on('keydown', function(e) {
        if (e.key === 'Enter') {
            $(this).prop('checked', true);
        }
    });

    // チェックボックスにEnterキーでチェックできるようにする
    $('input[type="checkbox"]').on('keydown', function(e) {
        if (e.key === 'Enter') {
            $(this).prop('checked', !$(this).prop('checked'));
        }
    });

    // 送信ボタンにフォーカス時にEnterキーをサポート
    $('.form__submit').on('keydown', function(e) {
        if (e.key === 'Enter') {
            $(this).click();
        }
    });

    // スクロール時のヘッダーのクラス変更
    $(window).on('scroll', function() {
        var header = $('.header');
        
        if ($(this).scrollTop() > 0) {  // スクロール量が0より大きい場合
            header.addClass('moving');  // .movingクラスを付与
        } else {
            header.removeClass('moving');  // スクロール位置がトップに戻ったらクラスを削除
        }
    });
});
