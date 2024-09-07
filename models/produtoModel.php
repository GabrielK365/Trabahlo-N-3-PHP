<?php
require_once 'DAL/produtoDAO.php';

class produtoModel {
    public ?int $id;
    public ?string $nome;
    public ?string $descricao;
    public ?float $preco;

    public function __construct(
        ?int $id = null,
        ?string $nome = null,
        ?string $descricao = null,
        ?float $preco = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
    }

    public function getProdutos() {
        $produtoDAO = new produtoDAO();
        return $produtoDAO->getProdutos();
    }

    public function create() {
        $produtoDAO = new produtoDAO();
        return $produtoDAO->createProduto($this);
    }

    public function update() {
        $produtoDAO = new produtoDAO();
        return $produtoDAO->updateProduto($this);
    }

    public function delete() {
        $produtoDAO = new produtoDAO();
        return $produtoDAO->deleteProduto($this->id);
    }

    public function getProduto($id) {
        $produtoDAO = new produtoDAO();
        return $produtoDAO->getProduto($id);
    }

    public function existeProdutoComNome($nome, $id = null) {
        $produtoDAO = new produtoDAO();
        return $produtoDAO->existeProdutoComNome($nome, $id);
    }
}
?>
