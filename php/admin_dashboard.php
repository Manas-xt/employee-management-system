<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}

include 'config.php';

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="/assests/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background-image: url(/assests/bg5.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            /* background: #f4f4f9; */
            color: #333;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            width: 100%;
        }
        .content {
            width: 90%;
            max-width: 1500px;
            padding: 30px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            margin: 50px auto;
            animation: fadeInDown 1s ease-out;
        }
        .title-container {
            background: linear-gradient(120deg, #4fc3f7 0%, #00acc1 100%);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #333;
            text-align: center;
            letter-spacing: 2px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 12px;
            background: #f8f9fa;
            color: #333;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background: #e3f2fd;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            width: auto;
            padding: 15px;
            background: linear-gradient(120deg, #4fc3f7 0%, #00acc1 100%);
            color: #ffffff;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 5px;
            text-decoration: none;
        }
        .button:hover {
            background: linear-gradient(120deg, #00acc1 0%, #4fc3f7 100%);
            transform: scale(1.05);
        }
        #color-patch {
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 80%;
            background: radial-gradient(circle at center, rgba(0, 153, 255, 0.1), rgba(0, 204, 204, 0.1), rgba(0, 0, 102, 0.1));
            pointer-events: none;
            filter: blur(100px);
            opacity: 0.4;
            transition: transform 0.1s ease-out;
        }

        @media (max-width: 768px) {
            h1 { font-size: 2.5rem; }
            .content { padding: 20px; width: 95%; }
            table th, table td { padding: 10px; font-size: 14px; }
            .button { width: 100%; margin: 5px 0; }
        }

        @media (max-width: 480px) {
            h1 { font-size: 2rem; }
            .content { padding: 15px; width: 100%; }
            table { border-spacing: 5px; }
            table th, table td { padding: 8px; font-size: 12px; }
            .button { padding: 10px; font-size: 14px; }
        }
    </style>
</head>
<body>
    <div id="color-patch"></div>
    <div class="content animate__animated animate__fadeIn">
        <h1>Admin Dashboard</h1>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Age</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="text-red-500 hover:text-red-700">Delete</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="logout.php" class="button">Logout</a>
        <a href="export.php" class="button">Export Data to PDF</a>
    </div>
</body>
</html>
