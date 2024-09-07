<?php
require_once 'models/pedidoModel.php';
require_once 'models/usuarioModel.php';
require_once 'models/statusModel.php';

class PedidoController {

    public function getPedidos() {
        $pedidoModel = new pedidoModel();
        $pedidos = $pedidoModel->getPedidos();
        echo json_encode(['error' => null, 'result' => $pedidos]);
    }

    public function buscarPedidoPorId() {
        $id = $_POST['id'] ?? null;

        if ($id === null) {
            echo json_encode(['error' => 'ID do pedido não fornecido', 'result' => null]);
            return;
        }

        $pedidoModel = new pedidoModel();
        $pedido = $pedidoModel->getPedido($id);
        echo json_encode(['error' => null, 'result' => $pedido]);
    }

    public function buscarPedidosPessoa() {
        $usuarioId = $_POST['usuario_id'] ?? null;

        if ($usuarioId === null) {
            echo json_encode(['error' => 'ID do usuário não fornecido', 'result' => null]);
            return;
        }

        $pedidoModel = new pedidoModel();
        $pedidos = $pedidoModel->getPedidosPorUsuario($usuarioId);
        echo json_encode(['error' => null, 'result' => $pedidos]);
    }

    public function cadastrarPedido() {
        $usuarioId = $_POST['usuario_id'] ?? null;
        $statusId = $_POST['status_id'] ?? null;
    
        if ($usuarioId === null || $statusId === null) {
            return json_encode(['error' => 'Dados incompletos', 'result' => null]);
        }
    
        $usuarioModel = new usuarioModel();
        $statusModel = new statusModel();
        
        if (!$usuarioModel->getUsuario($usuarioId)) {
            return json_encode(['error' => 'Usuário não encontrado', 'result' => null]);
        }
    
        if (!$statusModel->getStatusById($statusId)) {
            return json_encode(['error' => 'Status não encontrado', 'result' => null]);
        }
    
        $pedidoModel = new pedidoModel();
        $pedidoModel->create($usuarioId, $statusId);
    
        return json_encode(['error' => null, 'result' => 'Pedido cadastrado com sucesso']);
    }
    

    public function valorTotalPedido() {
        $pedidoId = $_POST['pedido_id'] ?? null;

        if ($pedidoId === null) {
            echo json_encode(['error' => 'ID do pedido não fornecido', 'result' => null]);
            return;
        }

        $pedidoModel = new pedidoModel();
        $valorTotal = $pedidoModel->calcularValorTotal($pedidoId);
        echo json_encode(['error' => null, 'result' => $valorTotal]);
    }

    public function updatePedido() {
        $id = $_POST['id'] ?? null;
        $usuarioId = $_POST['usuario_id'] ?? null;
        $statusId = $_POST['status_id'] ?? null;

        if ($id === null || $usuarioId === null || $statusId === null) {
            echo json_encode(['error' => 'Dados incompletos', 'result' => null]);
            return;
        }

        $pedidoModel = new pedidoModel();
        $pedidoModel->update($id, $usuarioId, $statusId);

        echo json_encode(['error' => null, 'result' => 'Pedido atualizado com sucesso']);
    }

    public function editarStatusPedido() {
        $id = $_POST['id'] ?? null;
        $statusId = $_POST['status_id'] ?? null;

        if ($id === null || $statusId === null) {
            echo json_encode(['error' => 'Dados incompletos', 'result' => null]);
            return;
        }

        $pedidoModel = new pedidoModel();
        $pedidoModel->updateStatus($id, $statusId);

        echo json_encode(['error' => null, 'result' => 'Status do pedido atualizado com sucesso']);
    }

    public function deletePedido() {
        $id = $_POST['id'] ?? null;

        if ($id === null) {
            echo json_encode(['error' => 'ID do pedido não fornecido', 'result' => null]);
            return;
        }

        $pedidoModel = new pedidoModel();
        $pedidoModel->delete($id);

        echo json_encode(['error' => null, 'result' => 'Pedido excluído com sucesso']);
    }
}
?>
