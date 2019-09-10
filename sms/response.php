<?php
if(isset($_POST['smsMsgId'])){
    if (isset($_POST['from'])) {
        $text = '';
        if (file_exists('text/smsResponse.txt')) {
            $text = file_get_contents('text/smsResponse.txt');
        }
        $text .= date('Y-m-d H:i:s') . ',' . $_POST['from'] . ',' . $_POST['to'] . ',' . $_POST['body'] . ',' . $_POST['smsMsgId'] . '\n';
        file_put_contents('text/smsResponse.txt', $text);
        echo date('Y-m-d H:i:s') . ',' . $_POST['from'] . ',' . $_POST['to'] . ',' . $_POST['body'] . ',' . $_POST['smsMsgId'] . '\n';
    }
    else {
        $text = '';
        if (file_exists('text/smsStatus.txt')) {
            $text = file_get_contents('text/smsStatus.txt');
        }
        $text .= date('Y-m-d H:i:s') . ',' . $_POST['total'] . ',' . $_POST['sequence'] . ',' . $_POST['status'] . ',' . $_POST['source'] . ',' . $_POST['updateTime'] . ',' . $_POST['orgCode'] . ',' . $_POST['extend'] . ',' . $_POST['to'] . ',' . $_POST['smsMsgId'] . '\n';
        file_put_contents('text/smsStatus.txt', $text);
    }
}
else {
    echo '<h2>Response:</h2> <br/>';
    echo str_replace('\n', '<br/>', file_get_contents('text/smsResponse.txt'));
    echo '<p></p>';
    echo '<h2>Status:</h2> <br/>';
    echo str_replace('\n', '<br/>', file_get_contents('text/smsStatus.txt'));
}
?>