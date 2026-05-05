<?php include 'db.php'; ?>

<?php

$msg = "";

if(isset($_POST['submit'])){

$pid      = $_POST['pid'];
$did      = $_POST['did'];
$docid    = $_POST['docid'];
$reaction = $_POST['reaction'];
$severity = $_POST['severity'];

$query = "INSERT INTO ADR_REPORT
(pat_id, drug_id, doctor_id, reaction_desc, severity)
VALUES
('$pid','$did','$docid','$reaction','$severity')";

if(mysqli_query($conn,$query)){
$msg = "ADR Report Added Successfully!";
}else{
$msg = "Failed to Add Report!";
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add ADR Report</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Poppins',sans-serif;
background:linear-gradient(135deg,#eef5ff,#f8fbff,#e8f1ff);
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
padding:30px;
}

.card{
width:100%;
max-width:700px;
background:white;
padding:35px;
border-radius:22px;
box-shadow:0 20px 40px rgba(0,0,0,.08);
animation:fade .7s ease;
}

@keyframes fade{
from{opacity:0;transform:translateY(20px);}
to{opacity:1;transform:translateY(0);}
}

.top{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
gap:15px;
flex-wrap:wrap;
}

.top h1{
font-size:30px;
color:#1565ff;
}

.back{
text-decoration:none;
background:#edf4ff;
color:#1565ff;
padding:10px 15px;
border-radius:10px;
font-weight:600;
}

.grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:18px;
}

.group{
display:flex;
flex-direction:column;
}

.group.full{
grid-column:1 / 3;
}

label{
font-size:14px;
margin-bottom:7px;
font-weight:600;
color:#44526b;
}

input,select,textarea{
padding:14px;
border:1px solid #d8e4ff;
border-radius:12px;
outline:none;
font-size:15px;
transition:.3s;
}

input:focus,select:focus,textarea:focus{
border-color:#1565ff;
box-shadow:0 0 0 4px rgba(21,101,255,.08);
}

textarea{
resize:none;
height:120px;
}

button{
margin-top:22px;
width:100%;
padding:15px;
border:none;
border-radius:12px;
background:linear-gradient(90deg,#1565ff,#00a2ff);
color:white;
font-size:16px;
font-weight:700;
cursor:pointer;
transition:.3s;
}

button:hover{
transform:translateY(-3px);
box-shadow:0 14px 25px rgba(21,101,255,.22);
}

.success{
margin-bottom:18px;
padding:14px;
border-radius:12px;
background:#eefaf0;
color:#2e7d32;
font-weight:600;
}

.footer{
margin-top:18px;
text-align:center;
color:#6d7b95;
font-size:14px;
}

@media(max-width:700px){

.grid{
grid-template-columns:1fr;
}

.group.full{
grid-column:auto;
}

.top h1{
font-size:24px;
}

}

</style>
</head>
<body>

<div class="card">

<div class="top">
<h1><i class="fa-solid fa-file-circle-plus"></i> Add ADR Report</h1>
<a href="index.php" class="back"><i class="fa-solid fa-arrow-left"></i> Dashboard</a>
</div>

<?php if($msg!=""){ ?>
<div class="success"><?php echo $msg; ?></div>
<?php } ?>

<form method="POST">

<div class="grid">

<div class="group">
<label>Patient ID</label>
<input type="number" name="pid" required>
</div>

<div class="group">
<label>Drug ID</label>
<input type="number" name="did" required>
</div>

<div class="group">
<label>Doctor ID</label>
<input type="number" name="docid" required>
</div>

<div class="group">
<label>Severity</label>
<select name="severity" required>
<option value="">Select Severity</option>
<option>Mild</option>
<option>Moderate</option>
<option>Severe</option>
</select>
</div>

<div class="group full">
<label>Reaction Description</label>
<textarea name="reaction" placeholder="Enter reaction details..." required></textarea>
</div>

</div>

<button type="submit" name="submit">
<i class="fa-solid fa-floppy-disk"></i> Save Report
</button>

</form>

<div class="footer">
ADR Monitoring System • Smart Reporting Panel
</div>

</div>

</body>
</html>
