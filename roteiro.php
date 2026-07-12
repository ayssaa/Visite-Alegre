<?php include_once 'conexao.php'; ?>

<!--
    Parte da página de roteiros
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
                <a href="inicio.php"><img src="img/inicio.svg" alt=""><span>Início</span></a>
                <a href="pontos.php"><img src="img/pontos.svg" alt=""><span>Pontos Turísticos</span></a>
                <a href="eventos.php"><img src="img/eventos.svg" alt=""><span>Eventos</span></a>
                <a href="roteiro.php" class="ativo"><img src="img/roteiro.svg" alt=""><span>Roteiro</span></a>
                <a href="guias.php"><img src="img/guias.svg" alt=""><span>Guias</span></a>
                <a href="login.php"><img src="img/sair.svg" alt=""><span>Sair</span></a>
            </nav>
        </menu>
    </header>

    <main>

        <!--
            Cabeçalho com título e Ratopeira
        -->
        
        <div class="painel-guia">
            <div class="cabecalho-guia">
                <div class="bemvindo-texto">
                    <h2>Cadastrar Roteiro</h2>
                    <p>Preencha os dados abaixo para cadastrar um novo roteiro.</p>
                </div>

                <div class="guia-imagem">
                    <img src="img/ratoperaMapa.png" alt="">
                </div>
            </div>

            <!--
                Cadastro dos roteiros
            -->

            <div class="cadastro">
                
                <div class="titulo">
                    <img src="img/roteiro.svg" alt="">
                    <h2>Dados do Roteiro</h2>
                </div>


                <div class="dados-guias">
                    <div class="cima">

                        <div class="dado-guia">
                            <label for="ponto-turistico">Guia responsável</label>

                            <input list="pontos-turisticos" id="ponto-turistico" name="ponto-turistico" placeholder="Pesquise o nome do guia">

                            <datalist id="pontos-turisticos">
                                <option value="Ayssa">
                                <option value="Guilherme">
                                <option value="Antonio">
                                <option value="Ratopeira">
                                <option value="André">
                                <option value="Bruno">
                                <option value="Juliana">
                            </datalist>
                        </div>

                        <div class="dado-guia">
                            <label for="date">Data</label>
                            <input type="date" id="date" name="date">
                        </div>

                        <div class="dado-guia">
                            <label for="number">Capacidade Máxima</label>
                            <input type="number" id="number" name="number" placeholder="Capacidade">
                        </div>
                    </div>
                </div>

                <div class="titulo linha">
                    <img src="img/local.svg" alt="">
                    <h2>Local de encontro</h2>
                </div>

                <div class="dados-endereco">
                    <div class="cima">
                        <div class="dado-guia">
                            <label for="encontro">Local de Encontro</label>
                            <input type="text" id="encontro" name="encontro" placeholder="Descreva o local de encontro">
                        </div>
                    </div>
                </div>

                <div class="titulo linha">
                    <img src="img/local.svg" alt="">
                    <h2>Pontos Turísticos Presentes no Roteiro</h2>
                </div>

                <div class="dados-endereco">

                    <div id="listaPontosTuristicos">
                        <div class="grupo-ponto">
                            <div class="cima">
                                <div class="dado-guia">
                                    <label>Ponto Turístico</label>
                                    <input type="text" name="ponto_turistico[]" class="ponto_turistico"
                                        placeholder="Nome do ponto turístico">
                                </div>

                                <div class="dado-guia">
                                    <label>Hora Início</label>
                                    <input type="time" name="hora_inicio[]" class="hora_inicio">
                                </div>

                                <div class="dado-guia">
                                    <label>Hora Fim</label>
                                    <input type="time" name="hora_fim[]" class="hora_fim">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="botaoSalvar">
                        <button type="button" id="btnAdicionarPonto">+</button>
                    </div>

                </div>

                <a href="roteiro.php">
                    <div class="salvar">
                        <p>Salvar roteiro</p>
                    </div>
                </a>
            </div>
        </div>

        <!--
            Historico dos roteiros
        -->

        <div class="painel-guia" id="historico">
            <div class="cabecalho-guia">
                <div class="bemvindo-texto">
                    <h2>Histórico de Roteiros</h2>
                    <p>Confira a lista de todos os roteiros cadastrados.</p>
                </div>

                <div class="guia-imagem">
                    <img src="img/ratopeiraCamera.png" alt="">
                </div>
            </div>

            <div class="lista">
                <div class="tabela">
                    <table>
                        <tr>
                            <td><b>Guia Responsável</b></td>
                            <td><b>Data</b></td>
                            <td><b>Capacidade Máxima</b></td>
                            <td><b>Local de Encontro</b></td>
                        </tr>
                        
                        <?php
                        try {
                            $sqlRoteiros = "
                                SELECT 
                                    u.nome AS nome_guia, 
                                    DATE_FORMAT(r.dataRoteiro, '%d/%m/%Y') AS data_formatada, 
                                    r.capacidadeMaxima, 
                                    r.localEncontro 
                                FROM Roteiro r
                                INNER JOIN Usuario u ON r.idGuia = u.idUsuario
                                ORDER BY r.dataRoteiro ASC
                            ";
                            $stmtRoteiros = $pdo->prepare($sqlRoteiros);
                            $stmtRoteiros->execute();

                            $roteiros = $stmtRoteiros->fetchAll(PDO::FETCH_ASSOC);

                            if (!empty($roteiros)):
                                foreach ($roteiros as $roteiro):
                        ?>
                                    <tr>
                                        <td><?= htmlspecialchars($roteiro['nome_guia']) ?></td>
                                        <td><?= htmlspecialchars($roteiro['data_formatada']) ?></td>
                                        <td><?= htmlspecialchars($roteiro['capacidadeMaxima']) ?> pessoas</td>
                                        <td><?= htmlspecialchars($roteiro['localEncontro']) ?></td>
                                    </tr>
                        <?php 
                                endforeach;
                            else: 
                        ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 20px; color: #666;">
                                        Nenhum roteiro cadastrado.
                                    </td>
                                </tr>
                        <?php 
                            endif;
                        } catch (PDOException $e) {
                            echo "<tr><td colspan='4' style='color: red; text-align: center;'>Erro ao carregar roteiros: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
    <script src="script.js"></script>
</body>
</html>