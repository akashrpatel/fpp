<?php
header( "Access-Control-Allow-Origin: *");

$wrapped = 0;

if (isset($_GET['wrapped']))
    $wrapped = 1;

if (!$wrapped) {
  echo "<!DOCTYPE html>\n";
  echo "<html>\n";
}

$skipJSsettings = 1;
require_once("common.php");

DisableOutputBuffering();
if (!$wrapped) {
?>

<head>
<title>
Copy Settings
</title>
</head>
<body>
<h2>Copy Settings</h2>
<pre>
<?php
}
    $date = date("Ymd-Hi");
    $path = preg_replace('/{DATE}/', $date, $_GET['path']);

		echo "==================================================================================\n";

    $command = "sudo " . __DIR__ . "/../scripts/copy_settings_to_storage.sh " . escapeshellcmd($_GET['storageLocation']) . " " . $path . " " . escapeshellcmd($_GET['direction']) . " " . escapeshellcmd(isset($_GET['remoteStorage']) ? $_GET['remoteStorage'] : 'none') . " " . escapeshellcmd($_GET['delete']) . " " . escapeshellcmd($_GET['flags']);

		echo "Command: ".htmlspecialchars($command)."\n";
		echo "----------------------------------------------------------------------------------\n";
        system($command . " 2>&1");
		echo "\n";
if (!$wrapped) {
?>

==========================================================================
</pre>
<a href='index.php'>Go to FPP Main Status Page</a><br>
</body>
</html>
<? } ?>
