<?php
include'../models/db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "DELETE FROM clientes WHERE id=$id";

    $maxRetries = 5;
    $retries = 0;
    $success = false;

    while ($retries < $maxRetries && !$success) {
        try {
            $conn->begin_transaction();
            if ($conn->query($sql) === TRUE) {
                $conn->commit();
                $success = true;
                echo "Registro deletado com sucesso";
            } else {
                $conn->rollback();
                throw new Exception("Erro ao deletar registro: " . $conn->error);
            }
        } catch (Exception $e) {
            $conn->rollback();
            if (strpos($e->getMessage(), 'Lock wait timeout exceeded') !== false) {
                $retries++;
                sleep(1); // Aguarde um segundo antes de tentar novamente
            } else {
                echo $e->getMessage();
                break;
            }
        }
    }

    if (!$success) {
        echo "Erro: Não foi possível deletar o registro após várias tentativas.";
    }

    $conn->close();
    header('Location: ../views/pages/cadastrar.php');
    exit();
}
?>
