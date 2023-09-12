<?php
    function afficherTR(){
        global $tab;
        $lesTR="";
        for($i=0; $i < count($tab); $i++){
            if($tab[$i] % 2 != 0){
                $lesTR.="<tr><td>".$tab[$i]."</td></tr>";
            }
        }
        return $lesTR;
   }
?>