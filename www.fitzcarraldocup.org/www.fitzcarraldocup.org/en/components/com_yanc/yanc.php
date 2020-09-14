<?php
// --------------------------------------------------------------------------------
// YaNC - Yet another Newsletter Component
// Copyright (C) 2003-2004 TIM_online
// http://www.tim-online.nl
//
// All rights reserved.  YaNC is a component for Mambo 4.5. 
// It allows you to compose various newsletters and send then to subscribers 
// to different lists. You can use HTML or text mailings
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html
// --------------------------------------------------------------------------------
// $Id: yanc.php,v 1.21 2005/08/01 10:23:48 websmurf Exp $

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path, $my, $newsletterConfig;
require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.mailing.php" );
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.letters.php" );
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.phpmailer.php" );
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.smtp.php" );
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.log.php" );
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.dbclasses.php" );
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.subscribers.php" );
require_once( $mosConfig_absolute_path . '/administrator/components/com_yanc/configuration.php');
require_once( $mosConfig_absolute_path . '/components/com_yanc/languages/class.translator.php');

require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.urls.php" ); 
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.sites.php" ); 
require_once( $mosConfig_absolute_path . "/administrator/components/com_yanc/classes/class.yancsubscription.php" );

$sites = new sites(); 
$urls = new urls(); 
$newslettersSubscriptions = new YancSubscription();

$listid = mosGetParam( $_REQUEST, 'listid', 0 );
$subscriber = mosGetParam( $_REQUEST, 'subscriber', '' );
$action = mosGetParam( $_REQUEST, 'action', '' );
$senddate = str_replace("_", " ", mosGetParam( $_REQUEST, 'send', '' ));
$letters = new letters();
$mailing = new mailing();
$log = new log();
$subscribers = new subscribers();

$lang = new translator();

if($action == 'showRegistration'){
  HTML_frontend_newsletter::showMassSubscribe();
}
else if($action == 'saveMassSubscribe'){
  HTML_frontend_newsletter::saveMassSubscribe();
}
else if($action == 'click'){
  $siteid = mosGetParam( $_REQUEST, 'siteid', 0 );
  $urlid = mosGetParam( $_REQUEST, 'urlid', 0 );
  
  sendToLink($siteid, $urlid, $listid, $senddate);
}
else if($action == 'compose'){
  if(intval($my->id) < 1){
    mosNotAuth();
    return;
  }
  $task = mosGetParam( $_REQUEST, 'task', '' );
  
  $old_level = $my->gid;
  $userlevel = $acl->get_group_id($my->usertype);
  
  $my->gid = $userlevel;
  
  if(empty($task)){
    //has to be in frontend, because backend an frontend user levels are different
    $ltrs = $letters->getLists();  
      
    HTML_frontend_newsletter::showLetters($ltrs);
  }
  else if($task == 'edit'){
    $listid = mosGetParam($_REQUEST, 'cid', 0);
    
    //$message = $mailing->getUnsend($listid);
		 
    HTML_frontend_newsletter::editMailing($listid);
  }
  else if($task == 'save'){
    $mailing->saveMailing($listid, 0);
    mosRedirect("index.php?option=com_yanc&action=compose&Itemid=" . $Itemid . "&mosmsg=" . $lang->translate("mailingsaved"));
  }
  else if($task == 'preview'){
    HTML_frontend_newsletter::previewMailing($listid);
  }
  else if($task == 'publish'){
    HTML_frontend_newsletter::publishMailing($listid);
  }
  else {
    $ltrs = $letters->getLists();  
      
    HTML_frontend_newsletter::showLetters($ltrs);
  }
  $my->gid = $old_level;
}
else if($listid){
	HTML_frontend_newsletter::showPageHeader($listid);
	switch ($action){
		case 'subscribe': 
			HTML_frontend_newsletter::subscribe($listid, $subscriber); 
			break;
	  case 'unsubscribe';
			HTML_frontend_newsletter::unsubscribe($listid, $subscriber);
			break;
	  case 'confirm': 
			confirmSubscriber($listid, $subscriber); 
			break;
	  case 'view':
			HTML_frontend_newsletter::showMailing($listid, $senddate);
      		break;
	  case 'log':
			logItem($listid, $senddate, $subscriber);
			exit;			//BB not yet sure if this is right...
			break;
	  default:
			HTML_frontend_newsletter::showArchive($listid);
			break;
	}
}
else{
  $mainframe->SetPageTitle( $lang->translate("yanc_title_overview") );
  HTML_frontend_newsletter::showOverview();
}


function saveSubscriber($name, $email, $html, $listid, $output = 1, $subscribemessage = 1) {
	global $database, $Itemid, $lang, $newslettersSubscriptions, $my;
	
	$row = new mosUser( $database );
 	$row->name = $name;
 	
 	//save only id for registered users
 	if($my->id > 0){
 	  $row->id = $my->id;
 	} 
 	$row->email = $email;

	$result = $newslettersSubscriptions->saveSubscription($row, $listid, $html, $subscribemessage);

	if ($result !== null) {
		echo "<script> alert('" . $result . "'); window.history.go(-1); </script>\n";
	} else {
		if($output){
			if ($subscribemessage) echo $lang->translate("confirm_message_user");
			else echo $lang->translate("email_added");
			echo '<br><a href="' . sefRelToAbs("index.php?option=com_yanc&amp;Itemid=$Itemid") . '">' . $lang->translate("returntolists") . '</a><br /><br />';
		}
	}
}

function deleteSubscriber($name, $email, $listid){
	global $database, $Itemid, $lang, $newslettersSubscriptions;
	
	$row = new mosUser( $database );
 	$row->name = $name;
 	$row->email = $email;
	$result = $newslettersSubscriptions->deleteSubscription($row, $listid);

	if ($result !== null) {
		echo $result;
	} else {
		echo $lang->translate("email_removed") . "<br>";
		echo '<a href="' . sefRelToAbs("index.php?option=com_yanc&amp;Itemid=$Itemid") . '">' . $lang->translate("returntolists") . '</a><br /><br />';
	}
}

function confirmSubscriber($listid, $subscriber){
	global $database, $Itemid, $lang, $newslettersSubscriptions;
	
	$result = $newslettersSubscriptions->confirmSubscription($listid, $subscriber);

	if ($result !== null) {
		echo $result;
	} else {		
		echo $lang->translate("accountconfirmed") . "<br>";
		echo '<a href="' . sefRelToAbs("index.php?option=com_yanc&amp;Itemid=$Itemid") . '">' . $lang->translate("returntolists") . '</a><br /><br />';
	}  
}

function logItem($listid, $senddate, $subscriber){
  global $database, $mosConfig_absolute_path, $log;
  
  $log->log_view($listid, $senddate, $subscriber);
  
  //echo $query;
  ob_end_clean();
  $filename = $mosConfig_absolute_path . "/components/com_yanc/images/spacer.gif";
  $handle = fopen ($filename, "r");
  $contents = fread ($handle, filesize ($filename));
  fclose ($handle);
  header ("Content-type: image/gif");
  echo $contents;
  exit;
}

function sendToLink($siteid, $urlid, $listid, $senddate){
  global $database, $log;
  
  $log->log_site_click($siteid, $listid, $senddate);
  $log->log_url_click($urlid, $listid, $senddate);
  
  $query = "SELECT url FROM #__newsletter_urls WHERE url_id = $urlid";
  $database->setQuery($query);
  $url = $database->loadResult();
  
  mosRedirect( $url );
  exit();
}

?>
