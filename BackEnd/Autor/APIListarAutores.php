<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $api_token = isset($_POST['api_token']) ? $_POST['api_token'] : null;
    
    if ($api_token == 'TokenTeste') {

        require_once('Index.php'); // Certifique-se de que $conn está definido em Index.php

        $query = 'SELECT Id_autor, nome_autor FROM autores';
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $Id_autor, $nome_autor);

            $response = array();

            while (mysqli_stmt_fetch($stmt)) {
                array_push($response, array(           
                    "Id_autor" => $Id_autor,
                    "nome_autor" => $nome_autor
                ));
            }

            echo json_encode($response);
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(array("error" => "Erro ao preparar a consulta"));
        }

        mysqli_close($conn);

    } else {
        $response = array('auth_token' => false, 'message' => 'Token inválido.');
        echo json_encode($response);
    }
} else {
    $response = array('error' => 'Método não suportado, use POST.');
    echo json_encode($response);
}

?>
