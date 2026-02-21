<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FleetFlow Register</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 420px;
            background: #020617;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .logo img {
            width: 50px;
            height: 50px;
        }

        .logo span {
            font-size: 22px;
            font-weight: bold;
            color: #22c55e;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            border-radius: 8px;
            border: none;
        }

        input, select {
            background: #020617;
            color: #fff;
            border: 1px solid #334155;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #22c55e;
        }

        button {
            background: #22c55e;
            color: #000;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #16a34a;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #94a3b8;
        }

        .footer a {
            color: #22c55e;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="card">

    <div class="logo">
        <img src="../assets/logo1.jpeg" alt="FleetFlow Logo">
        <span>FleetFlow</span>
    </div>

    <h2>Register</h2>

    <form action="register_process.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="manager">Fleet Manager</option>
            <option value="dispatcher">Dispatcher</option>
            <option value="safety">Safety Officer</option>
            <option value="finance">Finance Analyst</option>
        </select>

        <button type="submit">Register</button>
    </form>

    <div class="footer">
        Already have an account?
        <a href="login.php">Login</a>
    </div>

</div>

</body>
</html>