<?php
require_once 'DAL/itemPedidoDAO.php';

class itemPedidoModel {
    public ?int $id;
    public ?int $pedidoId;
    public ?int $produtoId;
    public ?int $quantidade;

    public function __construct(
        ?int $id = null,
        ?int $pedidoId = null,
        ?int $produtoId = null,
        ?int $quantidade = null
    ) {
        $this->id = $id;
        $this->pedidoId = $pedidoId;
        $this->produtoId = $produtoId;
        $this->quantidade = $quantidade;
    }

    public function getItensPedido($pedidoId) {
        $itemPedidoDAO = new itemPedidoDAO();
        return $itemPedidoDAO->getItensPedido($pedidoId);
    }

    public function create($pedidoId, $produtoId, $quantidade) {
        $itemPedidoDAO = new itemPedidoDAO();
        return $itemPedidoDAO->createItemPedido($pedidoId, $produtoId, $quantidade);
    }

    public function update($id, $quantidade) {
        $itemPedidoDAO = new itemPedidoDAO();
        return $itemPedidoDAO->updateItemPedido($id, $quantidade);
    }

    public function delete($id) {
        $itemPedidoDAO = new itemPedidoDAO();
        return $itemPedidoDAO->deleteItemPedido($id);
    }

    public function existeItemNoPedido($pedidoId, $produtoId) {
        $itemPedidoDAO = new itemPedidoDAO();
        return $itemPedidoDAO->existeItemNoPedido($pedidoId, $produtoId);
    }

    public function atualizaQuantidade($pedidoId, $produtoId, $quantidade) {
        $itemPedidoDAO = new itemPedidoDAO();
        return $itemPedidoDAO->atualizaQuantidade($pedidoId, $produtoId, $quantidade);
    }
}
?>
