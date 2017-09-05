<?php

class AliSms
{
	private $num = null;
	private $user = null;
	private $code = null;

	public function __construct($num,$user='用户',$code)
	{
		$this->num = $num;
		$this->user = $user;
		$this->code = $code;
	}

	public function __call($name,$agument)
	{
		return "The function is not exist!";
	}

	public function sendMsg()
	{
		require_once "TopClient.php";
		require_once "RequestCheckUtil.php";
		require_once "ResultSet.php";
		require_once "TopLogger.php";
		require_once "AlibabaAliqinFcSmsNumSendRequest.php";
		require_once "SmsConfig.php";

		$c = new TopClient;
	    $c->appkey = SmsConfig::APPKEY;
	    $c->secretKey = SmsConfig::SECRETKEY;
	    $req = new AlibabaAliqinFcSmsNumSendRequest;
	    $req ->setSmsType( SmsConfig::SMSTYPE );
	    $req ->setSmsFreeSignName( SmsConfig::SMSFREESIGNNAME );
	    $req ->setSmsParam( "{name:'{$this->user}',code:'{$this->code}'}" );
	    $req ->setRecNum( $this->num );
	    $req ->setSmsTemplateCode( SmsConfig::SMSTEMPLATECODE );
	    $resp = $c ->execute( $req ); 
	}
}