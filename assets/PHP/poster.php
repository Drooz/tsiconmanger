
  
<?php 
 
 
 /*
*****************************************************
/				V1 Autor: Pedro Arenas (Doc)		/
/				V2 Autor: DUO	                 	/
/				Archive : poster.php				    /
*************************************************
*/

require_once("libraries/TeamSpeak3/TeamSpeak3.php"); //TS3 Lib
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
            echo "<form name='formulario' method='POST' action='step2.php'>";
            
            $iconosm = 0;
            
            $server_groups = $ts3_VirtualServer->serverGroupList();
            $servergroups = array();
 //==========================================================================================================================================================================//
            foreach($server_groups as $group) {
                if($group->type != 1) { continue; }
                if(in_array($group["sortid"], $SID_GROUP_GAME)) {
                    $servergroups[] = array('name' => (string)$group, 'id' => $group->sgid, 'type' => $group->type);
                }
            } 
			$_SESSION['grupos'] = $servergroups;
        
            foreach($servergroups as $group) {      
                
                $miembros = $ts3_VirtualServer->serverGroupClientList($group["id"]);
                $estaengrupo = False;
                foreach($miembros as $m) {
                    if($m["client_unique_identifier"] == $client_uid) { 
                        $estaengrupo = True;
                    }                                   
                }
				
                if($estaengrupo) {
                    $iconosm = $iconosm + 1;
                    echo '<img src="icons/'.$group['id']. '.png" alt="" class="hvr-bounce-in" />  ';
                    echo '<input type=checkbox name=grupos['.$group["id"].'] id="'.$group["id"].'" value="'. $group["id"] .'"class="css-checkbox pop" checked >
					<label for="'.$group["id"].'" class="css-label lite-cyan-check hvr-bounce-in">'.$group["name"].'</label>
					<br>';
                } else {
                    echo '<img src="icons/'. $group['id'] . '.png" alt="" class="hvr-bounce-in" />  ';
                    echo '<input type=checkbox name=grupos['.$group["id"].'] id="'. $group["id"] .'" value="'. $group["id"] .'" class="css-checkbox pop">
					<label for="'.$group["id"].'" class="css-label lite-cyan-check hvr-bounce-in">'.$group["name"].'</label>
					<br>';
                }
			}
			

        }

                            if($verfied == "1"){
							echo "<br/><button type='submit' class='btn btn-primary'>Save</button>";
							}
				
				
                    if($verfied == "0"){
                //Disconnected User
                echo "
<div class='alert alert-dismissible alert-danger'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Oh snap! you cannot enter when you are not connected on our TS3 server </strong> <a href='ts3server://$TS3_IP' class='alert-link'> , Press here  </a> and try again.
</div>";
                }
				
                if($verfied > "1"){
                //too many identities
            header('location: ./usertow.php');
                }
				
        ?>
 
