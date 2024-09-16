<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.scss">
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">Add Item</a>
  <a href="#">View Menu</a>
  <a href="#">Add Table</a>
  <a href="#">Check Payments</a>
</div>

<div id="main">
  <h2>ADMINISTARIVE DASHBOARD</h2>
  <p>Perform different operation on the back end of the users</p>
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; MENU</span>
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   
</body>
</html> 