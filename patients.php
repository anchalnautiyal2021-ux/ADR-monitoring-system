<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Patients | ADR Monitoring System</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Poppins',sans-serif;
background:linear-gradient(135deg,#eef5ff,#f8fbff,#e9f2ff);
color:#1d2a44;
min-height:100vh;
}

/* NAVBAR */
nav{
display:flex;
justify-content:space-between;
align-items:center;
padding:18px 55px;
background:rgba(255,255,255,0.78);
backdrop-filter:blur(14px);
box-shadow:0 8px 20px rgba(0,0,0,0.06);
}

.logo{
font-size:24px;
font-weight:700;
color:#1565ff;
}

.nav-links a{
text-decoration:none;
margin-left:22px;
font-weight:500;
color:#33435f;
transition:0.3s;
}

.nav-links a:hover{
color:#1565ff;
}

/* PAGE HEADER */
.top{
padding:40px 55px 20px;
display:flex;
justify-content:space-between;
align-items:center;
gap:20px;
flex-wrap:wrap;
}

.top h1{
font-size:36px;
}

.top p{
color:#66758f;
margin-top:8px;
}

.back-btn{
text-decoration:none;
background:linear-gradient(90deg,#1565ff,#00a2ff);
color:white;
padding:12px 18px;
border-radius:10px;
font-weight:600;
transition:0.3s;
}

.back-btn:hover{
transform:translateY(-4px);
box-shadow:0 10px 18px rgba(21,101,255,.20);
}

/* SEARCH + CARD */
.wrapper{
padding:0 55px 50px;
}

.panel{
background:rgba(255,255,255,0.88);
border-radius:20px;
padding:28px;
box-shadow:0 14px 30px rgba(0,0,0,0.06);
backdrop-filter:blur(14px);
}

.search-box{
display:flex;
gap:12px;
flex-wrap:wrap;
margin-bottom:22px;
}

.search-box input{
flex:1;
min-width:250px;
padding:14px;
border:1px solid #dce7ff;
border-radius:10px;
outline:none;
font-size:15px;
}

.search-box i{
position:relative;
left:42px;
top:14px;
color:#8ea0be;
}

/* TABLE */
.table-wrap{
overflow:auto;
border-radius:16px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
overflow:hidden;
}

thead{
background:linear-gradient(90deg,#1565ff,#00a2ff);
color:white;
}

th{
padding:16px;
text-align:left;
font-size:14px;
letter-spacing:.4px;
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

/* BADGES */
.id-badge{
background:#edf4ff;
color:#1565ff;
padding:6px 12px;
border-radius:20px;
font-weight:700;
display:inline-block;
}

.gender{
padding:6px 12px;
border-radius:18px;
font-size:13px;
font-weight:600;
display:inline-block;
}

.male{
background:#e8f2ff;
color:#1565ff;
}

.female{
background:#ffe8f2;
color:#d63384;
}

.phone{
color:#66758f;
}

/* CHART BOX */
.chart-box{
margin-top:28px;
background:white;
padding:24px;
border-radius:18px;
box-shadow:0 10px 20px rgba(0,0,0,0.04);
}

/* MOBILE */
@media(max-width:900px){

nav{
padding:18px 20px;
flex-direction:column;
gap:14px;
}

.top,
.wrapper{
padding-left:20px;
padding-right:20px;
}

.top h1{
font-size:28px;
}

.nav-links a{
margin:0 10px;
}

}

</style>
</head>
<body>

<nav>
<div class="logo"><i class="fa-solid fa-shield-heart"></i> ADR System</div>

<div class="nav-links">
<a href="index.php">Home</a>
<a href="drugs.php">Drugs</a>
<a href="doctor.php">Doctors</a>
<a href="reports.php">Reports</a>
</div>
</nav>

<section class="top">
<div>
<h1><i class="fa-solid fa-users"></i> Patient Records</h1>
<p>Manage and review patient information database</p>
</div>

<a href="index.php" class="back-btn">
<i class="fa-solid fa-arrow-left"></i> Dashboard
</a>
</section>

<section class="wrapper">

<div class="panel">

<div class="search-box">
<input type="text" id="searchInput" placeholder="Search by patient name, gender or contact...">
</div>

<div class="table-wrap">

<table id="patientTable">

<thead>
<tr>
<th>ID</th>
<th>Patient Name</th>
<th>Age</th>
<th>Gender</th>
<th>Contact</th>
</tr>
</thead>

<tbody>

<?php

$result = mysqli_query($conn,"SELECT * FROM PATIENT");

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

$gender = strtolower($row['pat_gender']);
$class = ($gender=="male") ? "male" : "female";

echo "
<tr>
<td><span class='id-badge'>{$row['pat_id']}</span></td>
<td>{$row['pat_name']}</td>
<td>{$row['pat_age']} yrs</td>
<td><span class='gender $class'>{$row['pat_gender']}</span></td>
<td class='phone'><i class='fa-solid fa-phone'></i> {$row['pat_contact']}</td>
</tr>
";

}

}else{

echo "<tr><td colspan='5'>No patient data found.</td></tr>";

}

?>

</tbody>
</table>

</div>

<div class="chart-box">
<canvas id="ageChart"></canvas>
</div>

</div>
</section>

<script>

/* SEARCH FILTER */
document.getElementById("searchInput").addEventListener("keyup", function(){

let value=this.value.toLowerCase();
let rows=document.querySelectorAll("#patientTable tbody tr");

rows.forEach(function(row){

row.style.display=row.innerText.toLowerCase().includes(value) ? "" : "none";

});

});

/* CHART */
const ctx=document.getElementById('ageChart');

new Chart(ctx,{
type:'doughnut',
data:{
labels:['18-30','31-45','46+'],
datasets:[{
data:[12,18,8]
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
