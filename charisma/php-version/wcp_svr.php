<?php
if (!isset($_POST['action']) || !$_POST['action']){
    die('{"FUNC":"wcp_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER wcp_svr.php (on server): wrong post."}');
}
require_once('init.inc');
require_once('../../mobile/plugins.inc'); 

// 添加标签组
function addTagGroup(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup'])) {
        return $msg->msg(3, '无效的标签组名称！');
    }
    if (DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "'")) {
        return $msg->msg(3, '标签组名称已存在！');
    }
    // 获取最大顺序值
    $maxOrdnung = new Query("MAX(`groupIndex`) AS `maxOrdnung`", "`tb_wcp_tags`");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    $maxOrdnung = (DAS::hasData($maxOrdnung) && intval($maxOrdnung['data'][0]['maxOrdnung']) > 0) ? $maxOrdnung['data'][0]['maxOrdnung'] : 0;
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("tagGroup", trim($_POST['tagGroup']));
    $dml->setValue("groupIndex", $maxOrdnung + 1);
    if ($dml->insert()) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 重命名标签组
function renameTagGroup(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup'])) {
        return $msg->msg(3, '无效的标签组名称！');
    }
    if (!isset($_POST['groupIndex']) || intval($_POST['groupIndex']) < 1 || !DAS::isExistedInDB("`tb_wcp_tags`", "`groupIndex` = " . intval($_POST['groupIndex']))) {
        return $msg->msg(3, '无效的标签组顺序号！');
    }
    if (DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `groupIndex` != " . intval($_POST['groupIndex']))) {
        return $msg->msg(3, '标签组名称已存在！');
    }  
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("tagGroup", trim($_POST['tagGroup']));
    if ($dml->update("`groupIndex` = " . intval($_POST['groupIndex']))) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 前移标签组
function movePrevTagGroup(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup']) || !isset($_POST['groupIndex']) || intval($_POST['groupIndex']) < 2) {
        return $msg->msg(3, '无效的标签组名称或标签组顺序号！');
    }
    if (!DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `groupIndex` = " . intval($_POST['groupIndex']))) {
        return $msg->msg(3, '找不到对应的标签组名称或标签组顺序号！');
    }  
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("groupIndex", intval($_POST['groupIndex']));
    if ($dml->update("`groupIndex` = " . (intval($_POST['groupIndex']) - 1))) {
        $dml->setValue("groupIndex", (intval($_POST['groupIndex']) - 1));
        if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "'")) {
            return $msg->msg(1, '标签组前移成功！');
        }
        return $msg->msg(3, '标签组前移失败！');
    }
    return $msg->msg(3, '前一个标签组后移失败！');
}
// 后移标签组
function moveNextTagGroup(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup']) || !isset($_POST['groupIndex']) || !DAS::isExistedInDB("`tb_wcp_tags`", "`groupIndex` > " . intval($_POST['groupIndex']))) {
        return $msg->msg(3, '无效的标签组名称或标签组顺序号！');
    }
    if (!DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `groupIndex` = " . intval($_POST['groupIndex']))) {
        return $msg->msg(3, '找不到对应的标签组名称或标签组顺序号！');
    }  
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("groupIndex", intval($_POST['groupIndex']));
    if ($dml->update("`groupIndex` = " . (intval($_POST['groupIndex']) + 1))) {
        $dml->setValue("groupIndex", (intval($_POST['groupIndex']) + 1));
        if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "'")) {
            return $msg->msg(1, '标签组后移成功！');
        }
        return $msg->msg(3, '标签组后移失败！');
    }
    return $msg->msg(3, '后一个标签组前移失败！');
}
// 删除标签组
function deleteTagGroup(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup']) || !DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `groupIndex` = " . intval($_POST['groupIndex']))) {
        return $msg->msg(3, '无效的标签组名称或标签组顺序号！');
    }
    $maxOrdnung = new Query("max(`groupIndex`) as maxOrdung", "`tb_wcp_tags`");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    $maxOrdnung = DAS::hasData($maxOrdnung) ? $maxOrdnung['data'][0]['maxOrdung'] : 1;
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    if (intval($_POST['groupIndex']) < $maxOrdnung) {
      $dml->setUpdateExpr("`groupIndex` = `groupIndex` - 1"); 
      if (!$dml->update("`groupIndex` > " . intval($_POST['groupIndex']))) {
          return $msg->msg(1, '标签组顺序调整失败！');
      }
    }
    if ($dml->delete("`tagGroup` = '" . trim($_POST['tagGroup']) . "'")) {
        return $msg->msg(1, '标签组删除成功！');
    }
    return $msg->msg(3, '标签组删除失败！');
}

// 添加标签
function addTag(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup'])) {
        return $msg->msg(3, '无效的标签组名称！');
    }
    if (!isset($_POST['tag']) || !trim($_POST['tag'])) {
        return $msg->msg(3, '无效的标签名称！');
    }
    if (!DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "'")) {
        return $msg->msg(3, '标签组名称不存在！');
    }
    if (DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "'")) {
        return $msg->msg(3, '标签名称已存在！');
    }
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $tagGroup = new Query("*", "`tb_wcp_tags`", "", "`tagGroup` = '" . trim($_POST['tagGroup']) . "'", "`tagIndex` DESC");
    $tagGroup = DAS::quickQuery($tagGroup);
    $tagGroup = DAS::hasData($tagGroup) ? $tagGroup['data'] : false;
    if ($tagGroup && !$tagGroup[0]['tag']) {
        $dml->setValue("tag", trim($_POST['tag']));
        $dml->setValue("tagIndex", 1);
        if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "'")) {
            return $msg->msg(1, '提交成功！');
        }
        return $msg->msg(3, '提交失败！');
    }
    $dml->setValue("tagGroup", trim($_POST['tagGroup']));
    $dml->setValue("groupIndex", $tagGroup[0]['groupIndex']);
    $dml->setValue("tag", trim($_POST['tag']));
    $dml->setValue("tagIndex", $tagGroup[0]['tagIndex'] + 1);
    if ($dml->insert()) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 重命名标签
function renameTag(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup'])) {
        return $msg->msg(3, '无效的标签组名称！');
    }
    if (!isset($_POST['tag']) || !trim($_POST['tag'])) {
        return $msg->msg(3, '无效的标签名称！');
    }
    if (!isset($_POST['tagIndex']) || intval($_POST['tagIndex']) < 1) {
        return $msg->msg(3, '无效的标签顺序号！');
    }
    if (!DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tagIndex` = " . intval($_POST['tagIndex']))) {
        return $msg->msg(3, '找不到提交的标签组和标签顺序号的对应项！');
    }
    if (DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `tagIndex` != " . intval($_POST['tagIndex']))) {
        return $msg->msg(3, '标签名称已存在！');
    }
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("tag", trim($_POST['tag']));
    if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tagIndex` = " . intval($_POST['tagIndex']))) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 前移标签
function movePrevTag(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup']) || !isset($_POST['tag']) || !trim($_POST['tag']) || !isset($_POST['tagIndex']) || intval($_POST['tagIndex']) < 2) {
        return $msg->msg(3, '无效的标签组名称或标签名称或标签顺序号！');
    }
    if (!DAS::isExistedInDB("`tb_wcp_tags`", "`tag` = '" . trim($_POST['tag']) . "' AND `tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tagIndex` = " . intval($_POST['tagIndex']))) {
        return $msg->msg(3, '找不到提交的标签组和标签和标签顺序号的对应项！');
    }  
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("tagIndex", intval($_POST['tagIndex']));
    if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tagIndex` = " . (intval($_POST['tagIndex']) - 1))) {
        $dml->setValue("tagIndex", (intval($_POST['tagIndex']) - 1));
        if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "'")) {
            return $msg->msg(1, '标签前移成功！');
        }
        return $msg->msg(3, '标签前移失败！');
    }
    return $msg->msg(3, '前一个标签后移失败！');
}
// 后移标签
function moveNextTag(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup']) || !isset($_POST['tag']) || !trim($_POST['tag']) || !isset($_POST['tagIndex']) || !DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tagIndex` > " . intval($_POST['tagIndex']))) {
        return $msg->msg(3, '无效的标签组名称或标签名称或标签顺序号！');
    }
    if (!DAS::isExistedInDB("`tb_wcp_tags`", "`tag` = '" . trim($_POST['tag']) . "' AND `tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tagIndex` = " . intval($_POST['tagIndex']))) {
        return $msg->msg(3, '找不到提交的标签组和标签和标签顺序号的对应项！');
    }  
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("tagIndex", intval($_POST['tagIndex']));
    if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tagIndex` = " . (intval($_POST['tagIndex']) + 1))) {
        $dml->setValue("tagIndex", (intval($_POST['tagIndex']) + 1));
        if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "'")) {
            return $msg->msg(1, '标签后移成功！');
        }
        return $msg->msg(3, '标签后移失败！');
    }
    return $msg->msg(3, '后一个标签前移失败！');
}
// 删除标签
function deleteTag(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup'])) {
        return $msg->msg(3, '无效的标签组名称！');
    }
    if (!isset($_POST['tag']) || !trim($_POST['tag'])) {
        return $msg->msg(3, '无效的标签名称！');
    }
    if (!isset($_POST['tagIndex']) || intval($_POST['tagIndex']) < 1) {
        return $msg->msg(3, '无效的标签顺序号！');
    }
    if (!DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `tagIndex` = " . intval($_POST['tagIndex']))) {
        return $msg->msg(3, '找不到提交的标签组和标签和标签顺序号的对应项！');
    }
    // 获取最大顺序号
    $maxOrdnung = new Query("max(`tagIndex`) as maxOrdung", "`tb_wcp_tags`", "", "`tagGroup` = '" . trim($_POST['tagGroup']) . "'");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    $maxOrdnung = DAS::hasData($maxOrdnung) ? $maxOrdnung['data'][0]['maxOrdung'] : 1;
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    if (intval($_POST['tagIndex']) < $maxOrdnung) {
      $dml->setUpdateExpr("`tagIndex` = `tagIndex` - 1"); 
      if (!$dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tagIndex` > " . intval($_POST['tagIndex']))) {
          return $msg->msg(1, '标签顺序调整失败！');
      }
    }
    if ($dml->delete("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "'")) {
        return $msg->msg(1, '标签删除成功！');
    }
    return $msg->msg(3, '标签删除失败！');
}

// 为内容设置标签
function setItemTag(){
    $msg = new MSG(__FUNCTION__);
    // 内容类型数组
    $itemTypes = array(0 => false, 1 => '`tb_wcp_showrooms`');    
    // 验证参数有效性
    if (!isset($_POST['itemType']) || !isset($itemTypes[$_POST['itemType']]) || !$itemTypes[$_POST['itemType']]) {
        return $msg->msg(3, '无效的内容类型！');
    }
    if (!isset($_POST['itemID']) || !is_int(intval($_POST['itemID'])) || intval($_POST['itemID']) < 1 || !DAS::isExistedInDB($itemTypes[$_POST['itemType']], "`id` = " . intval($_POST['itemID']))) {
        return $msg->msg(3, '无效的内容ID！');
    }
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup'])) {
        return $msg->msg(3, '无效的标签组名称！');
    }
    if (!isset($_POST['tag']) || !trim($_POST['tag'])) {
        return $msg->msg(3, '无效的标签名称！');
    }
    
    $items = new Query("*", "`tb_wcp_tags`", "", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND (`itemType` = " . $_POST['itemType'] . " OR `itemType` IS NULL)", "`itemIndex` DESC");
    $items = DAS::quickQuery($items);
    if (!DAS::hasData($items)) {
        return $msg->msg(3, '无效的标签名称！');
    }
    $items = $items['data'];
    
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");    
    if (count($items) == 1) {
        if (!$items[0]['itemID']) {
            $dml->setValue("itemID", intval($_POST['itemID']));
            $dml->setValue("itemType", $_POST['itemType']);
            $dml->setValue("itemIndex", 1);
            if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "'")) {
                return $msg->msg(1, '提交成功！');
            }
            return $msg->msg(3, '提交失败！');
        }
        if ($items[0]['itemID'] && $items[0]['itemID'] == intval($_POST['itemID']) && $items[0]['itemType']) {
            $dml->setValue("itemID", NULL);
            $dml->setValue("itemType", NULL);
            $dml->setValue("itemIndex", NULL);
            if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "'")) {
                return $msg->msg(1, '提交成功！');
            }
            return $msg->msg(3, '提交失败！'); 
        }
    }
    $maxItemIndex = $items[0]['itemIndex'];
    $isExists = false;
    $itemIndex = 0;
    foreach ($items as $item) {
        if ($item['itemID'] == intval($_POST['itemID'])) {
            $isExists = true;
            $itemIndex = $item['itemIndex'];
        }
    }
    if ($isExists) {
        if ($itemIndex < $maxItemIndex) {
            $dml->setUpdateExpr("`itemIndex` = `itemIndex` - 1");
            if (!$dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `itemType` = " . $_POST['itemType'] . " AND `itemIndex` > " . $itemIndex)) {
                return $msg->msg(3, '样板间标签顺序调整失败！');
            }
        }        
        if ($dml->delete("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `itemType` = " . $_POST['itemType'] . " AND `itemID` = " . intval($_POST['itemID']))) {
            return $msg->msg(1, '样板间标签删除成功！');
        }
        return $msg->msg(3, '样板间标签删除失败！');
    }
    $dml->setValue("tagGroup", $items[0]['tagGroup']);
    $dml->setValue("groupIndex", $items[0]['groupIndex']);
    $dml->setValue("tag", $items[0]['tag']);
    $dml->setValue("tagIndex", $items[0]['tagIndex']);
    $dml->setValue("itemID", intval($_POST['itemID']));
    $dml->setValue("itemType", $_POST['itemType']);
    $dml->setValue("itemIndex", $maxItemIndex + 1);
    if ($dml->insert()) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 前移标签内容
function movePrevItem(){
    $msg = new MSG(__FUNCTION__);
    // 内容类型数组
    $itemTypes = array(0 => false, 1 => '`tb_wcp_showrooms`');    
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup'])) {
        return $msg->msg(3, '无效的标签组名称！');
    }
    if (!isset($_POST['tag']) || !trim($_POST['tag'])) {
        return $msg->msg(3, '无效的标签名称！');
    } 
    if (!isset($_POST['itemType']) || !isset($itemTypes[$_POST['itemType']]) || !$itemTypes[$_POST['itemType']]) {
        return $msg->msg(3, '无效的内容类型！');
    }
    if (!isset($_POST['itemID']) || !is_int(intval($_POST['itemID'])) || intval($_POST['itemID']) < 1 || !DAS::isExistedInDB($itemTypes[$_POST['itemType']], "`id` = " . intval($_POST['itemID']))) {
        return $msg->msg(3, '无效的内容ID！');
    }
    if (!$itemIndex = DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `itemType` = " . $_POST['itemType'] . " AND `itemID` = " . $_POST['itemID'], "itemIndex")) {
        return $msg->msg(3, '找不到所提交的内容的对应项！');
    }
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("itemIndex", $itemIndex);
    if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `itemType` = " . $_POST['itemType'] . " AND `itemIndex` = " . ($itemIndex - 1))) {
        $dml->setValue("itemIndex", ($itemIndex - 1));
        if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `itemType` = " . $_POST['itemType'] . " AND `itemID` = " . $_POST['itemID'])) {
            return $msg->msg(1, '内容前移成功！');
        }
        return $msg->msg(3, '内容前移失败！');
    }
    return $msg->msg(3, '前一个内容后移失败！');
}
// 后移标签内容
function moveNextItem(){
    $msg = new MSG(__FUNCTION__);
    // 内容类型数组
    $itemTypes = array(0 => false, 1 => '`tb_wcp_showrooms`');    
    // 验证参数有效性
    if (!isset($_POST['tagGroup']) || !trim($_POST['tagGroup'])) {
        return $msg->msg(3, '无效的标签组名称！');
    }
    if (!isset($_POST['tag']) || !trim($_POST['tag'])) {
        return $msg->msg(3, '无效的标签名称！');
    } 
    if (!isset($_POST['itemType']) || !isset($itemTypes[$_POST['itemType']]) || !$itemTypes[$_POST['itemType']]) {
        return $msg->msg(3, '无效的内容类型！');
    }
    if (!isset($_POST['itemID']) || !is_int(intval($_POST['itemID'])) || intval($_POST['itemID']) < 1 || !DAS::isExistedInDB($itemTypes[$_POST['itemType']], "`id` = " . intval($_POST['itemID']))) {
        return $msg->msg(3, '无效的内容ID！');
    }
    if (!$itemIndex = DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `itemType` = " . $_POST['itemType'] . " AND `itemID` = " . $_POST['itemID'], "itemIndex")) {
        return $msg->msg(3, '找不到所提交的内容的对应项！');
    }
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_tags`");
    $dml->setValue("itemIndex", $itemIndex);
    if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `itemType` = " . $_POST['itemType'] . " AND `itemIndex` = " . ($itemIndex + 1))) {
        $dml->setValue("itemIndex", ($itemIndex + 1));
        if ($dml->update("`tagGroup` = '" . trim($_POST['tagGroup']) . "' AND `tag` = '" . trim($_POST['tag']) . "' AND `itemType` = " . $_POST['itemType'] . " AND `itemID` = " . $_POST['itemID'])) {
            return $msg->msg(1, '内容后移成功！');
        }
        return $msg->msg(3, '内容后移失败！');
    }
    return $msg->msg(3, '后一个内容前移失败！');
}

// 添加门店
function addShop(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['name']) || !trim($_POST['name'])) {
        return $msg->msg(3, '无效的门店名称！');
    }
    if (!isset($_POST['city']) || !$_POST['city']) {
        return $msg->msg(3, '无效的城市名称！');
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 获取最大序号
    $maxOrdnung = new Query("MAX(`ordnung`) AS `maxOrdnung`", "`tb_wcp_shops`", "", "`status` > 0 AND `city` = '" . $_POST['city'] . "'");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    if (!DAS::hasData($maxOrdnung)) {
        $maxOrdnung = 0;
    }
    else {
        $maxOrdnung = $maxOrdnung['data'][0]['maxOrdnung'];
    }
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_shops`");
    $dml->setValue("name", trim($_POST['name']));
    $dml->setValue("city", $_POST['city']);
    $dml->setValue("company", $_POST['company']);
    $dml->setValue("address", $_POST['address']);
    $dml->setValue("tel", $_POST['tel']);
    $dml->setValue("coordinates", $_POST['coordinates']);
    $dml->setValue("contents", $_POST['contents']);
    $dml->setValue("ordnung", ($maxOrdnung + 1));
    $dml->setValue("status", $_POST['status']);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->insert()) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 编辑门店
function setShop(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['id']) || !is_int(intval($_POST['id'])) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_shops`", "`id` = " . intval($_POST['id']))) {
        return $msg->msg(3, '无效的门店ID！');
    }
    if (!isset($_POST['name']) || !trim($_POST['name'])) {
        return $msg->msg(3, '无效的门店名称！');
    }
    if (!isset($_POST['city']) || !$_POST['city']) {
        return $msg->msg(3, '无效的城市名称！');
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_shops`");
    $dml->setValue("name", trim($_POST['name']));
    $dml->setValue("city", $_POST['city']);
    $dml->setValue("company", $_POST['company']);
    $dml->setValue("address", $_POST['address']);
    $dml->setValue("tel", $_POST['tel']);
    $dml->setValue("coordinates", $_POST['coordinates']);
    $dml->setValue("contents", $_POST['contents']);
    $dml->setValue("status", $_POST['status']);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// movePrevImage() 前移门店
function movePrevShop(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确, 获取字段`ordnung`值（门店顺序值，用于重新编排门店顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_shops`", "`id` = " . intval($_POST['id']) . " AND `status` > 0", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取上一个门店的ID
    $prevID = new Query("`id`", "`tb_wcp_shops`", "", "`city` = '" . $_POST['city'] . "' AND `ordnung` = " . ($ordnung - 1) . " AND `status` > 0");
    $prevID = DAS::quickQuery($prevID);
    if (DAS::hasData($prevID)) {
        $prevID = $prevID['data'][0]['id'];
    }
    else {
        $prevID = false;
    }
    if ($prevID) {
        $dml = new DML("`tb_wcp_shops`");
        $dml->setUpdateExpr("`ordnung` = `ordnung` - 1"); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            $dml->setUpdateExpr("`ordnung` = `ordnung` + 1");
            if ($dml->update("`id` = " . $prevID)) {
                return $msg->msg(1, '门店前移成功！');
            }
            return $msg->msg(3, '前一个门店后移失败！'); 
        }
        return $msg->msg(3, '门店前移失败！'); 
    }
    return $msg->msg(3, '获取前一个门店失败！');
}
// moveNextImage() 后移门店
function moveNextShop(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确, 获取字段`ordnung`值（门店顺序值，用于重新编排门店顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_shops`", "`id` = " . intval($_POST['id']) . " AND `status` > 0", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取下一个门店的ID
    $nextID = new Query("`id`", "`tb_wcp_shops`", "", "`city` = '" . $_POST['city'] . "' AND `ordnung` = " . ($ordnung + 1) . " AND `status` > 0");
    $nextID = DAS::quickQuery($nextID);
    if (DAS::hasData($nextID)) {
        $nextID = $nextID['data'][0]['id'];
    }
    else {
        $nextID = false;
    }
    if ($nextID) {
        $dml = new DML("`tb_wcp_shops`");
        $dml->setUpdateExpr("`ordnung` = `ordnung` + 1"); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            $dml->setUpdateExpr("`ordnung` = `ordnung` - 1");
            if ($dml->update("`id` = " . $nextID)) {
                return $msg->msg(1, '门店后移成功！');
            }
            return $msg->msg(3, '下一个门店前移失败！'); 
        }
        return $msg->msg(3, '门店后移失败！'); 
    }
    return $msg->msg(3, '获取下一个门店失败！');
}
// deleteShop() 删除门店
function deleteShop(){
    $msg = new MSG(__FUNCTION__);    
    // 判断id是否正确, 获取字段`ordnung`值（门店顺序值，用于重新编排门店顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_shops`", "`id` = " . intval($_POST['id']) . " AND `status` > 0", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取最大顺序值
    $maxOrdnung = new Query("max(`ordnung`) as maxOrdung", "`tb_wcp_shops`", "", "`city` = '" . $_POST['city'] . "' AND `status` > 0");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    if (DAS::hasData($maxOrdnung)) {
        $maxOrdnung = $maxOrdnung['data'][0]['maxOrdung'];
    }
    else {
        $maxOrdnung = false;
    }
    if ($maxOrdnung) {
        $dml = new DML("`tb_wcp_shops`");
        // 调整相同city的门店顺序
        $dml->setUpdateExpr("`ordnung` = `ordnung` - 1");        
        if ($ordnung < $maxOrdnung) {
            if (!$dml->update("`city` = '" . $_POST['city'] . "' AND `ordnung` > " . $ordnung . " AND `status` > 0")) {
                return $msg->msg(3, '门店顺序调整失败！');
            }
        }
        // 删除门店
        /*
        if ($dml->delete("`id` = " . $_POST['id'])) {
            return $msg->msg(1, '图片删除成功！');
        }*/
        // 伪删除，顺序值ordnung设-1，状态值status设-1
        $dml->setUpdateExpr("");
        $dml->setValue("ordnung", -1); 
        $dml->setValue("status", -1); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            return $msg->msg(1, '门店删除成功！');
        }
        return $msg->msg(3, '门店删除失败！');        
    }
    return $msg->msg(3, '获取最大顺序值失败！');
}

// 添加样板间
function addShowroom(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['number']) || !intval($_POST['number'])) {
        return $msg->msg(3, '无效的样板间编号！');
    }
    if (!isset($_POST['name']) || !$_POST['name']) {
        return $msg->msg(3, '样板间名称不能为空！');
    }
    if (!isset($_POST['shop']) || !intval($_POST['shop']) || !$shopName = DAS::isExistedInDB("`tb_wcp_shops`", "`id` = " . intval($_POST['shop']), "`name`")) {
        return $msg->msg(3, '无效的门店编号！');
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 获取最大序号
    $maxOrdnung = new Query("MAX(`ordnung`) AS `maxOrdnung`", "`tb_wcp_showrooms`", "", "`status` = 1 AND `shop` = " . $_POST['shop']);
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    if (!DAS::hasData($maxOrdnung)) {
        $maxOrdnung = 0;
    }
    else {
        $maxOrdnung = $maxOrdnung['data'][0]['maxOrdnung'];
    }
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_showrooms`");
    $dml->setValue("number", intval($_POST['number']));
    $dml->setValue("numberNew", intval($_POST['number']));
    $dml->setValue("shop", $_POST['shop']);
    $dml->setValue("name", $_POST['name']);
    $dml->setValue("ename", $_POST['ename']);
    $dml->setValue("content", $_POST['content']);
    $dml->setValue("descript", $shopName . intval($_POST['number']) . "号样板间“" . $_POST['name'] . "”，添加于" . $timestamp);
    $dml->setValue("ordnung", ($maxOrdnung + 1));
    $dml->setValue("toTop", 0);
    $dml->setValue("status", 1);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->insert()) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 设置样板间
function setShowroom(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID');
    }
    // 验证参数有效性
    if (!isset($_POST['number']) || !intval($_POST['number'])) {
        return $msg->msg(3, '无效的样板间编号！');
    }
    if (!isset($_POST['name']) || !$_POST['name']) {
        return $msg->msg(3, '样板间名称不能为空！');
    }
    if (!isset($_POST['shop']) || !intval($_POST['shop']) || !$shopName = DAS::isExistedInDB("`tb_wcp_shops`", "`id` = " . intval($_POST['shop']), "`name`")) {
        return $msg->msg(3, '无效的门店编号！');
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_showrooms`");
    $dml->setValue("numberNew", intval($_POST['number']));
    $dml->setValue("shop", $_POST['shop']);
    $dml->setValue("name", $_POST['name']);
    $dml->setValue("ename", $_POST['ename']);
    $dml->setValue("content", $_POST['content']);
    $dml->setValue("descript", $shopName . intval($_POST['number']) . "号样板间“" . $_POST['name'] . "”，更新于" . $timestamp);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 设置样板间价格表
function setPriceList(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID');
    }
    if (!isset($_POST['shop']) || !intval($_POST['shop']) || !$shopName = DAS::isExistedInDB("`tb_wcp_shops`", "`id` = " . intval($_POST['shop']), "`name`")) {
        return $msg->msg(3, '无效的门店编号！');
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_showrooms`");
    $dml->setValue("descript", $shopName . intval($_POST['number']) . "号样板间“" . $_POST['name'] . "”，更新于" . $timestamp);
    $dml->setValue("priceList", rawurlencode(rawurldecode($_POST['priceList'])));
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 设置样板间酷家乐链接
function setKujiale(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID');
    }
    if (!isset($_POST['shop']) || !intval($_POST['shop']) || !$shopName = DAS::isExistedInDB("`tb_wcp_shops`", "`id` = " . intval($_POST['shop']), "`name`")) {
        return $msg->msg(3, '无效的门店编号！');
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_showrooms`");
    $dml->setValue("descript", $shopName . intval($_POST['number']) . "号样板间“" . $_POST['name'] . "”，更新于" . $timestamp);
    $dml->setValue("kujiale", $_POST['kujiale']);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 更改样板间显示状态
function changeVisibility(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$status = DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0", "status")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID');
    }
    $status = $status == 1 ? 2 : 1;
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_showrooms`");
    $dml->setValue("status", $status);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// 更改样板间置顶状态
function changeToTop(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID');
    }
    $toTop = DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0", "toTop");
    $toTop = $toTop == 1 ? 0 : 1;
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_showrooms`");
    $dml->setValue("toTop", $toTop);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// movePrevImage() 前移样板间
function movePrevShowroom(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确, 获取字段`ordnung`值（样板间顺序值，用于重新编排样板间顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取上一个样板间的ID
    $prevID = new Query("`id`", "`tb_wcp_showrooms`", "", "`shop` = '" . $_POST['shop'] . "' AND `ordnung` = " . ($ordnung - 1) . " AND `status` > 0");
    $prevID = DAS::quickQuery($prevID);
    if (DAS::hasData($prevID)) {
        $prevID = $prevID['data'][0]['id'];
    }
    else {
        $prevID = false;
    }
    if ($prevID) {
        $dml = new DML("`tb_wcp_showrooms`");
        $dml->setUpdateExpr("`ordnung` = `ordnung` - 1"); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            $dml->setUpdateExpr("`ordnung` = `ordnung` + 1");
            if ($dml->update("`id` = " . $prevID)) {
                return $msg->msg(1, '样板间前移成功！');
            }
            return $msg->msg(3, '前一个样板间后移失败！'); 
        }
        return $msg->msg(3, '样板间前移失败！'); 
    }
    return $msg->msg(3, '获取前一个样板间失败！');
}
// moveNextImage() 后移样板间
function moveNextShowroom(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确, 获取字段`ordnung`值（样板间顺序值，用于重新编排样板间顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取下一个样板间的ID
    $nextID = new Query("`id`", "`tb_wcp_showrooms`", "", "`shop` = '" . $_POST['shop'] . "' AND `ordnung` = " . ($ordnung + 1) . " AND `status` > 0");
    $nextID = DAS::quickQuery($nextID);
    if (DAS::hasData($nextID)) {
        $nextID = $nextID['data'][0]['id'];
    }
    else {
        $nextID = false;
    }
    if ($nextID) {
        $dml = new DML("`tb_wcp_showrooms`");
        $dml->setUpdateExpr("`ordnung` = `ordnung` + 1"); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            $dml->setUpdateExpr("`ordnung` = `ordnung` - 1");
            if ($dml->update("`id` = " . $nextID)) {
                return $msg->msg(1, '样板间后移成功！');
            }
            return $msg->msg(3, '下一个样板间前移失败！'); 
        }
        return $msg->msg(3, '样板间后移失败！'); 
    }
    return $msg->msg(3, '获取下一个样板间失败！');
}
// deleteShowroom() 删除样板间
function deleteShowroom(){
    $msg = new MSG(__FUNCTION__);    
    // 判断id是否正确, 获取字段`ordnung`值（样板间顺序值，用于重新编排样板间顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_POST['id']) . " AND `status` > 0", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取最大顺序值
    $maxOrdnung = new Query("max(`ordnung`) as maxOrdung", "`tb_wcp_showrooms`", "", "`shop` = '" . $_POST['shop'] . "' AND `status` > 0");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    if (DAS::hasData($maxOrdnung)) {
        $maxOrdnung = $maxOrdnung['data'][0]['maxOrdung'];
    }
    else {
        $maxOrdnung = false;
    }
    if ($maxOrdnung) {
        $dml = new DML("`tb_wcp_showrooms`");
        // 调整相同shop的样板间顺序
        $dml->setUpdateExpr("`ordnung` = `ordnung` - 1");        
        if ($ordnung < $maxOrdnung) {
            if (!$dml->update("`shop` = '" . $_POST['shop'] . "' AND `ordnung` > " . $ordnung . " AND `status` > 0")) {
                return $msg->msg(3, '样板间顺序调整失败！');
            }
        }
        // 删除样板间
        /*
        if ($dml->delete("`id` = " . $_POST['id'])) {
            return $msg->msg(1, '样板间删除成功！');
        }*/
        // 伪删除，顺序值ordnung设-1，状态值status设-1
        $dml->setUpdateExpr("");
        $dml->setValue("ordnung", -1); 
        $dml->setValue("status", -1); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            return $msg->msg(1, '样板间删除成功！');
        }
        return $msg->msg(3, '样板间删除失败！');        
    }
    return $msg->msg(3, '获取最大顺序值失败！');
}

// 编辑页面
function setPage(){
    $msg = new MSG(__FUNCTION__);
    $isUpdate = true; 
    if (!isset($_POST['id']) || !$_POST['id'] || !is_int(intval($_POST['id'])) || intval($_POST['id']) < 1) {
        $isUpdate = false;
    }
    // 验证参数有效性   
    if (!$isUpdate) {     
        if (!isset($_POST['pageFile']) || !trim($_POST['pageFile'])) {
            return $msg->msg(3, '无效的页面路径！');
        }
        $pageFile = trim($_POST['pageFile']);
        $folder = (isset($_POST['folder']) && trim($_POST['folder'])) ? trim($_POST['folder']) : 'root';
        $templet = $_POST['templet'];
    }
    else {
        $pageData = new Query("*", "`tb_vcs_pages`", "", "`id` = " . intval($_POST['id']));
        $pageData = DAS::quickQuery($pageData);
        if (!DAS::hasData($pageData)) {
            return $msg->msg(3, '无效的页面ID！');
        }
        $pageFile = $pageData['data'][0]['pageFile'];
        $folder =  $pageData['data'][0]['folder'];
        if (isset($_POST['templet']) && $_POST['templet'] != $pageData['data'][0]['templet']) {
            if ($pageData['data'][0]['templet'] > 1) {
                return $msg->msg(3, '由模板创建的页面不支持更换模板类型！');
            }
            $templet = $_POST['templet'];
        }
        else {
            $templet = $pageData['data'][0]['templet'];
        }
    }
    if (!isset($_POST['siteCname']) || !$_POST['siteCname']) {
        return $msg->msg(3, '无效的站点别名！');
    }
    
    // 配置数据值
    $pageCname = $_POST['pageCname'] ? $_POST['pageCname'] : NULL;
    $siteCname = $_POST['siteCname'] ? $_POST['siteCname'] : NULL;
    $platform = $_POST['platform'];
    $pageNameCN = $_POST['pageNameCN'] ? $_POST['pageNameCN'] : NULL;
    $imagesFolder = (isset($_POST['imagesFolder']) && $_POST['imagesFolder']) ? $_POST['imagesFolder'] : NULL;
    $componentPrefix = (isset($_POST['componentPrefix']) && $_POST['componentPrefix']) ? $_POST['componentPrefix'] : NULL;
    $configFile = (isset($_POST['configFile']) && $_POST['configFile']) ? $_POST['configFile'] : NULL;
    
    // 编辑fullUrls
    $fullUrls = 'http://www.mingjugroup.com/' . $pageFile;
    $fullUrls .= $_POST['pageCname'] ? ',http://www.mingjugroup.com/' . trim($_POST['pageCname']) : '';
    
    // 检查数据变更
    $hasChange = false;
    if ($isUpdate) {
        $hasChange = $pageCname != $pageData['data'][0]['pageCname'] ? true : false;
        $hasChange = $siteCname != $pageData['data'][0]['siteCname'] ? true : false;
        $hasChange = $platform != $pageData['data'][0]['platform'] ? true : false;
        $hasChange = $pageNameCN != $pageData['data'][0]['pageNameCN'] ? true : false;
        $hasChange = $imagesFolder != $pageData['data'][0]['imagesFolder'] ? true : false;
        $hasChange = $componentPrefix != $pageData['data'][0]['componentPrefix'] ? true : false;
        $hasChange = $configFile != $pageData['data'][0]['$configFile'] ? true : false;
        $hasChange = $fullUrls != $pageData['data'][0]['$fullUrls'] ? true : false;
        if (!$hasChange) {
            return $msg->msg(3, '没有需要更新的数据！');
        }
    }
    
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_vcs_pages`");
    $dml->setValue("pageCname", $pageCname);
    $dml->setValue("siteCname", $siteCname);
    $dml->setValue("platform", $platform);
    $dml->setValue("pageNameCN", $pageNameCN);
    $dml->setValue("imagesFolder", $imagesFolder);
    $dml->setValue("componentPrefix", $componentPrefix);
    $dml->setValue("templet", $templet);
    $dml->setValue("configFile", $configFile);
    $dml->setValue("fullUrls", $fullUrls);
    
    // 如果不存在ID,则添加页面
    if (!isset($_POST['id']) || !$_POST['id'] || !is_int(intval($_POST['id'])) || intval($_POST['id']) < 1) {
        if ($_POST['templet'] > 1) {
            if ($_POST['templet'] == 2) {
                if (!file_exists('../../' . $pageFile)) {
                    if (!file_exists('../../templet/mobile.php')) {
                        return $msg->msg(3, '找不到官网移动页面模板！');
                    }
                    if (!copy('../../templet/mobile.php', '../../' . $pageFile)) {
                        return $msg->msg(3, '复制官网移动页面模板到' . '../../' . $pageFile . '时发生错误！');
                    }
                }
                else {
                    return $msg->msg(3, '官网移动页面文件已经存在！');
                }
            }
            if ($_POST['templet'] == 3) {
                if (!file_exists('../../' . $pageFile)) {
                    if (!file_exists('../../templet/tuiguang.php')) {
                        return $msg->msg(3, '找不到推广移动页面模板！');
                    }
                    if (!copy('../../templet/tuiguang.php', '../../' . $pageFile)) {
                        return $msg->msg(3, '复制推广移动页面模板到' . '../../' . $pageFile . '时发生错误！');
                    }
                }
                else {
                    return $msg->msg(3, '推广移动页面文件已经存在！');
                }
            }
        }
        $dml->setValue("pageFile", $pageFile);
        $dml->setValue("folder", $folder);
        $dml->setValue("status", 1);
        if ($dml->insert()) {
            return $msg->msg(1, '添加提交成功！');
        }
        return $msg->msg(3, '添加提交失败！');
    }
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '更新提交成功！');
    }
    return $msg->msg(3, '更新提交失败！');
}
// deletePage() 删除页面
function deletePage(){
    $msg = new MSG(__FUNCTION__);    
    // 判断id是否正确
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_vcs_pages`", "`id` = " . $_POST['id'] . " AND `status` = 1")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID。');
    }
    // 获取页面信息
    $pageData = new Query("*", "`tb_vcs_pages`","" , "`id` = " . $_POST['id'] . " AND `status` = 1");
    $pageData = DAS::quickQuery($pageData);
    $pageData = DAS::hasData($pageData) ? $pageData['data'][0] : false;
    
    if (!$pageData) {
        return $msg->msg(3, '获取页面信息失败。');
    }
    
    // 如果是由模板创建的页面，则删除页面文件
    if (intval($pageData['templet']) > 1) {
        if (!file_exists('../../' . $pageData['pageFile'])) {
            return $msg->msg(3, '找不到要删除的页面文件。');
        }
        if (!unlink('../../' . $pageData['pageFile'])) {
            return $msg->msg(3, '删除页面文件时发生错误。');
        }
        if (file_exists('../../' . $pageData['pageFile'])) {
            return $msg->msg(3, '页面文件未能正确删除。');
        }
    }
    
    // 删除各表中的相关项
    $error = '';
    
    $dml = new DML("`tb_vcs_pages`");
    $dml->setValue("status", 0); 
    if (!$dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '删除页面时发生错误！');
    }
    
    if (DAS::isExistedInDB("`tb_wcp_contents`", "`pageID` = " . intval($_POST['id']) . " AND `status` = 1")) {
        $dml = new DML("`tb_wcp_contents`");
        $dml->setValue("status", -1);
        if (!$dml->update("`pageID` = " . intval($_POST['id']))) {
            $error .= '删除相关文本内容时发生错误。';
        } 
    }
    if (DAS::isExistedInDB("`tb_wcp_images`", "`pageID` = " . intval($_POST['id']) . " AND `status` = 1")) {
        $dml = new DML("`tb_wcp_images`");
        $dml->setValue("status", -1);
        if (!$dml->update("`pageID` = " . intval($_POST['id']))) {
            $error .= '删除相关图片内容时发生错误。';
        } 
    }
    if (DAS::isExistedInDB("`tb_wcp_composes`", "`pageID` = " . intval($_POST['id']) . " AND `status` = 1")) {
        $dml = new DML("`tb_wcp_composes`");
        $dml->setValue("status", -1);
        if (!$dml->update("`pageID` = " . intval($_POST['id']))) {
            $error .= '删除相关插件内容时发生错误。';
        } 
    }
    if ($error == '') {
        return $msg->msg(1, '页面删除成功！');
    }
    return $msg->msg(3, $error);
}

// addContent() 添加文本内容
function addContent(){
    $msg = new MSG(__FUNCTION__);
    // 参数设置：
    // 组件名称（设置"component"字段值）
    $component = $_POST['component'];
    
    // 获取pageID
    if (!isset($_POST['pageFile']) || !$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . $_POST['pageFile'] . "' AND `status` = 1", "`id`")) {
        $pageID = -1;
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 获取最大序号
    $maxOrdnung = new Query("MAX(`ordnung`) AS `maxOrdnung`", "`tb_wcp_contents`", "", "`component` = '" . $component . "' AND `status` = 1 AND `pageID` = " . $pageID);
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    if (!DAS::hasData($maxOrdnung)) {
        $maxOrdnung = 0;
    }
    else {
        $maxOrdnung = $maxOrdnung['data'][0]['maxOrdnung'];
    }
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_contents`");
    $dml->setValue("pageFile", $_POST['pageFile']);
    $dml->setValue("pageID", $pageID);
    $dml->setValue("component", $component);
    $dml->setValue("textType", $_POST['textType']);
    if ($_POST['textType'] == 1) {
        $dml->setValue("contentChar", $_POST['contentChar']);
    }
    else {
        $dml->setValue("contentText", $_POST['contentText']);
    }
    if (isset($_POST['href'])) {
        $dml->setValue("href", $_POST['href']);
    }
    $dml->setValue("ordnung", ($maxOrdnung + 1));
    $dml->setValue("descript", $_POST['descript'] . "，更新时间：" . $timestamp);
    $dml->setValue("status", 1);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->insert()) {
        return $msg->msg(1, $_POST['descript'] . '文本内容提交成功！');
    }
    return $msg->msg(3, $_POST['descript'] . '文本内容提交失败！');
}
// setContent() 添加文本内容
function setContent(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_contents`", "`id` = " . intval($_POST['id']) . " AND `status` = 1")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID');
    }
    
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_contents`");
    if (isset($_POST['textType']) && $_POST['textType']) {
        if ($_POST['textType'] == 1) {
            $dml->setValue("contentChar", $_POST['contentChar']);
        }
        else {
            $dml->setValue("contentText", $_POST['contentText']);
        }
    }    
    if (isset($_POST['href'])) {
        $dml->setValue("href", $_POST['href']);
    }
    $dml->setValue("descript", $_POST['descript'] . "，更新时间：" . $timestamp);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, $_POST['descript'] . '文本内容修改成功！');
    }
    return $msg->msg(3, $_POST['descript'] . '文本内容修改失败！');
}
// setAContent 设置/添加单个文本内容
function setAContent(){
    $msg = new MSG(__FUNCTION__);
    // $isInsert参数用于标记执行添加模式或编辑模式
    $isInsert = false;
    // 判断是否存在ID,如果不存在则为添加模式，否则为修改模式
    if (!isset($_POST['id']) || !is_int(intval($_POST['id'])) || intval($_POST['id']) < 1) {
        $isInsert = true;
    }
    // 检查参数
    if ($isInsert) {        
        if (!isset($_POST['component']) || !trim($_POST['component'])) {
            return $msg->msg(3, '提交失败！错误原因：错误的组建名');
        }        
        // 组件名称（设置"component"字段值）
        $component = trim($_POST['component']);
        // 获取pageID
        if (!isset($_POST['pageFile']) || !$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . $_POST['pageFile'] . "' AND `status` = 1", "`id`")) {
            $pageID = -1;
        }
        // 获取最大序号
        $maxOrdnung = new Query("MAX(`ordnung`) AS `maxOrdnung`", "`tb_wcp_contents`", "", "`component` = '" . $component . "' AND `status` = 1 AND `pageID` = " . $pageID);
        $maxOrdnung = DAS::quickQuery($maxOrdnung);
        if (!DAS::hasData($maxOrdnung)) {
            $maxOrdnung = 0;
        }
        else {
            $maxOrdnung = $maxOrdnung['data'][0]['maxOrdnung'];
        }
    }
    if (!$isInsert && !DAS::isExistedInDB("`tb_wcp_contents`", "`id` = " . intval($_POST['id']) . " AND `status` = 1", "textType")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID');
    }
    // 描述
    $descript = isset($_POST['descript']) && $_POST['descript'] ? $_POST['descript'] : $component;
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_contents`");
    if (strlen($_POST['content']) < 256) {
        $dml->setValue("textType", 1);
        $dml->setValue("contentChar", $_POST['content']);
        $dml->setValue("contentText", NULL);
    }
    else {
        $dml->setValue("textType", 2);
        $dml->setValue("contentChar", NULL);
        $dml->setValue("contentText", $_POST['content']);
    }
    if (isset($_POST['href'])) {
        $dml->setValue("href", $_POST['href']);
    }   
    $dml->setValue("descript", $descript . "，更新时间：" . $timestamp); 
    $dml->setValue("timestamp", $timestamp);
    if ($isInsert) {
        $dml->setValue("pageFile", $_POST['pageFile']);
        $dml->setValue("pageID", $pageID);
        $dml->setValue("component", $component);
        $dml->setValue("ordnung", ($maxOrdnung + 1));
        $dml->setValue("status", 1);
        if ($dml->insert()) {
            return $msg->msg(1, $descript . '文本内容提交成功！');
        }
        return $msg->msg(3, $descript . '文本内容提交失败！');
    }
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, $descript . '文本内容修改成功！');
    }
    return $msg->msg(3, $descript . '文本内容修改失败！');
}
// movePrevContent() 前移文本内容顺序
function movePrevContent(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确, 获取字段`ordnung`值（文本内容顺序值，用于重新编排文本内容顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_contents`", "`id` = " . intval($_POST['id']) . " AND `status` = 1", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取上一个文本内容的ID
    $prevID = new Query("`id`", "`tb_wcp_contents`", "", "`component` = '" . $_POST['component'] . "' AND `ordnung` = " . ($ordnung - 1) . " AND `status` = 1");
    $prevID = DAS::quickQuery($prevID);
    if (DAS::hasData($prevID)) {
        $prevID = $prevID['data'][0]['id'];
    }
    else {
        $prevID = false;
    }
    if ($prevID) {
        $dml = new DML("`tb_wcp_contents`");
        $dml->setUpdateExpr("`ordnung` = `ordnung` - 1"); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            $dml->setUpdateExpr("`ordnung` = `ordnung` + 1");
            if ($dml->update("`id` = " . $prevID)) {
                return $msg->msg(1, '文本内容前移成功！');
            }
            return $msg->msg(3, '上条文本内容后移失败！'); 
        }
        return $msg->msg(3, '文本内容前移失败！'); 
    }
    return $msg->msg(3, '获取上一个文本内容失败！');
}
// moveNextContent() 后移文本内容顺序
function moveNextContent(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确, 获取字段`ordnung`值（文本内容顺序值，用于重新编排文本内容顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_contents`", "`id` = " . intval($_POST['id']) . " AND `status` = 1", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取下一个文本内容的ID
    $nextID = new Query("`id`", "`tb_wcp_contents`", "", "`component` = '" . $_POST['component'] . "' AND `ordnung` = " . ($ordnung + 1) . " AND `status` = 1");
    $nextID = DAS::quickQuery($nextID);
    if (DAS::hasData($nextID)) {
        $nextID = $nextID['data'][0]['id'];
    }
    else {
        $nextID = false;
    }
    if ($nextID) {
        $dml = new DML("`tb_wcp_contents`");
        $dml->setUpdateExpr("`ordnung` = `ordnung` + 1"); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            $dml->setUpdateExpr("`ordnung` = `ordnung` - 1");
            if ($dml->update("`id` = " . $nextID)) {
                return $msg->msg(1, '文本内容后移成功！');
            }
            return $msg->msg(3, '下一条文本内容前移失败！'); 
        }
        return $msg->msg(3, '文本内容后移失败！'); 
    }
    return $msg->msg(3, '获取下一条文本内容失败！');
}
// deleteContent() 删除文本内容
function deleteContent(){
    $msg = new MSG(__FUNCTION__);    
    // 判断id是否正确, 获取字段`ordnung`值（文本内容顺序值，用于重新编排文本内容顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_contents`", "`id` = " . intval($_POST['id']) . " AND `status` = 1", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取最大顺序值
    $maxOrdnung = new Query("max(`ordnung`) as maxOrdung", "`tb_wcp_contents`", "", "`component` = '" . $_POST['component'] . "' AND `status` = 1");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    if (DAS::hasData($maxOrdnung)) {
        $maxOrdnung = $maxOrdnung['data'][0]['maxOrdung'];
    }
    else {
        $maxOrdnung = false;
    }
    if ($maxOrdnung) {
        $dml = new DML("`tb_wcp_contents`");
        // 调整相同`component`的文本内容顺序
        $dml->setUpdateExpr("`ordnung` = `ordnung` - 1");        
        if ($ordnung < $maxOrdnung) {
            if (!$dml->update("`component` = '" . $_POST['component'] . "' AND `ordnung` > " . $ordnung . " AND `status` = 1")) {
                return $msg->msg(3, '文本内容顺序调整失败！');
            }
        }
        // 删除文本内容
        /*
        if ($dml->delete("`id` = " . $_POST['id'])) {
            return $msg->msg(1, '文本内容删除成功！');
        }*/
        // 伪删除，顺序值ordnung设-1，状态值status设-1
        $dml->setUpdateExpr("");
        $dml->setValue("ordnung", -1); 
        $dml->setValue("status", -1); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            return $msg->msg(1, '文本内容删除成功！');
        }
        return $msg->msg(3, '文本内容删除失败！');        
    }
    return $msg->msg(3, '获取最大顺序值失败！');
}
// setContentsGroup() 群组编辑文本内容
function setContentsGroup(){
    $msg = new MSG(__FUNCTION__);
    // 获取表单参数表
    if (!isset($_POST['formParameter']) || !$_POST['formParameter'] || !$components = json_decode($_POST['formParameter'])) {
        return $msg->msg(3, '获取表单参数表失败！');
    }
    $status = true;
    $change = false;
    // 获取pageID
    if (!isset($_POST['pageFile']) || !$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . $_POST['pageFile'] . "' AND `status` = 1", "`id`")) {
        $pageID = -1;
    }
    // 获取原始数据
    $origContents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = " . $pageID . " AND `status` = 1");
    $origContents = DAS::quickQuery($origContents);
    $origValues = array();
    if (DAS::hasData($origContents)) {
        foreach ($origContents['data'] as $origContent) {
            $origValues[$origContent['component']] = $origContent['textType'] == 1 ? $origContent['contentChar'] : $origContent['contentText'];
        }
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_contents`");
    foreach ($components as $component) {
        // 重置DML
        $dml->resetDML(); 
        // 判别文本内容数据类型（varchar或text）
        if (strlen(rawurlencode($_POST[$component])) > 255) {
            $dml->setValue("textType", 2);
            $dml->setValue("contentText", rawurlencode($_POST[$component]));
            $dml->setValue("contentChar", NULL);
        }
        else {
            $dml->setValue("textType", 1);
            $dml->setValue("contentChar", rawurlencode($_POST[$component]));
            $dml->setValue("contentText", NULL);
        }
        // 设置时间戳
        $dml->setValue("timestamp", $timestamp);
        // 如果数据库表中有相应数据且数据发生变化，更新数据
        if (isset($_POST[$component]) && isset($origValues[$component]) && $_POST[$component] != $origValues[$component]) { 
            if (!$dml->update("`pageID` = " . $pageID . " AND `status` = 1 AND `component` = '" . $component . "'")) {
                $status = false;
            }
            else {
                $change = true;
            }
        }
        // 如果数据库中无法查找到相应数据，添加数据
        else if(!isset($origValues[$component])) {
            $dml->setValue("pageFile", $_POST['pageFile']);
            $dml->setValue("pageID", $pageID);
            $dml->setValue("ordnung", 1);
            $dml->setValue("component", $component);
            $dml->setValue("status", 1);
            $dml->setValue("timestamp", $timestamp);
            switch ($component) {
                case 'topTitle':
                    $descript = '顶部标题';
                    break;
                case 'title':
                    $descript = 'title标签';
                    break;
                case 'keywords':
                    $descript = 'meta标签keywords属性';
                    break;
                case 'description':
                    $descript = 'meta标签description属性';
                    break;
                case 'backgroundColor':
                    $descript = 'body标签CSS background-color属性， 定义页面背景色';
                    break;
                case 'maxWidth':
                    $descript = 'body标签CSS max-width属性，定义页面最大宽度';
                    break;
                default:
                    $descript = $component . '属性';
                    break;
            }
            $dml->setValue("descript", $_POST['pageFile'] . '页面的' . $descript);
            if (!$dml->insert()) {
                $status = false;
            }
            else {
                $change = true;
            }
        }
    }
    if (!$change) {
        return $msg->msg(1, '数据没有改动！');
    }
    if ($status) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}
// setVCS() 设置VCS开关
function setVCS(){
    $msg = new MSG(__FUNCTION__);
    // 获取表单参数表
    if (!isset($_POST['vcs_status']) || !isset($_POST['geo_status'])) {
        return $msg->msg(3, '获取VCS参数失败！');
    }
    $vcsVal = $_POST['vcs_status'] ? 1 : 0;
    $geoVal = $_POST['geo_status'] ? 1 : 0;
    
    // 获取pageID
    if (!isset($_POST['pageFile']) || !$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . $_POST['pageFile'] . "' AND `status` = 1", "`id`")) {
        $pageID = -1;
    }
    
    // 获取原始数据
    $vcsStatus = new Query("*", "`tb_wcp_contents`", "", "`pageID` = " . $pageID . " AND `status` = 1 AND `component` = 'vcs_status'");
    $vcsStatus = DAS::quickQuery($vcsStatus);
    $geoStatus = new Query("*", "`tb_wcp_contents`", "", "`pageID` = " . $pageID . " AND `status` = 1 AND `component` = 'geo_status'");
    $geoStatus = DAS::quickQuery($geoStatus);
    
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    
    $status = true;
    
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_contents`");
    $dml->setValue("textType", 1);
    $dml->setValue("contentChar", $vcsVal);
    $dml->setValue("timestamp", $timestamp);
    // 如果数据库中没有相应记录，则插入新数据
    if (!DAS::hasData($vcsStatus)) {
        $dml->setValue("pageFile", $_POST['pageFile']);
        $dml->setValue("pageID", $pageID);
        $dml->setValue("ordnung", 1);
        $dml->setValue("component", "vcs_status");
        $dml->setValue("status", 1);        
        $dml->setValue("descript", $_POST['pageFile'] . '页面的本地访客统计系统VCS开关。');
        if (!$dml->insert()) {
            $status = false;
        }
    }
    else {
        if (!$dml->update("`pageID` = " . $pageID . " AND `status` = 1 AND `component` = 'vcs_status'")) {
            $status = false;
        }
    }
    $dml->resetDML(); 
    $dml->setValue("textType", 1);
    $dml->setValue("contentChar", $geoVal);
    $dml->setValue("timestamp", $timestamp);
    // 如果数据库中没有相应记录，则插入新数据
    if (!DAS::hasData($geoStatus)) {
        $dml->setValue("pageFile", $_POST['pageFile']);
        $dml->setValue("pageID", $pageID);
        $dml->setValue("ordnung", 1);
        $dml->setValue("component", "geo_status");
        $dml->setValue("status", 1);        
        $dml->setValue("descript", $_POST['pageFile'] . '页面的本地访客统计系统地理位置搜集开关。');
        if (!$dml->insert()) {
            $status = false;
        }
    }
    else {
        if (!$dml->update("`pageID` = " . $pageID . " AND `status` = 1 AND `component` = 'geo_status'")) {
            $status = false;
        }
    }
    if ($status) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}

// addImage() 添加图片内容
function addImage(){
    $msg = new MSG(__FUNCTION__);
    // 参数设置：
    // 组件名称（用于设置图片文件名、设置"component"字段值）
    $component = $_POST['component'];
    // 相对路径（用于uploadImage函数、用于产生"folderName"字段值）
    $relativeFolder = '../../images/' . $_POST['folder'];
    if (!file_exists($relativeFolder)) {
        mkdir ($relativeFolder, 0777, true);
    }
    
    // ----------------------------------------- 分割线 --------------------------------------------
    // 将相对路径转换为绝对路径
    $folderName = str_replace('../..', 'http://www.mingjugroup.com', $relativeFolder);
    // 如果是新上传图片，将临时上传图片文件转存入指定文件夹
    if (isset($_POST['path']) && $_POST['path']) {
        $fileName = basename($_POST['path']);
    }
    else {
        if (!isset($_POST['tempID']) || !$_POST['tempID']) {
            return $msg->msg(3, '获取临时图片文件ID失败');
        } 
        $uploadMSG = uploadImage($_POST['tempID'], $relativeFolder, $component);    
        if ($uploadMSG['TYPE'] != 1) {
            return $uploadMSG;
        }
        $fileName = $uploadMSG['DATA'];
    }
    // 检查图片路径及图片属性
    if (!file_exists($relativeFolder . '/' . $fileName) || !$dimen = getimagesize($relativeFolder . '/' . $fileName)) {
        return $msg->msg(3, $_POST['descript'] . '读取图片文件信息失败！');
    }
    // 获取pageID
    if (isset($_POST['pageFile'])) {
        if ($_POST['pageFile'] == 'showroom') {
            $pageID = -2; 
        }
        elseif ($_POST['pageFile'] == 'shop') {
            $pageID = -3; 
        }
        elseif (!$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . $_POST['pageFile'] . "' AND `status` = 1", "`id`")) {
            $pageID = -1;
        }
    }
    else {
       return $msg->msg(3, '未提供pageFile数据，获取pageID失败！');
    }
    // 检查样板间参数
    if ($pageID == -2) {
        if (!isset($_POST['showroomNum']) || !isset($_POST['showroomShop']) || intval($_POST['showroomNum']) < 1 || intval($_POST['showroomShop']) < 1) {
            return $msg->msg(3, '无效的样板间号或样板间所属门店！');
        }
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 获取最大序号
    $maxOrdnung = new Query("MAX(`ordnung`) AS `maxOrdnung`", "`tb_wcp_images`", "", "`status` = 1 AND `component` = '" . $component . "'");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    if (!DAS::hasData($maxOrdnung)) {
        $maxOrdnung = 0;
    }
    else {
        $maxOrdnung = $maxOrdnung['data'][0]['maxOrdnung'];
    }
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_images`");
    $dml->setValue("folderName", $folderName);
    $dml->setValue("fileName", $fileName);
    $dml->setValue("width", $dimen[0]);
    $dml->setValue("height", $dimen[1]);
    $dml->setValue("size", filesize($relativeFolder . '/' . $fileName));
    $dml->setValue("pageID", $pageID);
    if ($pageID == -2) {
        $dml->setValue("showroomNum", $_POST['showroomNum']);
        $dml->setValue("showroomShop", $_POST['showroomShop']);
    }
    if ($pageID == -3) {
        $dml->setValue("showroomShop", $_POST['showroomShop']);
    }
    if (isset($_POST['alt'])) {
        $dml->setValue("alt", $_POST['alt']);
    }
    if (isset($_POST['title'])) {
        $dml->setValue("title", $_POST['title']);
    }
    if (isset($_POST['href'])) {
        $dml->setValue("href", $_POST['href']);
    }
    if (isset($_POST['head'])) {
        $dml->setValue("head", $_POST['head']);
    }
    if (isset($_POST['content'])) {
        $dml->setValue("content", $_POST['content']);
    }
    if (isset($_POST['css'])) {
        $dml->setValue("css", $_POST['css']);
    }
    $dml->setValue("status", 1);
    $dml->setValue("component", $component);
    $dml->setValue("ordnung", ($maxOrdnung + 1));
    $dml->setValue("descript", $_POST['descript'] . "，上传时间：" . $timestamp . "；文件路径：" . $folderName . "." . $uploadMSG['DATA']);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->insert()) {
        return $msg->msg(1, $_POST['descript'] . '图片提交成功！');
    }
    return $msg->msg(3, $_POST['descript'] . '图片提交失败！');
}
// setImage() 编辑图片内容 （该设置不会更改PageID、showroomNum、showroomShop、component、ordnung、status字段）
function setImage(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_images`", "`id` = " . intval($_POST['id']) . " AND `status` = 1")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID');
    }
    // ----------------------------------------- 分割线 --------------------------------------------  
    // 参数设置：
    // 组件名称（用于设置图片文件名、设置"component"字段值）
    $component = $_POST['component'];
    // 相对路径（用于uploadImage函数、用于产生"folderName"字段值）
    $relativeFolder = '../../images/' . $_POST['folder'];
    
    // ----------------------------------------- 分割线 --------------------------------------------
    // 将相对路径转换为绝对路径
    $folderName = str_replace('../..', 'http://www.mingjugroup.com', $relativeFolder);
    // 如果是新上传图片，将临时上传图片文件转存入指定文件夹
    if (isset($_POST['path']) && $_POST['path']) {
        $fileName = basename($_POST['path']);
    }
    else {
        if (!isset($_POST['tempID']) || !$_POST['tempID']) {
            return $msg->msg(3, '获取临时图片文件ID失败');
        } 
        $uploadMSG = uploadImage($_POST['tempID'], $relativeFolder, $component);    
        if ($uploadMSG['TYPE'] != 1) {
            return $uploadMSG;
        }
        $fileName = $uploadMSG['DATA'];
    }
    // 检查图片路径及图片属性
    if (!file_exists($relativeFolder . '/' . $fileName) || !$dimen = getimagesize($relativeFolder . '/' . $fileName)) {
        return $msg->msg(3, $_POST['descript'] . '读取图片文件信息失败！');
    }
    // 获取pageID
    /*
    if (!isset($_POST['pageFile']) || !$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . $_POST['pageFile'] . "' AND `status` = 1", "`id`")) {
        $pageID = -1;
    }*/
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_images`");
    $dml->setValue("folderName", $folderName);
    $dml->setValue("fileName", $fileName);
    $dml->setValue("width", $dimen[0]);
    $dml->setValue("height", $dimen[1]);
    $dml->setValue("size", filesize($relativeFolder . '/' . $fileName));
    //$dml->setValue("pageID", $pageID);
    if (isset($_POST['alt'])) {
        $dml->setValue("alt", $_POST['alt']);
    }
    if (isset($_POST['title'])) {
        $dml->setValue("title", $_POST['title']);
    }
    if (isset($_POST['href'])) {
        $dml->setValue("href", $_POST['href']);
    }
    if (isset($_POST['head'])) {
        $dml->setValue("head", $_POST['head']);
    }
    if (isset($_POST['content'])) {
        $dml->setValue("content", $_POST['content']);
    }
    if (isset($_POST['css'])) {
        $dml->setValue("css", $_POST['css']);
    }
    //$dml->setValue("component", $component);
    $dml->setValue("descript", $_POST['descript'] . "，上传时间：" . $timestamp . "；文件路径：" . $folderName . "." . $uploadMSG['DATA']);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, $_POST['descript'] . '图片提交成功！');
    }
    return $msg->msg(3, $_POST['descript'] . '图片提交失败！');
}
// deleteImage() 删除图片内容
function deleteImage(){
    $msg = new MSG(__FUNCTION__);    
    // 判断id是否正确, 获取字段`ordnung`值（图片顺序值，用于重新编排图片顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_images`", "`id` = " . intval($_POST['id']) . " AND `status` = 1", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取最大顺序值
    $maxOrdnung = new Query("max(`ordnung`) as maxOrdung", "`tb_wcp_images`", "", "`component` = '" . $_POST['component'] . "' AND `status` = 1");
    $maxOrdnung = DAS::quickQuery($maxOrdnung);
    if (DAS::hasData($maxOrdnung)) {
        $maxOrdnung = $maxOrdnung['data'][0]['maxOrdung'];
    }
    else {
        $maxOrdnung = false;
    }
    if ($maxOrdnung) {
        $dml = new DML("`tb_wcp_images`");
        // 调整相同`component`的图片顺序
        $dml->setUpdateExpr("`ordnung` = `ordnung` - 1");        
        if ($ordnung < $maxOrdnung) {
            if (!$dml->update("`component` = '" . $_POST['component'] . "' AND `ordnung` > " . $ordnung . " AND `status` = 1")) {
                return $msg->msg(3, '图片顺序调整失败！');
            }
        }
        // 删除图片
        /*
        if ($dml->delete("`id` = " . $_POST['id'])) {
            return $msg->msg(1, '图片删除成功！');
        }*/
        // 伪删除，顺序值ordnung设-1，状态值status设-1
        $dml->setUpdateExpr("");
        $dml->setValue("ordnung", -1); 
        $dml->setValue("status", -1); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            return $msg->msg(1, '图片删除成功！');
        }
        return $msg->msg(3, '图片删除失败！');        
    }
    return $msg->msg(3, '获取最大顺序值失败！');
}
// movePrevImage() 前移图片顺序
function movePrevImage(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确, 获取字段`ordnung`值（图片顺序值，用于重新编排图片顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_images`", "`id` = " . intval($_POST['id']) . " AND `status` = 1", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取上一个图片内容的ID
    $prevID = new Query("`id`", "`tb_wcp_images`", "", "`component` = '" . $_POST['component'] . "' AND `ordnung` = " . ($ordnung - 1) . " AND `status` = 1");
    $prevID = DAS::quickQuery($prevID);
    if (DAS::hasData($prevID)) {
        $prevID = $prevID['data'][0]['id'];
    }
    else {
        $prevID = false;
    }
    if ($prevID) {
        $dml = new DML("`tb_wcp_images`");
        $dml->setUpdateExpr("`ordnung` = `ordnung` - 1"); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            $dml->setUpdateExpr("`ordnung` = `ordnung` + 1");
            if ($dml->update("`id` = " . $prevID)) {
                return $msg->msg(1, '图片前移成功！');
            }
            return $msg->msg(3, '前张图片后移失败！'); 
        }
        return $msg->msg(3, '图片前移失败！'); 
    }
    return $msg->msg(3, '获取前一个图片内容失败！');
}
// moveNextImage() 后移图片顺序
function moveNextImage(){
    $msg = new MSG(__FUNCTION__);
    // 判断id是否正确, 获取字段`ordnung`值（图片顺序值，用于重新编排图片顺序）
    if (!isset($_POST['id']) || intval($_POST['id']) < 1 || !$ordnung = DAS::isExistedInDB("`tb_wcp_images`", "`id` = " . intval($_POST['id']) . " AND `status` = 1", "`ordnung`")) {
        return $msg->msg(3, '提交失败！错误原因：错误的数据ID或获取顺序值失败。');
    }
    // 获取下一个图片内容的ID
    $nextID = new Query("`id`", "`tb_wcp_images`", "", "`component` = '" . $_POST['component'] . "' AND `ordnung` = " . ($ordnung + 1) . " AND `status` = 1");
    $nextID = DAS::quickQuery($nextID);
    if (DAS::hasData($nextID)) {
        $nextID = $nextID['data'][0]['id'];
    }
    else {
        $nextID = false;
    }
    if ($nextID) {
        $dml = new DML("`tb_wcp_images`");
        $dml->setUpdateExpr("`ordnung` = `ordnung` + 1"); 
        if ($dml->update("`id` = " . $_POST['id'])) {
            $dml->setUpdateExpr("`ordnung` = `ordnung` - 1");
            if ($dml->update("`id` = " . $nextID)) {
                return $msg->msg(1, '图片后移成功！');
            }
            return $msg->msg(3, '下张图片前移失败！'); 
        }
        return $msg->msg(3, '图片后移失败！'); 
    }
    return $msg->msg(3, '获取下一个图片内容失败！');
}


// 设置插件
function setPlugIn(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['pageFile']) || !$_POST['pageFile'] || !$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . $_POST['pageFile'] . "' AND `status` = 1", "id")) {
      return $msg->msg(3, '错误的pageFile');
    }
    // 检验ID，如果ID为无效ID则添加一条记录
    $id = false;
    if (isset($_POST['id']) && is_int(intval($_POST['id'])) && intval($_POST['id']) > 0 && DAS::isExistedInDB("`tb_wcp_composes`", "`status` = 1 AND `id` = " . intval($_POST['id']))) {
        $id = intval($_POST['id']);
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_composes`");
    $dml->setValue("name", $_POST['name']);
    $dml->setValue("plugInIndex", $_POST['plugInIndex']);
    $dml->setValue("type", PLUGIN::getPlugInType($_POST['plugInIndex']));
    $dml->setValue("pageID", $pageID);
    $dml->setValue("pageFile", $_POST['pageFile']);
    $dml->setValue("status", 1);
    if (isset($_POST['pageIndex']) && $_POST['pageIndex']){
        $dml->setValue("pageIndex", $_POST['pageIndex']);
    }
    $dml->setValue("json", $_POST['json']);
    $dml->setValue("timestamp", $timestamp);
    if (!$id) {
        if ($dml->insert()) {
            return $msg->msg(1, '提交成功！');
        }
        return $msg->msg(3, '提交失败！');
    }
    else {
        if ($dml->update("`id` = " . $id)) {
            return $msg->msg(1, '提交成功！');
        }
        return $msg->msg(3, '提交失败！');
    }    
}
// 载入插件(仅外观)
function loadPlugIn(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['id']) || !is_int(intval($_POST['id'])) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_composes`", "`status` = 1 AND `id` = " . intval($_POST['id']))) {
        return $msg->msg(3, 'ID参数错误！');
    }
    if (!isset(PLUGIN::$plugIns)) {
        return $msg->msg(3, 'PLUGIN类错误！');
    }
    if (!isset($_POST['plugInIndex']) || !is_int(intval($_POST['plugInIndex'])) || intval($_POST['plugInIndex']) < 0 || !isset(PLUGIN::$plugIns[intval($_POST['plugInIndex'])])) {
        return $msg->msg(3, 'plugIn Index 错误！');
    }
    // 转换插件参数条目
    $columnValues = new Query("`json`, `ordnung`", "`tb_wcp_composes`", "", "`status` = 1 AND `id` = " . intval($_POST['id']));
    $columnValues = DAS::quickQuery($columnValues);
    $ordnung = DAS::hasData($columnValues) ? $columnValues['data'][0]['ordnung'] : -1;
    $columnValues = DAS::hasData($columnValues) ? json_decode($columnValues['data'][0]['json'], true) : array();
    // 获取PLUGIN参数
    $columns = PLUGIN::$plugIns[intval($_POST['plugInIndex'])]['column'];
    if (count($columns) != count($columnValues)) {
        return $msg->msg(3, '插件条目数不正确！Columns条目' . count($columns) . 'ColumnValues条目' . count($columnValues));
    }
    $html = PLUGIN::$plugIns[intval($_POST['plugInIndex'])]['html'];
    for ($i = 0; $i < count($columns); $i++) {
        if (strpos($html, '*' . $columns[$i] . '#') !== false) {
            $html = str_replace('*' . $columns[$i] . '#', rawurldecode($columnValues[$i]), $html);
        }
    }
    return $msg->msg(1, '成功获取插件HTML', array('HTML' => $html, 'ORDNUNG' => $ordnung));
}
// 删除插件
function deletePlugIn(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['id']) || !is_int(intval($_POST['id'])) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_composes`", "`status` = 1 AND `id` = " . intval($_POST['id']))) {
        return $msg->msg(3, '错误的插件ID');
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_composes`");
    $dml->setValue("status", -1);
    if ($dml->update("`id` = " . intval($_POST['id']))) {
        return $msg->msg(1, '删除成功！');
    }
    return $msg->msg(3, '删除失败！');
}
// 设置排版顺序
function setCompose(){
    $msg = new MSG(__FUNCTION__);
    // 验证参数有效性
    if (!isset($_POST['id']) || !is_int(intval($_POST['id'])) || intval($_POST['id']) < 1 || !DAS::isExistedInDB("`tb_wcp_composes`", "`status` = 1 AND `id` = " . intval($_POST['id']))) {
        return $msg->msg(3, 'ID参数错误！');
    }
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    // 创建DML对象 设置相应字段值
    $dml = new DML("`tb_wcp_composes`");
    $dml->setValue("ordnung", $_POST['ordnung']);
    $dml->setValue("timestamp", $timestamp);
    if ($dml->update("`id` = " . $_POST['id'])) {
        return $msg->msg(1, '提交成功！');
    }
    return $msg->msg(3, '提交失败！');
}

// 转存上传图片 uploadImage($tmpImageID, relativeFolder, $component)
function uploadImage(){
    $msg = new MSG(__FUNCTION__);
    $tmpArgArr = func_get_args();
    if (!isset($tmpArgArr[0]) || !$tmpArgArr[0]) {
        return $msg->msg(3, '获取临时图片文件ID失败');
    }
    if (!isset($tmpArgArr[1]) || !file_exists($tmpArgArr[1])) {
        return $msg->msg(3, '未提供上传图片的目标文件夹,或目标文件夹路径错误。');
    }
    if (!isset($tmpArgArr[2]) || !$tmpArgArr[2]) {
        return $msg->msg(3, '未提供上传图片的组件名。');
    }
    $type = strpos($_SESSION['tmpPic'][$tmpArgArr[0]]['type'], 'png') ? '.png' : (strpos($_SESSION['tmpPic'][$tmpArgArr[0]]['type'], 'jpg') ? '.jpg' : '.gif');
    if (!file_put_contents($tmpArgArr[1] . '/' . $tmpArgArr[2] . '_' . $tmpArgArr[0] . $type, $_SESSION['tmpPic'][$tmpArgArr[0]]['content'])) {
        return $msg->msg(3, '转存上传图片失败，临时图片路径：' . 'http://www.mingjugroup.com/tmp/tmp.php?id=' . $tmpArgArr[0] . '，目标存储路径：' . $tmpArgArr[1] . '/' . $tmpArgArr[2] . '_' . $tmpArgArr[0] . $type);
    }
    unset($_SESSION['tmpPic'][$tmpArgArr[0]]);
    return $msg->msg(1, '转存上传图片成功！', $tmpArgArr[2] . '_' . $tmpArgArr[0] . $type);
}

switch ($_POST['action']) {
    case 'add_taggroup':
        die(json_encode(addTagGroup()));
    case 'rename_taggroup':
        die(json_encode(renameTagGroup()));
    case 'moveprev_taggroup':
        die(json_encode(movePrevTagGroup()));
    case 'movenext_taggroup':
        die(json_encode(moveNextTagGroup()));
    case 'delete_taggroup':
        die(json_encode(deleteTagGroup()));
    case 'add_tag':
        die(json_encode(addTag()));
    case 'rename_tag':
        die(json_encode(renameTag()));
    case 'moveprev_tag':
        die(json_encode(movePrevTag()));
    case 'movenext_tag':
        die(json_encode(moveNextTag()));
    case 'delete_tag':
        die(json_encode(deleteTag()));
    case 'set_item_tag':
        die(json_encode(setItemTag()));
    case 'moveprev_item':
        die(json_encode(movePrevItem()));
    case 'movenext_item':
        die(json_encode(moveNextItem()));
    case 'add_shop':
        die(json_encode(addShop()));
    case 'set_shop':
        die(json_encode(setShop()));
    case 'moveprev_shop':    
        die(json_encode(movePrevShop()));
    case 'movenext_shop':    
        die(json_encode(moveNextShop()));
    case 'delete_shop':
        die(json_encode(deleteShop()));
    case 'add_showroom':
        die(json_encode(addShowroom()));
    case 'set_showroom':
        die(json_encode(setShowroom()));
    case 'set_pricelist':
        die(json_encode(setPriceList()));
    case 'set_kujiale':
        die(json_encode(setKujiale()));
    case 'change_showroom_visibility':
        die(json_encode(changeVisibility()));
    case 'change_showroom_totop':
        die(json_encode(changeToTop()));        
    case 'moveprev_showroom':    
        die(json_encode(movePrevShowroom()));
    case 'movenext_showroom':    
        die(json_encode(moveNextShowroom()));
    case 'delete_showroom':
        die(json_encode(deleteShowroom()));
    case 'set_page':
        die(json_encode(setPage()));
    case 'delete_page':
        die(json_encode(deletePage()));
    case 'add_content':
        die(json_encode(addContent()));
    case 'set_content':
        die(json_encode(setContent()));
    case 'set_a_content':
        die(json_encode(setAContent()));
    case 'moveprev_content':    
        die(json_encode(movePrevContent()));
    case 'movenext_content':    
        die(json_encode(moveNextContent()));
    case 'delete_content':
        die(json_encode(deleteContent()));
    case 'set_contents_group':
        die(json_encode(setContentsGroup()));
    case 'set_vcs':
        die(json_encode(setVCS()));
    case 'add_image':
        die(json_encode(addImage()));
    case 'set_image':
        die(json_encode(setImage()));
    case 'delete_image':
        die(json_encode(deleteImage()));
    case 'moveprev_image':    
        die(json_encode(movePrevImage()));
    case 'movenext_image':    
        die(json_encode(moveNextImage()));
    case 'set_plugin':
        die(json_encode(setPlugIn()));
    case 'load_plugin':
        die(json_encode(loadPlugIn()));
    case 'delete_plugin':
        die(json_encode(deletePlugIn()));
    case 'set_compose':
        die(json_encode(setCompose()));
}
die('{"FUNC":"wcp_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER wcp_svr.php (on server): invalid action."}');
?>