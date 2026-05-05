<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ADR Monitoring System</title>

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
    background:linear-gradient(135deg,#eef4ff,#dcecff,#f6f9ff);
    color:#1c2b45;
}

/* NAVBAR */
nav{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 60px;
    background:rgba(255,255,255,0.75);
    backdrop-filter:blur(12px);
    box-shadow:0 8px 20px rgba(0,0,0,0.06);
    position:sticky;
    top:0;
    z-index:999;
}

.logo{
    font-size:24px;
    font-weight:700;
    color:#1565ff;
}

nav ul{
    list-style:none;
    display:flex;
    gap:28px;
}

nav ul li a{
    text-decoration:none;
    color:#243b55;
    font-weight:500;
    transition:0.3s;
}

nav ul li a:hover{
    color:#1565ff;
}

/* HERO */
.hero{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:60px;
    gap:40px;
}

.hero-left{
    flex:1;
}

.hero-left h1{
    font-size:52px;
    line-height:1.2;
    margin-bottom:20px;
}

.hero-left h1 span{
    color:#1565ff;
}

.hero-left p{
    font-size:18px;
    color:#5c6b82;
    margin-bottom:25px;
}

.btn{
    display:inline-block;
    padding:14px 28px;
    border-radius:10px;
    background:linear-gradient(90deg,#1565ff,#00a2ff);
    color:white;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}

.btn:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 20px rgba(21,101,255,0.25);
}

.hero-right{
    flex:1;
    text-align:center;
}

.hero-right img{
    width:85%;
    animation:float 3s ease-in-out infinite;
}

@keyframes float{
    0%,100%{transform:translateY(0);}
    50%{transform:translateY(-15px);}
}

/* COUNTERS */
.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
    padding:20px 60px;
}

.stat-box{
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
    text-align:center;
    transition:0.3s;
}

.stat-box:hover{
    transform:translateY(-8px);
}

.stat-box i{
    font-size:30px;
    color:#1565ff;
    margin-bottom:12px;
}

.stat-box h2{
    font-size:34px;
    margin-bottom:6px;
}

/* CARDS */
.section-title{
    text-align:center;
    font-size:34px;
    margin:55px 0 30px;
}

.cards{
    padding:0 60px 60px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:25px;
}

.card{
    background:white;
    padding:28px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    transition:0.35s;
    text-align:center;
}

.card:hover{
    transform:translateY(-10px);
}

.card i{
    font-size:42px;
    color:#1565ff;
    margin-bottom:16px;
}

.card h3{
    margin-bottom:10px;
}

.card p{
    color:#67768e;
    margin-bottom:16px;
}

.card a{
    text-decoration:none;
    color:#1565ff;
    font-weight:600;
}

/* CHART AREA */
.chart-box{
    width:90%;
    margin:20px auto 60px;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

/* FOOTER */
footer{
    background:#0e1c33;
    color:white;
    text-align:center;
    padding:22px;
}

/* MARQUEE */
.notice{
    background:#1565ff;
    color:white;
    padding:10px;
    font-weight:500;
}

/* MOBILE */
@media(max-width:900px){

.hero{
    flex-direction:column;
    text-align:center;
}

nav{
    padding:18px 20px;
    flex-direction:column;
    gap:15px;
}

.hero-left h1{
    font-size:38px;
}

.stats,
.cards{
    padding:20px;
}

}

</style>
</head>
<body>

<nav>
<div class="logo"><i class="fa-solid fa-shield-heart"></i> ADR System</div>

<ul>
<li><a href="patients.php">Patients</a></li>
<li><a href="drugs.php">Drugs</a></li>
<li><a href="doctor.php">Doctors</a></li>
<li><a href="reports.php">Reports</a></li>
<li><a href="gene.php">Genes</a></li>
</ul>
</nav>

<div class="notice">
<marquee behavior="scroll" scrollamount="6">
Welcome to ADR Monitoring System • Smart Drug Safety Platform • Real Time Monitoring • College Project Dashboard
</marquee>
</div>

<section class="hero">

<div class="hero-left">
<h1>Advanced <span>ADR Monitoring</span><br>Dashboard</h1>
<p>
Monitor adverse drug reactions, patient safety, doctor reports and gene-drug interaction using one intelligent platform.
</p>

<a href="add_report.php" class="btn">
<i class="fa-solid fa-plus"></i> Add New Report
</a>
</div>

<div class="hero-right">
<img src="https://cdn-icons-png.flaticon.com/512/4320/4320371.png">
</div>

</section>

<section class="stats">

<div class="stat-box">
<i class="fa-solid fa-users"></i>
<h2 id="count1">0</h2>
<p>Patients</p>
</div>

<div class="stat-box">
<i class="fa-solid fa-capsules"></i>
<h2 id="count2">0</h2>
<p>Drugs</p>
</div>

<div class="stat-box">
<i class="fa-solid fa-file-medical"></i>
<h2 id="count3">0</h2>
<p>Reports</p>
</div>

<div class="stat-box">
<i class="fa-solid fa-dna"></i>
<h2 id="count4">0</h2>
<p>Genes</p>
</div>

</section>

<h2 class="section-title">Quick Access Panels</h2>

<section class="cards">

<div class="card">
<i class="fa-solid fa-users"></i>
<h3>Patients</h3>
<p>Patient records and information</p>
<a href="patients.php">Open Module</a>
</div>

<div class="card">
<i class="fa-solid fa-capsules"></i>
<h3>Drugs</h3>
<p>Medicine details database</p>
<a href="drugs.php">Open Module</a>
</div>

<div class="card">
<i class="fa-solid fa-user-doctor"></i>
<h3>Doctors</h3>
<p>Medical professionals list</p>
<a href="doctor.php">Open Module</a>
</div>

<div class="card">
<i class="fa-solid fa-triangle-exclamation"></i>
<h3>Reports</h3>
<p>ADR reaction reports center</p>
<a href="reports.php">Open Module</a>
</div>

<div class="card">
<i class="fa-solid fa-dna"></i>
<h3>Genes</h3>
<p>Genetic information</p>
<a href="gene.php">Open Module</a>
</div>

<div class="card">
<i class="fa-solid fa-flask-vial"></i>
<h3>Drug-Gene</h3>
<p>Interaction mapping</p>
<a href="drug_gene.php">Open Module</a>
</div>

</section>

<div class="chart-box">
<canvas id="myChart"></canvas>
</div>

<footer>
Designed for ADR Monitoring Project • Premium Dashboard UI
</footer>

<script>

/* COUNTER ANIMATION */
function counter(id,target){
let count=0;
let speed=Math.ceil(target/50);

let x=setInterval(function(){
count+=speed;
if(count>=target){
count=target;
clearInterval(x);
}
document.getElementById(id).innerText=count;
},30);
}

counter("count1",150);
counter("count2",65);
counter("count3",90);
counter("count4",28);

/* CHART */
const ctx=document.getElementById('myChart');

new Chart(ctx,{
type:'bar',
data:{
labels:['Patients','Drugs','Reports','Genes'],
datasets:[{
label:'System Data',
data:[150,65,90,28],
borderRadius:8
}]
},
options:{
responsive:true,
plugins:{
legend:{display:false}
},
scales:{
y:{
beginAtZero:true
}
}
}
});

</script>

</body>
</html>
            
