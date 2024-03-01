<?php

// Endpoint para criar um novo usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do novo usuário do corpo da requisição
    $dados_usuario = json_decode(file_get_contents("php://input"), true);

    // Validação básica - Certifique-se de que os campos obrigatórios estão presentes
    if (isset($dados_usuario['nome']) && isset($dados_usuario['email'])) {
        // Lógica para criar um novo usuário no banco de dados
        $novo_usuario_id = criarNovoUsuario($dados_usuario['nome'], $dados_usuario['email']);

        // Resposta de sucesso
        http_response_code(201); // Código HTTP 201 Created
        echo json_encode(array('mensagem' => 'Usuário criado com sucesso', 'id' => $novo_usuario_id));
    } else {
        // Resposta de erro de validação
        http_response_code(400); // Código HTTP 400 Bad Request
        echo json_encode(array('mensagem' => 'Campos obrigatórios ausentes'));
    }
} else {
    // Resposta para métodos HTTP não suportados
    http_response_code(405); // Código HTTP 405 Method Not Allowed
    echo json_encode(array('mensagem' => 'Método não permitido'));
}

// Função para criar um novo usuário (simulada)
function criarNovoUsuario($nome, $email) {
    // Lógica para inserir o novo usuário no banco de dados
    // (Neste exemplo, apenas retorna um ID fictício)
    $novo_usuario_id = mt_rand(1000, 9999);
    return $novo_usuario_id;
}

?>
