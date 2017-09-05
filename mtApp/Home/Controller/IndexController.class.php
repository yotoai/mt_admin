<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{
	public function index()
	{
		$this->display();
	}

	public function websites()
	{
		$this->display();
	}



    public function test()
    {
    	$ipad = getIP();
		$url ="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$ipad;
		// $url1 ="http://api.map.baidu.com/location/ip?ak=aFVGF3EuNjByMUekzZFjRNwwC9MYwtMI&ip=".$ipad."&coor=bd09ll";
		$url1 = "http://api.map.baidu.com/highacciploc/v1?qcip=".$ipad."&qterm=pc&ak=aFVGF3EuNjByMUekzZFjRNwwC9MYwtMI&coord=bd09ll&extensions=1";
		$address = file_get_contents($url);
		$address_arr = json_decode($address);
	   // dump($address_arr );
		//dump($res);
    	$address1 = file_get_contents($url1);
		$address_arr1 = json_decode($address1);
		// dump($address_arr1->content->formatted_address);
		$this->assign('lng',$address_arr1->content->location->lng);
		$this->assign('lat',$address_arr1->content->location->lat);
	 	// echo "<meta charset='utf-8'>";
		// exit;
		echo '您在：'.$address_arr1->content->formatted_address;
		echo '<br>';
		$ch = curl_init();
	    $url = 'http://apis.baidu.com/apistore/weatherservice/citylist?cityname='.$address_arr->city;
	    $header = array(
	        'apikey:c8c9903b83167729498ea18cca3e4182',
	    );
	    // 添加apikey到header
	    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    // 执行HTTP请求
	    curl_setopt($ch , CURLOPT_URL , $url);
	    $res = curl_exec($ch);

	    $ad = json_decode($res);
	    //var_dump($ad->retData[0]);
	    $adname = $ad->retData[0]->name_en;
	    //var_dump($adname);
	    $ch = curl_init();
	    $url = 'http://apis.baidu.com/apistore/weatherservice/weather?citypinyin='.$adname;
	    $header = array(
	        'apikey:c8c9903b83167729498ea18cca3e4182',
	    );
	    // 添加apikey到header
	    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    // 执行HTTP请求
	    curl_setopt($ch , CURLOPT_URL , $url);
	    $res = curl_exec($ch);
	    echo '<br>';
	    $weather = json_decode($res);
	    //var_dump($weather);
	    $arr['city'] = $weather->retData->city;
	    $arr['weather'] = $weather->retData->weather;
	    $arr['temp'] = $weather->retData->temp;
	    $arr['l_tmp'] = $weather->retData->l_tmp;
	    $arr['h_tmp'] = $weather->retData->h_tmp;
	    $arr['WD'] = $weather->retData->WD;
	    $arr['WS'] = $weather->retData->WS;
	    echo "<meta charset='utf-8'>";
	    //var_dump($arr);
	    echo $address_arr->city.'的天气为：'. $arr['weather'] . '，气温：'.$arr['temp'] . '，最低：'.$arr['l_tmp'].'，最高：'.$arr['h_tmp'].'，'. $arr['WD'] .'，'.$arr['WS'];


	    echo '<iframe width="420" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&py='.$weather->retData->pinyin.'&num=5"></iframe>';
	    $this->display();
    }

    public function makeQRcode()
    {
    	$data = I('post.data');
    	$level = I('post.level');
    	$size = I('post.size');
    	$errorCorrectionLevel = 'L';
	    if (isset($level) && in_array($level, array('L','M','Q','H')))
	    {
	        $errorCorrectionLevel =  $level;
	    }

	    $matrixPointSize = 4;
	    if (isset($size))
	    {
	        $matrixPointSize = min(max((int)$size, 1), 10);
	    }

	    Vendor('Phpqrcode.phpqrcode');
    	$QRcode = new \QRcode();
	    if (isset($data))
	    {
	        //it's very important!
	        if (trim($data) == '')
	        {
	            die('data cannot be empty! <a href="?">back</a>');
	        }

    		$PNG_TEMP_DIR = 'Public/qrcode/';

	        if (!file_exists($PNG_TEMP_DIR))
		        mkdir($PNG_TEMP_DIR);
		    // user data
		    $filename = $PNG_TEMP_DIR.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    		$QRcode::png($data, $filename, $level, $size, 2,true); 
		    $filename  = str_replace('\\','/',$filename);

    		echo __ROOT__.'/'.$filename;
	        
	    }else{    
	    
	        //default data
	        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
	        $QRcode::png('二维码地址', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
    		echo __ROOT__.'/'.$filename;
	        
	    }  
    }

    public function visit()
    {
    	$requestUrl = 'www.gzftlkj.com';
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $requestUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
		curl_setopt($ch, CURLOPT_PROXY, '60.205.11.90'); //代理服务器地址
		curl_setopt($ch, CURLOPT_PROXYPORT, 80); //代理服务器端口
		//curl_setopt($ch, CURLOPT_PROXYUSERPWD, ":"); //http代理认证帐号，username:password的格式
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式
		$file_contents = curl_exec($ch);
		curl_close($ch);
		//echo $file_contents;
    }
    public function addCookie()
    {
    	$name = I('post.name');
    	$pass = I('post.pass');
    	dump(I('post.'));
    	if(I('post.remember') == 1){
    		// echo 1;
    		cookie('name',$name,600);
    		cookie('pass',$pass,600);

    		// echo cookie('name');
    		// echo cookie('pass');
    	}
    }
    public function getCookie()
    {
    	$data['name'] = cookie('name');
    	$data['pass'] = cookie('pass'); 
    	$this->ajaxReturn($data);
    }

    public function getCity()
    {
    	$ipad = getIP();
    	dump($ip.'<br>'.$ipad);
    	import('Org.Net.IpLocation');
    	$Ip = new \Org\Net\IpLocation('qqwry.dat');
    	$area = $Ip->getlocation($ipad);
    	$area = iconv('gbk','utf-8',$area['country']);
    	dump($area);
    }

    public function myCV()
   	{
		$this->display();
   	}
}