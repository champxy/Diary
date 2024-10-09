const myChartnut = document.getElementById('myChartnut');

const counter = {
    id: 'counter',
    beforeDraw(chart, args, options) {
        const { ctx, chartArea: { top, right, bottom, left, width, height } } = chart;
        ctx.font = '25px  sans-serif';
        ctx.textAlign = 'center';
        ctx.fillStyle = 'dark';
        ctx.fillText(chart.data.datasets[1].data[0] + '%', width / 2, top + (height / 2) + 40);
        ctx.save();
    }
}

const datanut = {
    datasets: [{
        type: 'doughnut',
        label: 'Grieve',
        data: [40, 20, 20, 30],
        borderWidth: 5,
        backgroundColor: ['red', 'yellow', 'MediumSeaGreen', 'green']
    }, {
        type: 'doughnut',
        label: 'Emotional',
        data: [0, 0],
        borderWidth: 2,
        backgroundColor: ['rgba(0,255,0,0.5)', 'rgba(200,200,200,0.5)',]
    }],
    labels: ['Broking Heart', 'Beware Yourself', "It's ok", 'Good Mood']

};

const confignut = {
    data: datanut,
    options: {
        maintainAspectRatio: false,
        circumference: 180,
        rotation: 180 + 90,
    },
    plugins: [counter],
};
new Chart(myChartnut, confignut)