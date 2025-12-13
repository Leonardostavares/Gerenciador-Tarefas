document.addEventListener('DOMContentLoaded', function () {
    
    // Função auxiliar para desenhar o Chart, evitando repetição de código
    const drawChart = (elementId, type, title, label, labels, data, colors, yAxisText = '') => {
        const ctx = document.getElementById(elementId);
        if (!ctx) return;
        
        // Configurações básicas
        const config = {
            // CORREÇÃO ESSENCIAL: 'type' deve usar a variável de parâmetro da função
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
                    // Exibir legenda apenas para Pizza/Rosca onde é essencial
                    legend: { display: (type === 'pie' || type === 'doughnut') },
                },
                scales: {
                    // Escala Y só é necessária para gráficos de barras/linhas
                    y: (type === 'bar' || type === 'line') ? {
                        beginAtZero: true, 
                        title: {
                            display: true,
                            text: yAxisText // Texto dinâmico para Dias ou Quantidade
                        }
                    } : { display: false } // Oculta o eixo Y para Pizza/Rosca
                }
            }
        };
        
        // Adiciona escalas X para barras/linhas
        if (type === 'bar' || type === 'line') {
              config.options.scales.x = { title: { display: true, text: 'Rótulos' }};
        }

        new Chart(ctx, config);
        
    };


    // ==============================================
    // 1. GRÁFICO DE VOLUME (CATEGORIAS)
    // Rota: /stats
    // ID da Blade: graficoCategorias
    // ==============================================
    fetch('/stats')
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json(); 
        })
        .then(dadosJson => {
            const labels = dadosJson.labels;
            const values = dadosJson.values;
            
            drawChart(
                'graficoCategorias',
                'bar', // Tipo Barras
                'Volume de Tarefas por Categoria',
                'Total de Tarefas',
                labels,
                values,
                '#36A2EB', // Azul
                'Quantidade de Tarefas'
            );
        })
        .catch(error => console.error('Erro Gráfico de Categorias:', error));


    // ==============================================
    // 2. GRÁFICO DE EFICIÊNCIA (TEMPO MÉDIO)
    // Rota: /stats/averageTasks
    // ID da Blade: graficoEficiencia
    // ==============================================
    fetch('/stats/averageTasks')
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json(); 
        })
        .then(dadosJson => {
            const labels = dadosJson.labels;
            const values = dadosJson.values;
            
            drawChart(
                'graficoEficiencia',
                'bar', // Tipo Barras
                'Tempo Médio de Conclusão',
                'Média em Dias',
                labels,
                values,
                '#28a745', // Verde
                'Dias (Média)' // O Eixo Y agora é em Dias
            );
        })
        .catch(error => console.error('Erro Gráfico de Eficiência:', error));


    // ==============================================
    // 3. GRÁFICO DE STATUS (SEU NOVO GRÁFICO!)
    // Rota: /stats/statusTasks 
    // ID da Blade: graficoStatus
    // ==============================================
    fetch('/stats/statusTasks')
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json(); 
        })
        .then(dadosJson => {
            const labels = dadosJson.labels;
            const values = dadosJson.values;
            
            // Definição de cores para diferentes status (personalize!)
            const statusColors = [
                '#FF6384', // Ex: Vermelho/Rosa para 'Pendente'
                '#FFCD56', // Ex: Amarelo para 'Em Andamento'
                '#4BC0C0', // Ex: Ciano para 'Concluída'
                '#9966FF', // Ex: Roxo para 'Cancelada'
            ];

            drawChart(
                'graficoStatus',
                'doughnut', // Tipo Rosca (ou 'pie') - Ideal para proporções
                'Distribuição de Tarefas por Status',
                'Total de Tarefas',
                labels,
                values,
                statusColors, 
                '' // Eixo Y desnecessário para Pie/Doughnut
            );
        })
        .catch(error => console.error('Erro Gráfico de Status:', error));


});