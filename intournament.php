<?php
/*
Plugin Name: in-Tournament
Plugin URI: 
Description: Erstellung und Verwaltung von Turnieren
Author: Eduard Ritt
Version: 0.1
Author URI: 
*/

/*
 * DEFINES 
 */
define('IN_ICON', 'http://www.ingame.de/wp-content/themes/intheme_ingame/img/favicon.ico');

/*
 * Wordpress Hooks
 */
register_activation_hook(__FILE__, 'intournament_install');
register_deactivation_hook(__FILE__, 'intournament_uninstall');

add_action( 'admin_menu', 'in_turnier_control_menu' );

/*
 * Functions
 */
function intournament_install() {
	require_once dirname(__FILE__).'/intournament_installer.php';
	$installer = new IntournamentInstaller();
	$installer->install();
}

function intournament_uninstall() {
	require_once dirname(__FILE__).'/intournament_installer.php';
	$installer = new IntournamentInstaller();
	$installer->uninstall();
}

function in_turnier_control_menu() {
	add_menu_page('ingame-Turnier', 'ingame-Turnier', 10, __FILE__, 'in_view_page', IN_ICON);
	add_submenu_page(__FILE__, 'Teams verwalten', 'Teams verwalten', 'manage_options', 'in_turnier_teams.php','in_turnier_team_page' );
	add_submenu_page(__FILE__, 'Turniere verwalten ', 'Turniere verwalten', 'manage_options', 'in_turnier_settings.php','in_turnier_page' );

}

?>