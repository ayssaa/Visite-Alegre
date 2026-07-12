<?php

include_once 'conexao.php';

$idGuia = $_GET["id"];
$stmt = $pdo->prepare("
    SELECT
        u.idUsuario,
        u.nome,
        u.cpf,
        u.email,
        u.telefone,
        u.senha,
        g.anoExperiencia,
        e.logradouro,
        e.numero,
        e.bairro,
        e.cep,
        c.nome AS cidade,
        c.uf
    FROM Usuario u
    INNER JOIN Guia g
        ON u.idUsuario = g.idGuia
    INNER JOIN Endereco e
        ON u.idEndereco = e.idEndereco
    INNER JOIN Cidade c
        ON e.idCidade = c.idCidade
    WHERE u.idUsuario = ?
");

$stmt->execute([$idGuia]);

$guia = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($guia);
?>