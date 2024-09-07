<?php
class Router {
    private array $routes;

    public function __construct() {
        $this->routes = [
            'GET' => [
                '/usuarios' => [
                    'controller' => 'usuarioController',
                    'function' => 'getUsuarios'
                ],
                '/status' => [
                    'controller' => 'statusController',
                    'function' => 'getStatus'
                ],
                '/produtos' => [
                    'controller' => 'produtoController',
                    'function' => 'getProdutos'
                ],
                '/pedidos' => [
                    'controller' => 'pedidoController',
                    'function' => 'getPedidos'
                ]
            ],
            'POST' => [
                '/buscarUsuario' => [
                    'controller' => 'usuarioController',
                    'function' => 'buscarUsuario'
                ],
                '/cadastrar-Usuario' => [
                    'controller' => 'usuarioController',
                    'function' => 'createUsuario'
                ],
                '/status' => [
                    'controller' => 'statusController',
                    'function' => 'createStatus'
                ],
                '/produto' => [
                    'controller' => 'produtoController',
                    'function' => 'buscarProdutoById'
                ],
                '/cadastrar-produto' => [
                    'controller' => 'produtoController',
                    'function' => 'createProduto'
                ],
                '/itens-Pedido' => [
                    'controller' => 'itemController',
                    'function' => 'buscarItemPedido'
                ],
                '/cadastrar-item-pedido' => [
                    'controller' => 'itemController',
                    'function' => 'createItemPedido'
                ],
                '/pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'buscarPedidoPorId'
                ],
                '/pedidos-pessoa' => [
                    'controller' => 'pedidoController',
                    'function' => 'buscarPedidoPessoa'
                ],
                '/cadastrarPedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'cadastrarPedido'
                ],
                '/valor-total-pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'buscarTotalPedido'
                ]
            ],
            'PUT' => [
                '/editar-Usuario' => [
                    'controller' => 'usuarioController',
                    'function' => 'updateUsuario'
                ],
                '/editar-Produto' => [
                    'controller' => 'produtoController',
                    'function' => 'updateProduto'
                ],
                '/editar-item-pedido' => [
                    'controller' => 'itemController',
                    'function' => 'updateItemPedido'
                ],
                '/editar-pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'updatePedido'
                ],
                '/editar-status-pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'updateStatusPedido'
                ]
            ],
            'DELETE' => [
                '/excluir-Usuario' => [
                    'controller' => 'usuarioController',
                    'function' => 'deleteUsuario'
                ],
                '/excluir-Produto' => [
                    'controller' => 'produtoController',
                    'function' => 'deleteProduto'
                ],
                '/excluir-item-pedido' => [
                    'controller' => 'itemController',
                    'function' => 'deleteItemPedido'
                ],
                '/excluir-pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'deletePedido'
                ]
            ]
        ];
    }

    public function handleRequest(string $method, string $route): string {
        $routeExists = !empty($this->routes[$method][$route]);

        if (!$routeExists) {
            return json_encode([
                'error' => 'Essa rota não existe!',
                'result' => null
            ]);
        }

        $routeInfo = $this->routes[$method][$route];

        $controller = $routeInfo['controller'];
        $function = $routeInfo['function'];

        require_once __DIR__ . '/../controllers/' . $controller . '.php';

        return (new $controller)->$function();
    }
}
?>
