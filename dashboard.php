<?php
require 'api/db.php';
$r=$conn->query("SELECT COUNT(*) c FROM maintenance_requests")->fetch_assoc();
$e=$conn->query("SELECT COUNT(*) c FROM equipment")->fetch_assoc();
$o=$conn->query("SELECT COUNT(*) c FROM maintenance_requests WHERE stage!='Repaired'")->fetch_assoc();
?>
<h2>Dashboard</h2>
<p>Total Equipment: <?= $e['c'] ?></p>
<p>Total Requests: <?= $r['c'] ?></p>
<p>Open Requests: <?= $o['c'] ?></p>
<a href="index.php">Back</a>
