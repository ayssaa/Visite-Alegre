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
                <a href="/eventos.php" class="ativo"><img src="img/eventos.svg" alt=""><span>Eventos</span></a>
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
                    <h2>Cadastrar Evento</h2>
                    <p>Preencha os dados abaixo para cadastrar um novo evento.</p>
                </div>

                <div class="guia-imagem-evento">
                    <img src="/img/RatopeiraEvento.png" alt="">
                </div>
            </div>

            <div class="cadastro">
                
                <div class="titulo">
                    <img src="/img/eventos.svg" alt="">
                    <h2>Dados do Evento</h2>
                </div>


                <div class="dados-guias">
                    <div class="cima">
                        <div class="dado-guia">
                            <label for="nome">Título</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite o título do evento">
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
                                <input type="text" id="nome" name="nome" placeholder="Descreva o evento">
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
                        <label for="ponto-turistico">Ponto Turístico onde está o evento</label>

                        <input list="pontos-turisticos" id="ponto-turistico" name="ponto-turistico" placeholder="Pesquise um ponto turístico">

                        <datalist id="pontos-turisticos">
                            <option value="Mirante do Cruzeiro">
                            <option value="Cachoeira da Fumaça">
                            <option value="Parque de Exposições">
                            <option value="Praça Central">
                            <option value="Centro Histórico">
                            <option value="UFES">
                            <option value="Igreja Matriz">
                            <option value="Pedra do Pombal">
                            <option value="Trilha do Itapetinga">
                            <option value="Museu Histórico de Alegre">
                        </datalist>
                        </div>
                    </div>
                </div>

                <a href="/inicio.html">
                    <div class="salvar">
                        <p>Salvar evento</p>
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