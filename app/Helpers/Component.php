<?php

namespace App\Helpers;
/**
 * @author Achmad Munandar
 */
class Component
{


    //BTN CRUD table
    public static function btnRead($src, $title)
    {
        return '<a href="'.$src.'" class="btn btn-outline-primary btn-show" title="'.$title.'"><i class="far fa-eye"></i> Detail</a> ';
    }

    public static function btnUpdate($src, $title)
    {
        return '<a href="'.$src.'" class="btn btn-outline-warning modal-show edit" title="'.$title.'"><i class="fas fa-edit"></i> Ubah</a> ';
    }

    public static function btnDelete($src, $title)
    {
        return '<a href="'.$src.'" class="btn btn-outline-danger btn-delete" title="'.$title.'"><i class="fas fa-trash"></i> Hapus</a> ';
    }
    public static function btnSync($src, $title)
    {
        return '<a href="'.$src.'" class="btn btn-outline-danger btn-delete" title="'.$title.'"><i class="fas fa-trash"></i> Sync</a> ';
    }
    public static function btnWhatsapp($src, $title)
    {
        return '<a href="'.$src.'" target="_blank" class="btn btn-outline-success" title="'.$title.'"><i class="fab fa-whatsapp"></i> Send WA</a> ';
    }
    public static function btnPay($src, $title)
    {
        return '<a href="'.$src.'" class="btn btn-outline-primary btn-pay" title="'.$title.'"><i class="far fa-credit-card"></i> Pay</a> ';
    }

    public static function btnToPdf($src, $title)
    {
        return '<a href="'.$src.'" target="_blank" class="btn btn-outline-danger " title="'.$title.'"><i class="fas fa-file-pdf"></i> Cetak PDF</a> ';
    }

    public static function btnDetailPaket($src, $title)
    {
        return '<a href="'.$src.'" class="btn btn-outline-primary btn-show" title="'.$title.'"><i class="far fa-eye"></i> Detail Paket</a> ';
    }

    
    public static function badgetLinkSuccess($title)
    {
        return '<a href="#" class="badge badge-success"><i class="fas fa-check-double"></i> '.$title.'</a>';

    }

    public static function badgetLinkDanger($title)
    {
        return '<a href="#" class="badge badge-danger"><i class="fas fa-exclamation"></i> '.$title.'</a>';
    }
    public static function badgetLinkWarning($title)
    {
        return '<a href="#" class="badge badge-warning"><i class="fas fa-minus-square"></i> '.$title.'</a>';
    }

    public static function clickableImg($src, $maxWidth) {

        $url = url(asset('Assets/Images/'.$src));
        return '<img onClick="showImage(\''.$url.'\')" src="'.$url.'" style="max-width:'.$maxWidth.';max-height:'.$maxWidth.';cursor:pointer" /> ';
    }

    public static function clickablePopImg($src, $title, $name)
    {
        $url = url(asset('Assets/Images/'.$src));
        return '<a class="pop btn btn-success text-white" src="'.$url.'" title="'.$title.'">'.$name.'</a>';
    }

}