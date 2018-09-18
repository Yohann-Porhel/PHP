<h2>Répartition du CA par type de financeur :</h2>
<div align="center" id="graph1"></div>
<br>
<h2>Volume d'heures par trimestre</h2>
<div align="center" id="graph2"></div>
<br>
<h2>Autres exemples</h2>
<div align="center" id="graph3"></div>
<br>
<br>
<div align="center" id="graph4"></div>

<script>
    new Morris.Donut({
        element: 'graph1',
        resize: true,
        data: [
            {value: 70, label: 'CG22'},
            {value: 15, label: 'APA'},
            {value: 10, label: 'PAYANT'},
            {value: 5, label: 'CRAM'}
        ],
        backgroundColor: '#ccc',
        labelColor: '#060',
        colors: [
            '#0BA462',
            '#39B580',
            '#67C69D',
            '#95D7BB'
        ],
        formatter: function (x) {
            return x + "%"
        }
    });


    new Morris.Bar({
        element: 'graph2',
        data: [
            {x: '1er Trim. 2016', y: 3, z: 2, a: 3},
            {x: '2nd Trim. 2016', y: 2, z: null, a: 1},
            {x: '3éme Trim. 2016', y: 0, z: 2, a: 4},
            {x: '4éme Trim. 2016', y: 2, z: 4, a: 3}
        ],
        xkey: 'x',
        ykeys: ['y', 'z', 'a'],
        labels: ['Y', 'Z', 'A']
    }).on('click', function (i, row) {
        console.log(i, row);
    });

    var decimal_data = [];
    for (var x = 0; x <= 360; x += 10) {
        decimal_data.push({
            x: x,
            y: 1.5 + 1.5 * Math.sin(Math.PI * x / 180).toFixed(4)
        });
    }
    new Morris.Line({
        element: 'graph3',
        data: decimal_data,
        xkey: 'x',
        ykeys: ['y'],
        labels: ['sin(x)'],
        parseTime: false,
        hoverCallback: function (index, options, default_content, row) {
            return default_content.replace("sin(x)", "1.5 + 1.5 sin(" + row.x + ")");
        },
        xLabelMargin: 10,
        integerYLabels: true
    });

// Use Morris.Area instead of Morris.Line
    new Morris.Area({
        element: 'graph4',
        data: [
            {x: '2010 Q4', y: 3, z: 7},
            {x: '2011 Q1', y: 3, z: 4},
            {x: '2011 Q2', y: null, z: 1},
            {x: '2011 Q3', y: 2, z: 5},
            {x: '2011 Q4', y: 8, z: 2},
            {x: '2012 Q1', y: 4, z: 4}
        ],
        xkey: 'x',
        ykeys: ['y', 'z'],
        labels: ['Y', 'Z']
    }).on('click', function (i, row) {
        console.log(i, row);
    });
</script>