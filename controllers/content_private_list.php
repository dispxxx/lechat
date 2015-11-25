<?php
    $row = 0;
    while ($result = mysqli_fetch_assoc($data)) {
    if ($_SESSION["id"] == $result['id_sender']) {
        $other_name = $result['name_recipient'];
        $other_id = $result['id_recipient'];
    } elseif ($_SESSION['id'] == $result['id_recipient']) {
        $other_name = $result['name_sender'];
        $other_id = $result['id_sender'];
    }
    $row++;
    require('views/content_private_list.phtml');
}