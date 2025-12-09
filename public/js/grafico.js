document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('meuGraficoDePizza'); 
    
    if (!ctx) return;

    fetch('/stats') 
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json(); 
        })
        .then(dadosJson => {
            const labels = dadosJson.map(item => item.label); 
            const values = dadosJson.map(item => item.total); 
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, 
                    datasets: [{
                        label: 'Total de Tarefas', 
                        data: values,
                        backgroundColor: '#36A2EB', 
                        borderColor: '#217fb9',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Volume de Tarefas por Categoria'
                        },
                        legend: { display: false },
                    },
                    scales: {
                        y: {
                            beginAtZero: true, 
                            title: {
                                display: true,
                                text: 'Quantidade de Tarefas'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Categorias'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Erro ao carregar gráfico:', error);
        });
});