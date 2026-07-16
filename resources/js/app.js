// resources/js/app.js
import intersect from '@alpinejs/intersect';
import Chart from 'chart.js/auto';


document.addEventListener('alpine:init', () => {
    Alpine.plugin(intersect);
});

function initScrollReveal() {
    const els = document.querySelectorAll('.reveal:not(.in-view)');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    els.forEach(el => observer.observe(el));
}

document.addEventListener('DOMContentLoaded', initScrollReveal);
document.addEventListener('livewire:navigated', initScrollReveal);


window.resultsCharts = function () {
    return {
        bar: null,
        pie: null,
        colors: ['#0d9488', '#22c55e', '#f59e0b', '#ef4444', '#6366f1', '#ec4899'],

        readData() {
            const el = document.getElementById('results-chart-data');
            if (!el) return { labels: [], votes: [] };
            return {
                labels: JSON.parse(el.dataset.labels || '[]'),
                votes: JSON.parse(el.dataset.votes || '[]'),
            };
        },

        init() {
            const { labels, votes } = this.readData();

            this.bar = new Chart(this.$refs.barCanvas, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{ label: 'Votes', data: votes, backgroundColor: this.colors }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } },
                },
            });

            this.pie = new Chart(this.$refs.pieCanvas, {
                type: 'pie',
                data: {
                    labels,
                    datasets: [{ data: votes, backgroundColor: this.colors }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } },
                },
            });

            // Poll the data island every 5s (matches wire:poll.5000ms) and refresh charts
            setInterval(() => {
                const fresh = this.readData();
                this.bar.data.labels = fresh.labels;
                this.bar.data.datasets[0].data = fresh.votes;
                this.bar.update();

                this.pie.data.labels = fresh.labels;
                this.pie.data.datasets[0].data = fresh.votes;
                this.pie.update();
            }, 5000);
        },
    };
};