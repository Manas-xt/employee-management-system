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



.attendance-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 40px auto;
    padding: 0px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    padding: 25px;
    text-align: center;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #00aaff, #00ff88);
}

.percentage-circle {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin: 10px auto 20px;
    position: relative;
    background: #f0f0f0;
    padding: 20px;
    box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.1);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

.circle-fill {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: #ffffff;
    position: absolute;
    top: 5px;
    left: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.percentage-value {
    font-size: 32px;
    font-weight: 700;
    background: linear-gradient(45deg, #00aaff, #00ff88);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 18px;
    font-weight: 600;
    color: #444;
    margin-top: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stat-sublabel {
    font-size: 14px;
    color: #666;
    margin-top: 5px;
}

.attendance-trend {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 15px;
}
@media (max-width: 768px) {
    .attendance-stats {
        display: flex;
        flex-direction: column;
    }
}
.trend-indicator {
    font-size: 14px;
    padding: 5px 12px;
    border-radius: 15px;
    background: rgba(0, 170, 255, 0.1);
    color: #00aaff;
}

.trend-up {
    background: rgba(0, 255, 136, 0.1);
    color: #00cc69;
}

.trend-down {
    background: rgba(255, 82, 82, 0.1);
    color: #ff5252;
}

/* Custom gradients for different percentage ranges */
.excellent {
    background: conic-gradient(#00ff88 0% var(--percentage), #f0f0f0 var(--percentage) 100%);
}

.good {
    background: conic-gradient(#00aaff 0% var(--percentage), #f0f0f0 var(--percentage) 100%);
}

.average {
    background: conic-gradient(#ffd700 0% var(--percentage), #f0f0f0 var(--percentage) 100%);
}

.poor {
    background: conic-gradient(#ff5252 0% var(--percentage), #f0f0f0 var(--percentage) 100%);
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

    <div class="attendance-stats">
        <div class="stat-card">
            <h3 class="stat-label">Overall Attendance</h3>
            <div class="percentage-circle excellent" style="--percentage: 95%">
                <div class="circle-fill">
                    <span class="percentage-value">95%</span>
                    <span class="stat-sublabel">Excellent</span>
                </div>
            </div>
            <div class="attendance-trend">
                <span class="trend-indicator trend-up">
                    <i class="fas fa-arrow-up"></i> 3% vs last month
                </span>
            </div>
        </div>
    
        <div class="stat-card">
            <h3 class="stat-label">This Month</h3>
            <div class="percentage-circle good" style="--percentage: 88%">
                <div class="circle-fill">
                    <span class="percentage-value">88%</span>
                    <span class="stat-sublabel">Good</span>
                </div>
            </div>
            <div class="attendance-trend">
                <span class="trend-indicator">
                    <i class="fas fa-equals"></i> Same as usual
                </span>
            </div>
        </div>
    
        <div class="stat-card">
            <h3 class="stat-label">This Week</h3>
            <div class="percentage-circle excellent" style="--percentage: 100%">
                <div class="circle-fill">
                    <span class="percentage-value">100%</span>
                    <span class="stat-sublabel">Perfect</span>
                </div>
            </div>
            <div class="attendance-trend">
                <span class="trend-indicator trend-up">
                    <i class="fas fa-arrow-up"></i> Perfect Week!
                </span>
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
