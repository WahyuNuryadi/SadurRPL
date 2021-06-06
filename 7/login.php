<?php
	session_start();
	ob_start();
	include "koneksi.php";
?>
<form method="POST">
	<table align="center">
		<tr>
			<td colspan="2"><h1>Login</h1></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" name="txtUsername"/></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="txtPassword"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" value="Login" name="btnLogin">
			</td>
		</tr>
	</table>
</form>
<?php
	if (isset($_POST["btnLogin"]))
	{
		$user = $_POST["txtUsername"];
		$pass = $_POST["txtPassword"];
		
		$hasil = mysqli_query($conn,"SELECT * FROM user WHERE username='".$user."' AND password=md5('".$pass."')");
		
		if ($hasil->num_rows > 0)
		{
			$_SESSION["username"] = $user;
			$_SESSION["password"] = $pass;
			$dt = $hasil->fetch_object();
			$_SESSION["peran"] = $dt->Peran;
			echo $user . $pass . $dt->Peran;
			header("Location: index.php");
		}
	} #akhir if
?>
