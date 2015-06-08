<?php 
	session_start();
	require('database.php');
	if($_GET['logout'] === "true"){
		session_destroy();
	}
	include('inc/header.php'); 
?>
			<div id="intro">
				<h2>Record your weight-lifting routine</h2>
				<h3>After creating an account, fill in the number of reps you completed, the weight you lifted, the movement (squat, bench press, etc), and the day you worked out.
				</h3>
				<h3>See how you compare to other people lifting too!</h3>
			</div>

<div class="createLogin">
		<div class="loginCont">
		<div id="login" class="loginClass">
		  <form id="login_form">
		  	<table>
			    <tr>
			      <th>
			        <label for"username">Username:</label>
			      </th>
			      <td>
			        <input type="text" name="username" id="user"> 
			      </td>
			    </tr>
			    <tr>
			      <th>
			        <label for"password">Password:</label>
			      </th>
			      <td>
			        <input type="password" name="password" id="pass">
			      </td>
			    </tr>
		  	</table>
		 	  <button type="submit" id="login">Login</button>
			</form>
			<div id="error"></div>
		</div>

		<div id="panel2" class="loginClass">
	    <form id="login_form2">
		  	<table>
			    <tr>
			      <th>
			        <label for"username">Username:</label>
			      </th>
			      <td>
			        <input type="text" name="username" id="user"> 
			      </td>
			    </tr>
			    <tr>
			      <th>
			        <label for"password">Password:</label>
			      </th>
			      <td>
			        <input type="password" name="password" id="pass">
			      </td>
			    </tr>
			    <tr>
			      <td>
			        <input type="hidden" name="new_account" value="create">
			      </td>
			    </tr>
		  	</table>
		  	<button type="submit" id="create">Create Account</button>
			</form>
	 		<div id="error2"></div>
		</div>
		</div>
			</div>
			</div>			
			</div>

