<!DOCTYPE html>
<html>
<head>
    <title>Electricity Consumption Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #add8e6; /* Baby blue color */
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border-color: #ccc;
            border-radius: 3px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .table {
            font-size: 14px;
            border-color: #ddd;
        }

        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #555;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Electricity Consumption Calculator</h1>
        <form id="calculator-form">
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
            <button type="button" class="btn btn-primary" onclick="calculateElectricity()">Calculate</button>
        </form>
        <div id="result" class="mt-4"></div>
        <table class="table table-striped table-bordered mt-5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hour</th>
                    <th>Energy (kWh)</th>
                    <th>Total (RM)</th>
                </tr>
            </thead>
            <tbody id="result-table"></tbody>
        </table>
    </div>

    <script>
        function calculateElectricity() {
            var voltage = document.getElementById("voltage").value;
            var current = document.getElementById("current").value;
            var currentRate = document.getElementById("current-rate").value;
            var hours = document.getElementById("hours").value;

            var power = voltage * current;
            var resultHtml = `
                <h2>Results:</h2>
                <p>Power: ${power.toFixed(5)} kW</p>
            `;

            var resultTableHtml = "";
            for (var i = 1; i <= hours; i++) {
                var energy = (power * i * 1000) / 1000; // Convert to kWh
                var total = energy * (currentRate / 100);
                resultTableHtml += `
                    <tr>
                        <td>${i}</td>
                        <td>${i}</td>
                        <td>${energy.toFixed(5)}</td>
                        <td>RM ${total.toFixed(2)}</td>
                    </tr>
                `;
            }

            var energyTotal = (power * hours * 1000) / 1000; // Convert to kWh
            var totalCharge = energyTotal * (currentRate / 100);
            resultHtml += `
                <p>Energy: ${energyTotal.toFixed(5)} kWh</p>
                <p>Total Charge: RM ${totalCharge.toFixed(2)}</p>
            `;

            document.getElementById("result").innerHTML = resultHtml;
            document.getElementById("result-table").innerHTML = resultTableHtml;
        }
    </script>
</body>
</html>