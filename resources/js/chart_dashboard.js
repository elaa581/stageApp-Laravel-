import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

const ctx = document.getElementById('statsChart').getContext('2d');
const labels = JSON.parse(document.getElementById('chart-labels').textContent);
const values = JSON.parse(document.getElementById('chart-values').textContent);

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Statistiques',
            data: values,
            backgroundColor: ['#dc2626', '#22c55e', '#ef4444', '#dc2626'],
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
