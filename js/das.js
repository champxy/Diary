var fn = null
var locationX = document.getElementById('locationX')

window.onload = () => {
    if (locationX.value != "") {
        fn = setInterval(async () => {
            try {
                const res = await fetch("control/rest.php?getid=" + locationX.value, {
                    method: 'get',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                if (res.ok) {
                    const datas = await res.text()
                    console.log(datas)
                    adddatapie(datas)
                } else {
                    throw new Error(res.status)
                }
            } catch (e) {
                console.log(e.message)
            }
        }, 5000)
    } else {
        clearInterval(fn)
    }
}

function adddatapie(data) {
    var key = Object.keys(Chart.instances)[0];
    var chart = Chart.instances[key];
    var ndata = chart.data.datasets[0].data;

    var ndata1 = chart.data.datasets[1].data;
    var label = chart.data.labels
    chart.data.datasets[1].data[1] = 100 - Math.floor(data)
    ndata1[0] = data
    console.log(ndata[0]);
    label.push("ok")
    if (ndata1[0] <= 48.99) {
        chart.data.datasets[1].backgroundColor[0] = 'red'
        var text = "You look sad. Take care of yourself.";
        document.getElementById("text").style.color = "#ff0000";
        chart.data.datasets[0].label = "Sad";

    } else if (ndata1[0] <= 56.99) {
        chart.data.datasets[1].backgroundColor[0] = 'yellow'
        var text = "Today be not cheerful. Keep going!";
        document.getElementById("text").style.color = "yellow";
        chart.data.datasets[0].label = "Not okay"
    } else if (ndata1[0] <= 73.99) {
        chart.data.datasets[1].backgroundColor[0] = 'MediumSeaGreen'
        var text = "You look ok, Are you happy?";
        document.getElementById("text").style.color = "MediumSeaGreen";
        chart.data.datasets[0].label = "It's ok"
    } else if (ndata1[0] <= 100.00) {
        chart.data.datasets[1].backgroundColor[0] = 'green'
        var text = "You look very happy, I’ve got your back.";
        document.getElementById("text").style.color = "green";
        chart.data.datasets[0].label = "Pretty good"
    } else if (ndata1[0] > 100) {
        chart.data.datasets[1].backgroundColor[0] = 'green'
        var text = "ํou look very happy, Pound of u.";
        document.getElementById("text").style.color = "green";
    }

    document.getElementById("text").innerHTML = text;
    chart.update();
}