<?php
require_once('init.inc');

function _POST($n){
    return isset($_POST[$n]) ? $_POST[$n] : NULL;
}

function delReserve(){
    $msg = new MSG(__FUNCTION__);
    if (_POST('id') && DAS::isExistedInDB("tb_mingju_reserves", "id = " . intval(_POST('id')))) {
        $drDML = new DML("tb_mingju_reserves");
        $drDML->setValue("status", "del");
        if($drDML->update("id = " . intval(_POST('id')))){
            return $msg->msg(1, '删除成功.');
        }
        return $msg->msg(1, '删除失败.');
    }
    return $msg->msg(1, 'ID错误.');
}

if (isset($_POST['action']) && $_POST['action']) {
    switch ($_POST['action']) {
        case 'delReserve':
            die(json_encode(delReserve()));
    }
    die('{"FUNC":"ims_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER ims_svr.php (on server): invalid action."}');
}
die('{"FUNC":"ims_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER ims_svr.php (on server): wrong post."}');
?>