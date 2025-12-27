<?php
require 'db.php';
$user=$_SESSION['user'];

if($_SERVER['REQUEST_METHOD']=='GET'){
$res=$conn->query("
SELECT r.*, e.name equipment,
IF(r.scheduled_date < CURDATE() AND r.stage!='Repaired',1,0) overdue
FROM maintenance_requests r
JOIN equipment e ON r.equipment_id=e.id
");
echo json_encode($res->fetch_all(MYSQLI_ASSOC));
}

if($_SERVER['REQUEST_METHOD']=='POST'){
if($user['role']=='technician') exit;

$data=json_decode(file_get_contents("php://input"),true);
$eq=$conn->query("SELECT default_technician FROM equipment WHERE id={$data['equipment_id']}")->fetch_assoc();

$conn->query("
INSERT INTO maintenance_requests
(subject,request_type,equipment_id,technician_id,scheduled_date)
VALUES(
'{$data['subject']}',
'{$data['request_type']}',
{$data['equipment_id']},
{$eq['default_technician']},
'{$data['scheduled_date']}'
)");
}

if($_SERVER['REQUEST_METHOD']=='PUT'){
if($user['role']=='user') exit;

$data=json_decode(file_get_contents("php://input"),true);

if($data['stage']=='Scrap' && $user['role']!='manager') exit;

$conn->query("UPDATE maintenance_requests 
SET stage='{$data['stage']}', duration={$data['duration']}
WHERE id={$data['id']}");

if($data['stage']=='Scrap'){
$eq=$conn->query("SELECT equipment_id FROM maintenance_requests WHERE id={$data['id']}")->fetch_assoc();
$conn->query("UPDATE equipment SET is_scrapped=1 WHERE id={$eq['equipment_id']}");
}
}
