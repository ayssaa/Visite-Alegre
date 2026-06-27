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
        <div class="title">
            <a href="/inicio.html">
                <img src="/img/VisiteAlegreLogo.png" alt="">
            </a>
        </div>

        <menu>
            <nav>
            </nav>
        </menu>
    </header>

    <main>

        <section class="interface-login">
            <img src="/img/RatoTopeiraGestor.png" alt="">

            <div class="login">

                <div class="login-texto">
                    <h1>Olá, Gestor!</h1>
                    <h2>Faça seu Login</h2>
                    <p>Que bom ver você! Informe seus dados para continuar.</p>
                </div>

                <div class="login-dados">
                    <label for="email">Email</label>
                    <img src="img/email.svg" alt="">
                    <input type="email" id="email" name="email" placeholder="seu@email.com"></input>

                    <label for="senha">Senha</label>
                    <img src="img/cadeado.svg" alt="">
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha"></input>
                    
                    <div class="rodape">

                        <div class="rodape-lembrar">
                            <input type="checkbox" id="lembrar" name="lembrar"></input>
                            <p>Lembrar de mim</p>
                        </div>

                        <a href="#">Esqueci minha senha</a>
                    </div>

                    <a href="inicio.html">
                        <div class="botao">
                            <p>Entrar</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

    </main>
    
    <script src="script.js"></script>
</body>
</html>