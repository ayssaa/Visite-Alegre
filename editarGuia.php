<?php

include_once 'conexao.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    try {


        $pdo->beginTransaction();


        $idGuia = $_POST["idGuia"];



        // ==========================
        // BUSCA DADOS ATUAIS
        // ==========================


        $stmt = $pdo->prepare("
            SELECT 
                idEndereco
            FROM Usuario
            WHERE idUsuario = ?
        ");


        $stmt->execute([$idGuia]);


        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


        if(!$usuario){

            throw new Exception("Guia não encontrado.");

        }


        $idEndereco = $usuario["idEndereco"];




        // ==========================
        // CIDADE
        // ==========================


        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];



        $stmt = $pdo->prepare("
            SELECT idCidade
            FROM Cidade
            WHERE nome = ?
            AND UF = ?
        ");


        $stmt->execute([
            $cidade,
            $estado
        ]);


        $cidadeBanco = $stmt->fetch(PDO::FETCH_ASSOC);



        if($cidadeBanco){


            $idCidade = $cidadeBanco["idCidade"];


        }else{


            $stmt = $pdo->prepare("
                INSERT INTO Cidade
                (nome, UF)
                VALUES (?,?)
            ");


            $stmt->execute([
                $cidade,
                $estado
            ]);


            $idCidade = $pdo->lastInsertId();


        }





        // ==========================
        // ATUALIZA ENDEREÇO
        // ==========================


        $stmt = $pdo->prepare("
            UPDATE Endereco
            SET 
                logradouro = ?,
                numero = ?,
                bairro = ?,
                CEP = ?,
                idCidade = ?
            WHERE idEndereco = ?
        ");


        $stmt->execute([

            $_POST["logradouro"],
            $_POST["numero"],
            $_POST["bairro"],
            preg_replace('/\D/','',$_POST["cep"]),
            $idCidade,
            $idEndereco

        ]);







        // ==========================
        // ATUALIZA USUARIO
        // ==========================


        $stmt = $pdo->prepare("
            UPDATE Usuario
            SET
                nome = ?,
                CPF = ?,
                email = ?,
                telefone = ?,
                senha = ?
            WHERE idUsuario = ?
        ");


        $stmt->execute([

            $_POST["nome"],
            preg_replace('/\D/','',$_POST["cpf"]),
            $_POST["email"],
            preg_replace('/\D/','',$_POST["telefone"]),
            $_POST["senha"],
            $idGuia

        ]);








        // ==========================
        // ATUALIZA GUIA
        // ==========================


        $stmt = $pdo->prepare("
            UPDATE Guia
            SET anoExperiencia = ?
            WHERE idGuia = ?
        ");


        $stmt->execute([

            $_POST["experiencia"],
            $idGuia

        ]);







        $pdo->commit();



        echo "
        <script>

            alert('Guia atualizado com sucesso!');

            window.location='guias.php';

        </script>
        ";



    }catch(Exception $e){



        if($pdo->inTransaction()){

            $pdo->rollBack();

        }



        echo "
        <script>

            alert('Erro ao atualizar guia!');

            window.location='guias.php';

        </script>
        ";


        // Para testar:
        // echo $e->getMessage();


    }

}

?>