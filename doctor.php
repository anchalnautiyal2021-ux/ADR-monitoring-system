<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Doctors | ADR Monitoring System</title>

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
background:linear-gradient(135deg,#eef4ff,#f7fbff,#e8f1ff);
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

/* SEARCH */
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

.spec{
background:#eefaf0;
color:#2e7d32;
padding:6px 12px;
border-radius:18px;
font-size:13px;
font-weight:600;
display:inline-block;
}

.hospital{
color:#66758f;
font-weight:500;
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
<div class="logo"><i class="fa-solid fa-user-doctor"></i> ADR System</div>

<div class="links">
<a href="index.php">Home</a>
<a href="patients.php">Patients</a>
<a href="drugs.php">Drugs</a>
<a href="reports.php">Reports</a>
</div>
</nav>

<section class="header">

<div>
<h1><i class="fa-solid fa-user-doctor"></i> Doctor Database</h1>
<p>Doctors, specializations and hospital information</p>
</div>

<a href="index.php" class="btn">
<i class="fa-solid fa-arrow-left"></i> Dashboard
</a>

</section>

<section class="wrapper">

<div class="panel">

<div class="search">
<input type="text" id="searchBox" placeholder="Search doctor, specialization or hospital...">
</div>

<div class="table-box">

<table id="doctorTable">

<thead>
<tr>
<th>ID</th>
<th>Doctor Name</th>
<th>Specialization</th>
<th>Hospital</th>
</tr>
</thead>

<tbody>

<?php

$result=mysqli_query($conn,"SELECT * FROM DOCTOR");

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

echo "
<tr>
<td><span class='id'>{$row['doctor_id']}</span></td>
<td>Dr. {$row['doc_name']}</td>
<td><span class='spec'>{$row['doc_specialization']}</span></td>
<td class='hospital'><i class='fa-solid fa-hospital'></i> {$row['doc_hospital']}</td>
</tr>
";

}

}else{

echo "<tr><td colspan='4'>No doctor records found.</td></tr>";

}

?>

</tbody>
</table>

</div>

<div class="chart">
<canvas id="doctorChart"></canvas>
</div>

</div>

</section>

<script>

/* SEARCH */
document.getElementById("searchBox").addEventListener("keyup",function(){

let value=this.value.toLowerCase();
let rows=document.querySelectorAll("#doctorTable tbody tr");

rows.forEach(function(row){

row.style.display=row.innerText.toLowerCase().includes(value) ? "" : "none";

});

});

/* CHART */
const ctx=document.getElementById('doctorChart');

new Chart(ctx,{
type:'pie',
data:{
labels:['General','Cardiology','Neurology','Others'],
datasets:[{
data:[10,6,4,5]
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
