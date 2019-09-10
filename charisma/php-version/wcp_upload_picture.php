<?php
function uploadPicture(){
    $name = date('YmdHis', time());
    $_SESSION['tmpPic'][$name] = $_FILES['image'];
    $_SESSION['tmpPic'][$name]['content'] = file_get_contents($_FILES['image']['tmp_name']);
    $type = strpos($_FILES['image']['type'], 'png') ? '.png' : (strpos($_FILES['image']['type'], 'jpg') ? '.jpg' : '.gif');
    $dimenSize = getimagesize($_FILES['image']['tmp_name']);
    if ($dimenSize[0] >= $dimenSize[1]) {
        $dimen = 'width:100%';
    }
    else {
        $dimen = 'height:100%';
    }
    echo json_encode(array('isSuccess' => true, 'f' => '../../tmp/tmp.php?id=' . $name, 'n' => ($name . $type), 'id' => ($name), 'dimen' => $dimen, 'width' => $dimenSize[0], 'height' => $dimenSize[1]));
}

if ($_FILES['image']) {
    if ($_FILES['image']['error'] > 0) {
        echo json_encode(array('isSuccess' => false, 'msg' => '文件上载错误' . $_FILES["f"]["error"]));
    }
    else {
        uploadPicture();
    }
}
else{
   echo json_encode(array('isSuccess' => false, 'msg' => '没有文件'));
}
?>