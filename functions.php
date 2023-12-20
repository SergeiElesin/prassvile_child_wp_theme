<?php add_action( 'after_setup_theme', 'lsvr_pressville_child_theme_setup' );
if ( ! function_exists( 'lsvr_pressville_child_theme_setup' ) ) {
	function lsvr_pressville_child_theme_setup() {

		/**
		 * Load parent and child style.css
		 *
		 * @link https://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme
		 */
		add_action( 'wp_enqueue_scripts', 'lsvr_pressville_child_enqueue_parent_styles' );
		if ( ! function_exists( 'lsvr_pressville_child_enqueue_parent_styles' ) ) {
			function lsvr_pressville_child_enqueue_parent_styles() {

				// Load parent theme's style.css
				$parent_version = wp_get_theme( 'pressville' );
				$parent_version = $parent_version->Version;
				wp_enqueue_style( 'lsvr-pressville-main-style', get_template_directory_uri() . '/style.css', array(), $parent_version );

				// Load child theme's style.css
				$child_version = wp_get_theme();
				$child_version = $child_version->Version;
				wp_enqueue_style( 'lsvr-pressville-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'lsvr-pressville-general-style' ), $child_version );

                // Load RTL
                if ( is_rtl() ) {
                    wp_enqueue_style( 'lsvr-pressville-rtl-style', get_template_directory_uri() . '/rtl.css', array( 'lsvr-pressville-general-style' ), $parent_version );
                }

			}
		}

		/* Load editor style */
		add_action( 'enqueue_block_editor_assets', 'lsvr_pressville_child_load_editor_assets' );
		if ( ! function_exists( 'lsvr_pressville_child_load_editor_assets' ) ) {
			function lsvr_pressville_child_load_editor_assets() {

				$child_version = wp_get_theme();
				$child_version = $child_version->Version;
				wp_enqueue_style( 'lsvr-pressville-child-editor-style', get_stylesheet_directory_uri() . '/editor-style.css', array(), $child_version );

			}
		}

		/* Add your code after this comment */

		/*Добавление своего типа записи "Блог"*/
		add_action( 'init', 'register_post_types' );
		function register_post_types(){
			register_post_type('blog', array(
				'label'  => null,
				'labels' => array(
					'name'               => 'Блог', // основное название для типа записи
					'singular_name'      => 'Блог', // название для одной записи этого типа
					'add_new'            => 'Добавить пост в блог', // для добавления новой записи
					'add_new_item'       => 'Добавление поста в блог', // заголовка у вновь создаваемой записи в админ-панели.
					'edit_item'          => 'Редактирование поста из блога', // для редактирования типа записи
					'new_item'           => 'Новый пост в блоге', // текст новой записи
					'view_item'          => 'Смотреть пост', // для просмотра записи этого типа.
					'search_items'       => 'Искать пост в блоге', // для поиска по этим типам записи
					'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
					'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
					'parent_item_colon'  => '', // для родителей (у древовидных типов)
					'menu_name'          => 'Блог', // название меню
				),
				'description'         => 'Записи в личном блоге',
				'public'              => true,
				'publicly_queryable'  => true, // зависит от public
				 'exclude_from_search' => false, // зависит от public
				 'show_ui'             => true, // зависит от public
				'show_in_nav_menus'   => true, // зависит от public
				'show_in_menu'        => true, // показывать ли в меню адмнки
				'show_in_admin_bar'   => true, // зависит от show_in_menu
				'show_in_rest'        => true, // добавить в REST API. C WP 4.7
				'rest_base'           => null, // $post_type. C WP 4.7
				'menu_position'       => 4,
				'menu_icon'           => 'dashicons-edit',
				'capability_type'   => 'post',
				//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
				//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
				'hierarchical'        => false,
				'supports'            => [ 'title', 'editor', 'author','thumbnail','excerpt','comments' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
				'taxonomies'          => [ 'themes' ],
				'has_archive'         => true,
				'rewrite'             => true,
				'query_var'           => true,
			) );
		}

		// хук для регистрации таксономии для типа записи "Блог"
		add_action( 'init', 'create_taxonomy' );
		function create_taxonomy(){
			register_taxonomy( 'themes', [ 'blog' ], [
				'label'                 => '', // определяется параметром $labels->name
				'labels'                => [
					'name'              => 'Темы',
					'singular_name'     => 'Тема',
					'search_items'      => 'Найти темы',
					'all_items'         => 'Все темы',
					'view_item '        => 'Смотреть темы',
					'parent_item'       => 'Родительская тема',
					'parent_item_colon' => 'Родительская тема:',
					'edit_item'         => 'Изменить тему',
					'update_item'       => 'Обновить тему',
					'add_new_item'      => 'Добавить новую тему',
					'new_item_name'     => 'Новое имя темы',
					'menu_name'         => 'Темы',
				],
				'description'           => 'Темы для постов', // описание таксономии
				'public'                => true,
				//'publicly_queryable'    => null, // равен аргументу public
				'hierarchical'          => true,
				'rewrite'               => true,
				'show_in_rest' => true, // отображать в админке при добавлении поста
				'rest_base'             => 'post', // отображать в админке при добавлении поста не заменяя другое
			] );
		}

//		добавление ссылки "читать далее" на странице всех постов блога
		add_filter( 'excerpt_more', 'new_excerpt_more' );
		function new_excerpt_more( $more ){
			global $post;
			return '   <a class="post__title-link" href="'. get_permalink($post) . '">[ Читать далее... ]</a>';
		}

//		добавление маленького размера превью-картинки для плагина Ultimate Posts Widget
		add_image_size( 'small-size', 70, 70, true );

		//Удаление автоматических тегов в формах
//		add_filter( 'wpcf7_autop_or_not', '__return_false' );

		//		БЕЗОПАСНОСТЬ WORDPRESS
		/* Удалить версию WP */
			function remove_version_info() {
				return '';
			}
			add_filter('the_generator', 'remove_version_info');

			/* Удалить версии скриптов и стилей УБРАЛ ИЗ ЗА ОШИБКИ В БРАУЗЕРЕ*/
//			function remove_wp_version_strings( $src ) {
//				global $wp_version;
//				parse_str(parse_url($src, PHP_URL_QUERY), $query);
//				if ( !empty($query[‘ver’]) && $query[‘ver’] === $wp_version ) {
//					$src = remove_query_arg(‘ver’, $src);
//				}
//				return $src;
//			}
//			add_filter( ‘script_loader_src’, ‘remove_wp_version_strings’ );
//			add_filter( ‘style_loader_src’, ‘remove_wp_version_strings’ );

		/*Изменить сообщение на странице входа при ошибке */
		function no_wordpress_errors(){
			return 'Неверный Логин или Пароль';
		}
		add_filter( 'login_errors', 'no_wordpress_errors' );

//		Удалить ссылку на Windows Live Writer
		remove_action('wp_head', 'wlwmanifest_link');

//		Удалить ссылку на Really Simple Discovery
		remove_action('wp_head', 'rsd_link');

		/* Запрет нумерации пользователей и Redirect to Home page УБРАЛ ИЗ ЗА ОШИБКИ В БРАУЗЕРЕ*/
//		add_action(‘template_redirect’, ‘tb_template_redirect’);
//		function tb_template_redirect()
//		{
//			if (is_author())
//			{
//				wp_redirect( home_url() ); exit;
//			}
//		}

// ИЗМЕНЕНИЕ ПЛАГИНА ОБЪЯВЛЕНИЙ
//		изменение шаблона страницы категории объвлений
		add_action("init", "pressville_wpadverts_init", 20);
		function pressville_wpadverts_init() {
			remove_filter('template_include', 'adverts_template_include');
		}


//		изменить постоянную ссылку страницы отдельного объявления, чтобы не блокировалось блокираторами рекламы
		// после обновления плагина все делается в настройках плагина
//		add_action("adverts_post_type", "customize_adverts_post_type");
//		function customize_adverts_post_type( $args ) {
//			if(!isset($args["rewrite"])) {
//				$args["rewrite"] = array();
//			}
//			$args["rewrite"]["slug"] = "obyavlenie";
//			return $args;
//		}

		//		изменить постоянную ссылку страницы категории объявления, чтобы не блокировалось блокираторами рекламы
		// после обновления плагина все делается в настройках плагина
//		add_action("adverts_register_taxonomy", "customize_adverts_taxonomy");
//		function customize_adverts_taxonomy( $args ) {
//			if(!isset($args["rewrite"])) {
//				$args["rewrite"] = array();
//			}
//			$args["rewrite"]["slug"] = "kategoriya-obyavleniya";
//			return $args;
//		}
//		КОНЕЦ ИЗМЕНЕНИЯ ПЛАГИНА ОБЪЯВЛЕНИЙ

		//ШИФРОВАНИЕ Email
		function email_encode_function( $atts, $content ){
			return '<a href="'.antispambot("mailto:".$content).'">'.antispambot($content).'</a>';
		}
		add_shortcode( 'email', 'email_encode_function' );
//ШИФРОВАНИЕ НОМЕРА ТЕЛЕФОНА С ССЫЛКОЙ
		function phone_link_encode_function( $atts, $content ){
			return '<a href="'.antispambot("tel:".$content).'">'.antispambot($content).'</a>';
		}
		add_shortcode( 'phone-link', 'phone_link_encode_function' );
//ШИФРОВАНИЕ НОМЕРА ТЕЛЕФОНА БЕЗ ССЫЛКИ
		function phone_encode_function( $atts, $content ){
			return '<span>'.antispambot($content).'</span>';
		}
		add_shortcode( 'phone', 'phone_encode_function' );



//		Replace Ultimate Member placeholders after nav menus rendered
//		Исправление аватарки залогиненного пользователя в меню в версии плагина 2.3.0
		remove_filter( 'wp_nav_menu_objects', 'um_add_custom_message_to_menu', 9999 );
		/**
		 * Add dynamic profile headers
		 *
		 * @param $items
		 * @param $args
		 *
		 * @return mixed
		 */
		function um_add_custom_message_to_menu_custom( $items, $args ) {
			if ( ! is_user_logged_in() ) {
				$items = UM()->shortcodes()->convert_user_tags( $items );
				return $items;
			}

			um_fetch_user( get_current_user_id() );
			$items = UM()->shortcodes()->convert_user_tags( $items );
			um_reset_user();

			return $items;
		}
		add_filter( 'wp_nav_menu_items', 'um_add_custom_message_to_menu_custom', 9999, 2 );


	}

	//Изменение адреса страницы входа на всем сайте на нестандартную
	add_filter( 'site_url', 'wplogin_filter', 10, 3 );
	function wplogin_filter( $url, $path, $orig_scheme ) {
		$old = array( "/(wp-login\.php)/" );
		$new = array( "loginly5r21p08qka3gpsoufk3o95" );

		return preg_replace( $old, $new, $url, 1 );
	}

	/**
	 * Отключаем принудительную проверку новых версий WP, плагинов и темы в админке,
	 * чтобы она не тормозила, когда долго не заходил и зашел...
	 * Все проверки будут происходить незаметно через крон или при заходе на страницу: "Консоль > Обновления".
	 *
	 * @see https://wp-kama.ru/filecode/wp-includes/update.php
	 * @author Kama (https://wp-kama.ru)
	 * @version 1.1
	 */
	if( is_admin() ){
		// отключим проверку обновлений при любом заходе в админку...
		remove_action( 'admin_init', '_maybe_update_core' );
		remove_action( 'admin_init', '_maybe_update_plugins' );
		remove_action( 'admin_init', '_maybe_update_themes' );

		// отключим проверку обновлений при заходе на специальную страницу в админке...
		remove_action( 'load-plugins.php', 'wp_update_plugins' );
		remove_action( 'load-themes.php', 'wp_update_themes' );

		// оставим принудительную проверку при заходе на страницу обновлений...
		//remove_action( 'load-update-core.php', 'wp_update_plugins' );
		//remove_action( 'load-update-core.php', 'wp_update_themes' );

		// внутренняя страница админки "Update/Install Plugin" или "Update/Install Theme" - оставим не мешает...
		//remove_action( 'load-update.php', 'wp_update_plugins' );
		//remove_action( 'load-update.php', 'wp_update_themes' );

		// событие крона не трогаем, через него будет проверяться наличие обновлений - тут все отлично!
		//remove_action( 'wp_version_check', 'wp_version_check' );
		//remove_action( 'wp_update_plugins', 'wp_update_plugins' );
		//remove_action( 'wp_update_themes', 'wp_update_themes' );

		/**
		 * отключим проверку необходимости обновить браузер в консоли - мы всегда юзаем топовые браузеры!
		 * эта проверка происходит раз в неделю...
		 * @see https://wp-kama.ru/function/wp_check_browser_version
		 */
		add_filter( 'pre_site_transient_browser_'. md5( $_SERVER['HTTP_USER_AGENT'] ), '__return_empty_array' );
	}



//Установить категорию по умолчанию для организации, если категория не выбрана

	add_action('save_post', function($post_id, $post) {
		$custom_post_type = 'lsvr_listing';
		$custom_taxonomy = 'lsvr_listing_cat';
		$default_term_slug = 'drugie';

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		// If this is just a revision, don't set default category
		if (wp_is_post_revision($post->ID)) return;

		if ($post->post_type !== $custom_post_type) return;

		if (!in_array($post->post_status, ['publish', 'draft'])) return;

		// Only set default category if no terms are set yet
		$terms = wp_get_post_terms($post_id, $custom_taxonomy);
		if (!empty($terms)) return;

		$default_term = get_term_by('slug', $default_term_slug, $custom_taxonomy);
		if (empty($default_term))  return;

		// Assign the default category
		wp_set_object_terms($post_id, $default_term->term_id, $custom_taxonomy);
	}, 10, 2);



//РЕДАКТИРУЕМ ФОРМУ КОММЕНТАРИЕВ
//	Убираем поля e-mail и сайт из формы комментариев
	function remove_comment_fields($fields) {
		unset($fields['url']); // Удаляем URL
		unset($fields['email']); // Удаляем E-mail
		unset($fields['author']); //Удаляем имя
		unset($fields['cookies']); // Удаляем галочку куки
		//Создаем ново поле имя
		$fields['author'] = '<p class="comment-form-author"><label for="author">ИМЯ (Обязательно) <span class="required">*</span></label><input type="text" id="author" name="author" maxlength="30" required  ></p>';
		//Создаем новоую галочку куки
		$fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"><label for="wp-comment-cookies-consent">Запомнить имя для следующих комментариев</label></p>';
		return $fields;
	}
	add_filter('comment_form_default_fields', 'remove_comment_fields');

//	Делаем поле Имя обязательным и выводим ошибку при незаполнении
	function custom_validate_comment_author() {
		if( empty( $_POST['author'] ) || ( !preg_match( '/[^\s]/', $_POST['author'] ) ) )
			wp_die( __('Чтобы оставить комментарий укажите свое имя'), '', ['back_link' => true]);
			echo esc_url(wp_get_referer());
	}
	add_action( 'pre_comment_on_post', 'custom_validate_comment_author' );

//	Убираем надпись «Ваш e-mail не будет опубликован»
	function my_comments_form($default) {
		$default['comment_notes_before'] = '';
		return $default;
	}
	add_filter('comment_form_defaults','my_comments_form',999);

//КОНЕЦ РЕДАКТИРОВАНИЯ ФОРМЫ КОММЕНТАРИЕВ

} ?>