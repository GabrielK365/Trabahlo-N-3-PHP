<?php
require_once 'Conexao.php';

class produtoDAO {

    public function getProdutos() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM produto;";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduto(produtoModel $produto) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO produto VALUES (null, :nome, :descricao, :preco);";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $produto->nome);
        $stmt->bindValue(':descricao', $produto->descricao);
        $stmt->bindValue(':preco', $produto->preco);

        return $stmt->execute();
    }

    public function updateProduto(produtoModel $produto) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $produto->id);
        $stmt->bindValue(':nome', $produto->nome);
        $stmt->bindValue(':descricao', $produto->descricao);
        $stmt->bindValue(':preco', $produto->preco);

        return $stmt->execute();
    }

    public function deleteProduto($id) { 
        $conexao = (new Conexao())->getConexao();

        $sql = "DELETE FROM produto WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function getProduto($id) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM produto WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existeProdutoComNome($nome, $id = null) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT COUNT(*) FROM produto WHERE nome = :nome";
        if ($id !== null) {
            $sql .= " AND id != :id";
        }

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        if ($id !== null) {
            $stmt->bindValue(':id', $id);
        }
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}
?>
