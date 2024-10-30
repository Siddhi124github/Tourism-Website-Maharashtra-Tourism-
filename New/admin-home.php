<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            padding-bottom: 20px;
            border-bottom: 2px solid #007BFF;
        }

        h1 {
            font-size: 24px;
            color: #007BFF;
        }

        main {
            margin-top: 20px;
        }

        section {
            margin-bottom: 20px;
            padding: 15px;
            background: #e9ecef;
            border-radius: 5px;
        }

        h2 {
            color: #343a40;
        }

        .admin-messages {
            margin-top: 20px;
            padding: 10px;
            background: #e9ecef;
            border: 1px solid #007BFF;
            border-radius: 5px;
            white-space: pre-wrap; /* Preserve line breaks */
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>
        
        <main>
            <section>
                <h2>Welcome, Admin!</h2>
                <p>Here are all the submitted messages:</p>
                <div class="admin-messages">
                    <?php
                    // Display all messages from the text file
                    if (file_exists('messages.txt')) {
                        echo nl2br(htmlspecialchars(file_get_contents('messages.txt'))); // Display messages
                    } else {
                        echo "No messages yet.";
                    }
                    ?>
                </div>
            </section>

            <section>
                <h2>Recent Bookings</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Adults</th>
                            <th>Children</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="bookingTable">
                        <?php
                        $servername = "localhost";
                        $username = "root"; // Your database username
                        $password = ""; // Your database password
                        $dbname = "maharashtra"; // Your database name

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch bookings
                        $sql = "SELECT * FROM bookings ORDER BY id DESC LIMIT 10"; // Fetch the latest 10 bookings
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['adults']}</td>
                                    <td>{$row['children']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['status']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No bookings found.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </section>
        </main>

        <footer>
            <p>&copy; 2024 Travel Site Admin Panel. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
