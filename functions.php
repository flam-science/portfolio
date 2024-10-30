<?php

function add_files() {
    // Google Fonts & External CSS
    // デフォルトスタイルをリセットするための外部CSS (destyle.css)
    wp_enqueue_style('reset-style', 'https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css', array(), '1.0.15');
    
    // Google Fonts
        // Googleフォント Kosugi Maru の読み込み
    wp_enqueue_style('google-fonts1', 'https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap', array(), null);

    // Slick CSS
    // Slick Carousel用のスタイルシートの読み込み
    wp_enqueue_style('slick-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');
    wp_enqueue_style('slick-theme-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array(), '1.8.1');
    
    // Main stylesheet
    // テーマのメインスタイルシートの読み込み (style.css)
    wp_enqueue_style('main-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    
    // jQuery
    // WordPressに標準で含まれているjQueryを読み込み
    wp_enqueue_script('jquery');
    
    // font awesomeを読み込み
    wp_enqueue_script('font-awesome','https://kit.fontawesome.com/34dd4847f4.js', array(), '2.1.0', true);
    
    // Stickyfill
    // Stickyポジションをサポートしないブラウザ向けのポリフィル (Stickyfill.js)
    wp_enqueue_script('stickyfill-js', 'https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js', array(), '2.1.0', true);
    
    // jQuery inview
    // 要素がビューポート内に入ったことを検出するプラグイン (inview.js)
    wp_enqueue_script('jquery-inview', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.inview/1.0.0/jquery.inview.min.js', array('jquery'), '1.0.0', true);
    
    // Slick.js
    // Slick Carouselのスクリプトファイルの読み込み (slick.js)
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
    
    // Main JavaScript
    // テーマのメインJavaScriptファイルの読み込み (main.js)
    wp_enqueue_script('main-js', get_theme_file_uri('main.js'), array('jquery', 'slick-js'), wp_get_theme()->get('Version'), true);
}

add_action('wp_enqueue_scripts', 'add_files');


// テーマのセットアップ
function theme_setup() {
    // アイキャッチ画像（投稿サムネイル）を有効にする
    add_theme_support('post-thumbnails');
    
    // ナビゲーションメニューの登録
    // メインメニューを登録して、WordPress管理画面から設定できるようにする
    register_nav_menus(array(
        'main-menu' => 'メインメニュー', // 'main-menu' という位置で 'メインメニュー' を定義
    ));
}
// テーマのセットアップが完了した後に上記の関数を実行する
add_action('after_setup_theme', 'theme_setup');



// 固定ページで「抜粋」を有効化
add_post_type_support('page', 'excerpt');

// カテゴリーとタグのmeta descriptionからpタグを除去
remove_filter('term_description','wpautop');




// カスタムカテゴリーリストのウォーカークラスを定義
class Custom_Walker_Category extends Walker_Category {
    // 各カテゴリーリストアイテムの開始要素を生成
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        // カテゴリー名をエスケープして取得
        $cat_name = esc_attr( $category->name );
        // カテゴリー名をフィルタリング（必要に応じてカスタマイズ可能）
        $cat_name = apply_filters( 'list_cats', $cat_name, $category );

        // カテゴリーのリンクを生成
        $link = '<a href="' . esc_url( get_term_link($category) ) . '" ';
        
        // 説明をリンクのタイトル属性として使用する場合
        if ( $args['use_desc_for_title'] && !empty($category->description) ) {
            // カテゴリー説明をエスケープしてタイトル属性にセット
            $link .= 'title="' . esc_attr( strip_tags(apply_filters('category_description', $category->description, $category)) ) . '"';
        }
        // リンクタグを閉じてカテゴリー名を表示
        $link .= '>';
        $link .= $cat_name . '</a>';

        // カテゴリーの投稿数を表示する場合
        if ( !empty($args['show_count']) ) {
            // 投稿数を括弧内に表示
            $link .= ' (' . intval($category->count) . ')';
        }

        // リスト形式のスタイルを適用する場合
        if ( 'list' == $args['style'] ) {
            // リスト要素を生成し、リンクを出力
            $output .= "\t<li class='footer__navigation-list'>" . $link . "\n";
        } else {
            // リスト要素を生成し、リンクと改行を出力
            $output .= "\t<li>" . $link . "<br />\n";
        }
    }
}



function remove_p_tags_from_cf7($content) {
    // pタグを削除または修正する
    $content = str_replace('<p>', '', $content);
    $content = str_replace('</p>', '', $content);
    return $content;
}

// ひらがなのみを許可するバリデーション
add_filter('wpcf7_validate_text*', 'custom_hiragana_validation', 20, 2);
function custom_hiragana_validation($result, $tag) {
    $name = $tag['name'];
    if ($name == 'your-furigana') {
        $value = isset($_POST[$name]) ? trim($_POST[$name]) : '';
        if (!preg_match('/^[ぁ-んー]+$/u', $value)) {
            $result->invalidate($tag, 'ふりがなはひらがなで入力してください。');
        }
    }
    return $result;
}

// メールアドレスに漢字が含まれているかのバリデーション
add_filter('wpcf7_validate_email*', 'custom_email_kanji_validation', 20, 2);
function custom_email_kanji_validation($result, $tag) {
    $name = $tag['name'];
    if ($name == 'your-email') { // フィールド名を実際のメールフィールド名に変更
        $value = isset($_POST[$name]) ? trim($_POST[$name]) : '';
        if (preg_match('/[\x{4E00}-\x{9FAF}]/u', $value)) { // 漢字の範囲
            $result->invalidate($tag, 'メールアドレスには漢字を含めないでください。');
        }
    }
    return $result;
}


// 画像サイズを定義
// サムネイルサイズの設定（デフォルトサイズ）
add_image_size('thumbnail', 0, 0); 

// 中サイズの画像サイズ設定（デフォルトサイズ）
add_image_size('medium', 0, 0); 

// 中大サイズの画像サイズ設定（デフォルトサイズ）
add_image_size('medium_large', 0, 0); 

// 大サイズの画像サイズ設定（デフォルトサイズ）
add_image_size('large', 0, 0); 

// 1536x1536ピクセルの画像サイズ設定
add_image_size('1536x1536', 0, 0); 

// 2048x2048ピクセルの画像サイズ設定
add_image_size('2048x2048', 0, 0); 


// 通常の投稿を管理画面から非表示にする
// function remove_default_post_type() {
//     remove_menu_page('edit.php'); // 投稿メニューの削除
// }
// add_action('admin_menu', 'remove_default_post_type');


// Contact Form 7で自動挿入されるPタグ、brタグを削除
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
  return false;
} 
add_filter('wpcf7_form_elements', function($content) {
    // 改行コードや<br>タグをすべて削除
    $content = preg_replace('/<br\s*\/?>/i', '', $content);
    // 改行コードを削除して、<br>が自動生成されるのを防ぐ
    $content = str_replace(array("\r\n", "\r", "\n"), '', $content);
    
    return $content;
});



// 'post_works' カスタム投稿タイプにカテゴリー編集用のサブメニューを追加
function add_post_works_category_submenu() {
    add_submenu_page(
        'edit.php?post_type=post_works', // 親メニュー (投稿一覧ページ)
        'カテゴリー', // ページタイトル
        'カテゴリー', // メニュータイトル
        'manage_categories', // 権限 (カテゴリー管理権限)
        'edit-tags.php?taxonomy=category&post_type=post_works' // URL (カテゴリー編集ページ)
    );
}
add_action('admin_menu', 'add_post_works_category_submenu');




// 'post_youtube' カスタム投稿タイプにカテゴリー編集用のサブメニューを追加
function add_post_youtube_category_submenu() {
    add_submenu_page(
        'edit.php?post_type=post_youtube', // 親メニュー (投稿一覧ページ)
        'カテゴリー', // ページタイトル
        'カテゴリー', // メニュータイトル
        'manage_categories', // 権限 (カテゴリー管理権限)
        'edit-tags.php?taxonomy=category&post_type=post_youtube' // URL (カテゴリー編集ページ)
    );
}
add_action('admin_menu', 'add_post_youtube_category_submenu');





// カスタム投稿タイプ 'post_works' のカテゴリーメタボックスを追加
function add_custom_category_meta_box_post_works() {
    add_meta_box(
        'custom-category-div', // メタボックスID
        'カテゴリー', // タイトル
        'custom_category_meta_box_post_works', // コールバック関数
        'post_works', // カスタム投稿タイプ
        'side', // 配置
        'core' // 優先順位
    );
}
add_action('add_meta_boxes', 'add_custom_category_meta_box_post_works');

// カスタムカテゴリーメタボックスのコールバック関数
function custom_category_meta_box_post_works($post) {
    // カテゴリースラッグ 'design' と 'coding' のみ取得
    $categories = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'slug' => array('design', 'coding'), // スラッグでフィルタリング
    ));

    echo '<div id="taxonomy-category" class="categorydiv">';
    echo '<ul id="categorychecklist" class="categorychecklist form-no-clear">';

    // カテゴリーをループして表示
    foreach ($categories as $category) {
        echo '<li id="category-' . esc_attr($category->term_id) . '">';
        echo '<label><input type="checkbox" name="post_category[]" value="' . esc_attr($category->term_id) . '"' . checked(in_array($category->term_id, wp_get_post_categories($post->ID)), true, false) . ' /> ' . esc_html($category->name) . '</label>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
}

// 投稿の保存時にカテゴリーを保存する
function save_custom_post_categories_post_works($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_category'])) {
        $categories = array_map('intval', $_POST['post_category']);
        wp_set_post_categories($post_id, $categories);
    }
}
add_action('save_post', 'save_custom_post_categories_post_works');


// カスタム投稿タイプ 'post_youtube' のカテゴリーメタボックスを追加
function add_custom_category_meta_box_post_youtube() {
    add_meta_box(
        'custom-category-div', // メタボックスID
        'カテゴリー', // タイトル
        'custom_category_meta_box_post_youtube', // コールバック関数
        'post_youtube', // カスタム投稿タイプ
        'side', // 配置
        'core' // 優先順位
    );
}
add_action('add_meta_boxes', 'add_custom_category_meta_box_post_youtube');

// カスタムカテゴリーメタボックスのコールバック関数
function custom_category_meta_box_post_youtube($post) {
    // カテゴリースラッグ 'camp', 'introduction', 'etc' のみ取得
    $categories = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'slug' => array('camp', 'introduction', 'etc'), // スラッグでフィルタリング
    ));

    echo '<div id="taxonomy-category" class="categorydiv">';
    echo '<ul id="categorychecklist" class="categorychecklist form-no-clear">';

    // カテゴリーをループして表示
    foreach ($categories as $category) {
        echo '<li id="category-' . esc_attr($category->term_id) . '">';
        echo '<label><input type="checkbox" name="post_category[]" value="' . esc_attr($category->term_id) . '"' . checked(in_array($category->term_id, wp_get_post_categories($post->ID)), true, false) . ' /> ' . esc_html($category->name) . '</label>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
}

// 投稿の保存時にカテゴリーを保存する
function save_custom_post_categories_post_youtube($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_category'])) {
        $categories = array_map('intval', $_POST['post_category']);
        wp_set_post_categories($post_id, $categories);
    }
}
add_action('save_post', 'save_custom_post_categories_post_youtube');


// カスタム投稿タイプ 'post_works' 用のテンプレートを指定
function custom_post_works_template($template) {
    if (is_singular('post_works')) {
        // テンプレートファイル single-works.php を使用
        $new_template = locate_template(array('single-works.php'));
        if ($new_template != '') {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'custom_post_works_template');

// カスタム投稿タイプ 'post_youtube' 用のテンプレートを指定
function custom_post_youtube_template($template) {
    if (is_singular('post_youtube')) {
        // テンプレートファイル single-youtube.php を使用
        $new_template = locate_template(array('single-youtube.php'));
        if ($new_template != '') {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'custom_post_youtube_template');


// カスタムメタボックスを追加
function add_custom_meta_box() {
    $post_types = array('page', 'post_works', 'post_youtube'); // カスタム投稿タイプを追加
    foreach ($post_types as $post_type) {
        add_meta_box(
            'custom_meta', // メタボックスID
            'SEO設定', // タイトル
            'custom_meta_callback', // コールバック関数
            $post_type, // 投稿タイプ: 固定ページとカスタム投稿タイプに追加
            'normal', // 表示位置
            'high' // 表示優先度
        );
    }
}
add_action('add_meta_boxes', 'add_custom_meta_box');

// メタボックスのコールバック関数
function custom_meta_callback($post) {
    // 既存のmeta titleとmeta descriptionを取得
    $meta_title = get_post_meta($post->ID, '_custom_meta_title', true);
    $meta_description = get_post_meta($post->ID, '_custom_meta_description', true);
    ?>
    <p>
        <label for="custom_meta_title">Meta Title:</label>
        <input type="text" id="custom_meta_title" name="custom_meta_title" value="<?php echo esc_attr($meta_title); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="custom_meta_description">Meta Description:</label>
        <textarea id="custom_meta_description" name="custom_meta_description" style="width: 100%;"><?php echo esc_textarea($meta_description); ?></textarea>
    </p>
    <?php
}

// メタボックスの値を保存
function save_custom_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['custom_meta_title'])) {
        update_post_meta($post_id, '_custom_meta_title', sanitize_text_field($_POST['custom_meta_title']));
    }
    if (isset($_POST['custom_meta_description'])) {
        update_post_meta($post_id, '_custom_meta_description', sanitize_textarea_field($_POST['custom_meta_description']));
    }
}
add_action('save_post', 'save_custom_meta');
