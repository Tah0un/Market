<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
body, h2, form {
margin: 0;
padding: 0;
font-family: Arial, sans-serif;
}

body {
background-color: #f0f8ff;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
}

.login-container {
background-color: #ffffff;
padding: 20px;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
width: 300px;
text-align: center;
}

h2 {
margin-bottom: 20px;
color: #333;
}

.input-group {
margin-bottom: 15px;
text-align: left;
}

.input-group label {
display: block;
margin-bottom: 5px;
color: #555;
}

.input-group input {
width: 100%;
padding: 8px;
border: 1px solid #ccc;
border-radius: 4px;
box-sizing: border-box;
}

button {
width: 100%;
padding: 10px;
background-color: #0073e6;
color: #fff;
border: none;
border-radius: 4px;
font-size: 16px;
cursor: pointer;
transition: background-color 0.3s ease;
}

button:hover {
background-color: #005bb5;
}
a{
    text-decoration: none;
}
</style>
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form method="post" >
    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" name="submit">Login</button>
    <?php 
        if (isset($_GET["err"])) echo $_GET["err"];
    ?> 
    <p>
        Don't hava an account? 
        <a href="/server/signup.php">Register</a>
    </p>
    </form>
</div>
</body>
</html>