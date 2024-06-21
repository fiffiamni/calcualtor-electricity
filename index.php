<!DOCTYPE html>
<html>
<head>
    <title>Electricity Consumption Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Same CSS styles as before */
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Electricity Consumption Calculator</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="voltage">Voltage (V):</label>
                <input type="number" class="form-control" id="voltage" name="voltage" required>
            </div>
            <div class="form-group">
                <label for="current">Current (A):</label>
                <input type="number" class="form-control" id="current" name="current" required>
            </div>
            <div class="form-group">
                <label for="current-rate">Current Rate (sen/kWh):</label>
                <input type="number" class="form-control" id="current-rate" name="current-rate" required>
            </div>
            <div class="form-group">
                <label for="hours">Hours:</label>
                <input type="number" class="form-control" id="hours" name="hours" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voltage = $_POST["voltage"];
            $current = $_POST["current"];
            $currentRate = $_POST["current-rate"];
            $hours = $_POST["hours"];

            $power = $voltage * $current;
            $energyTotal = ($power * $hours * 1000) / 1000; // Convert to kWh
            $totalCharge = $energyTotal * ($currentRate / 100);

            echo "<h2>Results:</h2>";
            echo "<p>Power: " . number_format($power, 5) . " kW</p>";
            echo "<p>Energy: " . number_format($energyTotal, 5) . " kWh</p>";
            echo "<p>Total Charge: RM " . number_format($totalCharge, 2) . "</p>";

            echo "<table class='table table-striped table-bordered mt-5'>";
            echo "<thead><tr><th>#</th><th>Hour</th><th>Energy (kWh)</th><th>Total (RM)</th></tr></thead>";
            echo "<tbody>";
            for ($i = 1; $i <= $hours; $i++) {
                $energy = ($power * $i * 1000) / 1000; // Convert to kWh
                $total = $energy * ($currentRate / 100);
                echo "<tr><td>" . $i . "</td><td>" . $i . "</td><td>" . number_format($energy, 5) . "</td><td>RM " . number_format($total, 2) . "</td></tr>";
            }
            echo "</tbody></table>";
        }
        ?>
    </div>
</body>
</html>