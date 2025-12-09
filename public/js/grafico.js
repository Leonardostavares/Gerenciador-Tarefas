document.addEventListener('DOMContentLoaded', function () {
    // 1. SINCRONIZANDO O ID: Usa o ID da sua Blade
    const ctx = document.getElementById('meuGraficoDePizza'); 
    
    if (!ctx) return;

    // Chamada para a rota que retorna os dados de Categoria (label e total)
    fetch('/stats') // Verifique se sua rota no web.php é exatamente esta!
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json(); 
        })
        .then(dadosJson => {
            // Mapeamento dos dados (label e total)
            const labels = dadosJson.map(item => item.label); 
            const values = dadosJson.map(item => item.total); 
            
            // Renderiza o gráfico de Barras
            new Chart(ctx, {
                type: 'bar', // 👈 MUDANÇA ESSENCIAL: Tipo Barras
                data: {
                    labels: labels, 
                    datasets: [{
                        label: 'Total de Tarefas', 
                        data: values,
                        backgroundColor: '#36A2EB', // Azul
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
                    scales: { // Define os eixos X e Y
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
            // Você pode adicionar uma mensagem de erro na tela aqui se quiser
        });
});