<?php
$dir = opendir("entrada/"); //ruta actual
while ($filedir = readdir($dir)){
    if (!is_dir($filedir)){
        if(!strpos($filedir, 'zip')){
            $name=explode('.',$filedir);
            $file = fopen("entrada/".$filedir, "r");
            $rounds=null;
            $countRow=0;
            $wplayer=0;
            $ahead=0;
            while (!feof($file)){
                $row = fgets($file);
                $arrRow=explode(" ", $row);
                switch($countRow){
                    case 0:
                        $rounds=intval($row);
                        break;
                    default:
                        $score=explode(" ", $row);
                        $preAhead = $score[0] - $score[1];
                        if (abs($preAhead) > $ahead) {
                            if($preAhead>0){
                                $wplayer=1;
                            }else{
                                $wplayer=2;
                            }
                            $ahead=abs($preAhead);
                        }
                        
                        
                        
                }
                $countRow++;
            }

            //echo abs($ahead) .' gano: '. $wplayer . '</br>';

            //process output
            $fileout = fopen('salida/salida'.'_'.$name[0].'.txt','w+'); 
            if ($rounds <=10000){
                fwrite($fileout,$wplayer.' ');
                fwrite($fileout,$ahead);
            }else{
                fwrite($fileout,0.' ');
                fwrite($fileout,0);
            }
            fclose($fileout); 

        }
    }
}

?>