<?php
$basedir = dirname(__FILE__); 

  
  
  //print_r($_FILES);
  //print_r($_POST);
  
$time = explode('-',gmdate("y-m-d-H-i-s", time()+28800));
$per = number_format((time()+28800-gmmktime(0,0,0,1,1,2012))/(gmmktime(0,0,0,1,1,2013)-gmmktime(0,0,0,1,1,2012))*100, 4);
$year = $time[0];$mon = $time[1];$day = $time[2];$hour = $time[3];$min = $time[4];$sec = $time[5];
function mkdirs($dir, $mode = 0777)
{
if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
if (!mkdirs(dirname($dir), $mode)) return FALSE;
return @mkdir($dir, $mode);
}



	$picurl = "";
	$error = "";
	$msg = "";
	$fileElementName = isset($_POST['FileObjName']) ? $_POST['FileObjName'] : 'fileToUpload';
	
	//print_r($_FILES);echo "$fileElementName";exit();
	if(!empty($_FILES[$fileElementName]['error'])){
		switch($_FILES[$fileElementName]['error'])
		{
			case '1':
				$error = '上传文件大小超过限制。The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;
			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none'){
		$error = 'No file was uploaded..';
	}else{
	
	
	
	
	
	
	
	
	
	//echo "xxxx";exit();
	
	
	
	
	
	
	$files = $_FILES[$fileElementName];
	if ((    (strstr($files["type"],'image')) || (strstr($files["type"],'audio'))) && ($files["size"] < 2000000))  {
		$filetype = ".file";$typedir = "file";
		if ( ($files["type"]=="image/jpeg") || ($files["type"]=="image/pjpeg") || ($files["type"]=="image/jpg")  ){
		  $filetype = ".jpg";$typedir = "image";
		}elseif( ($files["type"]=="image/png") || ($files["type"]=="image/x-png") ){
		  $filetype = ".png";$typedir = "image";
		}elseif( ($files["type"]=="image/bmp") ){
		  $filetype = ".bmp";$typedir = "image";
		}elseif( ($files["type"]=="image/gif") ){
		  $filetype = ".gif";$typedir = "image";
		}elseif ( ($files["type"]=="audio/x-ms-wma") ){
		  $filetype = ".wma";$typedir = "audio";
		}elseif ( ($files["type"]=="audio/ogg") ){
		  $filetype = ".ogg";$typedir = "audio";
		}elseif( ($files["type"]=="audio/mp3") || ($files["type"]=="audio/mpeg") ){
		  $filetype = ".mp3";$typedir = "audio";
		}
      $tmpfile = $files["tmp_name"];
      $filemd5 = md5_file($tmpfile);
      $savedir = "../../storage/$typedir/$year$mon/$mon$day/";
      $savefile = $savedir.$filemd5.$filetype;
      $fileurl = "/storage/$typedir/$year$mon/$mon$day/".$filemd5.$filetype;
      mkdirs($savedir,0777);
      //echo "xxx";
                if (file_exists($savefile)) {
                    $msg =   "文件已经存在。"; 
                    $picurl = $fileurl;
                }else{
                    if(move_uploaded_file($tmpfile, $savefile )){
                        $msg = "/storage/$typedir/$year$mon/$mon$day/".$filemd5.$filetype." 文件保存成功。";
                        $picurl = $fileurl;
                    }else{
                        $msg = "文件保存失败，错误未知，请联系管理员";
                    }
                }
                echo "{error: '',pic: '".$picurl."',msg: '" . $msg . "'}";exit();
	
	}else{
	echo "{error: '文件太大',msg: '文件太大'}";
	}
	
	exit();
	}
?>