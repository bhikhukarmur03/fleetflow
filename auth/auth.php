<!DOCTYPE html>
<html>
<head>
    <title>FleetFlow Authentication</title>
    <style>
        body {
            margin:0;
            font-family: Arial, sans-serif;
            background:#0f172a;
            color:#fff;
        }
        .container {
            display:flex;
            height:100vh;
        }
        .panel {
            width:50%;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .card {
            width:70%;
            background:#020617;
            border-radius:16px;
            padding:40px;
        }
        .avatar {
            width:90px;
            height:90px;
            border-radius:50%;
            border:3px solid #22c55e;
            margin:0 auto 20px;
        }
        h2 {
            text-align:center;
            margin-bottom:20px;
        }
        input, select, button {
            width:100%;
            padding:12px;
            margin-top:12px;
            border:none;
            border-radius:8px;
        }
        input, select {
            background:#020617;
            color:#fff;
            border:1px solid #334155;
        }
        button {
            background:#22c55e;
            color:#000;
            font-weight:bold;
            cursor:pointer;
        }
        button:hover {
            background:#16a34a;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- LOGIN -->
    <div class="panel">
        <div class="card">
            <div class="avatar"></div>
            <h2>Login</h2>

            <form action="login_process.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <!-- REGISTER -->
    <div class="panel">
        <div class="card">
            <div class="avatar"></div>
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
        </div>
    </div>

</div>

</body>
</html>