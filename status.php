<?php
require_once 'functions.php';

$configFilePath = 'config.ini';
$config = readConfig($configFilePath);

$servers = $config['servers'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Server Status Monitor</title>
</head>
<body>
    <div class="container">
        <h1>Server Status Monitor</h1>
        <table>
            <thead>
                <tr>
                    <th>Server Name</th>
                    <th>URL</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servers as $key => $value): ?>
                    <?php if (strpos($key, '_name') !== false): ?>
                        <?php
                        $serverName = $value;
                        $serverUrlKey = str_replace('_name', '_url', $key);
                        $serverUrl = $servers[$serverUrlKey] ?? '#';
                        $status = checkServerStatus($serverUrl);
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($serverName); ?></td>
                            <td><a href="<?php echo htmlspecialchars($serverUrl); ?>" target="_blank"><?php echo htmlspecialchars($serverUrl); ?></a></td>
                            <td class="<?php echo strtolower($status); ?>"><?php echo htmlspecialchars($status); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
