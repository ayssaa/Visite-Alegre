<?php include_once 'conexao.php'; ?>

<!--
    Parte da Lógica do PHP
-->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {

        $pdo->beginTransaction();

        $nomeCidade = $_POST["cidade"];
        $uf = $_POST["estado"];

        $stmt = $pdo->prepare("
            SELECT idCidade
            FROM Cidade
            WHERE nome = ? AND uf = ?
        ");

        $stmt->execute([$nomeCidade, $uf]);
        $cidade = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cidade) {

            $idCidade = $cidade["idCidade"];

        } else {

            $stmt = $pdo->prepare("
                INSERT INTO Cidade (nome, uf)
                VALUES (?, ?)
            ");

            $stmt->execute([$nomeCidade, $uf]);

            $idCidade = $pdo->lastInsertId();
        }

        $logradouro = $_POST["logradouro"];
        $numero = $_POST["numero"];
        $bairro = $_POST["bairro"];
        $cep = preg_replace('/\D/', '', $_POST["cep"]);

        $stmt = $pdo->prepare("
            SELECT idEndereco
            FROM Endereco
            WHERE logradouro = ?
            AND numero = ?
            AND bairro = ?
            AND cep = ?
            AND idCidade = ?
        ");

        $stmt->execute([
            $logradouro,
            $numero,
            $bairro,
            $cep,
            $idCidade
        ]);

        $endereco = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($endereco) {

            $idEndereco = $endereco["idEndereco"];

        } else {

            $stmt = $pdo->prepare("
                INSERT INTO Endereco
                (logradouro, numero, bairro, cep, idCidade)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $logradouro,
                $numero,
                $bairro,
                $cep,
                $idCidade
            ]);

            $idEndereco = $pdo->lastInsertId();
        }

        $nome = $_POST["nome"];
        $cpf = preg_replace('/\D/', '', $_POST["cpf"]);
        $email = $_POST["email"];
        $telefone = preg_replace('/\D/', '', $_POST["tel"]);
        $senha = $_POST["senha"];

        $stmt = $pdo->prepare("
            SELECT COUNT(*)
            FROM Usuario
            WHERE cpf = ?
            OR email = ?
        ");

        $stmt->execute([$cpf, $email]);

        if ($stmt->fetchColumn() > 0) {
            throw new Exception("CPF ou e-mail já cadastrados.");
        }

        $stmt = $pdo->prepare("
            INSERT INTO Usuario
            (nome, cpf, email, telefone, idEndereco, senha)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $nome,
            $cpf,
            $email,
            $telefone,
            $idEndereco,
            $senha
        ]);

        $idUsuario = $pdo->lastInsertId();

        $experiencia = $_POST["number"];

        $stmt = $pdo->prepare("
            INSERT INTO Guia
            (idGuia, anoExperiencia)
            VALUES (?, ?)
        ");

        $stmt->execute([
            $idUsuario,
            $experiencia
        ]);

        $pdo->commit();

        echo "<script>alert('Guia cadastrado com sucesso!');</script>";

    } catch (Exception $e) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        if ($e->getMessage() == "CPF ou e-mail já cadastrados.") {

            echo "<script>alert('CPF ou e-mail já cadastrado!');</script>";

        } else {

            echo "<script>alert('Não foi possível cadastrar o guia.');</script>";

            // echo $e->getMessage();
        }
    }
}
?>

<!--
    Parte da página de guias
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
                <a href="roteiro.php"><img src="img/roteiro.svg" alt=""><span>Roteiro</span></a>
                <a href="guias.php" class="ativo"><img src="img/guias.svg" alt=""><span>Guias</span></a>
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
                    <h2>Cadastrar Guia</h2>
                    <p>Preencha os dados abaixo para cadastrar um novo guia turístico.</p>
                </div>

                <div class="guia-imagem">
                    <img src="img/ratopeiraOi.png" alt="">
                </div>
            </div>

            <!--
                Cadastro dos guias
            -->

            <form method="POST">
                <div class="cadastro">
                    
                    <div class="titulo">
                        <img src="img/guias.svg" alt="">
                        <h2>Dados do Guia</h2>
                    </div>

                    <div class="dados-guias">
                        <div class="cima">
                            <div class="dado-guia">
                                <label for="nome">Nome completo</label>
                                <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" required>
                            </div>

                            <div class="dado-guia">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00" required>
                            </div>

                            <div class="dado-guia">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                            </div>
                        </div>

                        <div class="baixo">
                            <div class="dado-guia">
                                <label for="tel">Telefone</label>
                                <input type="tel" id="tel" name="tel" placeholder="(28) 99999-9999" minlength="15" required>
                            </div>

                            <div class="dado-guia">
                                <label for="senha">Senha</label>
                                <input type="password" id="senha" name="senha" minlength="5" maxlength="45" placeholder="Insira uma Senha" required>
                            </div>

                            <div class="dado-guia">
                                <label for="number">Anos de experiência</label>
                                <input type="number" id="number" name="number" min="0" max="99"placeholder="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="titulo linha">
                        <img src="img/local.svg" alt="">
                        <h2>Endereço</h2>
                    </div>

                    <div class="dados-endereco">
                        <div class="cima">
                            <div class="dado-guia">
                                <label for="logradouro">Logradouro</label>
                                <input type="text" id="logradouro" name="logradouro" placeholder="Rua, Avenida, etc." required>
                            </div>

                            <div class="dado-guia pequeno">
                                <label for="numero">Número</label>
                                <input type="number" id="numero" name="numero" placeholder="N°">
                            </div>

                            <div class="dado-guia">
                                <label for="bairro">Bairro</label>
                                <input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" required>
                            </div>
                        </div>

                        <div class="baixo">
                            <div class="dado-guia">
                                <label for="cidade">Cidade</label>
                                <input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" required>
                            </div>

                            <div class="dado-guia pequeno">
                                <label for="estado">UF</label>
                                <select id="estado" name="estado" required>
                                    <option value="">Selecione</option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>

                            <div class="dado-guia">
                                <label for="cep">CEP</label>
                                <input type="text" id="cep" name="cep" maxlength="9" placeholder="00000-000" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="salvar">
                        <p>Salvar guia</p>
                    </button>
                </div>
            </form>
        </div>

        <!--
            Historico de guias no banco de dados
        -->

        <div class="painel-guia" id="historico">
            <div class="cabecalho-guia">
                <div class="bemvindo-texto">
                    <h2>Histórico de Guias</h2>
                    <p>Confira a lista de todos os guias cadastrados.</p>
                </div>
                <div class="guia-imagem">
                    <img src="img/ratopeiraCamera.png" alt="">
                </div>
            </div>

            <!-- Esse php e form são para a barra de pesquisa -->

            <?php
            $busca = trim($_GET['busca'] ?? '');
            ?>

            <form method="GET" class="form-busca">
                <input
                    type="text"
                    name="busca"
                    placeholder="Buscar guia pelo nome..."
                    value="<?= htmlspecialchars($busca) ?>"
                >
                <button type="submit">Pesquisar</button>
            </form>

            <div class="lista">
                <div class="tabela">
                    <table>
                        <tr>
                            <td><b>Nome</b></td>
                            <td><b>Cpf</b></td>
                            <td><b>E-mail</b></td>
                            <td><b>Telefone</b></td>
                            <td><b>Anos de Experiência</b></td>
                            <td><b>Opções</b></td>
                        </tr>
                        
                        <?php
                        try {
                            $sqlGuias = "
                                SELECT 
                                    u.idUsuario AS idGuia,
                                    u.nome AS nome_guia, 
                                    u.cpf AS cpfGuia,
                                    u.email AS emailGuia,
                                    u.telefone AS telefoneGuia,
                                    g.anoExperiencia AS anoExperienciaGuia
                                FROM Usuario u
                                INNER JOIN Guia g ON u.idUsuario = g.idGuia
                            ";

                            $params = [];

                            if ($busca !== '') {
                                $sqlGuias .= " WHERE u.nome LIKE ? ";
                                $params[] = '%' . $busca . '%';
                            }

                            $sqlGuias .= " ORDER BY u.nome ASC ";

                            $stmtGuias = $pdo->prepare($sqlGuias);
                            $stmtGuias->execute($params);
                            $guias = $stmtGuias->fetchAll(PDO::FETCH_ASSOC);

                            if (!empty($guias)):
                                foreach ($guias as $guia):
                        ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($guia['nome_guia']); ?></td>
                                        <td><?php echo htmlspecialchars($guia['cpfGuia']); ?></td>
                                        <td><?php echo htmlspecialchars($guia['emailGuia']); ?></td>
                                        <td><?php echo htmlspecialchars($guia['telefoneGuia']); ?></td>
                                        <td><?php echo htmlspecialchars($guia['anoExperienciaGuia']); ?></td>
                                        
                                        <!-- Coluna com icones de edicao -->

                                        <td class="acoes">
                                            <a href="#"
                                            onclick="abrirModalEditar(<?php echo $guia['idGuia']; ?>)">
                                                <img src="img/editar.svg" alt="Editar" title="Editar" class="icone">
                                            </a>

                                            <a href="excluirGuia.php?id=<?php echo $guia['idGuia']; ?>"
                                            onclick="return confirm('Ao excluir este guia, todos os roteiros vinculados a ele também serão removidos. Deseja continuar?');">
                                                <img src="img/apagar.svg" alt="Excluir" title="Excluir" class="icone">
                                            </a>
                                        </td>
                                    </tr>
                        <?php 
                                endforeach;
                            else: 
                        ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                                        Nenhum guia cadastrado.
                                    </td>
                                </tr>
                        <?php 
                            endif;
                        } catch (PDOException $e) {
                            echo "<tr><td colspan='6' style='color: red; text-align: center;'>Erro ao carregar guias: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer></footer>

    <!-- 
        Essa parte so aparece se o botao de editar for clicado
    -->

    <div id="modalEditar" class="modal">

        <div class="modal-conteudo">

            <span class="fechar" onclick="fecharModal()">
                &times;
            </span>

            <div class="titulo">
                <img src="img/guias.svg" alt="">
                <h2>Editar Guia</h2>
            </div>

            <form method="POST" action="editarGuia.php">
                <input type="hidden" id="idGuiaEditar" name="idGuia">

                <div class="dados-guias">

                    <div class="dado-guia">
                        <label for="nomeEditar">Nome completo</label>
                        <input type="text" id="nomeEditar" name="nome" required>
                    </div>

                    <div class="dado-guia">
                        <label for="cpfEditar">CPF</label>
                        <input type="text" id="cpfEditar" name="cpf" maxlength="14" required>
                    </div>

                    <div class="dado-guia">
                        <label for="emailEditar">E-mail</label>
                        <input type="email" id="emailEditar" name="email" required>
                    </div>

                    <div class="dado-guia">
                        <label for="telefoneEditar">Telefone</label>
                        <input type="tel" id="telefoneEditar" name="telefone"  maxlength="15" required>
                    </div>

                    <div class="dado-guia">
                        <label for="senhaEditar">Senha</label>
                        <input type="password"  id="senhaEditar"  name="senha"  minlength="5"  maxlength="45" required>
                    </div>

                    <div class="dado-guia">
                        <label for="experienciaEditar">Anos de experiência</label>
                        <input type="number"  id="experienciaEditar" name="experiencia" min="0" max="99" required>
                    </div>
                </div>

                <div class="titulo linha">
                    <img src="img/local.svg" alt="">
                    <h2>Endereço</h2>
                </div>

                <div class="dados-endereco">
                    <div class="dado-guia">
                        <label for="logradouroEditar">Logradouro</label>
                        <input type="text" id="logradouroEditar" name="logradouro" required>
                    </div>

                    <div class="dado-guia pequeno">
                        <label for="numeroEditar">Número</label>
                        <input type="number" id="numeroEditar" name="numero">
                    </div>

                    <div class="dado-guia">
                        <label for="bairroEditar">Bairro</label>
                        <input type="text" id="bairroEditar" name="bairro" required>
                    </div>

                    <div class="dado-guia">
                        <label for="cidadeEditar">Cidade</label>
                        <input type="text" id="cidadeEditar" name="cidade" required>
                    </div>

                    <div class="dado-guia pequeno">
                        <label for="estadoEditar">UF</label>
                        <select id="estadoEditar" name="estado" required>
                            <option value="">Selecione</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>

                    <div class="dado-guia">
                        <label for="cepEditar">CEP</label>
                        <input type="text" id="cepEditar" name="cep" maxlength="9" required>
                    </div>
                </div>
                <button type="submit" class="salvar"><p>Salvar</p></button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>