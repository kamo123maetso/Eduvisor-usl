<?php
// Database connection details
$host = "localhost";
$dbname = "edudatas";    // Ensure the database "edudatas" exists
$username = "root";      // Default username for local MySQL (for XAMPP/WAMP)
$password = "";          // Leave empty if using default XAMPP/WAMP setup

// Create connection to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from prpgrass table for graph
$sql = "SELECT Name, Marks FROM prpgrass";
$result = $conn->query($sql);
$data = [];
if ($result->num_rows > 0) {
    // Store the data in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "No data found.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Mathematics - Grade 12</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General body styling */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        /* Main content container styling */
        .content {
            /* margin: 40px auto; */
            padding: 20px;
            /* width: 60%; */
            text-align: center;
            width: 80%; 
            margin: 0 auto;"
        }
        /* Canvas for Chart.js */
        #marksChart {
            margin: 20px auto;
            width: 80%;
            height: 400px;
        }
    </style>
</head>
<body>

    <div class="content">
        <h2>Mathematics - Grade 12</h2>
        <canvas id="marksChart"></canvas> <!-- Canvas for Chart.js -->
    </div>

    <script>
        // Prepare the data for the graph
        const data = <?php echo json_encode($data); ?>;  // Fetch data from PHP

        // Debug: Log the data to the browser console
        console.log(data); 

        if (data.length > 0) {
            const names = data.map(item => item.Name);   // Extract names from the data
            const marks = data.map(item => item.Marks);  // Extract marks from the data

            // Define colors based on marks
            const backgroundColors = marks.map(mark => {
         if (mark >= 75) {
        return 'rgba(54, 162, 235, 0.6)';  // Blue for marks >= 75
        } else if (mark >= 50 && mark < 75) {
        return 'rgba(75, 192, 192, 0.6)';  // Green for marks >= 50 and < 75
        } else  {
        return 'rgba(255, 99, 132, 0.6)';  // Pink for marks < 50
    }
         });

            const borderColors = backgroundColors.map(color => color.replace('0.6', '1'));  // Set a stronger border color

            // Create the chart
            const ctx = document.getElementById('marksChart').getContext('2d');
            const marksChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: names,  // Names go to the x-axis
                    datasets: [{
                        label: 'Marks',  // Dataset label
                        data: marks,     // Marks go to the y-axis
                        backgroundColor: backgroundColors,  // Dynamic background colors
                        borderColor: borderColors,          // Dynamic border colors
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Marks'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Learners'
                            }
                        }
                    }
                }
            });
        } else {
            console.error("No data available for the graph.");
        }
    </script>

</body>
</html>
