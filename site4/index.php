<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Responsiva com Botões</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
        }
        button {
            display: block;
            width: 80%;
            max-width: 300px;
            padding: 15px;
            margin: 10px auto;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
        }
        button:hover {
            background-color: #0056b3;
        }
        input {
            display: block;
            width: 80%;
            max-width: 300px;
            padding: 10px;
            margin: 10px auto;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lanchas:Cadastro_Óleo</h1>
        <button onclick="location.href='https://carlitoslocacoes.com/site4/cad_oleo.php'">Cadastrar Óleo</button>
        <button onclick="location.href='https://carlitoslocacoes.com/site4/exibir_oleo.php'">Exibir Óleo</button>
        </div>

    
</body>
</html>
