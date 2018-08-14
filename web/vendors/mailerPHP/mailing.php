<?php
//include '../settings/class_news_catalog.php';
//
//$catalog = new news_catalog_class(); 
//$getCatalog = $catalog->get_catalog_id("69");
//$dir_path = $getCatalog["dir_path"];
//
//
//$tpl_path = $dir_path. DIRECTORY_SEPARATOR . 'index.html'; 
//$image_path = $dir_path. DIRECTORY_SEPARATOR;
//$attachment_path = $dir_path. DIRECTORY_SEPARATOR;
//$config = $dir_path. DIRECTORY_SEPARATOR . 'config.php';
//$recipients = $dir_path. DIRECTORY_SEPARATOR . 'recipients.dat';
//
//
//
//if (!file_exists($tpl_path)) {
//    die("Mailing $mailing not found");
//}
//
//if (!file_exists($config)) {
//    die("Config file not found");
//} else {
//    include_once $config;
//}
//
//if (!file_exists($recipients)) {
//    die("Recipients file not found");
//}
//
//include_once 'Mailer.class.php';
//
//$lines = file($recipients);
//foreach ($lines as $line_num => $line) {
//    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $line)) {
//        try {
//            $mailer = new Mailer($connection);
//            $mailer->SetFrom($from);
//            $mailer->Subject = $subject;
//            $mailer->Body = file_get_contents($tpl_path);
//            $mailer->AddAddress(trim($line));
//            $mailer->ClearReplyTos();
//            if (!empty($reply_to)) {
//                $mailer->AddReplyTo($reply_to);
//            }
//            $mailer->SetEmbedImages($images, $image_path);
//            $mailer->SetAttachments($attachments, $attachment_path);
//            $mailer->Send($mailer);
//            echo "Wyslano wiadomosc do " . (trim($line)) . " (" . ($line_num + 1) . "/" . count($lines) . ") \n";
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
//    }
//}
?>