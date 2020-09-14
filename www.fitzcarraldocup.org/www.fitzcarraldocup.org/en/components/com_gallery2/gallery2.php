<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );	
/**
 * Mother file of the component
 *
 * @package com_gallery2
 * @subpackage core files
 */

require_once(dirname(__FILE__) . '/init.inc');
global $g2Config, $my;
$page = mosGetParam( $_REQUEST, 'page', 'gallery' );
$task = mosGetParam( $_REQUEST, 'task', null );

switch($page){
	case 'debug':
		include_once( BaseUrl.'/pages/debug.php' );
	break;
	case 'useralbum':
		/* make sure this can only happen when we activate this */
		if(empty($g2Config['enableAlbumCreation'])){
			mosRedirect($g2Config['embedUri'], 'This page is not active');
		} else {
			include_once( BaseUrl.'/pages/user.album.php');
		}
	break;
	case 'sitemap';
		include_once( BaseUrl.'/pages/sitemap.php');
	break;
	case 'gallery':
	default:
		/* load the core component but first check user albums but only if user is logged in and it 
		 * is configured. */
		if(!empty($my->usertype) && !empty($g2Config['enableAlbumCreation'])){
			core::classRequireOnce('userAlbum');
			$albumCheck = userAlbum::getUserAlbumId();
			$cookie = userAlbum::isCookieSet();
			if(!$albumCheck && !$cookie){
				/* no album yet, let's give them a option */
				/* link to create a album, form to set cookie */
				include_once( BaseUrl.'/pages/user.album.php');
			}
		}
		include_once(BaseUrl.'/pages/main.php');
	break;
}
/* If you want to remove the footer, please consider donating to support this component! */
require_once(BaseUrl.'/pages/footer.php' );
?>