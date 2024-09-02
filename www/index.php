<?php

try {
    $db = new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));

    $checkTable = $db->query("SHOW TABLES LIKE 'requests'");
    if ($checkTable->rowCount() == 0) {
        $createTable = $db->query("CREATE TABLE requests (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_agent VARCHAR(255) NOT NULL,
        request_uri VARCHAR(255) NOT NULL,
        ip_address VARCHAR(255) NOT NULL,
        request_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    }

    $insertRequest = $db->prepare("INSERT INTO requests (user_agent, request_uri, ip_address) VALUES (:user_agent, :request_uri, :ip_address)");
    $insertRequest->execute([
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        'request_uri' => $_SERVER['REQUEST_URI'],
        'ip_address' => $_SERVER['REMOTE_ADDR']
    ]);

    echo '<h1>Last up to 10 Requests</h1>';

    $lastRequests = $db->query("SELECT * FROM requests ORDER BY request_time DESC LIMIT 10");
    if ($lastRequests->rowCount() > 0) {
        echo '<table style="font-family: Arial, sans-serif; line-height: 1.5; border-collapse: collapse; width: 100%;">';
        echo '<tr><th style="border: 1px solid #ddd; padding: 8px;">User Agent</th><th style="border: 1px solid #ddd; padding: 8px;">Request URI</th><th style="border: 1px solid #ddd; padding: 8px;">IP Address</th><th style="border: 1px solid #ddd; padding: 8px;">Request Time</th></tr>';
        foreach ($lastRequests as $request) {
            echo '<tr>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($request['user_agent']) . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($request['request_uri']) . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($request['ip_address']) . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $request['request_time'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

} catch (\Exception $exception) {
    echo $exception->getMessage();
}

