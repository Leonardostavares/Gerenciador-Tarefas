document.addEventListener('DOMContentLoaded', function () {
    
    // Função auxiliar para desenhar o Chart, evitando repetição de código
    const drawChart = (elementId, type, title, label, labels, data, colors, yAxisText = '') => {
        const ctx = document.getElementById(elementId);
        if (!ctx) return;
        
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
                    legend: { display: false },
                },
                scales: {
                    y: {
                        beginAtZero: true, 
                        title: {
                            display: true,
                            text: yAxisText // Texto dinâmico para Dias ou Quantidade
                        }
                    }
                }
            }
        };
        // Adiciona escalas X e Y customizadas para barras, se não for Pizza/Rosca
        if (type === 'bar') {
             config.options.scales.x = { title: { display: true, text: 'Categorias' }};
        }

        new Chart(ctx, config);
    };


    // ==============================================
    // 1. GRÁFICO DE VOLUME (CATEGORIAS)
    // Rota: /api/stats/categories (ou a que você definiu)
    // ID da Blade: graficoCategorias
    // ==============================================
    fetch('/stats')
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json(); 
        })
        .then(dadosJson => {
            const labels = dadosJson.map(item => item.label); 
            const values = dadosJson.map(item => item.total); // Seu SQL retorna 'total'
            
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
    // Rota: /api/stats/avg-completion-time
    // ID da Blade: graficoEficiencia
    // ==============================================
    fetch('/stats/averageTasks')
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json(); 
        })
        .then(dadosJson => {
            const labels = dadosJson.map(item => item.label); 
            const values = dadosJson.map(item => item.value); // Seu SQL retorna 'value' (dias)
            
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
});