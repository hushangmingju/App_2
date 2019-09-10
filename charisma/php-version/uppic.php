<?php
function uppic(){
    $name = time();
    /*
    $info = move_uploaded_file($_FILES["myfile"]["tmp_name"], '../../tmp/' . $name);
    $imgpath='../../tmp/' . $name;  
    $response = array();  
    if($info){  
        $response['isSuccess'] = true;  
        $response['f'] = $name;  
    }else{  
        $response['isSuccess'] = false; 
        $response['msg'] = '转存错误' . $name;  
    }  
    echo json_encode($response);*/
    $_SESSION['tmpPic'][$name] = $_FILES["myfile"];
    $_SESSION['tmpPic'][$name]['content'] = file_get_contents($_FILES["myfile"]["tmp_name"]);
    echo json_encode(array('isSuccess' => true, 'f' => '../../tmp/tmp.php?id=' . $name));
}

if ($_FILES['myfile']) {
    if ($_FILES['myfile']['error'] > 0) {
        echo json_encode(array('isSuccess' => false, 'msg' => '文件上载错误' . $_FILES["f"]["error"]));
    }
    else {
        uppic();
    }
}
else{
   echo json_encode(array('isSuccess' => false, 'msg' => '没有文件'));
}
?>