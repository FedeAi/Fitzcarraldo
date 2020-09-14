<?php
/**
* @version $Id: mod_fullmenu.php 1833 2006-01-15 12:59:27Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/**
* Full DHTML Admnistrator Menus
* @package Joomla
*/
class mosFullAdminMenu {
	/**
	* Show the menu
	* @param string The current user type
	*/
	function show( $usertype='' ) {
		global $acl, $database;
		global $mosConfig_live_site, $mosConfig_enable_stats, $mosConfig_caching;

		// cache some acl checks
		$canConfig 			= $acl->acl_check( 'administration', 'config', 'users', $usertype );

		$manageTemplates 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_templates' );
		$manageTrash 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_trash' );
		$manageMenuMan 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_menumanager' );
		$manageLanguages 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_languages' );
		$installModules 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'modules', 'all' );
		$editAllModules 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'modules', 'all' );
		$installMambots 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'mambots', 'all' );
		$editAllMambots 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'mambots', 'all' );
		$installComponents 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'components', 'all' );
		$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', 'all' );
		$canMassMail 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_massmail' );
		$canManageUsers 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_users' );

		$query = "SELECT a.id, a.title, a.name, COUNT( DISTINCT c.id ) AS numcat, COUNT( DISTINCT b.id ) AS numarc"
		. "\n FROM #__sections AS a"
		. "\n LEFT JOIN #__categories AS c ON c.section = a.id"
		. "\n LEFT JOIN #__content AS b ON b.sectionid = a.id AND b.state = -1"
		. "\n WHERE a.scope = 'content'"
		. "\n GROUP BY a.id"
		. "\n ORDER BY a.ordering"
		;
		$database->setQuery( $query );
		$sections = $database->loadObjectList();
		$nonemptySections = 0;
		if (count($sections) > 0) {
			foreach ($sections as $section) {
				if ($section->numcat > 0) {
					$nonemptySections++;
				}
			}
		}
		$menuTypes = mosAdminMenus::menutypes();
		?>
		<div id="myMenuID"></div>
		<script language="JavaScript" type="text/javascript">
		var myMenu =
		[
		<?php
	// Home Sub-Menu
?>			[null,'Pannello di controllo','index2.php',null,'Pannello di controllo'],
			_cmSplit,
			<?php
	// Site Sub-Menu
?>			[null,'Sito',null,null,'Gestione sito',
<?php
			if ($canConfig) {
?>				['<img src="../includes/js/ThemeOffice/config.png" />','Configurazione globale','index2.php?option=com_config&hidemainmenu=1',null,'Configurazione'],
<?php
			}
			if ($manageLanguages) {
?>				['<img src="../includes/js/ThemeOffice/language.png" />','Gestione lingua',null,null,'Gestione lingua',
  					['<img src="../includes/js/ThemeOffice/language.png" />','Lingua del sito','index2.php?option=com_languages',null,'Gestione lingua'],
   				],
<?php
			}
?>				['<img src="../includes/js/ThemeOffice/media.png" />','Gestione media','index2.php?option=com_media',null,'Gestione file'],
					['<img src="../includes/js/ThemeOffice/preview.png" />', 'Anteprima', null, null, 'Anteprima',
					['<img src="../includes/js/ThemeOffice/preview.png" />','sito in nuova finestra','<?php echo $mosConfig_live_site; ?>/index.php','_blank','<?php echo $mosConfig_live_site; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" />','sito nel pannello di controllo','index2.php?option=com_admin&task=preview',null,'<?php echo $mosConfig_live_site; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" />','sito nel pannello di controllo con posizione blocchi modulo','index2.php?option=com_admin&task=preview2',null,'<?php echo $mosConfig_live_site; ?>'],
				],
				['<img src="../includes/js/ThemeOffice/globe1.png" />', 'Statistiche', null, null, 'Statistiche del sito',
<?php
			if ($mosConfig_enable_stats == 1) {
?>					['<img src="../includes/js/ThemeOffice/globe4.png" />', 'Browser, OS, Domini', 'index2.php?option=com_statistics', null, 'Browser, OS, Domini'],
  					['<img src="../includes/js/ThemeOffice/globe3.png" />', 'Impressione pagine', 'index2.php?option=com_statistics&task=pageimp', null, 'Impressione pagine'],
<?php
			}
?>					['<img src="../includes/js/ThemeOffice/search_text.png" />', 'Testo di ricerca', 'index2.php?option=com_statistics&task=searches', null, 'Testo di ricerca']
				],
<?php
			if ($manageTemplates) {
?>				['<img src="../includes/js/ThemeOffice/template.png" />','Gestione template',null,null,'Cambia template del sito',
  					['<img src="../includes/js/ThemeOffice/template.png" />','Template del sito','index2.php?option=com_templates',null,'Cambia template del sito'],
  					_cmSplit,
  					['<img src="../includes/js/ThemeOffice/template.png" />','Template amministratore','index2.php?option=com_templates&client=admin',null,'Cambia template pannello amministratore'],
  					_cmSplit,
  					['<img src="../includes/js/ThemeOffice/template.png" />','Posizione blocchi modulo','index2.php?option=com_templates&task=positions',null,'Posizione blocchi modulo']
  				],
<?php
			}
			if ($manageTrash) {
?>				['<img src="../includes/js/ThemeOffice/trash.png" />','Gestione cestino','index2.php?option=com_trash',null,'Gestione cestino'],
<?php
			}
			if ($canManageUsers || $canMassMail) {
?>				['<img src="../includes/js/ThemeOffice/users.png" />','Gestione utenti','index2.php?option=com_users&task=view',null,'Gestione utenti'],
<?php
				}
?>			],
<?php
	// Menu Sub-Menu
?>			_cmSplit,
			[null,'Menu',null,null,'Gestione menu',
<?php
			if ($manageMenuMan) {
?>				['<img src="../includes/js/ThemeOffice/menus.png" />','Gestione Menu','index2.php?option=com_menumanager',null,'Gestione Menu'],
				_cmSplit,
<?php
			}
			foreach ( $menuTypes as $menuType ) {
?>				['<img src="../includes/js/ThemeOffice/menus.png" />','<?php echo $menuType;?>','index2.php?option=com_menus&menutype=<?php echo $menuType;?>',null,''],
<?php
			}
?>			],
			_cmSplit,
<?php
	// Content Sub-Menu
?>			[null,'Contenuti',null,null,'Gestione contenuti',
<?php
			if (count($sections) > 0) {
?>				['<img src="../includes/js/ThemeOffice/edit.png" />','Contenuti delle sezioni',null,null,'Gestione contenuti',
<?php
				foreach ($sections as $section) {
					$txt = addslashes( $section->title ? $section->title : $section->name );
?>					['<img src="../includes/js/ThemeOffice/document.png" />','<?php echo $txt;?>', null, null,'<?php echo $txt;?>',
<?php
					if ($section->numcat) {
?>						['<img src="../includes/js/ThemeOffice/edit.png" />', 'Gestione articoli - <?php echo $txt;?>', 'index2.php?option=com_content&sectionid=<?php echo $section->id;?>',null,null],
<?php
					}
?>						['<img src="../includes/js/ThemeOffice/add_section.png" />', 'Aggiungi/Modifica categorie - <?php echo $txt;?>', 'index2.php?option=com_categories&section=<?php echo $section->id;?>',null, null],
<?php
					if ($section->numarc) {
?>						['<img src="../includes/js/ThemeOffice/backup.png" />', '<?php echo $txt;?> Archivia', 'index2.php?option=com_content&task=showarchive&sectionid=<?php echo $section->id;?>',null,null],
<?php
					}
?>					],
<?php
				} // foreach
?>				],
				_cmSplit,
<?php
			}
?>
				['<img src="../includes/js/ThemeOffice/edit.png" />','Tutti i contenuti','index2.php?option=com_content&sectionid=0',null,'Gestione contenuti'],
  				['<img src="../includes/js/ThemeOffice/edit.png" />','Gestione contenuti statici','index2.php?option=com_typedcontent',null,'Gestione contenuti statici'],
  				_cmSplit,
  				['<img src="../includes/js/ThemeOffice/add_section.png" />','Gestione sezioni','index2.php?option=com_sections&scope=content',null,'Gestione sezioni'],
				['<img src="../includes/js/ThemeOffice/add_section.png" />','Gestione categorie','index2.php?option=com_categories&section=content',null,'Gestione categorie'],
				_cmSplit,
  				['<img src="../includes/js/ThemeOffice/home.png" />','Gestione prima pagina','index2.php?option=com_frontpage',null,'Gestione prima pagina'],
  				['<img src="../includes/js/ThemeOffice/edit.png" />','Gestione archivio','index2.php?option=com_content&task=showarchive&sectionid=0',null,'Gestione archiviazione articoli'],
			],
<?php
	// Components Sub-Menu
	if ($installComponents) {
?>			_cmSplit,
			[null,'Componenti',null,null,'Gestione componenti',
<?php
		$query = "SELECT *"
		. "\n FROM #__components"
		. "\n WHERE name != 'frontpage'"
		. "\n AND name != 'media manager'"
		. "\n ORDER BY ordering, name"
		;
		$database->setQuery( $query );
		$comps = $database->loadObjectList();	// component list
		$subs = array();	// sub menus
		// first pass to collect sub-menu items
		foreach ($comps as $row) {
			if ($row->parent) {
				if (!array_key_exists( $row->parent, $subs )) {
					$subs[$row->parent] = array();
				}
				$subs[$row->parent][] = $row;
			}
		}
		$topLevelLimit = 19; //You can get 19 top levels on a 800x600 Resolution
		$topLevelCount = 0;
		foreach ($comps as $row) {
			if ($editAllComponents | $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', $row->option )) {
				if ($row->parent == 0 && (trim( $row->admin_menu_link ) || array_key_exists( $row->id, $subs ))) {
					$topLevelCount++;
					if ($topLevelCount > $topLevelLimit) {
						continue;
					}
					$name = addslashes( $row->name );
					$alt = addslashes( $row->admin_menu_alt );
					$link = $row->admin_menu_link ? "'index2.php?$row->admin_menu_link'" : "null";
					echo "\t\t\t\t['<img src=\"../includes/$row->admin_menu_img\" />','$name',$link,null,'$alt'";
					if (array_key_exists( $row->id, $subs )) {
						foreach ($subs[$row->id] as $sub) {
							echo ",\n";
							$name = addslashes( $sub->name );
							$alt = addslashes( $sub->admin_menu_alt );
							$link = $sub->admin_menu_link ? "'index2.php?$sub->admin_menu_link'" : "null";
							echo "\t\t\t\t\t['<img src=\"../includes/$sub->admin_menu_img\" />','$name',$link,null,'$alt']";
						}
					}
					echo "\n\t\t\t\t],\n";
				}
			}
		}
		if ($topLevelLimit < $topLevelCount) {
			echo "\t\t\t\t['<img src=\"../includes/js/ThemeOffice/sections.png\" />','Altri componenti...','index2.php?option=com_admin&task=listcomponents',null,'Altri componenti'],\n";
		}
?>
			],
<?php
	// Modules Sub-Menu
		if ($installModules | $editAllModules) {
?>			_cmSplit,
			[null,'Moduli',null,null,'Gestione moduli',
<?php
			if ($editAllModules) {
?>				['<img src="../includes/js/ThemeOffice/module.png" />', 'Moduli sito', "index2.php?option=com_modules", null, 'Gestione moduli sito'],
				['<img src="../includes/js/ThemeOffice/module.png" />', 'Moduli amministratore', "index2.php?option=com_modules&client=admin", null, 'Gestione moduli amministratore'],
<?php
			}
?>			],
<?php
		} // if ($installModules | $editAllModules)
	} // if $installComponents
	// Mambots Sub-Menu
	if ($installMambots | $editAllMambots) {
?>			_cmSplit,
			[null,'Mambot',null,null,'Gestione mambot',
<?php
		if ($editAllMambots) {
?>				['<img src="../includes/js/ThemeOffice/module.png" />', 'Mambot sito', "index2.php?option=com_mambots", null, 'Gestione mambot sito'],
<?php
		}
?>			],
<?php
	}
?>
<?php
	// Installer Sub-Menu
	if ($installModules) {
?>			_cmSplit,
			[null,'Installazioni',null,null,'Lista procedure di installazione',
<?php
		if ($manageTemplates) {
?>				['<img src="../includes/js/ThemeOffice/install.png" />','Template - Sito','index2.php?option=com_installer&element=template&client=',null,'Installa template sito'],
				['<img src="../includes/js/ThemeOffice/install.png" />','Template - Amministratore','index2.php?option=com_installer&element=template&client=admin',null,'Installa template amministratore'],
<?php
		}
		if ($manageLanguages) {
?>				['<img src="../includes/js/ThemeOffice/install.png" />','Lingue','index2.php?option=com_installer&element=language',null,'Installa lingue'],
				_cmSplit,
<?php
		}
?>				['<img src="../includes/js/ThemeOffice/install.png" />', 'Componenti','index2.php?option=com_installer&element=component',null,'Installa/Disinstalla Componenti'],
				['<img src="../includes/js/ThemeOffice/install.png" />', 'Moduli', 'index2.php?option=com_installer&element=module', null, 'Installa/Disinstalla moduli'],
				['<img src="../includes/js/ThemeOffice/install.png" />', 'Mambot', 'index2.php?option=com_installer&element=mambot', null, 'Installa/Disinstalla mambot'],
			],
<?php
	} // if ($installModules)
	// Messages Sub-Menu
	if ($canConfig) {
?>			_cmSplit,
  			[null,'Messaggi',null,null,'Gestione messaggi',
  				['<img src="../includes/js/ThemeOffice/messaging_inbox.png" />','Inbox','index2.php?option=com_messages',null,'Messaggi privati'],
  				['<img src="../includes/js/ThemeOffice/messaging_config.png" />','Configurazione','index2.php?option=com_messages&task=config&hidemainmenu=1',null,'Configurazione']
  			],
<?php
	// System Sub-Menu
?>			_cmSplit,
  			[null,'Sistema',null,null,'Gestione sistema',
  			   ['<img src="../includes/js/ThemeOffice/sysinfo.png" />', 'Info sistema', 'index2.php?option=com_admin&task=sysinfo', null,'Informazioni di sistema'],

<?php
  		if ($canConfig) {
?>				['<img src="../includes/js/ThemeOffice/checkin.png" />', 'Controllo globale', 'index2.php?option=com_checkin', null,'Controllo glabale elementi'],
<?php
			if ($mosConfig_caching) {
?>				['<img src="../includes/js/ThemeOffice/config.png" />','Pulizia cache contenuti','index2.php?option=com_admin&task=clean_cache',null,'Pulisci la cache contenuti'],
				['<img src="../includes/js/ThemeOffice/config.png" />','Pulizia cache completa','index2.php?option=com_admin&task=clean_all_cache',null,'Pulizia cache globale'],
<?php
			}
		}
?>			],
<?php
			}
?>			_cmSplit,
<?php
	// Help Sub-Menu
?>			[null,'Aiuto','index2.php?option=com_admin&task=help',null,null]
		];
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
		</script>
<?php
	}


	/**
	* Show an disbaled version of the menu, used in edit pages
	* @param string The current user type
	*/
	function showDisabled( $usertype='' ) {
		global $acl;

		$canConfig 			= $acl->acl_check( 'administration', 'config', 'users', $usertype );
		$installModules 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'modules', 'all' );
		$editAllModules 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'modules', 'all' );
		$installMambots 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'mambots', 'all' );
		$editAllMambots 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'mambots', 'all' );
		$installComponents 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'components', 'all' );
		$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', 'all' );
		$canMassMail 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_massmail' );
		$canManageUsers 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_users' );

		$text = 'Menu inattivo per questa pagina';
		?>
		<div id="myMenuID" class="inactive"></div>
		<script language="JavaScript" type="text/javascript">
		var myMenu =
		[
		<?php
	/* Home Sub-Menu */
		?>
			[null,'<?php echo 'Pannello di controllo'; ?>',null,null,'<?php echo $text; ?>'],
			_cmSplit,
		<?php
	/* Site Sub-Menu */
		?>
			[null,'<?php echo 'Sito'; ?>',null,null,'<?php echo $text; ?>'
			],
		<?php
	/* Menu Sub-Menu */
		?>
			_cmSplit,
			[null,'<?php echo 'Menu'; ?>',null,null,'<?php echo $text; ?>'
			],
			_cmSplit,
		<?php
	/* Content Sub-Menu */
		?>
 			[null,'<?php echo 'Contenuti'; ?>',null,null,'<?php echo $text; ?>'
			],
		<?php
	/* Components Sub-Menu */
			if ( $installComponents) {
				?>
				_cmSplit,
				[null,'<?php echo 'Componenti'; ?>',null,null,'<?php echo $text; ?>'
				],
				<?php
			} // if $installComponents
			?>
		<?php
	/* Modules Sub-Menu */
			if ( $installModules | $editAllModules) {
				?>
				_cmSplit,
				[null,'<?php echo 'Moduli'; ?>',null,null,'<?php echo $text; ?>'
				],
				<?php
			} // if ( $installModules | $editAllModules)
			?>
		<?php
	/* Mambots Sub-Menu */
			if ( $installMambots | $editAllMambots) {
				?>
				_cmSplit,
				[null,'<?php echo 'Mambot'; ?>',null,null,'<?php echo $text; ?>'
				],
				<?php
			} // if ( $installMambots | $editAllMambots)
			?>


			<?php
	/* Installer Sub-Menu */
			if ( $installModules) {
				?>
				_cmSplit,
				[null,'<?php echo 'Installazioni'; ?>',null,null,'<?php echo $text; ?>'
					<?php
					?>
				],
				<?php
			} // if ( $installModules)
			?>
			<?php
	/* Messages Sub-Menu */
			if ( $canConfig) {
				?>
				_cmSplit,
	  			[null,'<?php echo 'Messaggi'; ?>',null,null,'<?php echo $text; ?>'
	  			],
				<?php
			}
			?>

			<?php
	/* System Sub-Menu */
			if ( $canConfig) {
				?>
				_cmSplit,
	  			[null,'<?php echo 'Sistema'; ?>',null,null,'<?php echo $text; ?>'
				],
				<?php
			}
			?>
			_cmSplit,
			<?php
	/* Help Sub-Menu */
			?>
			[null,'<?php echo 'Aiuto'; ?>',null,null,'<?php echo $text; ?>']
		];
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
		</script>
		<?php
	}
}
$cache =& mosCache::getCache( 'mos_fullmenu' );

$hide = mosGetParam( $_REQUEST, 'hidemainmenu', 0 );

if ( $hide ) {
	mosFullAdminMenu::showDisabled( $my->usertype );
} else {
	mosFullAdminMenu::show( $my->usertype );
}
?>