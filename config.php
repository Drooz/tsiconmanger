<?php

/*
*****************************************************
/				V1 Autor: Pedro Arenas (Doc)		/
/				V2 Autor: DUO	                 	/
/				Archive : config.php				    /
*************************************************
*/
    
	$TS3_IP = 'REAL_TS_IP_HERE'; //here ts3 server ip , Alert !!! Dont put 'localhost' , put the real IP ! :)| Also you can put with port , Example : '0.0.0.0.0:9988' ^-^

    $RandomFunc = rand(1,1000); // Dont Touch that :p

    $config['teamspeak']['ip'] = 'TS_IP_HERE';      //SERVER IP , u can put localhost if u are in the same VPS 

    $config['teamspeak']['queryport'] = 'QUERY_PORT_HERE';   //Query Port , Default (10011)

    $config['teamspeak']['serverport'] = 'SERVER_PORT_HERE';      //SERVER PORT , Default (9987)

    $config['teamspeak']['loginname'] = 'QUERY_USERNAME_HERE'; //Query UserName

    $config['teamspeak']['loginpass'] = 'PASSWORD_HERE';      // Query Password        

    $config['teamspeak']['displayname'] ="TS3IMV2[$RandomFunc]";    // Bot Nickanme , Dont Delete [$RandomFunc] !!
	
	$SID_GROUP_GAME = array(100) //Groups Sort ID
	
?>