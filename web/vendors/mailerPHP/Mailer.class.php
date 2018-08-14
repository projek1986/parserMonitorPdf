<?php
include_once ('class.phpmailer.php');

class Mailer extends PHPMailer{
    public function __construct($con, $exceptions = false) {
        parent::__construct($exceptions);
        $this->IsSMTP(true);
        $this->SMTPAuth = true;
        $this->SMTPSecure = "ssl";          
        
        $this->Host = $con['host'];
        $this->Username = $con['username'];
        $this->Password = $con['password'];
        $this->Port = $con['port'];
        $this->CharSet = 'utf-8';
        $this->IsHTML(true);
        
        $this->AltBody = 'Jeżeli nie możesz odczytać tej wiadomości skorzystaj z programu wspierajacego język HTML';
    }
    
    public function SetEmbedImages($images, $image_path) {
        if(!empty($images)) {
            foreach($images as $i) {
                $image = $image_path.$i['path'];
                $this->AddEmbeddedImage($image, $i['cid'], $i['realname'], "base64", $i['mime']);
            }
        }
    }
    
    public function SetAttachments($attachments, $attachment_path) {
        if(!empty($attachments)) {
            foreach($attachments as $a) {
                $attachment = $attachment_path.$a['path'];
                $this->AddAttachment($attachment, $a['realname'], "base64",  $a['mime']);
            }
        }        
    }
}
?>
