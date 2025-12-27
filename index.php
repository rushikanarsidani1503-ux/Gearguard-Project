<?php
require 'api/db.php';
if(!isset($_SESSION['user'])) header("Location:login.php");
$user=$_SESSION['user'];
?>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<p>
<b><?= $user['name'] ?></b> (<?= $user['role'] ?>)
<a href="dashboard.php">Dashboard</a>
<a href="logout.php">Logout</a>
</p>

<?php if($user['role']!='technician'){ ?>
<form id="reqForm">
<input id="subject" placeholder="Problem" required>
<select id="type">
<option>Corrective</option>
<option>Preventive</option>
</select>
<input type="date" id="date">
<select id="equipment"><option value="1">Office Printer</option></select>
<button>Add</button>
</form>
<?php } ?>

<div class="board">
<div class="col" id="New"><h3>New</h3></div>
<div class="col" id="In Progress"><h3>In Progress</h3></div>
<div class="col" id="Repaired"><h3>Repaired</h3></div>
<div class="col" id="Scrap"><h3>Scrap</h3></div>
</div>

<script>const ROLE="<?= $user['role'] ?>"</script>
<script src="script.js"></script>
</body>
</html>
