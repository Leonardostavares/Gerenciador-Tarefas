document.addEventListener('DOMContentLoaded', function () {
    // Objeto para armazenar as instâncias dos gráficos e permitir a atualização
    const charts = {};

    /**
     * Função auxiliar para desenhar ou atualizar um gráfico
     */
    const drawChart = (elementId, type, title, label, labels, data, colors, yAxisText = '') => {
        const ctx = document.getElementById(elementId);
        if (!ctx) return;

        // LÓGICA DE ATUALIZAÇÃO (AJAX/POLLING)
        // Se o gráfico já existe no nosso objeto 'charts', apenas atualizamos os dados
        if (charts[elementId]) {
            charts[elementId].data.labels = labels;
            charts[elementId].data.datasets[0].data = data;
            charts[elementId].update(); // O Chart.js anima a mudança sozinho
            return;
        }

        // LÓGICA DE CRIAÇÃO (Primeira vez que a página carrega)
        const config = {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: colors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: { display: true, text: title },
                    legend: { display: (type === 'pie' || type === 'doughnut') },
                },
                scales: {
                    y: (type === 'bar' || type === 'line') ? {
                        beginAtZero: true,
                        title: { display: true, text: yAxisText }
                    } : { display: false }
                }
            }
        };

        if (type === 'bar' || type === 'line') {
            config.options.scales.x = { title: { display: true, text: 'Rótulos' } };
        }

        // Guarda a instância para a próxima atualização do polling
        charts[elementId] = new Chart(ctx, config);
    };

    /**
     * Função que busca os dados no Laravel (Backend)
     */
    function fetchAllStats() {
        console.log('Buscando atualizações do banco de dados...');

        // 1. Gráfico de Volume (Categorias)
        fetch('/stats')
            .then(response => response.json())
            .then(dadosJson => {
                drawChart(
                    'graficoCategorias',
                    'bar',
                    'Volume de Tarefas por Categoria',
                    'Total de Tarefas',
                    dadosJson.labels,
                    dadosJson.values,
                    '#36A2EB',
                    'Quantidade de Tarefas'
                );
            })
            .catch(error => console.error('Erro ao atualizar Categorias:', error));

        // 2. Gráfico de Eficiência (Tempo Médio)
        fetch('/stats/averageTasks')
            .then(response => response.json())
            .then(dadosJson => {
                drawChart(
                    'graficoEficiencia',
                    'bar',
                    'Tempo Médio de Conclusão',
                    'Média em Dias',
                    dadosJson.labels,
                    dadosJson.values,
                    '#28a745',
                    'Dias (Média)'
                );
            })
            .catch(error => console.error('Erro ao atualizar Eficiência:', error));

        // 3. Gráfico de Status
        fetch('/stats/statusTasks')
            .then(response => response.json())
            .then(dadosJson => {
                const statusColors = ['#FF6384', '#FFCD56', '#4BC0C0', '#9966FF'];
                drawChart(
                    'graficoStatus',
                    'doughnut',
                    'Distribuição de Tarefas por Status',
                    'Total de Tarefas',
                    dadosJson.labels,
                    dadosJson.values,
                    statusColors,
                    ''
                );
            })
            .catch(error => console.error('Erro ao atualizar Status:', error));
    }

    // Chamada inicial para carregar os gráficos assim que a página abrir
    fetchAllStats();

    // CONFIGURAÇÃO DO POLLING
    // Executa a função fetchAllStats a cada 10 segundos
    // Isso é o "Tempo Real" via AJAX sem recarregar a página.
    setInterval(fetchAllStats, 5000); 
});