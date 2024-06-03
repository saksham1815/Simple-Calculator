<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 200;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: lightcyan;
            overflow: hidden;
            /* Prevent scrollbars */
        }

        .bordered {
            position: relative;
            width: 300px;
            /* height: 20px; */
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .bordered::before,
        .bordered::after {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background-image: url('mathpic.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            z-index: -1;
            border-radius: 100px;
        }

        .bordered::before {
            filter: blur(10px);
            transform: scale(1.2);
        }

        .bordered::after {
            filter: blur(0);
            transform: scale(4.3);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"],
        select,
        button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            color: black;
        }

        button {
            background-color: red;
            color: #fff;
            cursor: pointer;
            border: 1px solid #3e8e41;
        }

        button:hover {
            background-color: #3e8e41;
        }

        #result {
            width: 100%;
            padding: 10px;
            border: 2px solid #4CAF50;
            border-radius: 5px;
            font-size: 1.5em;
            text-align: center;
            margin-top: 1px;
            background-color: #e0f7e0;
        }
    </style>
</head>

<body>
    <?php
    $result = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        $operation = $_POST['operation'];

        if (is_numeric($number1) && is_numeric($number2)) {
            switch ($operation) {
                case '+':
                    $result = $number1 + $number2;
                    break;
                case '-':
                    $result = $number1 - $number2;
                    break;
                case '*':
                    $result = $number1 * $number2;
                    break;
                case '/':
                    if ($number2 != 0) {
                        $result = $number1 / $number2;
                    } else {
                        $result = 'Division by zero error';
                    }
                    break;
                case '%':
                    $result = $number1 % $number2;
                    break;
                case '++':
                    $result = $number1 + 1;
                    break;
                case '--':
                    $result = $number1 - 1;
                    break;
                case '**':
                    $result = $number1 ** $number2;
                    break;
                case 'sqrt':
                    $result = sqrt($number1);
                    break;
                default:
                    $result = 'Invalid operation';
            }
        } else {
            $result = 'Please enter valid numbers';
        }
    }
    ?>

    <div class="bordered">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="number1">Number 1:</label>
            <input type="number" id="number1" name="number1" min="0" max="999999999999999999" value="<?php echo isset($number1) ? htmlspecialchars($number1) : ''; ?>" required>

            <label for="number2">Number 2:</label>
            <input type="number" id="number2" name="number2" min="0" max="999999999999999999" value="<?php echo isset($number2) ? htmlspecialchars($number2) : ''; ?>" required>

            <label for="operation">Operation:</label>
            <select id="operation" name="operation" required>
                <option value="" selected disabled>Select operation</option>
                <option value="+" <?php if (isset($operation) && $operation == '+') echo 'selected'; ?>>+</option>
                <option value="-" <?php if (isset($operation) && $operation == '-') echo 'selected'; ?>>-</option>
                <option value="*" <?php if (isset($operation) && $operation == '*') echo 'selected'; ?>>*</option>
                <option value="/" <?php if (isset($operation) && $operation == '/') echo 'selected'; ?>>/</option>
                <option value="%" <?php if (isset($operation) && $operation == '%') echo 'selected'; ?>>%</option>
                <option value="++" <?php if (isset($operation) && $operation == '++') echo 'selected'; ?>>++</option>
                <option value="--" <?php if (isset($operation) && $operation == '--') echo 'selected'; ?>>--</option>
                <option value="**" <?php if (isset($operation) && $operation == '**') echo 'selected'; ?>>**</option>
                <option value="sqrt" <?php if (isset($operation) && $operation == 'sqrt') echo 'selected'; ?>>sqrt</option>
            </select>

            <button type="submit">Compute</button>
        </form>
        <input type="text" id="result" value="<?php echo htmlspecialchars($result); ?>" disabled placeholder="Result">
    </div>
</body>

</html>