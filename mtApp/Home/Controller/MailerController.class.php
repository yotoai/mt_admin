<?php
namespace Home\Controller;
use Think\Controller;

class MailerController extends Controller 
{
	public function index()
	{
       $this->display('mailer');
	}

    public function sendMail()
    {
        $email = I('post.mail');
        import('Org.Util.PHPMailer');
        $mail = new \Org\Util\PHPMailer();

        $mail->IsSMTP();              // send via SMTP   
        $mail->Host = "smtp.qq.com";  // SMTP servers  
        $mail->Port = 465;  
        $mail->SMTPAuth = true;           // turn on SMTP authentication   
        $mail->Username ="824963272@qq.com";//SMTP username注意:普通邮件认证不需要加 @域名   
        $mail->Password = "ehaolkazfllkbdda";  // SMTP password   
        $mail->From = "824963272@qq.com";      // 发件人邮箱   
        $mail->FromName =  "YoToAi";  // 发件人   
        $mail->SMTPSecure = 'ssl';
        $mail->CharSet = "utf-8";   // 这里指定字符集！   
        $mail->Encoding = "base64";   
        $mail->AddAddress('"'.$email.'"','');  // 收件人邮箱和姓名   
        $mail->AddReplyTo("824963272@qq.com","");   
        //$mail->WordWrap = 50; // set word wrap 换行字数   
        //$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment 附件   
        //$mail->AddAttachment("/tmp/image.jpg", "new.jpg");   
        $mail->IsHTML(true);  // send as HTML   
        $mail->Subject = "注册邮件";   // 邮件主题  
        //邮件内容   
        $mail->Body = " 
            <html><head>  
            <meta http-equiv='Content-Language' content='zh-cn'>  
            <meta http-equiv='Content-Type' content='text/html; charset=GB2312'>  
            </head>  
            <body>  
                <a href='http://www.yotoai.com/index.php/Home/Mailer/sendSuccess.html'>点击完成注册</a> 

                此为电子邮件,请勿回复!
            </body>  
            </html>  
            ";                                                                       
        $mail->AltBody ="text/html";   
        if(!$mail->Send())   
        {   
            echo "邮件发送有误 <p>";   
            echo "邮件错误信息: " . $mail->ErrorInfo;   
            exit;   
        }else{   
            echo "您已邮件发送成功!<br />";   
        } 
    }

    public function sendSuccess()
    {
        $this->display('succ');
    }
}