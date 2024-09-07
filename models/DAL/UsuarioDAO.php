<?php
require_once 'Conexao.php';

class UsuarioDAO {
    public function getUsuarios() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM usuario;";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUsuario(UsuarioModel $usuario) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO usuario (nome, cpf, senha) VALUES (:nome, :cpf, :senha);";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $usuario->nome);
        $stmt->bindValue(':cpf', $usuario->cpf);
        $stmt->bindValue(':senha', $usuario->senha);

        return $stmt->execute();
    }

    public function updateUsuario(UsuarioModel $usuario) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE usuario SET nome = :nome, cpf = :cpf, senha = :senha WHERE id = :id;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $usuario->id);
        $stmt->bindValue(':nome', $usuario->nome);
        $stmt->bindValue(':cpf', $usuario->cpf);
        $stmt->bindValue(':senha', $usuario->senha);

        return $stmt->execute();
    }

    public function deleteUsuario(UsuarioModel $usuario) {
        $conexao = (new Conexao())->getConexao();

        $sql = "DELETE FROM usuario WHERE id = :id;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $usuario->id);

        return $stmt->execute();
    }

    public function getUsuario($id) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM usuario WHERE id = :id;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existeCpf($cpf, $id = null) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT COUNT(*) FROM usuario WHERE cpf = :cpf";
        if ($id !== null) {
            $sql .= " AND id != :id";
        }

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':cpf', $cpf);
        if ($id !== null) {
            $stmt->bindValue(':id', $id);
        }
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}
?>
