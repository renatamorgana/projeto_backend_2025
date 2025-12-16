<?php

session_start();
header('Content-Type: application/json');


require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../vendor/autoload.php';

$accessToken = ''; //aqui nós vamos colocar o código
MercadoPago\SDK::setAccessToken($accessToken);

if (!isset($_SESSION['cliente_id'])){
    http_response_code(401); 
    echo json_encode(['status' => 'erro', 'mensagem' => 'Acesso negado. Necessário fazer login.']);
    exit;
}
$cliente_id = $_SESSION['cliente_id']; 


$dados_compra = [
    'lote_id' => $_POST['lote_id'] ?? null,
    'quantidade' => (int)($_POST['quantidade'] ?? 0),
    'evento_nome' => 'Semana de Tecnologia IF',
    'cupom_codigo' => trim($_POST['cupom_codigo'] ?? '')
];


if ($dados_compra['lote_id'] <= 0 || $dados_compra['quantidade'] <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados de compra incompletos.']);
    exit;
}


$desconto = 0.00;
$cupom_id = null;
$taxa_percentual = 0.10;


try {
    $conexao = new Conexao();
    $db = $conexao->getConexao();
    $db->beginTransaction();


    $stmt_lote = $db->prepare("
        SELECT l.preco, l.setor_id FROM lote l WHERE l.id = ? AND l.status = 'ativo'
    ");
    $stmt_lote->execute([$dados_compra['lote_id']]);
    $lote = $stmt_lote->fetch(PDO::FETCH_ASSOC);


    if (!$lote) {
        throw new Exception("Lote de ingresso inválido ou inativo.");
    }

    $preco_unitario = $lote['preco'];
    $setor_id = $lote['setor_id'];
    $valor_bruto = $dados_compra['quantidade'] * $preco_unitario;


    if (!empty($dados_compra['cupom_codigo'])) {
        $stmt_cupom = $db->prepare("
            SELECT id, valor FROM cupom
            WHERE codigo = ? AND tipo = 'valor' AND periodo_fim > NOW()
        ");
        $stmt_cupom->execute([$dados_compra['cupom_codigo']]);
        $cupom = $stmt_cupom->fetch(PDO::FETCH_ASSOC);
        if ($cupom) {
            $desconto = $cupom['valor'];
            $cupom_id = $cupom['id'];
        }
    }

    $taxa = $valor_bruto * $taxa_percentual;
    $total_liquido = $valor_bruto + $taxa - $desconto;
    if ($total_liquido <= 0) $total_liquido = 0.01;


    $stmt_pedido = $db->prepare("
        INSERT INTO pedido
        (cliente_id, canal_venda, setor_id, lote_id, quantidade, valor_bruto, taxa, desconto, total_liquido, cupom_id, status)
        VALUES (?, 'ecommerce', ?, ?, ?, ?, ?, ?, ?, ?, 'pendente')
    ");
    $stmt_pedido->execute([
        $cliente_id, $setor_id, $dados_compra['lote_id'], $dados_compra['quantidade'],
        $valor_bruto, $taxa, $desconto, $total_liquido, $cupom_id
    ]);
    $pedido_id = $db->lastInsertId();


    $stmt_pagamento = $db->prepare("
        INSERT INTO pagamento (pedido_id, metodo, status, valor, taxa)
        VALUES (?, 'cartao', 'pendente', ?, ?)
    ");
    $stmt_pagamento->execute([$pedido_id, $total_liquido, $taxa]);

    $db->commit();

    $preference = new MercadoPago\Preference();
    $item = new MercadoPago\Item();
    $item->title = $dados_compra['evento_nome'] . " (Pedido #{$pedido_id})";
    $item->quantity = 1;
    $item->unit_price = $total_liquido;
    $preference->items = [$item];


    $preference->back_urls = [
        "success" => "http://localhost/projeto_backend_2025/pages/sucesso.php?pedido_id={$pedido_id}",
        "failure" => "http://localhost/projeto_backend_2025/pages/falha.php"
    ];
    $preference->auto_return = "approved";
    $preference->notification_url = "URL_PÚBLICA/api/webhook_mercadopago.php";
    $preference->external_reference = (string)$pedido_id;

    $preference->save();


    echo json_encode(['status' => 'ok', 'link_pagamento' => $preference->init_point]);


} catch (Exception $e) {
    if (isset($db) && $db->inTransaction()) $db->rollBack();
    error_log("Erro ao Criar Pedido: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao processar o pedido: ' . $e->getMessage()]);
}
?>