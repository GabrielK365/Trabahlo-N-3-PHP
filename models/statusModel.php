<?php
require_once 'DAL/statusDAO.php';

class statusModel {
    public ?int $id;
    public ?string $nome;

    public function __construct(
        ?int $id = null,
        ?string $nome = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getStatus() {
        $statusDAO = new statusDAO();
        return $statusDAO->getAllStatus();
    }

    public function create() {
        $statusDAO = new statusDAO();
        return $statusDAO->createStatus($this);
    }

    public function update() {
        $statusDAO = new statusDAO();
        return $statusDAO->updateStatus($this);
    }

    public function delete() {
        $statusDAO = new statusDAO();
        return $statusDAO->deleteStatus($this);
    }

    public function getStatusById($id) {
        $statusDAO = new statusDAO();
        return $statusDAO->getStatusById($id);
    }
}
?>
