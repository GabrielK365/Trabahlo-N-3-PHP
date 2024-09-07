<?php
require_once 'Conexao.php';

class statusDAO {
    public function getAllStatus() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM status;";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createStatus(statusModel $status) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO status (nome) VALUES (:nome);";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $status->nome);

        return $stmt->execute();
    }

    public function updateStatus(statusModel $status) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE status SET nome = :nome WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $status->id);
        $stmt->bindValue(':nome', $status->nome);

        return $stmt->execute();
    }

    public function deleteStatus(statusModel $status) {
        $conexao = (new Conexao())->getConexao();

        $sql = "DELETE FROM status WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $status->id);

        return $stmt->execute();
    }

    public function getStatusById($id) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM status WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
