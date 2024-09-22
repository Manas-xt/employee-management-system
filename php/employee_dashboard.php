<?php
include 'config.php';
session_start();

if (!isset($_SESSION['employee_id'])) {
    header("Location: ../login.html");
    exit();
}

$employee_id = $_SESSION['employee_id'];
$sql = "SELECT * FROM employees WHERE id='$employee_id'";
$result = $conn->query($sql);
$employee = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="icon" type="image/png" href="/assests/bg5.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        * {
           font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        body {
            background-image: url(/assests/bg5.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            /* background-color: #f0f0f0; */
            color: #333333;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #ffffff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #e0e0e0;
        }
        .navbar h1 {
            font-size: 24px;
            color: #333333;
        }
        .profile-icon {
            width: 50px;
            height: 50px;
            background-color: #00aaff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .profile-icon:hover {
            background-color: #0077cc;
        }
        .dropdown-menu {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }
        .dropdown-menu a {
            color: #333333;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }
        .content-box {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px;
            max-width: 600px;
            width: 100%;
            margin: 40px auto;
        }
        h1, p {
            color: #333333;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <h1 class="empdsh">Employee Dashboard</h1>
        <div class="profile-container">
            <div class="profile-icon" onclick="toggleDropdown()">
                <?php echo strtoupper($employee['name'][0]); ?>
            </div>
            <div id="dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                <a href="logout.php" class="block px-4 py-2 text-sm">Logout</a>
                <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=GTvVlcRwPkWvCvNNXppdZgXVsqmhJDJjCvBljNHzsVQhNQTcJffCDmdQqChjZKXLNmQKjPVTmfWQb" class="block px-4 py-2 text-sm">Request leave</a>
            </div>
        </div>
    </div>

    <div class="flex-grow flex justify-center items-center">
        <div class="content-box w-full max-w-md p-8 animate__animated animate__fadeInUp">
            <h1 class="text-2xl font-semibold mb-6 text-center">Welcome, <?php echo $employee['name']; ?>!</h1>
            <div>
                <p class="mb-2"><strong>Phone:</strong> <?php echo $employee['phone']; ?></p>
                <p class="mb-2"><strong>Email:</strong> <?php echo $employee['email']; ?></p>
                <p class="mb-2"><strong>Home Address:</strong> <?php echo $employee['address']; ?></p>
                <p class="mb-2"><strong>Salary:</strong> <?php echo $employee['salary']; ?></p>
                <p class="mb-2"><strong>Age:</strong> <?php echo $employee['age']; ?></p>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile-icon')) {
                const dropdown = document.getElementById('dropdown-menu');
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            }
        }
    </script>
</body>
</html>
<?php
$conn->close();
?>
