<?php include_once 'conexao.php'; ?>

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
        <div class="title"><a href="inicio.php"><img src="img/VisiteAlegreLogo.png" alt=""></a></div>
        <menu>
            <nav>
                <a href="inicio.php"><img src="img/inicio.svg" alt=""><span>Início</span></a>
                <a href="pontos.php"><img src="img/pontos.svg" alt=""><span>Pontos Turísticos</span></a>
                <a href="eventos.php" class="ativo"><img src="img/eventos.svg" alt=""><span>Eventos</span></a>
                <a href="roteiro.php"><img src="img/roteiro.svg" alt=""><span>Roteiro</span></a>
                <a href="guias.php"><img src="img/guias.svg" alt=""><span>Guias</span></a>
                <a href="login.php"><img src="img/sair.svg" alt=""><span>Sair</span></a>
            </nav>
        </menu>
    </header>

    <main>
        
        <div class="painel-guia">
            <div class="cabecalho-guia">
                <div class="bemvindo-texto">
                    <h2>Cadastrar Evento</h2>
                    <p>Preencha os dados abaixo para cadastrar um novo evento.</p>
                </div>

                <div class="guia-imagem-evento">
                    <img src="img/RatopeiraEvento.png" alt="">
                </div>
            </div>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $pontoTuristico = $_POST["ponto-turistico"];

                    $stmt = $pdo->prepare("
                        SELECT idPontoTuristico
                        FROM pontoturistico
                        WHERE nome = ?
                    ");

                    $stmt->execute([$pontoTuristico]);
                    $ponto = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($ponto) {
                        $idPontoTuristico = $ponto["idPontoTuristico"];
                    } else {
                        echo "Ponto turístico não encontrado.";
                    }


                    $titulo = $_POST["titulo"];
                    $date = $_POST["date"];
                    $number = $_POST["number"];
                    $tipoEvento = $_POST["tipoEvento"];

                    $stmt = $pdo->prepare("
                        SELECT idEvento
                        FROM evento
                        WHERE titulo = ?
                        AND dataEvento = ?
                        AND taxaEntrada = ?
                        AND tipoEvento = ?
                        AND idPontoTuristico = ?
                    ");

                    $stmt->execute([
                        $titulo,
                        $date,
                        $number,
                        $tipoEvento,
                        $idPontoTuristico
                    ]);

                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($result) {
                        echo "Já existe um evento com essas informações.";
                    } else {

                        $stmt = $pdo->prepare("
                            INSERT INTO evento
                            (titulo, dataEvento, taxaEntrada, tipoEvento, idPontoTuristico)
                            VALUES (?, ?, ?, ?, ?)
                        ");

                        $stmt->execute([
                            $titulo,
                            $date,
                            $number,
                            $tipoEvento,
                            $idPontoTuristico
                        ]);

                        echo "Evento cadastrado com sucesso!";
                    }
                }
            ?>

            <form method="POST">
                <div class="cadastro">
                    
                    <div class="titulo">
                        <img src="img/eventos.svg" alt="">
                        <h2>Dados do Evento</h2>
                    </div>


                    <div class="dados-guias">
                        <div class="cima">
                            <div class="dado-guia">
                                <label for="nome">Título</label>
                                <input type="text" id="titulo" name="titulo" placeholder="Digite o título do evento">
                            </div>

                            <div class="dado-guia">
                                <label for="date">Data</label>
                                <input type="date" id="date" name="date">
                            </div>

                            <div class="dado-guia">
                                <label for="number">Taxa de Entrada</label>
                                <input type="number" id="number" name="number" placeholder="Valor da taxa">
                            </div>

                        </div>

                        <div class="baixo">
                            <div class="dado-guia">
                                <div class="dado-guia">
                                    <label for="nome">Tipo do evento</label>
                                    <input type="text" id="tipoEvento" name="tipoEvento" placeholder="Descreva o evento">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="titulo linha">
                        <img src="img/local.svg" alt="">
                        <h2>Endereço</h2>
                    </div>

                    <?php
                        $stmt = $pdo->query("
                            SELECT nome
                            FROM pontoturistico
                            ORDER BY nome
                        ");

                        $pontos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <div class="dados-endereco">
                        <div class="cima">
                            <div class="dado-guia">
                                <label for="ponto-turistico">
                                    Ponto Turístico onde está o evento
                                </label>

                                <input
                                    list="pontos-turisticos"
                                    id="ponto-turistico"
                                    name="ponto-turistico"
                                    placeholder="Pesquise um ponto turístico"
                                >

                                <datalist id="pontos-turisticos">
                                    <?php foreach ($pontos as $ponto): ?>
                                        <option value="<?= htmlspecialchars($ponto['nome']) ?>">
                                    <?php endforeach; ?>
                                </datalist>

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="salvar">
                        <p>Salvar Evento</p>
                    </button>
                </div>
            </form>
        </div>

        <div class="painel-guia" id="historico">
            <div class="cabecalho-guia">
                <div class="bemvindo-texto">
                    <h2>Histórico de Eventos</h2>
                    <p>Confira a lista de todos os eventos cadastrados.</p>
                </div>

                <div class="guia-imagem">
                    <img src="img/ratopeiraCamera.png" alt="">
                </div>
            </div>

            <div class="lista">
                <div class="tabela">
                    <table>
                        <tr>
                            <td><b>Nome</b></td>
                            <td><b>Data</b></td>
                            <td><b>Local do Evento</b></td>
                            <td><b>Taxa de Entrada</b></td>
                            <td><b>Tipo do Evento</b></td>
                        </tr>
                        
                        <?php
                        try {
                            $sqlEventos = "
                                SELECT
                                    e.titulo AS nome_evento,
                                    DATE_FORMAT(e.dataEvento, '%d/%m/%Y') AS dataEvento,
                                    pt.nome AS localEvento,
                                    e.taxaEntrada AS taxaEntrada,
                                    e.tipoEvento AS tipoEvento
                                FROM Evento e
                                INNER JOIN PontoTuristico pt ON pt.idPontoTuristico = e.idPontoTuristico
                                ORDER BY e.dataEvento ASC
                            ";
                            $stmtEventos = $pdo->query($sqlEventos);
                            $eventos = $stmtEventos->fetchAll(PDO::FETCH_ASSOC);

                            // Verifica se encontrou algum evento
                            if (!empty($eventos)):
                                foreach ($eventos as $evento):
                        ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($evento['nome_evento']); ?></td>
                                        <td><?php echo htmlspecialchars($evento['dataEvento']); ?></td>
                                        <td><?php echo htmlspecialchars($evento['localEvento']); ?></td>
                                        <td>
                                                <?php 
                                                if ($evento['taxaEntrada'] > 0) {
                                                    echo 'R$ ' . number_format($evento['taxaEntrada'], 2, ',', '.');
                                                } else {
                                                    echo '<span style="color: #28a745; font-weight: 500;">Gratuito</span>';
                                                }
                                                ?>
                                            </td>
                                        <td><?php echo htmlspecialchars($evento['tipoEvento']); ?></td>
                                    </tr>
                        <?php 
                                endforeach;
                            else: 
                        ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 20px; color: #666;">
                                        Nenhum evento cadastrado no sistema.
                                    </td>
                                </tr>
                        <?php 
                            endif;
                        } catch (PDOException $e) {
                            echo "<tr><td colspan='4' style='color: red; text-align: center;'>Erro ao carregar eventos: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        
    </main>

    <footer>

    </footer>

    <script src="script.js"></script>
</body>
</html>