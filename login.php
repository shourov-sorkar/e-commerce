<?php
		include "db/conf.php";
		include "db/db.php";
		$db = new Database();
		include "db/session.php";
		Session::checkLogin();

		if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $pass = md5($_POST["pass"]);
        $query = "SELECT * FROM admin_login WHERE `username`='$username' and `pass`='$pass'";
        $result = $db->select($query);
        if ($result == true) {
            $value = $result->fetch_assoc(); 
            Session::set("login", true);
            header("Location: login.php");
        }else{
        	header("Location: login.php?msg='Wrong information!'");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/admin_icon.png">
    <title>Admin Panel</title>
</head>
<body>
    <div id="cover" class="min-vh-100">
        <div id="cover-caption">
            <div class="container">
                <div class="row text-white">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                        <h1 class="display-4 py-2 text-truncate">Login</h1>
                        <div class="px-2">
                            <form action="login.php" method="POST" class="justify-content-center">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control input" placeholder="User Name">                     
                                </div>
                                <div class="form-group">
                                    <input type="password" name="pass" class="form-control" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <script src="js/jquery-1.12.4.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <?php
            if(isset($_GET["msg"]))
            {
				$msg = $_GET["msg"];
		?>
		<script type="text/javascript">
			window.alert(<?php echo $msg;?>);
		</script>
		<?php
			}
		?>
</body>
</html>