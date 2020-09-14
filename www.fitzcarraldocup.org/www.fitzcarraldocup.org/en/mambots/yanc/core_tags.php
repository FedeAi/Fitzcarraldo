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
// $Id: core_tags.php,v 1.2 2005/06/22 09:07:27 websmurf Exp $

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onSend', 'replaceCoreTags' );


function replaceCoreTags( $list, &$mailing, $receiver, $menuitem ) {
	global $mosConfig_live_site, $mosConfig_absolute_path, $newsletterConfig, $lang; 	 

	$send_date = str_replace(" ", "_", $mailing->send_date);

  $confirmlink = $mosConfig_live_site . "/index.php?option=com_yanc&Itemid=$menuitem&listid=$list->id&subscriber=" . md5($receiver->subscriber_id) . "&action=confirm"; 	 

  $unsubscribelink = $mosConfig_live_site . "/index.php?option=com_yanc&Itemid=$menuitem&listid=$list->id&action=unsubscribe"; 	 
  if($newsletterConfig['block_number'] <= 1){
    $unsubscribelink = $unsubscribelink . "&subscriber=" . md5($receiver->subscriber_id);
  }
	
  if($list->html == 1){
    $mailing->list_content = str_replace("[CONFIRM]", '<a href="' . $confirmlink . '" target="_blank">' . $lang->translate("confirmlinktekst") . '</a>', $mailing->list_content); 	 
    $mailing->list_content = str_replace("[UNSUBSCRIBE]", '<a href="' . $unsubscribelink . '" target="_blank">' . $lang->translate("unsubscribelinktekst") . '</a>', $mailing->list_content); 	 
  } else {
    $mailing->list_content = str_replace("[CONFIRM]", $lang->translate("confirmlinktekst")  . ":\n" . $confirmlink, $mailing->list_content); 	 
    $mailing->list_content = str_replace("[UNSUBSCRIBE]", $lang->translate("unsubscribelinktekst") . ":\n" . $unsubscribelink, $mailing->list_content);
  }
  $mailing->list_textonly = str_replace("[CONFIRM]", $lang->translate("confirmlinktekst")  . ":\n" . $confirmlink, $mailing->list_textonly); 	 
  $mailing->list_textonly = str_replace("[UNSUBSCRIBE]", $lang->translate("unsubscribelinktekst") . ":\n" . $unsubscribelink, $mailing->list_textonly);
	
	if($newsletterConfig['block_number'] <= 1){
    $mailing->list_content = str_replace("[NAME]", $receiver->subscriber_name, $mailing->list_content); 	 
    $mailing->list_textonly = str_replace("[NAME]", $receiver->subscriber_name, $mailing->list_textonly); 	
	}
	else {
	  $mailing->list_content = str_replace("[NAME]", '', $mailing->list_content); 	 
    $mailing->list_textonly = str_replace("[NAME]", '', $mailing->list_textonly);
  } 
  
  if(!empty($send_date)){
   if($newsletterConfig['enable_statistics'] == '1' && ($list->html == 1)){ 	 
     if(($newsletterConfig['statistics_per_subscriber'] == '1') && ($newsletterConfig['block_number'] <= 1)){ 	
       //add image with subscriberid 	 
       $mailing->list_content = $mailing->list_content . '<img src="' . $mosConfig_live_site . '/index2.php?option=com_yanc&Itemid=' . $menuitem . '&listid=' . $list->id . '&action=log&send=' . $send_date . '&subscriber=' . $receiver->subscriber_id . '" border="0" width="1" height="1" />'; 	 
     } 	 
     else{ 	 
       //add image without subscriberid 	 
       $mailing->list_content = $mailing->list_content . '<img src="' . $mosConfig_live_site . '/index2.php?option=com_yanc&Itemid=' . $menuitem . '&listid=' . $list->id . '&action=log&send=' . $send_date . '" border="0" width="1" height="1" />'; 	 
     } 	 
   } 	 
  } 	 
}
?>
