<?php
require_once './models/statusModel.php';

class statusController {
    public function getStatus() {
        $statusModel = new statusModel();
        $status = $statusModel->getStatus();

        return json_encode([
            'error' => null,
            'result' => $status
        ]);
    }

    public function getStatusById() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id']))
            return $this->mostrarErro('Você deve informar o ID do status!');

        $statusModel = new statusModel();
        $status = $statusModel->getStatusById($dados['id']);

        if (!$status)
            return $this->mostrarErro('Status não encontrado!');

        return json_encode([
            'error' => null,
            'result' => $status
        ]);
    }

    public function createStatus() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['nome']))
            return $this->mostrarErro('Você deve informar o nomeStatus!');
        
        $status = new statusModel(
            null,
            $dados['nome']
        );

        $status->create();

        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }

    private function mostrarErro(string $mensagem) {
        return json_encode([
            'error' => $mensagem,
            'result' => null
        ]);
    }
}
?>
