<!DOCTYPE html> 
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
        <body>
            <img src="Screenshot_3.png">
            <div class="container mt-5" >
            <form method="POST" name="Formulario" action="retorno.php">
            
                <label for="inputPassword5" class="form-label">Insira o cep para a busca: </label>
            <input class = "form-control-sm" type="text" aria-describedby="passwordHelpBlock" name="cep" pattern="[0-9]{8}" title="O cep tem que conter 8 dígitos e somente números">
            <!--<input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">-->
            <div id="passwordHelpBlock" class="form-text">
            Seu Cep tem que conter 8 digítos e ser um número válido.
            </div>
            <input type="submit">
            
            
            
            </form></div>
        </body>


</html>