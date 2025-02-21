<!DOCTYPE html>
<html>
<head>
    <title>Visualização dos Níveis de Óleo</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container, .table-container { width: 50%; margin: 0 auto; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        .low { background-color: red; color: white; }
        .highlight { background-color: red; color: white; }
        input[type="text"], input[type="number"], input[type="date"], button { padding: 8px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Pesquisar Níveis de Óleo por ID da Lancha</h2>
        <input type="text" id="search-id" placeholder="ID da Lancha">
        <button onclick="searchOilLevel()">Pesquisar</button>
    </div>
    <div class="table-container">
        <h2>Níveis de Óleo das Lanchas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID da Lancha</th>
                    <th>Nível de Óleo</th>
                    <th>Próxima Troca</th>
                    <th>Valor da Próxima Troca</th>
                    <th>Data do Cadastro</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody id="oil-levels-table">
            </tbody>
        </table>
    </div>

    <script>
        async function loadOilLevels() {
            const response = await fetch('get_oil_levels.php');
            const oilLevels = await response.json();
            oilLevels.sort((a, b) => {
                const diffA = Math.abs(a.oil_level - a.next_change_value);
                const diffB = Math.abs(b.oil_level - b.next_change_value);
                return diffA - diffB;
            });
            displayOilLevels(oilLevels);
        }

        function displayOilLevels(oilLevels) {
            const tableBody = document.getElementById('oil-levels-table');
            tableBody.innerHTML = '';

            oilLevels.forEach(level => {
                const row = document.createElement('tr');
                if (level.oil_level >= level.next_change_value) {
                    row.classList.add('highlight');
                }
                row.innerHTML = `
                    <td>${level.boat_id}</td>
                    <td>
                        <input type="number" value="${level.oil_level}" onchange="updateOilLevel('${level.boat_id}', this.value)">
                    </td>
                    <td>
                        <input type="date" value="${level.next_change}" onchange="updateNextChange('${level.boat_id}', this.value)">
                    </td>
                    <td>
                        <input type="number" step="0.01" value="${level.next_change_value}" onchange="updateNextChangeValue('${level.boat_id}', this.value)">
                    </td>
                    <td>${level.registration_date}</td>
                    <td>
                        <button onclick="updateOilLevel('${level.boat_id}', this.parentElement.parentElement.querySelector('input[type=number]').value); updateNextChange('${level.boat_id}', this.parentElement.parentElement.querySelector('input[type=date]').value); updateNextChangeValue('${level.boat_id}', this.parentElement.parentElement.querySelectorAll('input[type=number]')[1].value)">Salvar</button>
                    </td>
                `;
                if (level.oil_level >= level.next_change_value) {
                    tableBody.prepend(row);
                } else {
                    tableBody.appendChild(row);
                }
            });
        }

        async function updateOilLevel(boatId, oilLevel) {
            const response = await fetch('update_oil_level.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ boatId, oilLevel })
            });

            const result = await response.text();
            alert(result);
            loadOilLevels();
        }

        async function updateNextChange(boatId, nextChange) {
            const response = await fetch('update_next_change.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ boatId, nextChange })
            });

            const result = await response.text();
            alert(result);
            loadOilLevels();
        }

        async function updateNextChangeValue(boatId, nextChangeValue) {
            const response = await fetch('update_next_change_value.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ boatId, nextChangeValue })
            });

            const result = await response.text();
            alert(result);
            loadOilLevels();
        }

        async function searchOilLevel() {
            const searchId = document.getElementById('search-id').value;
            if (searchId) {
                const response = await fetch(`get_oil_levels.php?boat_id=${searchId}`);
                const oilLevels = await response.json();
                oilLevels.sort((a, b) => {
                    const diffA = Math.abs(a.oil_level - a.next_change_value);
                    const diffB = Math.abs(b.oil_level - b.next_change_value);
                    return diffA - diffB;
                });
                displayOilLevels(oilLevels);
            } else {
                loadOilLevels();
            }
        }

        window.onload = loadOilLevels;
    </script>
</body>
</html>
