<?php

include_once('phpqrcode.php');

class Erweima
{
	public $data;
	public $level;
	public $size;
    public function __construct($data,$level,$size)
    {
    	$this->data = $data;
    	$this->level = $level;
    	$this->size = $size;
    }

    public function makeQR()
    {
	    // set it to writable location, a place for temp generated PNG files
	    // $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
	    // $PNG_TEMP_DIR =$_SERVER['HTTP_REFERER'].'Public'.DIRECTORY_SEPARATOR.'qrcode'.DIRECTORY_SEPARATOR;
	    $PNG_TEMP_DIR =__ROOT__.'/Public'.DIRECTORY_SEPARATOR.'qrcode'.DIRECTORY_SEPARATOR;

	   	// dump($PNG_TEMP_DIR);
	    $str = str_replace('/','\\',$PNG_TEMP_DIR);
	    // dump($str);
	    $str1 = str_replace('/','\\',$_SERVER["DOCUMENT_ROOT"]);
		$PNG_TEMP_DIR = $str1.$str;
	    // ofcourse we need rights to create temp dir
         if (!file_exists($PNG_TEMP_DIR))
	        mkdir($PNG_TEMP_DIR);
	    // user data
	    $filename = $PNG_TEMP_DIR.md5($this->data.'|'.$this->level.'|'.$this->size).'.png';
	    // echo $filename;
	    // exit;
	    QRcode::png($this->data, $filename,$this->level,$this->size, 2);
	    //dump($filename);
	    $pos = ltrim(__URL__,'/');
	    dump($pos);
	    $pos=strpos($filename,$pos);
		$filename=substr($filename, $pos);
	    $filename = str_replace("\\",'/',$filename);
	    return $filename;
	}
}   
