<?php include_once 'conexao.php'; ?>

<?php
$totalPontos = 0;
$totalEventos = 0;
$totalRoteiros = 0;
$totalGuias = 0;
$proximosEventos = [];
$atividadesRecentes = [];

try {
    $sql = "SELECT COUNT(*) FROM pontoturistico"; // contando quantos pontos turisticos existem no banco
    $stmt = $pdo->query($sql);
    $totalPontos = $stmt->fetchColumn();

    $sql = "SELECT COUNT(*) FROM evento"; // contando quantos eventos existem no banco
    $stmt = $pdo->query($sql);
    $totalEventos = $stmt->fetchColumn();

    $sql = "SELECT COUNT(*) FROM roteiro"; // contando quantos roteiros existem no banco
    $stmt = $pdo->query($sql);
    $totalRoteiros = $stmt->fetchColumn();

    $sql = "SELECT COUNT(*) FROM guia"; // contando quantos guias existem no banco
    $stmt = $pdo->query($sql);
    $totalGuias = $stmt->fetchColumn();

    $sqlEventos = "
        SELECT 
            'img/eventos.svg' AS caminho_imagem,
            e.titulo, 
            DATE_FORMAT(e.dataEvento, '%d/%m/%Y') AS data_evento,
            pt.nome AS local
        FROM Evento e
        INNER JOIN PontoTuristico pt ON e.idPontoTuristico = pt.idPontoTuristico
        WHERE e.dataEvento >= CURDATE()
        ORDER BY e.dataEvento ASC
        LIMIT 4
    ";
    $stmtEventos = $pdo->query($sqlEventos);
    $proximosEventos = $stmtEventos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Se der algum erro na busca, a variável continua como 0 e não quebra a tela
    // Você pode registrar o erro se quiser, mas para o usuário final, mostraremos 0.
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Visite Alegre</title>
</head>
<body>

    <header>
        <div class="title"><a href="/inicio.php"><img src="/img/VisiteAlegreLogo.png" alt=""></a></div>
        <menu>
            <nav>
                <a href="/inicio.php" class="ativo"><img src="img/inicio.svg" alt=""><span>Início</span></a>
                <a href="/pontos.php"><img src="img/pontos.svg" alt=""><span>Pontos Turísticos</span></a>
                <a href="/eventos.php"><img src="img/eventos.svg" alt=""><span>Eventos</span></a>
                <a href="/roteiro.php"><img src="img/roteiro.svg" alt=""><span>Roteiro</span></a>
                <a href="/guias.php"><img src="img/guias.svg" alt=""><span>Guias</span></a>
                <a href="/login.php"><img src="img/sair.svg" alt=""><span>Sair</span></a>
            </nav>
        </menu>
    </header>

    <main>
        
        <div class="bemvindo">
            <img src="/img/RatoPelado.png" alt="">
            
            <div class="bemvindo-texto">
                <h1>Olá, Gestor!</h1>
                <h2>Bem-vindo ao painel</h2>
                <p>Gerencie os Pontos Turísticos, Eventos, Roteiros e guias de forma eficiente.</p>
            </div>
        </div>

        <div class="painel">
            <div class="todos-cartao">
                <div class="cartao">
                    <div class="painel-imagem">
                        <img src="img/pontos.svg" alt="">
                    </div>

                    <div class="painel-texto">
                        <h3>Pontos turísticos</h3>
                        <h2><?php echo $totalPontos ?? 0; ?></h2>
                        <a href="#">Ver todos</a>
                    </div>
                </div>

                <div class="cartao">
                    <div class="painel-imagem">
                        <img src="img/eventos.svg" alt="">
                    </div>

                    <div class="painel-texto">
                        <h3>Eventos ativos</h3>
                        <h2><?php echo $totalEventos ?? 0; ?></h2>
                        <a href="#">Ver todos</a>
                    </div>
                </div>

                <div class="cartao">
                    <div class="painel-imagem">
                        <img src="img/roteiro.svg" alt="">
                    </div>

                    <div class="painel-texto">
                        <h3>Roteiros cadastrados</h3>
                        <h2><?php echo $totalRoteiros ?? 0; ?></h2>
                        <a href="#">Ver todos</a>
                    </div>
                </div>

                <div class="cartao">
                    <div class="painel-imagem">
                        <img src="img/guias.svg" alt="">
                    </div>
                
                    <div class="painel-texto">
                        <h3>Guias</h3>
                        <h2><?php echo $totalGuias ?? 0; ?></h2>
                        <a href="#">Ver todos</a>
                    </div>
                </div>
            </div>
            <div class="meio-pagina">
                <div class="atividade-recente">

                    <div class="cabecalho">
                        <h3>Atividades Recentes</h3>

                        <a href="#">
                            <div class="ver-todas">
                                <p>Ver todas</p>
                            </div>
                        </a>
                    </div>

                    <div class="tabela">
                        <table>
                            <tr>
                                <td>Tipo</td>
                                <td>Descrição</td>
                                <td>Usuário</td>
                                <td>Data</td>
                            </tr>
                            <?php 
                            // Verifica se a variável existe e tem dados antes de tentar listar
                            if (!empty($atividadesRecentes)): 
                                foreach ($atividadesRecentes as $atividade): 
                            ?>
                                <tr>
                                    <td><img src="<?php echo $atividade['caminho_icone']; ?>" alt="Ícone da atividade"></td>
                                    
                                    <td><?php echo $atividade['descricao']; ?></td>
                                    <td><?php echo $atividade['nome_usuario']; ?></td>
                                    <td><?php echo $atividade['data_registro']; ?></td>
                                </tr>
                            <?php 
                                endforeach; 
                            else: 
                            ?>
                                <tr>
                                    <td colspan="4" style="text-align: center;">Nenhuma atividade recente encontrada.</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>

                <div class="proximos-eventos">

                    <div class="cabecalho">
                        <h3>Próximos Eventos</h3>

                        <a href="#">
                            <div class="ver-todas">
                                <p>Ver todas</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="eventos">
                        <?php 
                        // Verifica se a variável de eventos tem dados para exibir
                        if (!empty($proximosEventos)): 
                            foreach ($proximosEventos as $evento): 
                        ?>
                            <div class="cartao-evento">

                                <div class="evento-texto">
                                    <h3><?php echo $evento['titulo']; ?></h3>
                                    
                                    <div class="item">
                                        <div class="evento-mini"><img src="img/eventos.svg" alt="Data"></div>
                                        <h2><?php echo $evento['data_evento']; ?></h2>
                                    </div>
                                    
                                    <div class="item">
                                        <div class="evento-mini"><img src="img/local.svg" alt="Local"></div>
                                        <h2><?php echo $evento['local']; ?></h2>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endforeach; 
                        else: 
                        ?>
                                <p style="text-align: center; width: 100%; color: #666; padding: 20px;">
                                    Nenhum evento programado para os próximos dias.
                                </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>

    </footer>

    <script src="script.js"></script>
</body>
</html>