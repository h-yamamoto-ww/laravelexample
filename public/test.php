<?php
 
$compress_file = './index.php';
$file = './compress.zip';
 
// 圧縮・解凍するためのオブジェクト生成
$zip = new ZipArchive();
 
$result = $zip->open($file, ZipArchive::CREATE);
if($result === true)
{
  // 圧縮
  $zip->addFile($compress_file);
 
  // ファイルを生成
  $zip->close();
}
?>