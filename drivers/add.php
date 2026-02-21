<?php include "../auth/auth_check.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Driver</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .box {
            width:400px;
            margin:50px auto;
            background:#020617;
            padding:20px;
            border-radius:12px;
        }
        input, button {
            width:100%;
            padding:10px;
            margin-top:10px;
            border-radius:6px;
            border:none;
        }
        button {
            background:#22c55e;
            font-weight:bold;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>Add Driver</h3>

    <form action="save.php" method="POST">
        <input name="name" placeholder="Driver Name" required>
        <input name="license_number" placeholder="License Number" required>
        <input type="date" name="license_expiry" required>
        <button>Save</button>
    </form>
</div>

</body>
</html>