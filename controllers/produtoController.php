<?php
require_once './models/produtoModel.php';

class produtoController {

    public function getProdutos() {
        $produtoModel = new produtoModel();
        $produtos = $produtoModel->getProdutos();

        return json_encode([
            'error' => null,
            'result' => $produtos
        ]);
    }

    public function buscarProdutoById() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id']))
            return $this->mostrarErro('Você deve informar o ID do produto!');

        $produtoModel = new produtoModel();
        $produto = $produtoModel->getProduto($dados['id']);

        if (!$produto)
            return $this->mostrarErro('Produto não encontrado!');

        return json_encode([
            'error' => null,
            'result' => $produto
        ]);
    }

    public function createProduto() {
        try {
            $dados = json_decode(file_get_contents('php://input'), true);

            $produtoModel = new produtoModel(
                null,
                $dados['nome'],
                $dados['descricao'],
                $dados['preco']
            );

            if ($produtoModel->existeProdutoComNome($produtoModel->nome)) {
                throw new Exception("Produto com este nome já cadastrado!");
            }

            $produtoModel->create();

            return json_encode([
                'error' => null,
                'result' => 'Produto cadastrado com sucesso!'
            ]);
        } catch (Exception $e) {
            return $this->mostrarErro($e->getMessage());
        }
    }

    public function updateProduto() {
        try {
            $dados = json_decode(file_get_contents('php://input'), true);

            $produtoModel = new produtoModel(
                $dados['id'],
                $dados['nome'],
                $dados['descricao'],
                $dados['preco']
            );

            if ($produtoModel->existeProdutoComNome($produtoModel->nome, $produtoModel->id)) {
                throw new Exception("Outro produto com este nome já cadastrado!");
            }

            $produtoModel->update();

            return json_encode([
                'error' => null,
                'result' => 'Produto atualizado com sucesso!'
            ]);
        } catch (Exception $e) {
            return $this->mostrarErro($e->getMessage());
        }
    }

    public function deleteProduto() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id'])) {
            return $this->mostrarErro('Você deve informar o ID do produto!');
        }

        $produtoModel = new ProdutoModel();
        $produto = $produtoModel->getProduto($dados['id']);

        if (!$produto) {
            return $this->mostrarErro('Produto não encontrado!');
        }

        $produtoModel->id = $dados['id'];
        $produtoModel->delete();

        return json_encode([
            'error' => null,
            'result' => 'Produto excluído com sucesso!'
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
