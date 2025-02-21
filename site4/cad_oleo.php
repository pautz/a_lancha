<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Nível de Óleo</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { width: 300px; margin: 0 auto; }
        label, input { display: block; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Cadastro de Nível de Óleo</h2>
        <form id="oil-level-form" action="register.php" method="post">
            <label for="boat-id">ID da Lancha:</label>
            <input type="text" id="boat-id" name="boatId">

            <label for="oil-level">Nível de Óleo:</label>
            <input type="number" id="oil-level" name="oilLevel">

            <label for="next-change">Próxima Troca:</label>
            <input type="date" id="next-change" name="nextChange">

            <label for="next-change-value">Valor da Próxima Troca:</label>
            <input type="number" step="0.01" id="next-change-value" name="nextChangeValue">

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
