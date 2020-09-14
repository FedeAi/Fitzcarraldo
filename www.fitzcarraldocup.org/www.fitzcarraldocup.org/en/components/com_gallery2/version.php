<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
 * This file contains the version of this component, may hold more info in future.
 *
 * @package com_gallery2
 * @subpackage core files
 */

class g2Version {
	var $PRODUCT 	= 'Gallery Bridge!';
	var $RELEASE 	= '2.0';
	var $DEV_STATUS = 'Beta';
	var $DEV_LEVEL 	= '13';
	var $BUILD	 	= 'Revision: ?';
	var $CODENAME 	= 'Quick Fix gallery 2.1 rc1';
	var $RELDATE 	= '15-Feb-2006';
	var $RELTIME 	= '13:00';
	var $RELTZ 		= 'CET';
	
	var $MIN_G2		= '1.0.0.2';
	
	/**
	 * @return string Short version format
	 */
	function getShortVersion() {
		return $this->RELEASE.'.'.$this->DEV_LEVEL;
	}
}
?>