<?PHP
/*
*****************************************************
/				V1 Autor: Pedro Arenas (Doc)		/
/				V2 Autor: DUO	                 	/
/				Archive : step1.php				    /
*************************************************
*/
session_start();

include('config.php');
 ?>
<html>
<head>
<title>Title | TS3 Icons </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/paper.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.noty.packaged.min.js"></script>
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

</head>

<body>

<br/><br/><br/>
<div class="container">
	<div class="row">
		<center>
		<div class="panel panel-primary" style="width: 300px;">
			<div class="panel-heading">
				<h3 class="panel-title" style="height: 16px;">TS3IconManagerV2</h3>
			</div>
			<div class="panel-body" style="width: 300px;">
			<div align="left" dir="ltr" style="margin-left:34%;" class="">

<?PHP 
include('assets/PHP/poster.php');
				
 ?>
  <script>
var maxicon = "2 <?PHP //Here you put the number of max games user can select and get ! :) ?>" ; 
var icons = "0" ;

$(document).ready(function () {
    //set initial state.

    $('input[type=checkbox]').change(function () {
		var id = $(this).prop('id');
        if ($(this).is(":checked")) {
            if (icons >= maxicon) {
      {
         $(this).prop("checked", "");
         alert('Sorry you cannot select more!');
        checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
     }
				//alert("Maximo");
                $(this).prop('checked', false);

            } else {
                icons++;
				<?php 
					$_SESSION['numiconos'] += 1;
				?>
            }

        } else {
            icons--;
            			<?php 
					$_SESSION['numiconos'] -= 1;
				?>
        }
        //$('.txt').val(icons);
    });

});
</script>
						</div>
		</div>
		</center>
	</div>
</div>

</body>

<footer>
<center>
<p class="text-capitalize">Script created by <a href="mailto:leduo.channel@gmail.com">DUO</a> - V1.0 | Special Thanks to <a href="https://docs.planetteamspeak.com/ts3/php/framework/">TS3API</a> | SourceCode On <a href="https://github.com/DUOGR/TS3IconManagerV2">GitHub</a></p></center>
</footer>
</html>
