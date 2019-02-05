<?php
/*
*****************************************************
/				V1 Autor: Pedro Arenas (Doc)		/
/				V2 Autor: DUO	                 	/
/				Archive : action.php				    /
*************************************************
*/
require_once("libraries/TeamSpeak3/TeamSpeak3.php"); //Libreria del FRAMEWORK TS3
        $client_uid = $_SESSION['client_uid'];
		$grupos = $_SESSION['grupos'];
		$client_db = $_SESSION['client_db'];
		$numicons = $_SESSION['numiconos'];
       if(isset($_POST['send'])) {
       if(sizeof($_POST['price']) == 2) {
       } else { 
          echo "error, pick exactly two prices!";
       } 
   }         
        if(isset($_GET['group'])) {
        if(isset($_SESSION["count"])){
        $_SESSION["count"] = $_SESSION["count"] + 1;
        }else{ $_SESSION["count"] = 1;
        }
        }
        $result = array();
        $verfied = "0";
        try {
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");
                foreach ($ts3_VirtualServer->clientList() as $client) {
                                        if ($client->getProperty('connection_client_ip') == $_SERVER['REMOTE_ADDR']) 
										
{
                                                $result[] = $client->client_nickname;
                                                $client_verified = $client;
                                                $verfied++;
												$unid = $client["client_unique_identifier"];
                $_SESSION['client_uid'] = $unid;
        $client_uid = $unid;
		$_SESSION['client_db'] = $client["client_database_id"];
		$checked = count($_POST["grupos"]);
                                }
                        }
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }

                if($verfied == "1"){   

				                foreach(explode(",", $client_verified["client_servergroups"]) as $sgid)
                                                {
                                                $cgroups[] = $ts3_VirtualServer->serverGroupGetById($sgid);
                                                }
   

        $_SESSION ['sp'] = explode(",", $client_verified["client_servergroups"]);
if (in_array("» No ACT «",$cgroups)){
				header('location: ./');
				die;
                } 	
				
			}			
		
        if($checked > 2) {
			die;
		} else{
		}
			
			
			
		if(empty($_POST["grupos"])) {
		} else {
			$n_grupos = $_POST["grupos"];
		}
		

		try {
			foreach($grupos as $group) {			
				$needle = $group['id'];
				$miembros = $ts3_VirtualServer->serverGroupClientList($needle);
                $estaengrupo = False;
                foreach($miembros as $m) {
                    if($m["client_unique_identifier"] == $client_uid) { 
                        $estaengrupo = True; 
                    }                                   
                }
				if(in_array($needle,$n_grupos)) {
					if($estaengrupo == False) {
						$ts3_VirtualServer->serverGroupClientAdd($group["id"],$client_db);
					}
				} else 
			
				
				{
					if($estaengrupo == True) {
						$ts3_VirtualServer->serverGroupClientDel($group["id"],$client_db);
					}
				}
			}
				
			
			 
		} catch(Exception $e) {
			if($DEBUG == True) {
				echo "[DEBUG] ".$lang['f_derrortitle']." <br>";
				echo "[DEBUG] ".$lang['f_dmsg'].": ".$e->getMessage()."<br>";
				echo "[DEBUG] ".$lang['f_dcode']." ".$e->getCode()."<br>";
			}
		}
        if($verfied == "1")							
		{
		echo "<img src='assets/images/Done.png'>";
		}
		
elseif($verfied == "0"){
echo "
<div class='alert alert-dismissible alert-danger'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Oh snap! you cannot enter when you are not connected on our TS3 server </strong> <a href='ts3server://$TS3_IP' class='alert-link'> , Press here  </a> and try again.
</div>";
}
        
    
       
?>




