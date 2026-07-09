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
        <div class="title"><a href="/inicio.php"><img src="/img/VisiteAlegreLogo.png" alt=""></a></div>
        <menu>
            <nav>
                <a href="/inicio.php"><img src="img/inicio.svg" alt=""><span>Início</span></a>
                <a href="/pontos.php" class="ativo"><img src="img/pontos.svg" alt=""><span>Pontos Turísticos</span></a>
                <a href="/eventos.php"><img src="img/eventos.svg" alt=""><span>Eventos</span></a>
                <a href="/roteiro.php"><img src="img/roteiro.svg" alt=""><span>Roteiro</span></a>
                <a href="/guias.php"><img src="img/guias.svg" alt=""><span>Guias</span></a>
                <a href="/login.php"><img src="img/sair.svg" alt=""><span>Sair</span></a>
            </nav>
        </menu>
    </header>

    <main>
        
        <div class="painel-guia">
            <div class="cabecalho-guia">
                <div class="bemvindo-texto">
                    <h2>Cadastrar Ponto Turístico</h2>
                    <p>Preencha os dados abaixo para cadastrar um novo ponto turístico.</p>
                </div>

                <div class="guia-imagem">
                    <img src="/img/ratopeiraOi.png" alt="">
                </div>
            </div>

            <div class="cadastro">
                
                <div class="titulo">
                    <img src="/img/pontos.svg" alt="">
                    <h2>Dados do Ponto Turístico</h2>
                </div>


                <div class="dados-guias">
                    <div class="cima">
                        <div class="dado-guia">
                            <label for="nome">Título</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite o título do ponto turístico">
                        </div>

                        <div class="dado-guia">
                            <label for="tel">Telefone</label>
                            <input type="tel" id="tel" name="tel" placeholder="(28) 99999-9999">
                        </div>

                        <div class="dado-guia">
                            <label for="number">Taxa de Entrada</label>
                            <input type="number" id="number" name="number" placeholder="Valor da taxa">
                        </div>
                    </div>

                    <div class="baixo">
                        <div class="dado-guia">
                            <label for="nome">Descrição</label>
                            <input type="text" id="nome" name="nome" placeholder="Descreva o ponto turístico">
                        </div>

                        <div class="dado-guia">
                            <label for="nome">Site</label>
                            <input type="text" id="nome" name="nome" placeholder="Link do site do ponto turístico">
                        </div>
                        
                        <div class="funcionamento">
                            <div class="dado-guia horario">
                                <label for="hora">Abertura</label>
                                <input type="time" id="hora" name="hora">
                            </div>

                            <div class="dado-guia horario">
                                <label for="hora">Fechamento</label>
                                <input type="time" id="hora" name="hora">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="titulo linha">
                    <img src="/img/local.svg" alt="">
                    <h2>Endereço</h2>
                </div>

                <div class="dados-endereco">
                    <div class="cima">
                        <div class="dado-guia">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" id="logradouro" name="logradouro" placeholder="Rua, Avenida, etc.">
                        </div>

                        <div class="dado-guia pequeno">
                            <label for="numero">Número</label>
                            <input type="number" id="numero" name="numero" placeholder="N°">
                        </div>

                        <div class="dado-guia">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" placeholder="Digite o bairro">
                        </div>
                    </div>

                    <div class="baixo">
                        <div class="dado-guia">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" placeholder="Digite a cidade">
                        </div>

                        <div class="dado-guia">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" placeholder="00000-000">
                        </div>
                    </div>
                </div>

                <div class="titulo linha">
                    <img src="/img/pontos.svg" alt="">
                    <h2>Especificações</h2>
                </div>

                <div class="especializacao">
                    <details>
                        <summary>Gastronomia</summary>

                        <div class="dado-guia">
                            <label for="especialidade">Especialidade</label>
                            <input type="text" id="especialidade" name="especialidade" placeholder="Ex: comida mineira, cafeteria, doces">
                        </div>
                    </details>

                    <details>
                        <summary>Trilha</summary>

                        <div class="cima">
                            <div class="dado-guia">
                                <label for="nivel">Nível de dificuldade</label>
                                <select id="nivel" name="nivel">
                                    <option value="">Selecione</option>
                                    <option value="facil">Fácil</option>
                                    <option value="medio">Médio</option>
                                    <option value="dificil">Difícil</option>
                                </select>
                            </div>

                            <div class="dado-guia">
                                <label for="distancia">Distância em km</label>
                                <input type="number" id="distancia" name="distancia" placeholder="Ex: 3.5">
                            </div>

                            <div class="dado-guia">
                                <label for="tempo">Tempo estimado</label>
                                <input type="text" id="tempo" name="tempo" placeholder="Ex: 2 horas">
                            </div>
                        </div>
                    </details>

                    <details>
                        <summary>Parque</summary>

                        <div class="dado-guia">
                            <label for="area-total">Área total</label>
                            <input type="text" id="area-total" name="area-total" placeholder="Ex: 5000 m²">
                        </div>
                    </details>

                    <details>
                        <summary>Local Histórico</summary>

                        <div class="cima">
                            <div class="dado-guia">
                                <label for="data-construcao">Data de construção</label>
                                <input type="date" id="data-construcao" name="data-construcao">
                            </div>

                            <div class="dado-guia">
                                <label for="estilo">Estilo arquitetônico</label>
                                <input type="text" id="estilo" name="estilo" placeholder="Ex: colonial, moderno">
                            </div>
                        </div>
                    </details>

                    <details>
                        <summary>Local Científico</summary>

                        <div class="cima">
                            <div class="dado-guia">
                                <label for="area-pesquisa">Área de pesquisa</label>
                                <input type="text" id="area-pesquisa" name="area-pesquisa" placeholder="Ex: biologia, tecnologia">
                            </div>

                            <div class="dado-guia">
                                <label for="instituicao">Instituição responsável</label>
                                <input type="text" id="instituicao" name="instituicao" placeholder="Ex: UFES">
                            </div>
                        </div>
                    </details>
                </div>
                <a href="/inicio.html">
                    <div class="salvar">
                        <p>Salvar Ponto</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="painel-guia">
            <div class="cabecalho-guia">
                <div class="bemvindo-texto">
                    <h2>Histórico de Pontos</h2>
                    <p>Confira a lista de todos os pontos cadastrados.</p>
                </div>

                <div class="guia-imagem">
                    <img src="/img/ratopeiraCamera.png" alt="">
                </div>
            </div>

            <div class="lista">
                <div class="tabela">
                    <table>
                        <tr>
                            <td><b>Título</b></td>
                            <td><b>Telefone</b></td>
                            <td><b>Taxa de Entrada</b></td>
                            <td><b>Descrição</b></td>
                        </tr>
                        <?php
                            try {
                                // Buscando todos pontos turisticos
                                $sqlPontos = "SELECT nome, telefone, taxaEntrada, descricao FROM PontoTuristico ORDER BY nome ASC";
                                $stmtPontos = $pdo->query($sqlPontos);
                                $pontos = $stmtPontos->fetchAll(PDO::FETCH_ASSOC);

                                // Verifica se encontrou algum ponto turístico
                                if (!empty($pontos)):
                                    foreach ($pontos as $ponto):
                            ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($ponto['nome']); ?></td>
                                            
                                            <td><?php echo !empty($ponto['telefone']) ? htmlspecialchars($ponto['telefone']) : '<span style="color: #999;">Não informado</span>'; ?></td>
                                            
                                            <td>
                                                <?php 
                                                if ($ponto['taxaEntrada'] > 0) {
                                                    echo 'R$ ' . number_format($ponto['taxaEntrada'], 2, ',', '.');
                                                } else {
                                                    echo '<span style="color: #28a745; font-weight: 500;">Gratuito</span>';
                                                }
                                                ?>
                                            </td>
                                            
                                            <td><?php echo htmlspecialchars($ponto['descricao'] ?? 'Sem descrição'); ?></td>
                                        </tr>
                            <?php 
                                    endforeach;
                                else: 
                            ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 20px; color: #666;">
                                            Nenhum ponto turístico registado no sistema.
                                        </td>
                                    </tr>
                            <?php 
                                endif;
                            } catch (PDOException $e) {
                                echo "<tr><td colspan='4' style='color: red; text-align: center;'>Erro ao carregar pontos: " . $e->getMessage() . "</td></tr>";
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