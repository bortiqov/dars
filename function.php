<?php

class GreatValue {
    public $value1;
    public $value2;
    public $value3;
    public $value4 = 0;

    public function engKattasi($value1, $value2, $value3){
         $value4 = $value1;
         if($value4 > $value2){
             if($value4 > $value3){
                 echo "$value4 barcha sonlardan katta";
             }
         }else{
             $value4 = $value2;
             if($value4 > $value3){
                 echo "$value4 barcha sonlardan katta"; 
             }else{
                 echo "$value3 barcha sonlardan katta";
             }
         } 
    }

    public function engKichigi($value1, $value2, $value3){
        $value4 = $value1;
        if($value4 < $value2){
            if($value4 < $value3){
                echo "$value4 barcha sonlardan kichkina";
            }
        }else{
            $value4 = $value2;
            if($value4 < $value3){
                echo "$value4 barcha sonlardan kichkina"; 
            }else{
                echo "$value3 barcha sonlardan kichkina";
            }
        }
    }
}
