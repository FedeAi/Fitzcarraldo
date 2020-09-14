<?php
/**
* Letterman Subscriber Module 
* based on the one for Yanc 1.3
*
* @author soeren
* @author Wee Keat Chin
* @Copyright (C) 2004-2005 soeren
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version 1.1
*
* Email: soeren@virtuemart.net
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $my;
/**
 * Configuration
 * ------------------
 */
if( !file_exists($mosConfig_absolute_path . "/components/com_letterman/letterman.php")) {
	echo '<p>This module requires the Letterman component.</p>';
}
else {
	
	if( !@include_once( $mosConfig_absolute_path . "/administrator/components/com_letterman/language/$mosConfig_lang.messages.php" ) ) {
		include_once( $mosConfig_absolute_path . "/administrator/components/com_letterman/language/english.messages.php" );
	}
	
	// The Text to be shown in front of the Subscribe Form
	$pretext = isset( $params->_params->pretext ) 
						? $params->_params->pretext
						:"Keep yourself updated with our FREE newsletters now!"; 
	
	//1 to limit the number of characters of title, 0 to disable it
	$chars_limit = $params->get( 'chars_limit', 1); 
	
	// used with character limits enabled. the value signifies the number of characters to display
	$chars = intval( $params->get( 'chars', 15) ); 
	
	//to hide the name field, set it to 1
	$hide_name_field = $params->get( 'hide_name_field', 0); 
	$my->load( $my->id );
	$username = ( !empty( $my->name ) ) ? $my->name : $my->username;
	
	?>
	<script type="text/javascript" language="Javascript"><!--
	function changeTask() {
		var name = document.lettermanMod.subscriber_name.value;
		var email;
		var max_length = <?php echo $chars ?>;
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
		
		if (filter.test(document.lettermanMod.email.value)) {
			email = document.lettermanMod.email.value;
			var a = true;
		} else {
			alert("<?php echo LM_FORM_NOEMAIL ?>");
			var a = true; return false;
		}
		try {
		<?php 
	  	if( !empty($chars_limit) && $hide_name_field=="0" ) { ?>
			if(document.lettermanMod.subscriber_name.length > max_length) {
				alert("<?php echo LM_FORM_SHORTERNAME; ?>");
				return false;
			} 
		<?php
	 	}
	  	if( $hide_name_field=="0" ) { ?>
			if(document.lettermanMod.subscriber_name.length < 1) {
				alert("<?php echo LM_FORM_NONAME ?>");
				return false;
			} 
			<?php
	  	}
	  	?>
		}
		catch(e) {}
		return true;
	} // -->
	</script>
	<?php if( !empty( $pretext)) {
		echo '<p>'. $pretext .'</p>';
	}
	?>
	<form method="post" action="<?php echo $mosConfig_live_site ?>/index.php?option=com_letterman" name="lettermanMod"> 
	<p>
	<?php
	if($hide_name_field == 1) { ?>
	  	<input type="hidden" name="subscriber_name" value="<?php echo !empty( $username) ? $username: "Subscriber"; ?>" />
	<?php 
	} 
	else { ?>
         <input type="text" id="subscriber_name" style="font-size:smaller;" name="subscriber_name" class="inputbox" value="<?php echo $username; ?>" /><br/>
         <span class="smallgrey"><label for="subscriber_name"><?php echo _CMN_NAME ; ?></label></span><br/>
	<?php 
	}
	?>
	<input type="text" id="lm_email" name="email" style="font-size:smaller;" class="inputbox" value="<?php echo $my->email; ?>" /><br/>
	<span class="smallgrey"><label for="lm_email"><?php echo _CMN_EMAIL ; ?></label></span>
	</p>        
	<p>
	<?php
	if( $my->id ) {
		
		$q = "SELECT subscriber_id FROM `#__letterman_subscribers` WHERE user_id=".$my->id.' OR subscriber_email=\''.$my->email.'\'';
		$database->setQuery($q); $subscriber = $database->loadResult();
		
		if( empty($subscriber)) { ?>
			<input name="task" type="hidden" value="subscribe" />
			<input type="submit" class="button" value="<?php echo LM_SUBSCRIBE ?>" onclick="return changeTask();" />
			<?php
		}
		else { 
			echo LM_ALREADY_SUBSCRIBED;
			?><br/>
			<input name="task" type="hidden" value="unsubscribe" />
			<input type="submit" onclick="return( confirm('<?php echo LM_CONFIRM_UNSUBSCRIBE ?>'));" class="button" value="<?php echo LM_UNSUBSCRIBE ?>" onclick="return changeTask();" />
			<?php 
		}
	}
	else {
		?>
		<p><input name="task" type="radio" class="inputbox" id="lm_subscribe" value="subscribe" checked="checked"/>
			<label for="lm_subscribe"><?php echo LM_SUBSCRIBE; ?></label><br/>
			<input name="task" type="radio" class="inputbox" id="lm_unsubscribe" value="unsubscribe" />
			<label for="lm_unsubscribe"><?php echo LM_UNSUBSCRIBE; ?></label>
			<br/>
			<input type="submit" class="button" value="<?php echo LM_BUTTON_SUBMIT ?>" onclick="return changeTask();" />
		</p>
		<?php
	}
	?>
	</p>
	 <input type="hidden" name="Itemid" value="<?php echo @$_REQUEST['Itemid'] ?>" />
	 </form>	
<?php
	$my = $mainframe->getUser();
}
?>