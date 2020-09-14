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
// $Id: yanc.html.php,v 1.16 2005/08/01 10:23:48 websmurf Exp $

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/HTML_toolbar.php' );

class HTML_frontend_newsletter{
	
	function showOverview(){
		global $my, $mosConfig_live_site, $Itemid, $lang, $newslettersSubscriptions;
		
		$rows = $newslettersSubscriptions->getLists($my);
		
?>
		<div class="componentheading">
      <?php echo $lang->translate("newsletterheading"); ?>
    </div>
    <div class="maintext">
      <?php echo $lang->translate("newsletterdescription"); ?>
    </div>
    <?php
    if (count( $rows )) { ?>
    <div>
    	<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="32" height="20" align="center" class="sectiontableheader">&nbsp;</td>
          <td height="20" class="sectiontableheader"><?php echo $lang->translate("header_title_newsletter"); ?></td>
					<td width="25%" height="20" class="sectiontableheader" align="right">&nbsp;</td>
        </tr>
<?php
		foreach ($rows AS $row){
?>
			<tr>
				<td valign="top"><a href="<?php echo sefRelToAbs("index.php?option=com_yanc&amp;Itemid=$Itemid&amp;listid=$row->id"); ?>"><img src="<?php echo $mosConfig_live_site;?>/components/com_yanc/images/folder_blue.png" border="0"></a></td>
				<td valign="top"><?php echo $row->list_name; ?></td>
				<td align="right" valign="top">
					<a href="<?php echo sefRelToAbs("index.php?option=com_yanc&amp;Itemid=$Itemid&amp;listid=$row->id&amp;action=subscribe"); ?>"><?php echo $lang->translate("subscribe"); ?></a>


				</td>
			</tr>
<?php
		}
?>
			</table>
			<?php 
// disallow unsubscription from the site//BB replace allof this by MassSubscription list workflow like in CB...
?>					<br>
Se invece volete cancellare il vostro indirizzo dalla mailing list <a href="<?php echo sefRelToAbs("index.php?option=com_yanc&amp;Itemid=$Itemid&amp;listid=$row->id&amp;action=unsubscribe"); ?>">cliccate qui.</a>

<?php } ?>
	</div>			
<?php
	}
	
	function showMassSubscribe(){
	  global $my, $database, $mosConfig_live_site, $Itemid, $option, $lang, $newslettersSubscriptions;
  
	  if(intval($my->id) < 1){
	    mosNotAuth();
      return;
	  }
	  
	  $YaNCUsers = new mosUser($database);
	  $YaNCUsers->load($my->id);
	  $rows = $newslettersSubscriptions->getSubscriberLists($YaNCUsers)
	  ?>
		<div class="componentheading">
        <?php echo $lang->translate("masssubscribe"); ?>
    </div>
    <div class="contentdescription">
        <?php echo $lang->translate("masssubscribe_description"); ?>
    </div>
    <?php
    if (count( $rows )) { ?>
    <div><br />
    <form action="index.php" method="POST" name="mosUserForm">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
          <td width="32" height="20" align="center" class="sectiontableheader">&nbsp;</td>
          <td width="25%" height="20" class="sectiontableheader"><?php echo $lang->translate("header_title_newsletter"); ?></td>
					<td height="20" class="sectiontableheader"><?php echo $lang->translate("header_desciption_newsletter"); ?></td>
        </tr>
<?php
		foreach ($rows AS $row){
?>
			<tr>
				<td valign="top"><input type="checkbox" name="items[]" value="<?php echo $row->id; ?>" <?php if($row->subscribed) { echo 'checked="checked" '; }?>/></td>
				<td valign="top"><?php echo $row->list_name; ?></td>
				<td valign="top"><?php echo $row->list_desc; ?></td>
			</tr>
<?php
		}
?>
			</table>
<?php } ?>
      <br />
      <input type="checkbox" name="html" value="1" <?php if((!isset($rows[0]->receive_html)) or $rows[0]->receive_html) { echo 'checked="checked" '; }?> /> <?php echo $lang->translate("receive_html"); ?><br /><br />
      <input class="button" type="button" value="<?php echo $lang->translate("update"); ?>" onclick="submit();" />
    	<input type="hidden" name="option" value="<?php echo $option; ?>">
    	<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>">
    	<input type="hidden" name="action" value="saveMassSubscribe" />
    </form>
    </div>	
<?php
	}
	
	function saveMassSubscribe(){
	  global $database, $my, $lang, $newslettersSubscriptions;
	  
	  $lists = mosGetParam($_REQUEST, 'items', array());
	  $html = mosGetParam($_REQUEST, 'html', 0);
	  
	  $YaNCUsers = new mosUser($database);
	  $YaNCUsers->load($my->id);
	  $result = $newslettersSubscriptions->saveMassSubscribe($YaNCUsers, $lists, $html, true);
	  if ($result) echo $result;
	  else echo $lang->translate("masssubscribe_updated");
	}
	
	function subscribe($listid, $subscriber){
		global $newsletterConfig;
	  
		if(isset($_POST['email']) and (!empty($_POST['email']))) {
			if(($newsletterConfig['name_required']) && (isset($_POST['name']) and (!empty($_POST['name'])))) { 
				saveSubscriber(addslashes($_POST['name']), addslashes($_POST['email']), addslashes(isset($_POST['html']) ? $_POST['html']: null), $listid);
			} else {
				saveSubscriber('', addslashes($_POST['email']), addslashes(isset($_POST['html']) ? $_POST['html']: null), $listid);
	    	}
		} else {
			//new subscriber					//BB: implement MassSubscribe workflow if user logged in....
			HTML_frontend_newsletter::showField($listid, "subscribe");
		}
	}
	
	function unsubscribe($listid, $subscriber){
		global $newsletterConfig;
	  
		if(isset($_POST['email']) && !empty($_POST['email'])){
		    if(($newsletterConfig['name_required']) && (isset($_POST['name']) and (!empty($_POST['name'])))) {
				deleteSubscriber(addslashes($_POST['name']), addslashes($_POST['email']), $listid);
		    } else {
		    	deleteSubscriber("", addslashes($_POST['email']), $listid);
		    }
		} else {
			//new subscriber
			HTML_frontend_newsletter::showField($listid, "unsubscribe", $subscriber);
		}
	}
	
	function loadSubscribingUser($subscriberCode) {
		global $newslettersSubscriptions, $database;
		
		$user = $newslettersSubscriptions->loadSubscribingUser($subscriberCode);
		if ($user === null) {
			$user = new mosUser($database);
			$user->name = "";
			$user->email = "";
		}
		return $user;
	}
	
	function showField($listid, $action, $subscriber = '') {
		global $Itemid, $letters, $database, $newsletterConfig, $lang;
		$list = $letters->getListDetails($listid);
		
		$user = HTML_frontend_newsletter::loadSubscribingUser($subscriber);
?>
  <script language="JavaScript">
  <!--
  
  function validate(){
    if(<?php if($newsletterConfig['name_required']){ ?>document.showField.name.value == "" || <?php } ?>document.showField.email.value == ""){
      alert('<?php echo $lang->translate("enter_data"); ?>');
      return false;
    }
    else{
      return true;
    }
  }
  
  //-->
  </script>
	<form method="post" name="showField" action="<?php echo sefRelToAbs("index.php?option=com_yanc&amp;Itemid=$Itemid&amp;listid=$listid&amp;action=$action"); ?>">
	<table border="0" cellpadding="0" cellspacing="0" class="contentpane" width="100%">
    <tr>
      <th></th>
      <th style="text-align:left;"><?php echo $lang->translate( (empty($user->name)) ? "input_details" : "your_details" ); ?></th>
      <th width="40%"></th>
    </tr>
<?php if($newsletterConfig['name_required']){ ?>
    <tr>
      <td><?php echo $lang->translate("input_name"); ?></td>
      <td><input type="text" name="name" class="inputbox" maxlength="64" value="<?php echo $user->name; ?>" <?php if ($action=='unsubscribe' && !empty($user->name)){echo 'readonly="readonly"';}; ?>></td>
      <td></td>
    </tr>
<?php } ?>
    <tr>
      <td><?php echo $lang->translate("input_email"); ?></td>
      <td><input type="text" name="email" class="inputbox" maxlength="64" value="<?php echo $user->email; ?>" <?php if ($action=='unsubscribe' && !empty($user->name)){echo 'readonly="readonly"';}; ?>></td>
      <td></td>
    </tr>
<?php
    if($list->html && ($action != 'unsubscribe')){
?>
    <tr>
      <td></td>
      <td><input type="checkbox" name="html" value="1" class="inputbox" checked /><?php echo $lang->translate("receive_html"); ?></td>
      <td></td>
    </tr>
<?php
    }
?>
    <tr>
      <td colspan="2"><br /><input type="submit" name="submit" value="<?php echo $lang->translate("$action"); ?>" class="button" onclick="return validate();" /></td>
      <td></td>
    </tr>
  </table>
	</form><br><br>
	Compilando il modulo di abbonamento alla Fitzletter l'utente d&agrave; il consenso al trattamento dei dati ed autorizza l’Associazione Velica Fitzcarraldo alla custodia dei propri dati. 
Tali dati non saranno comunicati a terzi.  Saranno pertanto utilizzati solo da Associazione Velica Fitzcarraldo per l'invio di materiale informativo,commerciale e pubblicitario 
strettamente legato al sito, nel pieno rispetto del D.Lgs.196/2003.<br>
La titolarit&agrave; dei dati &egrave; di Associazione Velica Fitzcarraldo – Via Colombo 7, Brenzone (VR).<br>
L'elenco dei responsabili dei dati &egrave; disponibile presso la sede di Associazione Velica Fitzcarraldo.<br>
Il trattamento dei dati avviene con modalit&agrave; automatizzate e viene effettuato in Italia. <br>
L'articolo 7 D.Lgs.196/2003 riconosce all'interessato il diritto di accesso ai propri dati e il diritto di chiederne, in qualunque momento, la cancellazione, l'aggiornamento, la rettifica, l'integrazione, il blocco dei dati trattati in violazione di legge.<br>
Il conferimento dei propri dati &egrave; facoltativo.Qualora l'utente decidesse di non fornire i propri dati Associazione Velica Fitzcarraldo non potr&agrave; inviargli la newsletter.<br>
&Egrave; diritto dell'utente poter consultare, modificare, opporsi o far cancellare i propri dati, scrivendo a Associazione Velica Fitzcarraldo.

<?php
	}
	
	function showPageHeader($listid){
		global $database, $mainframe, $lang;
		
		$query = "SELECT list_name, list_desc FROM #__newsletter_letters WHERE id = " . $listid;
		$database->setQuery($query);
		$row = $database->loadRow();
		
		$mainframe->SetPageTitle( $row[0]);
?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="contentheading"><?php echo $row[0]; ?></td>
			</tr>
			<tr>
				<td class="small"><?php echo $lang->translate("description") ?><?php echo $row[1]; ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
		  </tr>
		</table>
<?php
	}
	
	function showarchive($listid){
	  global $database, $mosConfig_live_site, $Itemid, $my, $lang;
	  
	  //check if user has access to it...
	  $query = "SELECT count(1) AS aantal FROM #__newsletter_letters WHERE hidden <= '$my->gid' AND id = " . intval($listid);
	  $database->setQuery($query);
	  $row = $database->loadRow();
  
	  
	  if($row[0] == 0){
      mosNotAuth();
      return;
		}
		
		$query = "SELECT send_date, list_subject FROM #__newsletter_mailing WHERE list_id = " . $listid . " AND published = 1 AND visible = 1 ORDER BY send_date DESC";
	  $database->setQuery($query);
		$rows = $database->loadObjectList();
		
?>   
    <table width="100%" cellpadding="4" cellspacing="0" border="0" class="contentpane">
      <tr>
        <td width="32" height="20" align="center" class="sectiontableheader">&nbsp;</td>
        <td width="30%" height="20" class="sectiontableheader"><?php echo $lang->translate("header_newsletter_date"); ?></td>
				<td height="20" class="sectiontableheader"><?php echo $lang->translate("header_newsletter_subject"); ?></td>
      </tr>
<?php
      if (count( $rows )) { 
        foreach ($rows AS $row){
          $send_date = mosFormatDate ( $row->send_date );
          $row->send_date = str_replace(" ", "_", $row->send_date);
        ?>
      <tr>
        <td width="32" height="20" align="center"><a href="<?php echo "index2.php?option=com_yanc&amp;Itemid=$Itemid&amp;listid=$listid&send=$row->send_date&action=view"; ?>" target="_blank"><img src="<?php echo $mosConfig_live_site;?>/components/com_yanc/images/search.gif" border="0" height="15"></a></td>
        <td width="25%" height="20"><?php echo $send_date; ?></td>
				<td height="20"><a href="<?php echo "index2.php?option=com_yanc&amp;Itemid=$Itemid&amp;listid=$listid&send=$row->send_date&action=view"; ?>" target="_blank"><?php echo $row->list_subject; ?></a></td>
      </tr>
    
<?php   }
      } ?>
    </table>
<?php		
	}
	
	function showMailing($listid, $send_date){
	  global $database, $mosConfig_live_site, $my, $lang, $_MAMBOTS, $letters, $Itemid;
	  
	  //check if user has access to it...
	  $query = "SELECT count(1) AS aantal FROM #__newsletter_letters WHERE hidden <= '$my->gid' AND id = " . intval($listid);
	  $database->setQuery($query);
	  $row = $database->loadRow();
  
	  if($row[0] == 0){
	  	mosNotAuth();
		return;
	  }

	  $_MAMBOTS->loadBotGroup( 'yanc' );

	  $mailing = null;
	  $query = "SELECT * FROM #__newsletter_mailing WHERE list_id = " . $listid . " AND send_date = '" . urldecode($send_date) . "'";
	  $database->setQuery($query);
	  $database->loadObject($mailing);

	  $list = $letters->getListDetails($listid);

	  $mail = new PHPMailer();
	  $_MAMBOTS->trigger( 'onPrepareContent', array( &$mailing, &$mail, 1 ) );
	  $receiver = new yancSubscriber($database);
	  $_MAMBOTS->trigger( 'onSend', array( $list, &$mailing, $receiver, $Itemid ) );

		?>   
    <table width="100%" cellpadding="4" cellspacing="0" border="0" class="contentpane">
      <tr>
        <td height="20" width="150" class="sectiontableheader"><?php echo $lang->translate("header_newsletter_date"); ?>:</td>
        <?
    		$date = mosFormatDate ( $send_date );
    		?>
        <td class="sectiontableheader"><?php echo $date; ?></td>
      </tr>
      <tr>
				<td height="20"><b><?php echo $lang->translate("header_newsletter_subject"); ?>:</b></td>
				<td><?php echo $mailing->list_subject; ?></td>
      </tr>
      <tr>
				<td colspan="2" height="20"><b><?php echo $lang->translate("header_newsletter_content"); ?>:</b></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo $mailing->list_content ?></td>
      </tr>
<?php
      $mailing->attachments = explode("\n", $mailing->attachments);
      if(is_array($mailing->attachments)){
      	array_pop($mailing->attachments);
      }
		  if(sizeof($mailing->attachments)){
		  	
?>      
      <tr>
        <td colspan="2">
          <b><?php echo $lang->translate("attachedfiles"); ?>:</b><br />
<?php 
          foreach ($mailing->attachments AS $attachment){
?>
            <a href="<?php echo $mosConfig_live_site; ?>/images/stories/newsletter/<?php echo $attachment; ?>" target="_blank"><?php echo $attachment; ?></a><br />
<?php
          }
?>      </td>
      </tr>
<?php } ?>
    </table>
<?php
	}
	
	function showLetters($rows){
	  global $option, $Itemid, $lang;

?>
    <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td>&nbsp;</td>
      <td width="10%">
  		 <?php
  		 mosToolBar::startTable();
  		 mosToolBar::editList();
  		 mosToolBar::endtable();
  		?>
  		</td>
		</tr>
		</table>
    <form action="index.php" method="post" name="adminForm">
    <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <th width="2%" class="contentheading">#</td>
      <th width="3%" class="contentheading">&nbsp;</th>
      <th width="40%" class="contentheading"><?php echo $lang->translate("list_name"); ?></th>
      <th width="45%" class="contentheading"><?php echo $lang->translate("list_sender"); ?></th>
    </tr>
<?php
	$k=0;
  	for ($i=0, $n=count( $rows ); $i < $n; $i++) {
  		$row =& $rows[$i];
?>
			<tr class="<?php echo "row$k"; ?>">
	      <td><?php echo $i+1; ?></td>
	      <td><input type="radio" id="cb<?php echo $i;?>" name="cid" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" /></td>
	      <td> <a href="#edit" onClick="return listItemTask('cb<?php echo $i;?>','edit')">
	        <?php echo $row->list_name; ?> </a> </td>
	      <td><?php echo $row->sendername; ?></td>
	    </tr>
<?php
    	$k = 1 - $k;
		}
?>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="Itemid" value="<?php echo $Itemid;?>" />
	  <input type="hidden" name="task" value="" />
	  <input type="hidden" name="action" value="compose" />
	  <input type="hidden" name="boxchecked" value="0" />
		</form>

<?php
	}
	
	function editMailing($listid){
	  global $mailing;
?>
    <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td>&nbsp;</td>
      <td width="10%">
<?php 
	  mosToolBar::startTable();
	  mosToolBar::publish();
	  mosToolBar::custom('preview', 'preview.png', 'preview_f2.png', 'Preview', false);
	  mosToolBar::divider();
	  mosToolBar::spacer(25);
    mosToolBar::save();
    mosToolBar::cancel();
    mosToolBar::endtable();
?>
  		</td>
		</tr>
		</table>
<?php
    $mailing->editMailing($listid, 1);
	}
	
	function previewMailing($listid){
	  global $mailing;
?>
    <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td>&nbsp;</td>
      <td width="10%">
<?php 
	  mosToolBar::startTable();
	  mosToolBar::custom('preview', 'preview.png', 'preview_f2.png', 'Preview', false);
	  mosToolBar::divider();
	  mosToolBar::spacer(25);
    mosToolBar::cancel();
    mosToolBar::endtable();
?>
  		</td>
		</tr>
		</table>
<?php
    $mailing->previewmailing($listid, 1);
	}
	
	function publishMailing($listid){
	  global $mailing;
      if($listid != 0){
	    $start = mosGetParam( $_REQUEST, 'start', '0' );
        $mailing->sendMailing($listid, 0, $start, 1);
      }
	}
}
?>
