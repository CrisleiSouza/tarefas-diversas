<?php
include '../models/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM empresas WHERE id = ?";
        
        $maxRetries = 5;
        $retries = 0;
        $success = false;

        while ($retries < $maxRetries && !$success) {
            try {
                $conn->begin_transaction();
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    throw new Exception("Erro ao preparar a declaração: " . $conn->error);
                }
                
                $stmt->bind_param('i', $id);
                
                if ($stmt->execute()) {
                    $conn->commit();
                    $success = true;
                    echo "Produto deletado com sucesso";
                } else {
                    $conn->rollback();
                    throw new Exception("Erro ao deletar registro: " . $stmt->error);
                }
                
                $stmt->close();
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
        header('Location: ../views/pages/cadastrarempresa.php');
        exit();
    } else {
        echo "ID do produto não fornecido.";
        header('Location: ../views/pages/cadastrarempresa.php');
        exit();
    }
} else {
    header('Location: ../views/pages/cadastrarempresa.php');
    exit();
}
?>
