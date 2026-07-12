<!--
    Parte da Lógica do PHP
-->

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

    $sqlPontos = "
    SELECT
        pt.nome,
        pt.taxaEntrada,
        ROUND(AVG(a.nota), 1) AS media,
        COUNT(a.idAvaliacao) AS qtdAvaliacoes
    FROM PontoTuristico pt
    INNER JOIN Avaliacao a
        ON pt.idPontoTuristico = a.idPontoTuristico
    GROUP BY
        pt.idPontoTuristico,
        pt.nome,
        pt.taxaEntrada
    ORDER BY media DESC, qtdAvaliacoes DESC
    LIMIT 4
    ";

    $stmtPontos = $pdo->query($sqlPontos);
    $pontosBemAvaliados = $stmtPontos->fetchAll(PDO::FETCH_ASSOC);

    $sqlRoteiros = "
    SELECT
        r.idRoteiro,
        r.dataRoteiro,
        r.localEncontro,
        u.nome AS guia,
        rp.tempoInicio,
        DATE_FORMAT(r.dataRoteiro, '%d') AS dia,
        UPPER(DATE_FORMAT(r.dataRoteiro, '%b')) AS mes,
        pt.nome AS titulo
    FROM Roteiro r
    INNER JOIN Guia g
        ON g.idGuia = r.idGuia
    INNER JOIN Usuario u
        ON u.idUsuario = g.idGuia
    INNER JOIN Roteiro_PontoTuristico rp
        ON rp.idRoteiro = r.idRoteiro
    INNER JOIN PontoTuristico pt
        ON pt.idPontoTuristico = rp.idPontoTuristico
    WHERE r.dataRoteiro >= CURDATE()
    ORDER BY r.dataRoteiro, rp.tempoInicio
    LIMIT 4
    ";

    $stmtRoteiros = $pdo->query($sqlRoteiros);
    $proximosRoteiros = $stmtRoteiros->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {}
?>

<!--
    Parte do Visite Alegre em si
-->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Visite Alegre</title>
</head>
<body>

    <!--
        Menu do Inicio
    -->

    <header>
        <div class="title"><a href="inicio.php"><img src="img/VisiteAlegreLogo.png" alt=""></a></div>
        <menu>
            <nav>
                <a href="inicio.php" class="ativo"><img src="img/inicio.svg" alt=""><span>Início</span></a>
                <a href="pontos.php"><img src="img/pontos.svg" alt=""><span>Pontos Turísticos</span></a>
                <a href="eventos.php"><img src="img/eventos.svg" alt=""><span>Eventos</span></a>
                <a href="roteiro.php"><img src="img/roteiro.svg" alt=""><span>Roteiro</span></a>
                <a href="guias.php"><img src="img/guias.svg" alt=""><span>Guias</span></a>
                <a href="login.php"><img src="img/sair.svg" alt=""><span>Sair</span></a>
            </nav>
        </menu>
    </header>

    <main>

        <!--
            Esse 'bemvindo' é a faixa branca com o RatoPeira
        -->
        
        <div class="bemvindo">
            <img src="img/RatoPelado.png" alt="">
            
            <div class="bemvindo-texto">
                <h1>Olá, Gestor!</h1>
                <h2>Bem-vindo ao painel</h2>
                <p>Gerencie os Pontos Turísticos, Eventos, Roteiros e guias de forma eficiente.</p>
            </div>
        </div>

        <!--
            O 'painel' é o dasboard para o gestor
        -->

        <div class="painel">
            
            <!-- O 'todos-cartao' são os 4 cartões com os valores de pontos, eventos, roteiros e guias armazenados no banco de dados -->
            <div class="todos-cartao">
                <div class="cartao">
                    <div class="painel-imagem">
                        <img src="img/pontos.svg" alt="">
                    </div>

                    <div class="painel-texto">
                        <h3>Pontos</h3>
                        <h2><?php echo $totalPontos ?? 0; ?></h2>
                        <div class="ver-todos"><a href="pontos.php#historico">Ver todos</a></div>
                    </div>
                </div>

                <div class="cartao">
                    <div class="painel-imagem">
                        <img src="img/eventos.svg" alt="">
                    </div>

                    <div class="painel-texto">
                        <h3>Eventos</h3>
                        <h2><?php echo $totalEventos ?? 0; ?></h2>
                        <div class="ver-todos"><a href="eventos.php#historico">Ver todos</a></div>
                    </div>
                </div>

                <div class="cartao">
                    <div class="painel-imagem">
                        <img src="img/roteiro.svg" alt="">
                    </div>

                    <div class="painel-texto">
                        <h3>Roteiros</h3>
                        <h2><?php echo $totalRoteiros ?? 0; ?></h2>
                        <div class="ver-todos"><a href="roteiro.php#historico">Ver todos</a></div>
                    </div>
                </div>

                <div class="cartao">
                    <div class="painel-imagem">
                        <img src="img/guias.svg" alt="">
                    </div>
                
                    <div class="painel-texto">
                        <h3>Guias</h3>
                        <h2><?php echo $totalGuias ?? 0; ?></h2>
                        <div class="ver-todos"><a href="guias.php#historico">Ver todos</a></div>
                    </div>
                </div>
            </div>
            
            <!-- O 'meio-pagina' são as 3 colunas de informações sobre pontos bem avaliados, proximos roteiros e proximos eventos -->
            <div class="meio-pagina">

                <!-- Aqui é a coluna de 'Pontos Mais Bem Avaliados' -->
                <div class="proximos-eventos">

                    <div class="cabecalho">
                        <img src="img/pontos.svg" alt="" class="icone">
                        <h3>Pontos mais bem avaliados</h3>
                    </div>

                    <div class="eventos">
                        <?php
                        if (!empty($pontosBemAvaliados)):
                            foreach ($pontosBemAvaliados as $ponto):
                        ?>
                            <div class="cartao-ponto">
                                <div class="conteudo-ponto">

                                    <div class="estrela-aninhada">
                                        <h3><?php echo $ponto['nome']; ?></h3>

                                        <div class="estrelas-ponto">
                                            <?php echo str_repeat("⭐", floor($ponto['media'])); ?>
                                        </div>
                                    </div>

                                    <div class="avaliacao-ponto">
                                        <span class="nota">
                                            <?php echo number_format($ponto['media'], 1, ',', '.'); ?>
                                        </span>
                                    </div>

                                </div>
                            </div>

                        <?php
                            endforeach;
                        else:
                        ?>
                            <p style="color:#666">
                                Nenhum ponto avaliado.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Aqui é a coluna de 'Próximos Roteiros' -->
                <div class="proximos-eventos">

                    <div class="cabecalho">
                        <img src="img/pontos.svg" alt="" class="icone">
                        <h3>Próximos Roteiros</h3>
                    </div>

                    <div class="eventos">
                        <?php if (!empty($proximosRoteiros)): ?>

                            <?php foreach ($proximosRoteiros as $roteiro): ?>

                                <div class="roteiro-cartao">

                                    <div class="roteiro-data">
                                        <span class="dia"><?php echo $roteiro['dia']; ?></span>
                                        <span class="mes"><?php echo $roteiro['mes']; ?></span>
                                    </div>

                                    <div class="roteiro-info">

                                        <h3><?php echo $roteiro['titulo']; ?></h3>

                                        <p>
                                            <img src="img/guias.svg" alt="" class="icone">
                                            Guia: <?php echo $roteiro['guia']; ?>
                                        </p>

                                        <p>
                                            <img src="img/local.svg" alt="" class="icone">
                                            Local de encontro: <?php echo $roteiro['localEncontro']; ?>
                                        </p>

                                    </div>

                                    <div class="roteiro-hora">
                                        <img src="img/relogio.svg" alt="">
                                        <?php echo substr($roteiro['tempoInicio'], 0, 5); ?>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="color:#666;">
                                Nenhum roteiro programado.
                            </p>
                        <?php endif; ?>

                    </div>

                </div>

                <!-- Aqui é a coluna de 'Próximos Eventos' -->
                <div class="proximos-eventos">
                    <div class="cabecalho">
                        <img src="img/eventos.svg" alt="" class="icone"><h3>Próximos Eventos</h3>
                    </div>
                    
                    <div class="eventos">
                        <?php 
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

    <footer></footer>

    <script src="script.js"></script>
</body>
</html>