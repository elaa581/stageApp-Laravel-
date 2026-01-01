import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

// Exemple de données dynamiques
const labels = ['Offres', 'CVs', 'Étudiants', 'Entreprises'];
const dataValues = [
    parseInt(document.querySelector('.dashboard-grid .card:nth-child(1) p').innerText),
    parseInt(document.querySelector('.dashboard-grid .card:nth-child(2) p').innerText),
    parseInt(document.querySelector('.dashboard-grid .card:nth-child(3) p').innerText),
    parseInt(document.querySelector('.dashboard-grid .card:nth-child(4) p').innerText)
];

const ctx = document.getElementById('adminChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Statistiques',
            data: dataValues,
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
