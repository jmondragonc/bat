<?php require_once "inc/config.php";

$file_to_upload = $_FILES['croppedImage']['tmp_name'];
$file_name = 'img/files/cropped.jpg';
move_uploaded_file($file_to_upload, $file_name);

$file_to_upload2 = $_FILES['croppedImage2']['tmp_name'];
$file_name2 = 'img/files/cropped2.jpg';
move_uploaded_file($file_to_upload2, $file_name2);

$base = imagecreatefrompng('img/block.png');
$logo = imagecreatefrompng('img/logobat.png');
$img1 = imagecreatefrompng($file_name);
$img2 = imagecreatefrompng($file_name2);
$rnd = rand(1, 4);
$sello = imagecreatefrompng('img/sello'.$rnd.'.png');

imagecopymerge_alpha($base, $img1, 0, 0, 0, 0, 656, 278, 100);
imagecopymerge_alpha($base, $img2, 0, 278, 0, 0, 656, 278, 100);
imagecopymerge_alpha($base, $logo, 184, 259, 0, 0, 289, 37, 100);
imagecopymerge_alpha($base, $sello, 495, 192, 0, 0, 162, 162, 100);

$userid = $_POST['userid'];
$name = 'img/files/'.$userid.'-'.date('Y-m-d_H-i-s').'.png';
$file = $userid.'-'.date('Y-m-d_H-i-s').'.png';


header('Content-Type: image/png');
imagepng($base, $name);

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
    $cut = imagecreatetruecolor($src_w, $src_h);
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}

imagedestroy($img1);
imagedestroy($img2);

DB::insert('imagen', array(
    'file' => $name,
    'userid' => $userid,
    'status' => 0,
    'fecha' => DB::sqleval("NOW()")
));

$id = DB::insertId();

if (file_exists($file_name)) {
    unlink($file_name);
}

if (file_exists($file_name2)) {
    unlink($file_name2);
}

echo $file.'|'.$id;
