document.addEventListener("DOMContentLoaded", function () {


    // ==========================
    // ROTEIRO
    // ==========================

    const lista = document.getElementById("listaPontosTuristicos");
    const btn = document.getElementById("btnAdicionarPonto");


    if (lista && btn) {

        btn.addEventListener("click", function () {

            const ultimoGrupo = lista.lastElementChild;

            const ponto = ultimoGrupo.querySelector(".ponto_turistico");
            const inicio = ultimoGrupo.querySelector(".hora_inicio");
            const fim = ultimoGrupo.querySelector(".hora_fim");


            if (
                ponto.value.trim() === "" ||
                inicio.value === "" ||
                fim.value === ""
            ) {

                alert("Preencha todos os campos antes de adicionar outro.");
                return;

            }


            const novoGrupo = ultimoGrupo.cloneNode(true);


            novoGrupo.querySelector(".ponto_turistico").value = "";
            novoGrupo.querySelector(".hora_inicio").value = "";
            novoGrupo.querySelector(".hora_fim").value = "";


            lista.appendChild(novoGrupo);

        });

    }



    // ==========================
    // FUNÇÕES DE MÁSCARA
    // ==========================


    function aplicarEvento(campos, evento){

        campos.forEach(function(id){

            const campo = document.getElementById(id);

            if(campo){

                campo.addEventListener(evento.tipo, evento.funcao);

            }

        });

    }



    // ==========================
    // NOME
    // ==========================

    aplicarEvento(
        [
            "nome",
            "nomeEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g,"");

            }
        }
    );




    // ==========================
    // CPF
    // ==========================


    aplicarEvento(
        [
            "cpf",
            "cpfEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                let valor = this.value.replace(/\D/g,"");


                valor = valor.substring(0,11);


                valor = valor.replace(/(\d{3})(\d)/,"$1.$2");
                valor = valor.replace(/(\d{3})\.(\d{3})(\d)/,"$1.$2.$3");
                valor = valor.replace(/(\d{3})\.(\d{3})\.(\d{3})(\d)/,"$1.$2.$3-$4");


                this.value = valor;

            }
        }
    );





    // ==========================
    // TELEFONE
    // ==========================


    aplicarEvento(
        [
            "tel",
            "telefoneEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                let valor = this.value.replace(/\D/g,"");


                valor = valor.substring(0,11);


                valor = valor.replace(/^(\d{2})(\d)/,"($1) $2");
                valor = valor.replace(/(\d{5})(\d)/,"$1-$2");


                this.value = valor;

            }
        }
    );





    // ==========================
    // CEP
    // ==========================


    aplicarEvento(
        [
            "cep",
            "cepEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                let valor = this.value.replace(/\D/g,"");


                valor = valor.substring(0,8);


                valor = valor.replace(/(\d{5})(\d)/,"$1-$2");


                this.value = valor;

            }
        }
    );





    // ==========================
    // LOGRADOURO
    // ==========================


    aplicarEvento(
        [
            "logradouro",
            "logradouroEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                this.value = this.value.replace(/[^A-Za-zÀ-ÿ0-9\s\.\-\/]/g,"");

            }
        }
    );





    // ==========================
    // BAIRRO
    // ==========================


    aplicarEvento(
        [
            "bairro",
            "bairroEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g,"");

            }
        }
    );





    // ==========================
    // CIDADE
    // ==========================


    aplicarEvento(
        [
            "cidade",
            "cidadeEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g,"");

            }
        }
    );





    // ==========================
    // NÚMERO
    // ==========================


    aplicarEvento(
        [
            "numero",
            "numeroEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                this.value = this.value.replace(/\D/g,"");

            }
        }
    );





    // ==========================
    // EXPERIÊNCIA
    // ==========================


    aplicarEvento(
        [
            "number",
            "experienciaEditar"
        ],
        {
            tipo:"input",
            funcao:function(){

                if(this.value > 99){

                    this.value = 99;

                }


                if(this.value < 0){

                    this.value = 0;

                }

            }
        }
    );






    // ==========================
    // VALIDAÇÃO NOME COMPLETO
    // ==========================


    const formularios = document.querySelectorAll("form");


    formularios.forEach(function(formulario){


        formulario.addEventListener("submit",function(e){


            const nome = this.querySelector(
                "#nome, #nomeEditar"
            );


            if(nome){


                let valor = nome.value.trim();


                if(valor.length < 3 || valor.split(" ").length < 2){


                    alert("Digite o nome completo.");

                    e.preventDefault();

                }

            }


        });


    });





    // ==========================
    // VALIDAÇÃO TELEFONE
    // ==========================


    aplicarEvento(
        [
            "tel",
            "telefoneEditar"
        ],
        {
            tipo:"blur",
            funcao:function(){


                let valor = this.value.replace(/\D/g,"");


                if(valor.length !== 11){

                    alert("Digite um telefone válido com DDD.");

                    this.value = "";

                }


            }
        }
    );






    // ==========================
    // VALIDAÇÃO CPF
    // ==========================


    aplicarEvento(
        [
            "cpf",
            "cpfEditar"
        ],
        {
            tipo:"blur",
            funcao:function(){


                let valor = this.value.replace(/\D/g,"");


                if(valor.length !== 11){

                    alert("Digite um CPF válido.");

                    this.value = "";

                }


            }
        }
    );






    // ==========================
    // VALIDAÇÃO CEP
    // ==========================


    aplicarEvento(
        [
            "cep",
            "cepEditar"
        ],
        {
            tipo:"blur",
            funcao:function(){


                let valor = this.value.replace(/\D/g,"");


                if(valor.length !== 8){

                    alert("Digite um CEP válido.");

                    this.value = "";

                }


            }
        }
    );



});

function abrirModalEditar(id) {

    document.getElementById("modalEditar").style.display = "flex";

    document.getElementById("idGuiaEditar").value = id;


    fetch("buscarGuia.php?id=" + id)

    .then(response => response.json())

    .then(dados => {


        document.getElementById("nomeEditar").value = dados.nome;

        document.getElementById("cpfEditar").value = dados.cpf;

        document.getElementById("emailEditar").value = dados.email;

        document.getElementById("telefoneEditar").value = dados.telefone;

        document.getElementById("senhaEditar").value = dados.senha;

        document.getElementById("experienciaEditar").value = dados.anoExperiencia;


        document.getElementById("logradouroEditar").value = dados.logradouro;

        document.getElementById("numeroEditar").value = dados.numero;

        document.getElementById("bairroEditar").value = dados.bairro;

        document.getElementById("cidadeEditar").value = dados.cidade;

        document.getElementById("estadoEditar").value = dados.uf;

        document.getElementById("cepEditar").value = dados.cep;


    })

    .catch(error => {

        console.error(error);

        alert("Erro ao carregar os dados do guia.");

    });

}


function fecharModal(){

    document.getElementById("modalEditar").style.display = "none";

}