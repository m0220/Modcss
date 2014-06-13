<?php
$htmDirectory    = '/path/modcss/htm/'; //Source Image Directory End with Slash
$DesthtmDirectory    = '/path/modcss/newhtm/'; //Destination Image Directory End with Slash
$cssdainserire = '/path/modcss/newcss.txt';

if($dir = opendir($htmDirectory)){
    while(($file = readdir($dir))!== false){

        $htmPath = $htmDirectory.$file;
        $desthtmPath = $DesthtmDirectory.$file;
        if ((file_exists($htmPath)) && (strpos($htmPath,'.htm'))) //Continue only if 2 given parameters are $ (in this case the file must have extension .htm)
        {
          $testo = file_get_contents($htmPath);
          $ex = '';
	  $newcss = file_get_contents($cssdainserire);
	  $ex_1=explode('    <STYLE TYPE="text/css">',$testo); //cut if string is found and keep the text before <STYLE TYPE="text/css">
	  $ex = $ex_1[0];
	  $ex = $ex.$newcss; //concat the text keeped upper with the content of the file $newcss
	  $ex_2=explode('<H1>',$testo); //cut string and keep the text after <H1>
	  $ex = $ex.$ex_2[1];
	  file_put_contents($desthtmPath,$ex); //put the $ex string in the new file created in the path $desthtmPath 
	  echo 'Creato file: '.$desthtmPath.'<br>';
        }
    }
    closedir($dir);
}
?>
