<?php
require_once 'Model/itemPedidoModel.php';
require_once 'Model/produtoModel.php'; 
require_once 'Model/pedidoModel.php'; 

class ItemPedidoController {

    public function buscarItensPedido() {
        $pedidoId = $_POST['pedido_id'] ?? null;

        if ($pedidoId === null) {
            echo json_encode(['error' => 'ID do pedido não fornecido', 'result' => null]);
            return;
        }

        $itemPedidoModel = new itemPedidoModel();
        $itens = $itemPedidoModel->getItensPedido($pedidoId);
        echo json_encode(['error' => null, 'result' => $itens]);
    }

    public function cadastrarItemPedido() {
        $pedidoId = $_POST['pedido_id'] ?? null;
        $produtoId = $_POST['produto_id'] ?? null;
        $quantidade = $_POST['quantidade'] ?? null;

        if ($pedidoId === null || $produtoId === null || $quantidade === null) {
            echo json_encode(['error' => 'Dados incompletos', 'result' => null]);
            return;
        }

        $produtoModel = new produtoModel();
        $pedidoModel = new pedidoModel();
        
        if (!$produtoModel->getProduto($produtoId)) {
            echo json_encode(['error' => 'Produto não encontrado', 'result' => null]);
            return;
        }

        if (!$pedidoModel->getPedido($pedidoId)) {
            echo json_encode(['error' => 'Pedido não encontrado', 'result' => null]);
            return;
        }

        $itemPedidoModel = new itemPedidoModel();
        if ($itemPedidoModel->existeItemNoPedido($pedidoId, $produtoId)) {
            $itemPedidoModel->atualizaQuantidade($pedidoId, $produtoId, $quantidade);
        } else {
            $itemPedidoModel->create($pedidoId, $produtoId, $quantidade);
        }

        echo json_encode(['error' => null, 'result' => 'Item do pedido cadastrado com sucesso']);
    }

    public function editarItemPedido() {
        $id = $_POST['id'] ?? null;
        $quantidade = $_POST['quantidade'] ?? null;

        if ($id === null || $quantidade === null) {
            echo json_encode(['error' => 'Dados incompletos', 'result' => null]);
            return;
        }

        $itemPedidoModel = new itemPedidoModel();
        $itemPedidoModel->update($id, $quantidade);

        echo json_encode(['error' => null, 'result' => 'Item do pedido atualizado com sucesso']);
    }

    public function excluirItemPedido() {
        $id = $_POST['id'] ?? null;

        if ($id === null) {
            echo json_encode(['error' => 'ID do item do pedido não fornecido', 'result' => null]);
            return;
        }

        $itemPedidoModel = new itemPedidoModel();
        $itemPedidoModel->delete($id);

        echo json_encode(['error' => null, 'result' => 'Item do pedido excluído com sucesso']);
    }
}
?>
