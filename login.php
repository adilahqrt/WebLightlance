<?php
    session_start();

    if(isset($_SESSION["login"])){
        header("Location: dashboard.php");
        exit;
      }

    require ('koneksi.php');
?>
    <?php
        if(isset($_POST['login'])){
            $ambil = $koneksi->query("SELECT * FROM admin WHERE user_email='$_POST[txt_email]' AND user_password='$_POST[txt_pass]'");
            $yangcocok = $ambil->num_rows;
        
            if($yangcocok == 1){
                $_SESSION['user'] = $ambil->fetch_assoc();
                //echo "alert(Login Sukses)";
                //Cek Session
                $_SESSION["login"] = true;
                echo "<meta http-equiv='refresh' content='1;url=dashboard.php'>";
            }
            else{
                //echo "<div class='alert alert-danger'>Login gagal!</div>";
                echo '<script>alert("Username atau Password Salah."); document.location="kategori.php";</script>';
            }
        }
    ?>

<html>
<head>
    <title>Ligthlance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="left-side">
        <h1>Welcome To <span id="title">Lightlance</span></h1>
        <div class="horizontal-line"></div>
        <p>Take Your Moment</p>
    </div>
    <div class="right-side">
        <h1>Hey There!</h1>
        <h3>Please login to continue!</h3>
        <form method="post">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" placeholder="  user@gmail.com" name="txt_email" required>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" placeholder="  enter your password" name="txt_pass" id="txt_pass" required>
            </div>
            <div class="field">
                <input type="checkbox" style="background-color: #FB0445;" onclick="change()">
                <label>Show Password</label>
            </div>
            <div class="field">
                <input type="submit" value="LOGIN" name="login">
            </div>
        </form>
        <p class="copyright">Copyright &copy; 2021 Lightlance. All right reserved.</p>
    </div>

    <script>
		function change() {
			var x = document.getElementById('txt_pass').type;
            if (x == 'password')
            {
               document.getElementById('txt_pass').type = 'text';
            } else {
               document.getElementById('txt_pass').type = 'password';
            }
        }
	</script>

</body>
</html>