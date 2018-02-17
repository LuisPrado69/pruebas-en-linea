<?php
function encoded($ses)  
{     
  $sesencoded = $ses;  
  $num = mt_rand(4,4);  
  for($i=1;$i<=$num;$i++)  
  {  
     $sesencoded =  
     base64_encode($sesencoded);  
  }  
   
  $alpha_array =  
  array('Y','D','U','R','P',  
  'S','B','M','A','T','H');  
  $sesencoded =  
  $sesencoded."+".$alpha_array[$num];  
  $sesencoded =  
  base64_encode($sesencoded);  
  return $sesencoded;  
}//end of encoded function  

function decoded($str)  
{  
   $alpha_array =  
   array('Y','D','U','R','P',  
   'S','B','M','A','T','H');  
   $decoded =  
    base64_decode($str);  
   list($decoded,$letter) =  
    Preg_split ("\+",$decoded);  
   for($i=0;$i<count($alpha_array);$i++)  
   {  
   if($alpha_array[$i] == $letter)  
   break;  
   }  
   for($j=1;$j<=$i;$j++)  
   {  
      $decoded =  
       base64_decode($decoded);  
   }  
   return $decoded;  
}//end of decoded function  
?>