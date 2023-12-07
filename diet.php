<?php

require_once 'conecao.php';

// Verifica se as variáveis estão definidas e não são vazias
$requiredVariables = ['idade', 'peso', 'altura', 'alcool', 'alergia'];
// Verifica se as variáveis estão definidas e não são vazias
if (isset($requiredVariables)) {
    // Atribui os valores às variáveis
    $idade = $_REQUEST['idade'];
    $peso = $_REQUEST['peso'];
    $altura = $_REQUEST['altura'];
    $alergia = $_REQUEST['alergia'];
    

    $alcool = isset($_REQUEST['alcool']) ? $_REQUEST['alcool'] : null;
    $gener = isset($_REQUEST['gener']) ? $_REQUEST['gener'] : null;
    
    $bmi = calculateBMI($peso, $altura);
    $bmi = round($bmi,2);
    
    // Prepara a instrução SQL
    $sql = "INSERT INTO Diet (Age, Weight, height, Alcool, Allergy) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração foi bem-sucedida
    if ($stmt) {
        // Associa os parâmetros
        $stmt->bind_param('ddddd', $idade, $peso, $altura, $alcool, $alergia);
    
        // Executa a declaração
        $stmt->execute();

        // Verifica se a inserção foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            
        } else {
            echo "Erro na inserção: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro na preparação da declaração: " . $conn->error;
    }
    
    
} else {
    echo "Algumas variáveis não foram definidas ou estão vazias.";
}

function calculateBMI($weight, $height) {
    // Convert height from centimeters to meters
    $heightInMeters = $height / 100;

    // Calculate BMI
    $bm = $weight / ($heightInMeters * $heightInMeters);

    return $bm;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>ChatGPT Integration</title>
</head>

<body style="background-color: rgb(138, 136, 133); color:white;">
    <script src="client.js"></script>

    <script>
    async function response() {
        var bmi = '<?php echo $bmi; ?>';
        var gener = '<?php echo $gener; ?>';

        getResponse(bmi, gener)
    }
    response()
    </script>
    <div id="preloader" style="background-color: gray">

        <div id="status">&nbsp;</div>
        <div class="loader">
            <span class="carregando"></span>
            <span class="title">Loanding...</span>
        </div>
    </div>

</body>

</html>