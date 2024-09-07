<?php
    require_once 'DAL/UsuarioDAO.php';

    class UsuarioModel {
        public ?int $id;
        public ?string $nome;
        public ?int $cpf;
        public ?string $senha;

        public function __construct(
            ?int $id = null,
            ?string $nome = null,
            ?int $cpf = null,
            ?string $senha = null
        ) {
            $this->id = $id;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->senha = $senha;
        }

        public function getUsuarios() {
            $usuarioDAO = new UsuarioDAO();

            $usuarios = $usuarioDAO->getUsuarios();

            foreach ($usuarios as &$usuario) {
                $usuario = new UsuarioModel(
                    $usuario['id'],
                    $usuario['nome'],
                    $usuario['cpf'],
                    $usuario['senha']
                );
            }

            return $usuarios;
        }

        public function create() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->createUsuario($this);
        }

        public function update() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->updateUsuario($this);
        }

        public function delete() {
            $usuarioDAO = new UsuarioDAO();

            return $usuarioDAO->deleteUsuario($this);
        }

        public function getUsuario($id) {
            $usuarioDAO = new UsuarioDAO;

            $usuario = $usuarioDAO->getUsuario($id);

            $usuario = new UsuarioModel(
                $usuario['id'],
                $usuario['nome'],
                $usuario['cpf'],
                $usuario['senha']
            );

            return $usuario;
        }
    }
?>