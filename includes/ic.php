<?php
if(!empty($icArray))
{
// print_r($icArray);
          $icArray[1] *= 2;
          $icArray[2] *= 7;
          $icArray[3] *= 6;
          $icArray[4] *= 5;
          $icArray[5] *= 4;
          $icArray[6] *= 3;
          $icArray[7] *= 2;
          $weight=0;
          for ($i=1; $i<8 ; $i++) { 
              $weight+=$icArray[$i];
          }
          $offset=($icArray[0]=="T"||$icArray[0]=="G")?4:0;
          $temp=($offset+$weight)%11;
          $st=array("J","Z","I","H","G","F","E","D","C","B","A");
          $fg=array("X","W","U","T","R","Q","P","N","M","L","K");
          if ($icArray[0]=="S"||$icArray[0]=="T") 
          {
              $theAlpha=$st[$temp];
          }elseif ($icArray[0]=="F"||$icArray[0]=="G") {
              $theAlpha=$fg[$temp];
          }
          }
?>