<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ADR Reports | ADR Monitoring System</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Poppins',sans-serif;
background:linear-gradient(135deg,#eef5ff,#f9fbff,#e8f2ff);
color:#1d2a44;
min-height:100vh;
}

/* NAVBAR */
nav{
display:flex;
justify-content:space-between;
align-items:center;
padding:18px 55px;
background:rgba(255,255,255,.82);
backdrop-filter:blur(14px);
box-shadow:0 8px 20px rgba(0,0,0,.06);
}

.logo{
font-size:24px;
font-weight:700;
color:#1565ff;
}

.links a{
text-decoration:none;
margin-left:20px;
color:#33435f;
font-weight:500;
transition:.3s;
}

.links a:hover{
color:#1565ff;
}

/* HEADER */
.header{
padding:40px 55px 20px;
display:flex;
justify-content:space-between;
align-items:center;
gap:15px;
flex-wrap:wrap;
}

.header h1{
font-size:36px;
}

.header p{
margin-top:8px;
color:#6d7b95;
}

.btn{
text-decoration:none;
background:linear-gradient(90deg,#1565ff,#00a2ff);
color:white;
padding:12px 18px;
border-radius:10px;
font-weight:600;
transition:.3s;
}

.btn:hover{
transform:translateY(-4px);
box-shadow:0 10px 18px rgba(21,101,255,.22);
}

/* CONTENT */
.wrapper{
padding:0 55px 55px;
}

.panel{
background:rgba(255,255,255,.92);
padding:28px;
border-radius:20px;
box-shadow:0 14px 30px rgba(0,0,0,.06);
}

.search{
margin-bottom:20px;
}

.search input{
width:100%;
padding:14px;
border:1px solid #dce7ff;
border-radius:10px;
outline:none;
font-size:15px;
}

/* TABLE */
.table-box{
overflow:auto;
border-radius:16px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

thead{
background:linear-gradient(90deg,#1565ff,#00a2ff);
color:white;
}

th{
padding:16px;
text-align:left;
font-size:14px;
}

td{
padding:15px;
border-bottom:1px solid #edf2ff;
font-size:14px;
vertical-align:top;
}

tbody tr{
transition:.25s;
}

tbody tr:hover{
background:#f5f9ff;
transform:scale(1.003);
}

/* TAGS */
.id{
background:#edf4ff;
color:#1565ff;
padding:6px 12px;
border-radius:20px;
font-weight:700;
display:inline-block;
}

.badge{
padding:6px 12px;
border-radius:18px;
font-size:13px;
font-weight:600;
display:inline-block;
}

.mild{
background:#eefaf0;
color:#2e7d32;
}

.moderate{
background:#fff6e6;
color:#e67e22;
}

.severe{
background:#ffeaea;
color:#d63031;
}

/* CHART */
.chart{
margin-top:28px;
background:white;
padding:22px;
border-radius:18px;
box-shadow:0 10px 18px rgba(0,0,0,.04);
}

/* MOBILE */
@media(max-width:900px){

nav{
padding:18px 20px;
flex-direction:column;
gap:12px;
}

.header,
.wrapper{
padding-left:20px;
padding-right:20px;
}

.header h1{
font-size:28px;
}

.links a{
margin:0 8px;
}

}

</style>
</head>
<body>

<nav>
<div class="logo"><i class="fa-solid fa-file-waveform"></i> ADR System</div>

<div class="links">
<a href="index.php">Home</a>
<a href="patients.php">Patients</a>
<a href="drugs.php">Drugs</a>
<a href="doctor.php">Doctors</a>
</div>
</nav>

<section class="header">

<div>
<h1><i class="fa-solid fa-triangle-exclamation"></i> ADR Reports</h1>
<p>Track adverse drug reactions and severity reports</p>
</div>

<a href="index.php" class="btn">
<i class="fa-solid fa-arrow-left"></i> Dashboard
</a>

</section>

<section class="wrapper">

<div class="panel">

<div class="search">
<input type="text" id="searchBox" placeholder="Search patient ID, drug ID, reaction or severity...">
</div>

<div class="table-box">

<table id="reportTable">

<thead>
<tr>
<th>Report ID</th>
<th>Patient ID</th>
<th>Drug ID</th>
<th>Doctor ID</th>
<th>Reaction</th>
<th>Severity</th>
<th>Date</th>
</tr>
</thead>

<tbody>

<?php

$result=mysqli_query($conn,"SELECT * FROM ADR_REPORT");

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

$sev = strtolower($row['severity']);
$class = "moderate";

if($sev=="mild"){ $class="mild"; }
if($sev=="severe"){ $class="severe"; }

echo "
<tr>
<td><span class='id'>{$row['report_id']}</span></td>
<td>{$row['pat_id']}</td>
<td>{$row['drug_id']}</td>
<td>{$row['doctor_id']}</td>
<td>{$row['reaction_desc']}</td>
<td><span class='badge $class'>{$row['severity']}</span></td>
<td>{$row['date_reported']}</td>
</tr>
";

}

}else{

echo "<tr><td colspan='7'>No ADR reports found.</td></tr>";

}

?>

</tbody>
</table>

</div>

<div class="chart">
<canvas id="reportChart"></canvas>
</div>

</div>

</section>

<script>

/* SEARCH */
document.getElementById("searchBox").addEventListener("keyup",function(){

let value=this.value.toLowerCase();
let rows=document.querySelectorAll("#reportTable tbody tr");

rows.forEach(function(row){
row.style.display=row.innerText.toLowerCase().includes(value) ? "" : "none";
});

});

/* CHART */
const ctx=document.getElementById('reportChart');

new Chart(ctx,{
type:'doughnut',
data:{
labels:['Mild','Moderate','Severe'],
datasets:[{
data:[8,14,5]
}]
},
options:{
responsive:true,
plugins:{
legend:{
position:'bottom'
}
}
}
});

</script>

</body>
</html>
