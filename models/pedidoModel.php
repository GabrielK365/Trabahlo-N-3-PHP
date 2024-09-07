<?php
require_once 'DAL/pedidoDAO.php';

class pedidoModel {
    public ?int $id;
    public ?int $usuarioId;
    public ?int $statusId;

    public function __construct(
        ?int $id = null,
        ?int $usuarioId = null,
        ?int $statusId = null
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->statusId = $statusId;
    }

    public function getPedidos() {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->getPedidos();
    }

    public function getPedido($id) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->getPedido($id);
    }

    public function getPedidosPorUsuario($usuarioId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->getPedidosPorUsuario($usuarioId);
    }

    public function create($usuarioId, $statusId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->createPedido($usuarioId, $statusId);
    }

    public function update($id, $usuarioId, $statusId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->updatePedido($id, $usuarioId, $statusId);
    }

    public function updateStatus($id, $statusId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->updateStatusPedido($id, $statusId);
    }

    public function delete($id) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->deletePedido($id);
    }

    public function calcularValorTotal($pedidoId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->calcularValorTotal($pedidoId);
    }
}
?>
