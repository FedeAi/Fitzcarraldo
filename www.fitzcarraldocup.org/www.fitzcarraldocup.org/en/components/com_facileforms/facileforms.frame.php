<?php
/**
* Facile Forms - A Joomla Forms Application
* @version 1.4.4
* @package FacileForms
* @copyright (C) 2004-2005 by Peter Koch
* @license Released under the terms of the GNU General Public License
**/
define( "_VALID_MOS", 1 );

global $ff_config, $ff_mospath, $ff_compath, $ff_mossite, $ff_request;
global $ff_version, $ff_processor, $database, $mainframe, $my;

// get paths
$ff_mospath = str_replace('\\','/',dirname(dirname(dirname(__FILE__))));
$ff_compath = $ff_mospath.'/components/com_facileforms';

// get mos basics
chdir($ff_mospath);
include_once('globals.php');
require_once('configuration.php');

// load language file (in fact we only need _ISO)
if ($mosConfig_lang == '') $mosConfig_lang = 'english';
include_once ( 'language/'.$mosConfig_lang.'.php' );

require_once('includes/mambo.php');
if (file_exists('components/com_sef/sef.php')) {
	require_once('components/com_sef/sef.php');
} else {
	require_once('includes/sef.php');
}
require_once('includes/frontend.php');

/** retrieve some expected url arguments */
$option = trim( strtolower( mosGetParam( $_REQUEST, 'option' ) ) );
$Itemid = intval( mosGetParam( $_REQUEST, 'Itemid', null ) );

$database = new database(
	$mosConfig_host, $mosConfig_user, $mosConfig_password,
	$mosConfig_db, $mosConfig_dbprefix );
$database->debug( $mosConfig_debug );
$acl = new gacl_api();

/** mainframe is an API workhorse, lots of 'core' interaction routines */
$mainframe = new mosMainFrame( $database, $option, '.' );
$mainframe->initSession();

// get ff config
require_once($ff_compath.'/facileforms.class.php');
$ff_config = new facileFormsConf();
initFacileForms('frame');

// get ff parameters
$target  = mosGetParam($_REQUEST,'ff_target','');
$form    = mosGetParam($_REQUEST,'ff_form','');
$page    = mosGetParam($_REQUEST,'ff_page',1);
$task    = mosGetParam($_REQUEST,'ff_task','view');
$border  = mosGetParam($_REQUEST,'ff_border',0);
$align   = mosGetParam($_REQUEST,'ff_align',1);
$top     = mosGetParam($_REQUEST,'ff_top',0);
$suffix  = mosGetParam($_REQUEST,'ff_suffix','');
$runmode = mosGetParam($_REQUEST,'ff_mode',_FF_RUNMODE_FRONTEND);
$rmde    = mosGetParam($_REQUEST,'ff_rmde',0);

// build request array
$ff_request = array();
reset($_REQUEST);
while (list($prop, $val) = each($_REQUEST))
	if (!is_array($val) && substr($prop,0,9)=='ff_param_')
		$ff_request[$prop] = $val;

$template = $ff_mossite.'/templates/'.$mainframe->getTemplate().'/css/template_css.css';
if ($runmode != _FF_RUNMODE_FRONTEND) {
	require_once($ff_mospath.'/administrator/includes/auth.php');
	if ($rmde==2) {
		$mainframe->_setTemplate(true);
		$template = $ff_mossite.'/administrator/templates/'.$mainframe->getTemplate().'/css/template_css.css';
	} // if
} else {
	/** get the information about the current user from the sessions table */
	$my = $mainframe->getUser();
	/** detect first visit and update stats */
	$mainframe->detect();
} // if

$database->setQuery("select id from #__users where lower(username)=lower('$my->username')");
$id = $database->loadResult();
if ($id) $my->load($id);

require_once($ff_compath.'/facileforms.process.php');

$iso = split('=',_ISO);
echo '<?xml version="1.0" encoding="'.$iso[1].'"?>'."\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Facile Forms Frame</title>
<?php
// DO NOT REMOVE OR CHANGE OR OTHERWISE MAKE INVISIBLE THE FOLLOWING META
// FAILURE TO COMPLY IS A DIRECT VIOLATION OF THE GNU GENERAL PUBLIC LICENSE
// http://www.gnu.org/copyleft/gpl.html
?>
<meta name="Generator" content="FacileForms V<?php echo $ff_version; ?> (C) 2004-2005 by IBK Software AG.  All rights reserved."/>
<?php
// END OF COPYRIGHT
?>
<link rel="stylesheet" href="<?php echo $template; ?>" type="text/css"/>
</head>
<body style="background-color:transparent">
<?php
$ff_processor = new HTML_facileFormsProcessor(
	$runmode, true, $form, $page, $option, $Itemid,
	$border, $align, $top, $target, $suffix
);
if ($task=='submit') $ff_processor->submit(); else $ff_processor->view();
?>
</body>
</html>