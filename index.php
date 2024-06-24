<!DOCTYPE html>
<html>
<head>
    <title>Electricity Consumption Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-weight: bold;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004a99;
        }

        .table {
            margin-top: 30px;
        }

        .table th, .table td {
            text-align: center;
        }
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
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php
        function calculatePower($voltage, $current) {
            return $voltage * $current;
        }

        function calculateEnergyPerHour($power) {
            return ($power * 1000) / 1000; // Convert to kWh
        }

        function calculateTotalEnergy($energyPerHour) {
            return $energyPerHour * 24;
        }

        function calculateTotalCharge($totalEnergy, $currentRate) {
            return $totalEnergy * ($currentRate / 100);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voltage = $_POST["voltage"];
            $current = $_POST["current"];
            $currentRate = $_POST["current-rate"];

            $power = calculatePower($voltage, $current);
            $energyPerHour = calculateEnergyPerHour($power);
            $totalEnergy = calculateTotalEnergy($energyPerHour);
            $totalCharge = calculateTotalCharge($totalEnergy, $currentRate);

            echo "<h2>Results:</h2>";
            echo "<p>Power: " . number_format($power, 5) . " kW</p>";
            echo "<p>Energy per Hour: " . number_format($energyPerHour, 5) . " kWh</p>";
            echo "<p>Total Energy: " . number_format($totalEnergy, 5) . " kWh</p>";
            echo "<p>Total Charge: RM " . number_format($totalCharge, 2) . "</p>";

            echo "<table class='table table-striped table-bordered mt-5'>";
            echo "<thead><tr><th>#</th><th>Hour</th><th>Energy (kWh)</th><th>Total (RM)</th></tr></thead>";
            echo "<tbody>";
            for ($i = 1; $i <= 24; $i++) {
                $energy = $energyPerHour;
                $total = $energy * ($currentRate / 100);
                echo "<tr><td>" . $i . "</td><td>" . $i . "</td><td>" . number_format($energy, 5) . "</td><td>RM " . number_format($total, 2) . "</td></tr>";
            }
            echo "</tbody></table>";
        }
        ?>
    </div>
</body>
</html>
