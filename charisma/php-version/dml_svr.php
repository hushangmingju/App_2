<?php
if (!isset($_POST['action']) || !$_POST['action']){
    die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER dml_svr.php (on server): wrong post."}');
}
require_once('init.inc');

function insertJob(){
    $msg = new MSG(__FUNCTION__);
    if (!isset($_SESSION['cms']['userID']) || !$_SESSION['cms']['userID'] || !DAS::isExistedInDB("user", "id = " . $_SESSION['cms']['userID'])){
        return $msg->msg(3, 'No Permission to run this operation.');
    }
    if (!isset($_POST['post']) || trim($_POST['post']) == ''){
        return $msg->msg(3, '岗位信息不能为空。');
    }
    if (!isset($_POST['number']) || trim($_POST['number']) == ''){
        return $msg->msg(3, '人数不能为空。');
    }
    $post = trim($_POST['post']);
    $number = trim($_POST['number']);
    $location = isset($_POST['location']) && trim($_POST['location']) != '' ? trim($_POST['location']) : '上海闵行区';
    $ijDML = new DML('tb_mingju_jobs');
    $ijDML->setValue('userID', $_SESSION['cms']['userID']);
    $ijDML->setValue('post', rawurlencode($post));
    $ijDML->setValue('number', rawurlencode($number));
    $ijDML->setValue('location', rawurlencode($location));
    if (isset($_POST['contents']) && trim($_POST['contents']) != ''){
        $ijDML->setValue('contents', rawurlencode(trim($_POST['contents'])));
    }
    $ijDML->setValue('ip', $_SERVER['REMOTE_ADDR']);
    $ijDML->setValue('timestamp', date('Y-m-d H:i:s'));
    if ($ijDML->insert()){
        $_SESSION['vcs']['vcsID'] = mysqli_insert_id(SGF::$dbCon);
		return $msg->msg(1, '提交成功');
	}
	return $msg->msg(3, 'Error by insert.');
}

function updateJob(){
    $msg = new MSG(__FUNCTION__);
    if (!isset($_SESSION['cms']['userID']) || !$_SESSION['cms']['userID'] || !DAS::isExistedInDB("user", "id = " . $_SESSION['cms']['userID'])){
        return $msg->msg(3, 'No Permission to run this operation.');
    }
    if (!isset($_POST['id']) || !intval($_POST['id']) || !DAS::isExistedInDB("`tb_mingju_jobs`", "`id` = " . intval($_POST['id']))){
        return $msg->msg(3, 'Invalid Job ID.');
    }
    if (!isset($_POST['post']) || trim($_POST['post']) == ''){
        return $msg->msg(3, '岗位信息不能为空。');
    }
    if (!isset($_POST['number']) || trim($_POST['number']) == ''){
        return $msg->msg(3, '人数不能为空。');
    }
    $post = trim($_POST['post']);
    $number = trim($_POST['number']);
    $location = isset($_POST['location']) && trim($_POST['location']) != '' ? trim($_POST['location']) : '上海闵行区';
    $ujDML = new DML('tb_mingju_jobs');
    $ujDML->setValue('userID', $_SESSION['cms']['userID']);
    $ujDML->setValue('post', rawurlencode($post));
    $ujDML->setValue('number', rawurlencode($number));
    $ujDML->setValue('location', rawurlencode($location));
    if (isset($_POST['contents']) && trim($_POST['contents']) != ''){
        $ujDML->setValue('contents', rawurlencode(trim($_POST['contents'])));
    }
    $ujDML->setValue('ip', $_SERVER['REMOTE_ADDR']);
    $ujDML->setValue('timestamp', date('Y-m-d H:i:s'));
    if ($ujDML->update("id = " . intval($_POST['id']))){
		return $msg->msg(1, '提交成功');
	}
	return $msg->msg(3, 'Error by update.');
}

function deleteJob(){
    $msg = new MSG(__FUNCTION__);
    if (!isset($_SESSION['cms']['userID']) || !$_SESSION['cms']['userID'] || !DAS::isExistedInDB("user", "id = " . $_SESSION['cms']['userID'])){
        return $msg->msg(3, 'No Permission to run this operation.');
    }
    if (!isset($_POST['id']) || !intval($_POST['id']) || !DAS::isExistedInDB("`tb_mingju_jobs`", "`id` = " . intval($_POST['id']))){
        return $msg->msg(3, 'Invalid Job ID.');
    }
    $djDML = new DML('tb_mingju_jobs');
    $djDML->setValue('status', 'del');
    $djDML->setValue('ip', $_SERVER['REMOTE_ADDR']);
    $djDML->setValue('timestamp', date('Y-m-d H:i:s'));
    if ($djDML->update("id = " . intval($_POST['id']))){
		return $msg->msg(1, '删除成功');
	}
	return $msg->msg(3, 'Error by delete.');
}

switch($_POST['action']){
    case 'insert_job':
        die(json_encode(insertJob()));
    case 'update_job':
        die(json_encode(updateJob()));
    case 'delete_job':
        die(json_encode(deleteJob()));
}
die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER dml_svr.php (on server): invalid action."}');



?>