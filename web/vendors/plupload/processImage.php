
<?php
if (!empty($_POST)) {
    $data = $_POST;
    $crop = 1;
    $width = intval($data['target_width']);
    $cropper_size = intval($data['jcrop_holder_width']);
    $ratio1 = 1;
    $name = 'image';
    if ($data['picture_type'] == 'image') {
//            $ratio1 = intval($cropper_size)/intval($data['jcrop_holder_height']);
//        $ratio1 = 4;
        $name = 'image_' . $data['user_id'];
    }
//    if ($data['picture_type'] == 'product1') {
//        $ratio1 = 1;
//        $name = 'product1';
//    }
//    if ($data['picture_type'] == 'product2') {
//        $ratio1 = 1;
//        $name = 'product2';
//    }
//    if ($data['picture_type'] == 'product3') {
//        $ratio1 = 1;
//        $name = 'product3';
//    }
    $height = intval($width / $ratio1);


//var_dump($data);
    $src = $_SERVER["DOCUMENT_ROOT"] . $data['file'];
//function image_resize($src, $dst, $width, $height, $crop=0){

    if (!list($w, $h) = getimagesize($src)) {
        return "Unsupported picture type!";
    }
    $scale = $w / $cropper_size;

    $type = strtolower(substr(strrchr($src, "."), 1));
    if ($type == 'jpeg')
        $type = 'jpg';
    switch ($type) {
        case 'bmp': $img = imagecreatefromwbmp($src);
            break;
        case 'gif': $img = imagecreatefromgif($src);
            break;
        case 'jpg': $img = imagecreatefromjpeg($src);
            break;
        case 'png': $img = imagecreatefrompng($src);
            break;
        default : return "Unsupported picture type!";
    }

    $dst = $_SERVER["DOCUMENT_ROOT"] . 'uploads/image/id/' . $data['user_id'] . '/' . $name . '.' . $type;
    // Create target dir
    $targetDir = $_SERVER["DOCUMENT_ROOT"] . 'uploads/image/id/' . $data['user_id'];
    if (!file_exists($targetDir)) {
        @mkdir($targetDir, 0755);
    }


// resize
    if ($crop) {
        if ($w < $width or $h < $height)
            return "Picture is too small!";
        $ratio = max($width / $w, $height / $h);
        $h = $height / $ratio;
        $x = ($w - $width / $ratio) / 2;
        $w = $width / $ratio;
    }
//else {
//    if ($w < $width and $h < $height)
//        return "Picture is too small!";
//    $ratio = min($width / $w, $height / $h);
//    $width = $w * $ratio;
//    $height = $h * $ratio;
//    $x = 0;
//}
// var_dump(imagecreatetruecolor(200, 200));
    $new = imagecreatetruecolor($width, $height);

// preserve transparency
    if ($type == "gif" or $type == "png") {
        imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
        imagealphablending($new, false);
        imagesavealpha($new, true);
    }

    imagecopyresampled($new, $img, 0, 0, $data['x1'] * $scale, $data['y1'] * $scale, $width, $height, $data['w'] * $scale, $data['h'] * $scale);
    $arr = array('file' => $dst);
    switch ($type) {
        case 'bmp': imagewbmp($new, $dst);
            break;
        case 'gif': imagegif($new, $dst);
            break;
        case 'jpg': imagejpeg($new, $dst);
            break;
        case 'png': imagepng($new, $dst);
            break;
    }

    echo '/uploads/image/id/' . $data['user_id'] . '/' . $name . '.' . $type;
} else {
    return false;
}
//}
?>
