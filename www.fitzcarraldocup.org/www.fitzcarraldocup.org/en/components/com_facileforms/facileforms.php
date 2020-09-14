<?php
/**
* Facile Forms - A Joomla Forms Application
* @version 1.4.4
* @package FacileForms
* @copyright (C) 2004-2005 by Peter Koch
* @license Released under the terms of the GNU General Public License
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $database, $ff_config, $ff_mospath, $ff_compath, $ff_comsite, $ff_request, $ff_processor, $ff_target;

// get paths
$ff_mospath = str_replace('\\','/',dirname(dirname(dirname(__FILE__))));
$ff_compath = $ff_mospath.'/components/com_facileforms';

// load config and initialize globals
require_once($ff_compath.'/facileforms.class.php');
$ff_config = new facileFormsConf();
initFacileForms();

$formid = null;
$formname = null;
$task = 'view';
$page = 1;
$inframe = 0;
$border = 0;
$align = 1;
$left = 0;
$top = 0;
$suffix = '';
$mustFrame = false;
$parprv = '';
$ff_request = array();

if (!$ff_target) $ff_target = 1; else $ff_target++;
$target = mosGetParam($_REQUEST,'ff_target','');
$myTarget = $target==$ff_target || ($target=='' && $ff_target==1);

if (isset($ff_applic) && $ff_applic=='mod_facileforms') {
	// get the module parameters
	$formname = $params->get('ff_mod_name');
	$page     = intval($params->get('ff_mod_page', $page));
	$inframe  = 1; $mustFrame = true;
	$border   = intval($params->get('ff_mod_border', $border));
	$align    = intval($params->get('ff_mod_align', $align));
	$left     = intval($params->get('ff_mod_left', $left));
	$top      = intval($params->get('ff_mod_top', $top));
	$suffix   = $params->get('ff_mod_suffix', '');
	$parprv   = $params->get('ff_mod_parprv', '');
	addRequestParams($params->get('ff_mod_parpub', ''));
} else
	if ($Itemid > 0) {
		// get parameters from menu
		$menu =& new mosMenu($database);
		$menu->load($Itemid);
		$params =& new mosParameters($menu->params);
		$formname = $params->get('ff_com_name');
		$page     = intval($params->get('ff_com_page', $page));
		$inframe  = intval($params->get('ff_com_frame', $inframe));
		$border   = intval($params->get('ff_com_border', $border));
		$align    = intval($params->get('ff_com_align', $align));
		$left     = intval($params->get('ff_com_left', $left));
		$top      = intval($params->get('ff_com_top', $top));
		$suffix   = $params->get('ff_com_suffix', '');
		$parprv   = $params->get('ff_com_parprv', '');
		addRequestParams($params->get('ff_com_parpub', ''));
	} // if

if ($myTarget) {
	// allow overriding by url params
	$formid = mosGetParam($_REQUEST, 'ff_form', $formid);
	if ($formid==null)
		$formname = mosGetParam($_REQUEST,'ff_name', $formname);
	else
		$formname = null;
	$task = mosGetParam($_REQUEST,'ff_task', $task);
	$page = mosGetParam($_REQUEST,'ff_page', $page);
	if (!$mustFrame)
		$inframe  = mosGetParam($_REQUEST,'ff_frame', $inframe);
	$border = mosGetParam($_REQUEST,'ff_border', $border);
	$align1 = mosGetParam($_REQUEST,'ff_align', -1);
	if ($align1>=0) {
		$align = mosGetParam($_REQUEST, 'ff_align', $align);
		$left = 0;
		if ($align>2) { $left = $align; $align = 3; }
	} // if
	$top = mosGetParam($_REQUEST,'ff_top',$top);
	$suffix = mosGetParam($_REQUEST,'ff_suffix',$suffix);
} // if

// load form
$ok = true;
if ($formid != null) {
	$database->setQuery(
		"select * from #__facileforms_forms ".
		"where id=$formid and published=1 and runmode<2"
	);
	$forms = $database->loadObjectList();
	if (count($forms) < 1) {
		echo '[Form '.$formid.' not found!]';
		$ok = false;
	} else
		$form = $forms[0];
} else
	if ($formname != null) {
		$database->setQuery(
			"select * from #__facileforms_forms ".
			"where name='$formname' and published=1 and runmode<2 ".
			"order by ordering, id"
		);
		$forms = $database->loadObjectList();
		if (count($forms) < 1) {
			echo '[Form '.$formname.' not found!]';
			$ok = false;
		} else
			$form = $forms[0];
	} else {
		echo '[No form id or name provided!]';
		$ok = false;
	} // if

if ($ok) {
	if ($form->name==$formname) addRequestParams($parprv);
	if ($myTarget) {
	    reset($_REQUEST);
	    while (list($prop, $val) = each($_REQUEST))
	        if (!is_array($val) && substr($prop,0,9)=='ff_param_')
	            $ff_request[$prop] = $val;
	} // if

	if ($inframe) {
	    // open frame and detach processing
	    $divstyle = 'overflow:hidden;';
	    switch ($align) {
	        case 0: $divstyle .= 'text-align:left;';   break;
	        case 1: $divstyle .= 'text-align:center;'; break;
	        case 2: $divstyle .= 'text-align:right;';  break;
	        case 3: if ($left > 0) $divstyle .= 'left:'.$left.'px;'; break;
	        default: break;
	    } // switch
	    if ($top > 0) $divstyle .= 'top:'.$top.'px;';
	    $framewidth = 'width="'.$form->width;
	    if ($form->widthmode) $framewidth .= '%" '; else $framewidth .= '" ';
	    $frameheight = '';
	    if (!$form->heightmode) $frameheight = 'height="'.$form->height.'" ';
	    echo '<div style="position:relative;'.$divstyle.'">'."\n";
	    $url = $ff_comsite.'/facileforms.frame.php?ff_target='.$ff_target.'&amp;ff_form='.$form->id;
	    if ($form->runmode>0) $url .= '&amp;ff_rmde='.$form->runmode;
	    if ($page>1)          $url .= '&amp;ff_page='.$page;
	    if ($border>0)        $url .= '&amp;ff_border='.$border;
	    if ($left > 3) $align = $left;
	    if ($align!=1)        $url .= '&amp;ff_align='.$align;
	    if ($top>0)           $url .= '&amp;ff_top='.$top;
	    if ($suffix!='')      $url .= '&amp;ff_suffix='.urlencode($suffix);
	    reset($ff_request);
	    while (list($prop, $val) = each($ff_request))
	        $url .= '&amp;'.$prop.'='.urlencode($val);
	    reset($_POST);
	    while (list($prop, $val) = each($_POST))
	        if (!is_array($val) && !ff_reserved($prop))
	            $url .= '&amp;'.$prop.'='.urlencode($val);
	    reset($_GET);
	    while (list($prop, $val) = each($_GET))
	        if (!is_array($val) && !ff_reserved($prop))
	            $url .= '&amp;'.$prop.'='.urlencode($val);
	    $params =   'id="ff_frame'.$form->id.'" '.
	                'src="'.$url.'" '.
	                $framewidth.
	                $frameheight.
	                'frameborder="'.$border.'" '.
	                'allowtransparency="true" '.
	                'scrolling="no" ';
	    echo "<iframe ".$params.">\n".
	         "<p>Sorry, your browser cannot display frames!</p>\n".
	         "</iframe>\n".
	         "</div>\n";
	} else {
	    // process inline
	    $database->setQuery("select id from #__users where lower(username)=lower('$my->username')");
	    $id = $database->loadResult();
	    if ($id) $my->load($id);
	    require_once($ff_compath.'/facileforms.process.php');
	    $tabparams = '';
	    $tabstyle  = '';
	    $divstyle  = 'left:0px;top:0px;position:relative;';
	    $toprow    = '';
	    $botrow    = '';
	    $leftcol   = '';
	    $midcol    = '';
	    $rightcol  = '';
	    if ($border) $divstyle .= "border:1px solid black;";
	    switch ($align) {
	        case 0: // left
	            if ($form->widthmode) {
	                $tabparams .= ' width="'.$form->width.'%"';
	                $divstyle  .= 'width:100%;';
	            } else {
	                $tabparams .= ' width="'.$form->width.'"';
	                $divstyle  .= 'width:'.$form->width.'px;';
	            } // if
	            $midcol = '<td>';
	            break;
	        case 1: // center
	            $tabparams .= ' width="100%"';
	            if ($form->widthmode) {
	                $divstyle  .= 'width:100%;';
	                $leftcol    = '<td>&nbsp;</td>';
	                $midcol     = '<td width="'.$form->width.'%">';
	                $rightcol   = '<td>&nbsp;</td>';
	            } else {
	                $divstyle  .= 'width:'.$form->width.'px;';
	                $leftcol    = '<td width="50%"></td>';
	                $midcol     = '<td>';
	                $rightcol   = '<td width="50%"></td>';
	            } // if
	            break;
	        case 2: // right
	            if ($form->widthmode) {
	                $tabparams .= ' width="100%"';
	                $divstyle  .= 'width:100%;';
	                $leftcol    = '<td>&nbsp;</td>';
	                $midcol     = '<td width="'.$form->width.'%">';
	            } else {
	                $tabparams .= ' width="100%"';
	                $divstyle  .= 'width:'.$form->width.'px;';
	                $leftcol    = '<td width="100%"></td>';
	                $midcol     = '<td>';
	            } // if
	            break;
	        case 3: // absolute
	            if ($form->widthmode) {
	                $tabparams .= ' width="100%"';
	                $divstyle  .= 'width:'.$form->width.'%;';
	            } else {
	                $tabparams .= ' width="'.($form->width+$left+$left).'"';
	                $divstyle  .= 'width:'.$form->width.'px;';
	            } // else
	            $leftcol    = '<td width="'.$left.'"></td>';
	            $midcol     = '<td>';
	            $rightcol   = '<td width="'.$left.'"></td>';
	    } // switch
	    if ($top > 0) {
	        $toprow = '<tr style="height:'.$top.'px">'.$leftcol.$midcol.'</td>'.$rightcol.'</tr>';
	        if ($leftcol  != '') $leftcol  = '<td></td>';
	                             $midcol   = '<td>';
	        if ($rightcol != '') $rightcol = '<td></td>';
	        $botrow = '<tr style="height:'.$top.'px">'.$leftcol.$midcol.'</td>'.$rightcol.'</tr>';
	    } // if
	    if (!$form->heightmode) {
	        $tabstyle .= 'height:'.($form->height+$top+$top).'px;';
	        $divstyle .= 'height:'.$form->height.'px;';
	    } // if
	    if ($tabstyle!='') $tabparams .= ' style="'.$tabstyle.'"';
	    echo '<div id="overDiv" style="position:absolute;visibility:hidden;z-index:1000;"></div>'."\n";
	    echo '<table cellpadding="0" cellspacing="0" border="0"'.$tabparams.'>'."\n";
	    echo $toprow.'<tr>'.$leftcol.$midcol.'<div style="'.$divstyle.'">'."\n";
	    if ($left > 3) $align = $left;
	    $ff_processor = new HTML_facileFormsProcessor(
	        _FF_RUNMODE_FRONTEND, false, $form->id, $page, $option,
	        $Itemid, $border, $align, $top, $ff_target, $suffix
	    );
	    if ($task == 'submit') $ff_processor->submit(); else $ff_processor->view();
	    echo '</div></td>'.$rightcol.'</tr>'.$botrow.'</table>'."\n";
	} // if
} // if

?>