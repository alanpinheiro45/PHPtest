<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<img src="Screenshot_3.png">
<div class="container mt-5">
<?php 
$banco = new PDO("sqlite:bancocep.sqlite3");
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["cep"])){
        $cep = $_POST["cep"];

        if(strlen($cep) == 8){

      $result =  $banco->query(" SELECT * FROM Endereco WHERE Cep = $cep", PDO::FETCH_ASSOC);
     // var_dump (count($result->fetchAll()));
    
      //$result = $result->fetch();
      //var_dump ($result);
            if(count($result->fetchAll()) <=0 ){
                $resultado = file_get_contents("https://viacep.com.br/ws/$cep/xml/");
                $resultadoxml = simplexml_load_string($resultado);
                if($resultadoxml->erro == true){

                    echo "Cep Inválido";
                    echo '<br><br><a href="index.php"> Clique aqui para voltar </a>';
                    exit;
                }
                $linhasafetadas = $banco->exec("INSERT INTO Endereco VALUES('$cep', '$resultadoxml->logradouro', '$resultadoxml->complemento', '$resultadoxml->bairro', '$resultadoxml->localidade', '$resultadoxml->uf', '$resultadoxml->ibge', '$resultadoxml->gia', '$resultadoxml->ddd', '$resultadoxml->siafi')");
                if($linhasafetadas == false){
                    echo "Erro ao inserir dados.";

                    echo '<br><br><a href="index.php"> Clique aqui para voltar </a>';
                }
                echo $resultado;
            }else{

                $result =  $banco->query(" SELECT * FROM Endereco WHERE Cep = $cep", PDO::FETCH_ASSOC);
                //var_dump($result->fetch());
                $rfetch = $result->fetch(); 
                $resultadoxml = <<<XML
                    <?xml version='1.0' standalone='yes'?>
                    <cep> $rfetch[Cep]</cep>
                    <logradouro>$rfetch[Logradouro]</logradouro>
                    <complemento>$rfetch[Complemento]</complemento>
                    <bairro>$rfetch[Bairro]</bairro>
                    <localidade>$rfetch[Localidade]</localidade>
                    <uf>$rfetch[UF]</uf>
                    <ibge>$rfetch[IBGE]</ibge>
                    <gia>$rfetch[GIA]</gia>
                    <ddd>$rfetch[DDD]</ddd>
                    <siafi>$rfetch[Siafi]</siafi>
                XML;
                //var_dump($rfetch);
                //echo"<br>";
                echo($resultadoxml);
            }


                echo '<br><br><a href="index.php"> Clique aqui para voltar </a>';

                



           
        }else{
            echo "Cep precisa ter 8 dígitos.";
            echo '<br><br><a href="index.php"> Clique aqui para voltar </a>';
        }
    }

}



?></div>
