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
                <a href="/pontos.php"><img src="img/pontos.svg" alt=""><span>Pontos Turísticos</span></a>
                <a href="/eventos.php"><img src="img/eventos.svg" alt=""><span>Eventos</span></a>
                <a href="/roteiro.php" class="ativo"><img src="img/roteiro.svg" alt=""><span>Roteiro</span></a>
                <a href="/guias.php"><img src="img/guias.svg" alt=""><span>Guias</span></a>
                <a href="/login.php"><img src="img/sair.svg" alt=""><span>Sair</span></a>
            </nav>
        </menu>
    </header>

    <main>
        
        <div class="painel-guia">
            <div class="cabecalho-guia">
                <div class="bemvindo-texto">
                    <h2>Cadastrar Roteiro</h2>
                    <p>Preencha os dados abaixo para cadastrar um novo roteiro.</p>
                </div>

                <div class="guia-imagem">
                    <img src="/img/ratoperaMapa.png" alt="">
                </div>
            </div>

            <div class="cadastro">
                
                <div class="titulo">
                    <img src="/img/roteiro.svg" alt="">
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
                    <img src="/img/local.svg" alt="">
                    <h2>Local de encontro</h2>
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

                <a href="/inicio.html">
                    <div class="salvar">
                        <p>Salvar roteiro</p>
                    </div>
                </a>
            </div>
        </div>
    </main>

    <footer>

    </footer>

    <script src="script.js"></script>
</body>
</html>