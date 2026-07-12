<?php

include_once 'conexao.php';


if(isset($_GET["id"])){

    $idGuia = $_GET["id"];


    try {

        $pdo->beginTransaction();


        // Busca o endereço do usuário antes de excluir

        $stmt = $pdo->prepare("
            SELECT idEndereco
            FROM Usuario
            WHERE idUsuario = ?
        ");

        $stmt->execute([$idGuia]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


        if(!$usuario){

            throw new Exception("Guia não encontrado.");

        }


        $idEndereco = $usuario["idEndereco"];



        // 1 - Exclui os roteiros desse guia

        $stmt = $pdo->prepare("
            DELETE FROM Roteiro
            WHERE idGuia = ?
        ");

        $stmt->execute([$idGuia]);



        // 2 - Exclui o guia

        $stmt = $pdo->prepare("
            DELETE FROM Guia
            WHERE idGuia = ?
        ");

        $stmt->execute([$idGuia]);



        // 3 - Exclui o usuário

        $stmt = $pdo->prepare("
            DELETE FROM Usuario
            WHERE idUsuario = ?
        ");

        $stmt->execute([$idGuia]);



        // Verifica se o endereço ficou sem usuários

        $stmt = $pdo->prepare("
            SELECT COUNT(*)
            FROM Usuario
            WHERE idEndereco = ?
        ");

        $stmt->execute([$idEndereco]);

        $usuariosEndereco = $stmt->fetchColumn();



        if($usuariosEndereco == 0){


            // Descobre a cidade desse endereço

            $stmt = $pdo->prepare("
                SELECT idCidade
                FROM Endereco
                WHERE idEndereco = ?
            ");

            $stmt->execute([$idEndereco]);

            $endereco = $stmt->fetch(PDO::FETCH_ASSOC);


            $idCidade = $endereco["idCidade"];



            // Exclui endereço

            $stmt = $pdo->prepare("
                DELETE FROM Endereco
                WHERE idEndereco = ?
            ");

            $stmt->execute([$idEndereco]);



            // Verifica se a cidade ficou sem endereços

            $stmt = $pdo->prepare("
                SELECT COUNT(*)
                FROM Endereco
                WHERE idCidade = ?
            ");

            $stmt->execute([$idCidade]);

            $enderecosCidade = $stmt->fetchColumn();



            if($enderecosCidade == 0){


                $stmt = $pdo->prepare("
                    DELETE FROM Cidade
                    WHERE idCidade = ?
                ");

                $stmt->execute([$idCidade]);

            }

        }



        $pdo->commit();


        echo "
        <script>
            alert('Guia excluído com sucesso!');
            window.location='guias.php';
        </script>
        ";



    } catch(Exception $e){


        if($pdo->inTransaction()){

            $pdo->rollBack();

        }


        echo "
        <script>
            alert('Erro ao excluir guia!');
            window.location='guias.php';
        </script>
        ";


        // Para testar:
        // echo $e->getMessage();

    }

}

?>