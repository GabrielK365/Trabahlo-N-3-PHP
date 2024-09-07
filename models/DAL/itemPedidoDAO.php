<?php
require_once 'Conexao.php';

class itemPedidoDAO {
    public function getItensPedido($pedidoId) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM item_pedido WHERE pedido_id = :pedido_id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pedido_id', $pedidoId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createItemPedido($pedidoId, $produtoId, $quantidade) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO item_pedido (pedido_id, produto_id, quantidade) VALUES (:pedido_id, :produto_id, :quantidade);";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pedido_id', $pedidoId);
        $stmt->bindValue(':produto_id', $produtoId);
        $stmt->bindValue(':quantidade', $quantidade);

        return $stmt->execute();
    }

    public function updateItemPedido($id, $quantidade) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE item_pedido SET quantidade = :quantidade WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':quantidade', $quantidade);

        return $stmt->execute();
    }

    public function deleteItemPedido($id) {
        $conexao = (new Conexao())->getConexao();

        $sql = "DELETE FROM item_pedido WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function existeItemNoPedido($pedidoId, $produtoId) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT COUNT(*) FROM item_pedido WHERE pedido_id = :pedido_id AND produto_id = :produto_id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pedido_id', $pedidoId);
        $stmt->bindValue(':produto_id', $produtoId);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function atualizaQuantidade($pedidoId, $produtoId, $quantidade) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE item_pedido SET quantidade = :quantidade WHERE pedido_id = :pedido_id AND produto_id = :produto_id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pedido_id', $pedidoId);
        $stmt->bindValue(':produto_id', $produtoId);
        $stmt->bindValue(':quantidade', $quantidade);

        return $stmt->execute();
    }
}
?>
