<?php 

	class Teilnehmer{
		
		public function addTeilnehmer($name, $vorname, $alter){
			
			global $wpdb;
			
			$teilnehmers = array($name, $vorname, $alter);
			
			/*
			 * Hier werden die Regeln für die Überprufung der Benutzereingaben festgelegt
			 * $rules = [true] / [false];
			 */
			$rules = array(
					preg_match('/^[a-zA-Z]{2,25}\D*\W*$/g',$teilnehmer[0]),
					preg_match('/^[a-zA-Z]{2,25}\D*\W*$/g',$teilnehmer[1]),
					preg_match('/^[0-9]{1,3}\W*$/g',$teilnehmer[2])
			);
			
			/*
			 * Hier findet die Überprüfung der Benutzereingaben statt
			 * Bei erfolgreichen Überpruffung [$rules = false;] werden die Daten in utf8 Konvertiert 
			 * und in die Datenbank geschrieben
			 * Bei fehlgeschlagenen Überprüffung [$rules = true;] wird eine Fehlermeldung generiert und ausgegeben.
			 */
			try{
				
				if($rules[0] === false && $rules[1] === false && $rules[2] === false){
				
					foreach($teilnehmers as $teilnehmer){
						$encoded = utf8_encode($teilnehmer); //Hier findet die Umwandlung in UTF8 statt
					}
					
					$sql = 'INSERT INTO '.$wpdb->prefix.'Teilnehmer (
							tlnName, tlnVorname, tlnAlter) VALUES (
							'.$encoded[0].', '.$encoded[1].', '.$encoded[2].')';
				
					dbDelta($sql);
				}
				else{
					
					throw new Exception('Die Eingaben ');
				}
			}
			catch(Exception $e){
				
				echo 'Fehler: '.$e->getMessage(),'\n';
				
			}
						
		}

		public function selectTeilnehmer(){
			
			global $wpdb;
			
			$sql='SELECT tlnName, tlnVorname, tln_isSigned, tln_teamName 
					FROM '.$wpdb->prefix.'Teilnehmer ORDER BY tlnName';
			
			return $wpdb->get_results($sql);
		}
	
	}
?>