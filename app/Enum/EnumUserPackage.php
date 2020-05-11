<?php

namespace App\Enum;
/**
 * @author Achmad Munandar
 */
class EnumUserPackage
{

    CONST STATUS_AKTIF            = '0'; //AKTIF
    CONST STATUS_BERHENTI         = '1'; //BERHENTI LANGGANAN 


    public static function status($status)
    {
        if($status == 0){
            return \Component::badgetLinkSuccess("Aktif");
        }else if($status == 1){
            return \Component::badgetLinkDanger("Berhenti Berlangganan");       
        }
    }

}