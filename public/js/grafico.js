document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('meuGraficoDePizza');
    // Removemos a linha const footerText = document.getElementById('footer-stats');

    if (!ctx) return;

    // Garanta que esta rota chame a sua função StatsController@tasks()
    fetch('/stats') 
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            // O JSON agora é uma LISTA de categorias, não um objeto único.
            return response.json(); 
        })
        .then(dadosJson => {
            // 🚨 Mapeamento dos dados retornados pelo SQL Puro:
            const labels = dadosJson.map(item => item.label); // Ex: ["Estudos", "Trabalho", ...]
            const values = dadosJson.map(item => item.total); // Ex: [15, 11, ...]

            // Removemos a lógica do rodapé, pois o JSON não contém data.total_tasks

            // Renderiza o gráfico de Pizza (Categorias)
            new Chart(ctx, {
                type: 'pie',
                data: {
                    // O Chart.js usa os labels e values mapeados.
                    labels: labels, 
                    datasets: [{
                        data: values,
                        backgroundColor: ['#36A2EB', '#ff6363', '#FFCE56', '#4BC0C0', '#9966FF'],
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribuição de Tarefas por Categoria'
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Erro ao carregar gráfico:', error);
            // Removemos a lógica de atualizar o rodapé com erro
        });
});