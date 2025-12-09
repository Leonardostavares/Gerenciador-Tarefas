document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('meuGraficoDePizza');
    const footerText = document.getElementById('footer-stats');

    if (!ctx) return;

    // Chamada para a rota definida no seu web.php
    fetch('/stats')
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json();
        })
        .then(data => {
            // Atualiza o texto do rodapé
            if (footerText) footerText.innerText = `Total: ${data.total_tasks} tarefas cadastradas`;

            // Renderiza o gráfico de Pizza
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Concluídas', 'Pendentes'],
                    datasets: [{
                        data: [data.completed_tasks, data.pending_tasks],
                        backgroundColor: ['#36A2EB', '#FF6384'], // Azul e Rosa
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Erro ao carregar gráfico:', error);
            if (footerText) footerText.innerText = 'Falha ao carregar estatísticas.';
        });
});