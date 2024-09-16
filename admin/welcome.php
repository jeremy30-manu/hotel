
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.scss">
     <!--Google Fonts-->
     <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
   
</head>
<body>
<div style="text-align: center; padding-top: 250px;
                font-size: 55px; color: green;">

        <!-- Declare all the characters of text 
            one-by-one, inside span tags -->
        <span class="G1">W</span>
        <span class="e1">E</span>
        <span class="e2">L</span>
        <span class="k1">C</span>
        <span class="s1">O</span>
        <span class="f">M</span>
        <span class="o">E</span>
        <span class="r">.</span>
        <span class="G2">A</span>
        <span class="e3">D</span>
        <span class="e4">M</span>
        <span class="k2">I</span>
        <span class="s2">N</span>
    </div>
    
<div class="popup">
        <button id="close">&times;</button>
        <h2>This is an Admin Page</h2>
        <p>
           Be sure that youre an admin to continue with operation
        </p>
        <a href="admin.php">Yes am an Admin</a>
    </div>
    <!--Script-->
    <script type="text/javascript">
window.addEventListener("load", function(){
    setTimeout(
        function open(event){
            document.querySelector(".popup").style.display = "block";
        },
        2000 
    )
});


document.querySelector("#close").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
});
    </script>
    

</body>
</html>



