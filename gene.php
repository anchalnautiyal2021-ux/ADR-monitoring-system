<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Genes | ADR Monitoring System</title>

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
background:linear-gradient(135deg,#eef6ff,#f9fcff,#e8f2ff);
color:#1d2a44;
min-height:100vh;
}

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

.header{
padding:40px 55px 20px;
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
gap:15px;
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

.id{
background:#edf4ff;
color:#1565ff;
padding:6px 12px;
border-radius:20px;
font-weight:700;
display:inline-block;
}

.type{
background:#eefaf0;
color:#2e7d32;
padding:6px 12px;
border-radius:18px;
font-size:13px;
font-weight:600;
display:inline-block;
}

.chart{
margin-top:28px;
background:white;
padding:22px;
border-radius:18px;
box-shadow:0 10px 18px rgba(0,0,0,.04);
}

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
<div class="logo"><i class="fa-solid fa-dna"></i> ADR System</div>

<div class="links">
<a href="index.php">Home</a>
<a href="patients.php">Patients</a>
<a href="drugs.php">Drugs</a>
<a href="reports.php">Reports</a>
</div>
</nav>

<section class="header">

<div>
<h1><i class="fa-solid fa-dna"></i> Gene Database</h1>
<p>Manage pharmacogenomic gene records</p>
</div>

<a href="index.php" class="btn">
<i class="fa-solid fa-arrow-left"></i> Dashboard
</a>

</section>

<section class="wrapper">

<div class="panel">

<div class="search">
<input type="text" id="searchBox" placeholder="Search gene name or gene type...">
</div>

<div class="table-box">

<table id="geneTable">

<thead>
<tr>
<th>Gene ID</th>
<th>Gene Name</th>
<th>Gene Type</th>
</tr>
</thead>

<tbody>

<?php

$result=mysqli_query($conn,"SELECT * FROM GENE");

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

echo "
<tr>
<td><span class='id'>{$row['gene_id']}</span></td>
<td>{$row['gene_name']}</td>
<td><span class='type'>{$row['gene_type']}</span></td>
</tr>
";

}

}else{

echo "<tr><td colspan='3'>No gene records found.</td></tr>";

}

?>

</tbody>
</table>

</div>

<div class="chart">
<canvas id="geneChart"></canvas>
</div>

</div>

</section>

<script>

document.getElementById("searchBox").addEventListener("keyup",function(){

let value=this.value.toLowerCase();
let rows=document.querySelectorAll("#geneTable tbody tr");

rows.forEach(function(row){
row.style.display=row.innerText.toLowerCase().includes(value) ? "" : "none";
});

});

const ctx=document.getElementById('geneChart');

new Chart(ctx,{
type:'bar',
data:{
labels:['CYP','HLA','TPMT','Others'],
datasets:[{
label:'Gene Groups',
data:[10,6,4,3],
borderRadius:8
}]
},
options:{
responsive:true,
plugins:{
legend:{display:false}
},
scales:{
y:{beginAtZero:true}
}
}
});

</script>

</body>
</html>
