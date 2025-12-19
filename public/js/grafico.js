document.addEventListener('DOMContentLoaded', function () {
    const charts = {};

    // 1. Função para desenhar/atualizar os gráficos (Sua lógica original)
    const drawChart = (elementId, type, title, label, labels, data, colors) => {
        const ctx = document.getElementById(elementId);
        if (!ctx) return;

        if (charts[elementId]) {
            charts[elementId].data.labels = labels;
            charts[elementId].data.datasets[0].data = data;
            charts[elementId].update(); 
            return;
        }

        charts[elementId] = new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{ label: label, data: data, backgroundColor: colors }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    };

    // 2. Busca inicial de dados
    function fetchAllStats() {
        fetch('/stats').then(res => res.json()).then(d => drawChart('graficoCategorias', 'bar', 'Categorias', 'Total', d.labels, d.values, '#36A2EB'));
        fetch('/stats/averageTasks').then(res => res.json()).then(d => drawChart('graficoEficiencia', 'bar', 'Tempo Médio', 'Dias', d.labels, d.values, '#28a745'));
        fetch('/stats/statusTasks').then(res => res.json()).then(d => drawChart('graficoStatus', 'doughnut', 'Status', 'Total', d.labels, d.values, ['#FF6384', '#FFCD56', '#4BC0C0']));
    }

    fetchAllStats();

    // 3. O SEGREDO: Conexão com o Reverb usando o ID do Layout
    // Buscamos a tag <meta name="user-id"> que você acabou de colocar no layout.blade.php
    const userIdMeta = document.querySelector('meta[name="user-id"]');
    
    if (userIdMeta && userIdMeta.content && window.Echo) {
        const userId = userIdMeta.content;
        console.log("📡 Reverb conectado para o usuário:", userId);

        window.Echo.private(`user.${userId}`)
            .listen('DashboardUpdated', (e) => {
                console.log("⚡ Novos dados recebidos via Reverb!", e);
                
                // Atualiza os gráficos com os dados que vieram do evento PHP
                drawChart('graficoCategorias', 'bar', 'Categorias', 'Total', e.tasksByCategory.labels, e.tasksByCategory.values, '#36A2EB');
                drawChart('graficoEficiencia', 'bar', 'Tempo Médio', 'Dias', e.averageTime.labels, e.averageTime.values, '#28a745');
                drawChart('graficoStatus', 'doughnut', 'Status', 'Total', e.tasksByStatus.labels, e.tasksByStatus.values, ['#FF6384', '#FFCD56', '#4BC0C0']);
            });
    } else {
        console.warn("⚠️ Echo não pôde ser iniciado. Verifique se o usuário está logado e o Reverb ativo.");
    }
});