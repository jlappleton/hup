<?php

function checkKey($post_key) {
        $conn = get_database_connection();
        $sql = "SELECT * FROM handsUp.api_keys WHERE api_key = :aKey;";
        $np = array(':aKey' => $post_key);
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $ret = $stmt->fetch(PDO::FETCH_ASSOC);

        return $ret->rowCount() == 1;
    }
