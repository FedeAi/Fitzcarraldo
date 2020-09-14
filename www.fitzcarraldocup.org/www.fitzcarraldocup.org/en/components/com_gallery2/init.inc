<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * This files will get executed first most of the time by moduels and this component
 * It loads the basic info and classes.
 *
 * @package com_gallery2
 * @subpackage core files
 */

/**
 * defines that path to front-end of this component
 */
define( 'BaseUrl', dirname(__FILE__));
/**
 * defines that path to back-end of this component
 */
define( 'BaseAdminUrl', realpath(dirname(__FILE__).'/../../administrator/components/com_gallery2'));

/**
 * Load language file
 */
global $mosConfig_lang;
if (file_exists(BaseAdminUrl.'/language/'.$mosConfig_lang.'.php')){
  include(BaseAdminUrl.'/language/'.$mosConfig_lang.'.php');
} else {
  include(BaseAdminUrl.'/language/english.php');
}

/**
 * load class we need no matter what
 * @note at the moment we need cache and core
 */
 
require_once(dirname(__FILE__) . '/classes/core.class');
core::classRequireOnce('g2cache');
$GLOBALS['g2Cache'] = new g2cache();

/**
 * these are loaded for now, but will be removed in version 2.0.11
 */
core::classRequireOnce('utility');
core::classRequireOnce('user');
core::classRequireOnce('group');
core::classRequireOnce('config');

/**
 * load g2Config global
 */
$GLOBALS['g2Config'] = core::loadConfig();

?>