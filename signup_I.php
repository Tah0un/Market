<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input[type="radio"] {
            margin-right: 10px;
        }

        .gender-group {
            display: flex;
            justify-content: space-around;
        }

        .gender-group label {
            font-weight: normal;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .name-group {
            display: block;
        }

        .name-group input[type="text"] {
            width: 100%;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registration Form</h2>
        <form method="post">
            <div class="form-group name-group">
                <div>
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div>
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="number">Phone Number</label>
                <input type="text" id="number" name="number" required>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <div class="gender-group">
                    <label><input type="radio" name="gender" value="male" required> Male</label>
                    <label><input type="radio" name="gender" value="female" required> Female</label>
                </div>
            </div>
            <button type="submit" name="submit" class="submit-btn">SignUp</button>
            <p>
                Have an account? 
                <a href="login.php">Login</a>
            </p>
        </form>
    </div>
</body>
</html>