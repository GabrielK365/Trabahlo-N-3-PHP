<?php
require_once './models/UsuarioModel.php';

class usuarioController {
    public function getUsuarios() {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->getUsuarios();

        return json_encode([
            'error' => null,
            'result' => $usuarios
        ]);
    }

    public function buscarUsuario() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id']))
            return $this->mostrarErro('Você deve informar o ID do usuário!');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->getUsuario($dados['id']);

        if (!$usuario)
            return $this->mostrarErro('Usuário não encontrado!');

        return json_encode([
            'error' => null,
            'result' => $usuario
        ]);
    }

    public function createUsuario() {
        try {
            $dados = json_decode(file_get_contents('php://input'), true);

            $usuarioModel = new UsuarioModel(
                null,
                $dados['nome'],
                $dados['cpf'],
                $dados['senha']
            );

            $conexao = (new Conexao())->getConexao();
        
            $sql = "SELECT COUNT(*) FROM usuario WHERE cpf = :cpf;";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':cpf', $usuarioModel->cpf);
            $stmt->execute();
        
            if ($stmt->fetchColumn() > 0) {
                throw new Exception("CPF já cadastrado!");
            }
        
            $usuarioModel->create();

            return json_encode([
                'error' => null,
                'result' => 'Usuário cadastrado com sucesso!'
            ]);
        } catch (Exception $e) {
            return $this->mostrarErro($e->getMessage());
        }
    }

    public function updateUsuario() {
        try {
            $dados = json_decode(file_get_contents('php://input'), true);

            $usuarioModel = new UsuarioModel(
                $dados['id'],
                $dados['nome'],
                $dados['cpf'],
                $dados['senha']
            );

            $conexao = (new Conexao())->getConexao();
        
            $sql = "SELECT COUNT(*) FROM usuario WHERE cpf = :cpf AND id != :id;";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':cpf', $usuarioModel->cpf);
            $stmt->bindValue(':id', $usuarioModel->id);
            $stmt->execute();
        
            if ($stmt->fetchColumn() > 0) {
                throw new Exception("CPF já cadastrado por outro usuário!");
            }
        
            $usuarioModel->update();

            return json_encode([
                'error' => null,
                'result' => 'Usuário atualizado com sucesso!'
            ]);
        } catch (Exception $e) {
            return $this->mostrarErro($e->getMessage());
        }
    }

    public function deleteUsuario() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id']))
            return $this->mostrarErro('Você deve informar o ID do usuário!');

        $usuario = (new UsuarioModel())->getUsuario($dados['id']);

        if (!$usuario)
            return $this->mostrarErro('Usuário não encontrado!');

        $usuario->delete();

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
