<?php

class IntournamentInstaller {
	
	private $tables = array('Teilnehmer','Team');
	
	function install() {
	
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		global $wpdb;
		
		$sql_1 = 'CREATE TABLE '.$wpdb->prefix.$this->tables[0].' (
				tlnID int(11) NOT NULL AUTO_INCREMENT,
				tlnName varchar(25) NOT NULL,
				tlnVorname varchar(25) default NULL,
				tlnAlter int(3) default NULL,
				tln_isSigned int(1) NOT NULL,
				tln_teamName int(11) NOT NULL,
				PRIMARY KEY (tlnID)
				) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;';
		
		$sql_2 = 'CREATE TABLE '.$wpdb->prefix.$this->tables[1].' (
				teamID int(11) NOT NULL AUTO_INCREMENT,
				teamName varchar(25) NOT NULL,
				teamPoints int(11) default NULL,
				team_isWinner int(1) default NULL,
				PRIMARY KEY (teamID)
				) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;';
		
		$queries = array($sql_1, $sql_2);
		
		foreach($queries as $query){
			dbDelta($query);
		}
		
		
	}

	function uninstall() {
		
		global $wpdb;
		
		foreach($this->tables as $table){
			$wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.$table);
		}
		
	
	}

}

?>