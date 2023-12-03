function idButton() {
    const input = document.getElementById('select_by_id').value;
    
    // newInfo.innerHTML = '<form method="GET" action="home.php">\n' +
    // 'Filter by Type: <input name="type"><br>' +
    // '<p>Select Columns: </p>' +
    // 'Type:<input type="checkbox" name="typeCheck" checked>' +
    // 'Size:<input type="checkbox" name="sizeCheck" checked>' +
    // '<input type="submit" value="Submit" name="submit">' +
    // '</form>';
    console.log(input);
}

function filterButton1() {
    const input = document.getElementById('select_by_filters').value;
    const newInfoDiv = document.getElementById('filter_search_2');
    const newInfo = document.createElement('div');
    newInfoDiv.innerHTML = '';
    if (input === 'galaxy') {
        newInfo.innerHTML = '<form method="GET" action="home.php">\n' +
            '<input type="hidden" id="galaxyQuery" name="galaxyQuery">\n' +
            'Filter by Size:<select name="comparison">' +
            '<option value=">">Greater than</option><option value="<">Less than</option>' +
            '<option value="=">Equal to</option></select>' +
            '<input name="size"><br>' +
            'Filter by Type: <input name="type"><br>' +
            '<p>Select Columns: </p>' +
            'Type:<input type="checkbox" name="typeCheck" checked>' +
            'Size:<input type="checkbox" name="sizeCheck" checked>' +
            '<input type="submit" value="Submit" name="submit">' +
            '</form>';
    }
    else if (input === 'satellite') {
        newInfo.innerHTML = '<form method="GET" action="home.php">\n' +
            '<input type="hidden" id="satelliteQuery" name="satelliteQuery">\n' +
            'Filter by Planet ID:<input name="planetId"><br>' +
            'Filter by Size:<select name="sizeComparison">' +
            '<option value=">">Greater than</option><option value="<">Less than</option>' +
            '<option value="eq">Equal to</option></select>' +
            '<input type="number" name="mass"><br>' +
            'Filter by is Moon:<input type="checkbox" name="isMoon"><br>' +
            'Filter by Radius:<select name="satellite_f_radius_compare">' +
            '<option value=">">Greater than</option><option value="<">Less than</option>' +
            '<option value="=">Equal to</option></select>' +
            '<input type="number" name="radiusComparison"><br>' +
            '<p>Select Columns: </p>' +
            'ID:<input type="checkbox" name="idCheck" checked>' +
            'Mass:<input type="checkbox" name="massCheck" checked>' +
            'Is Moon:<input type="checkbox" name="isMoonCheck" checked>' +
            'Radius:<input type="checkbox" name="radiusCheck" checked><br>' +
            '<input type="submit" value="Submit" name="submit">' +
            '</form>';
    }
    else if (input === 'nebula') {
        newInfo.innerHTML = '<form method="GET" action="home.php">\n' +
            '<input type="hidden" id="nebulaQuery" name="nebulaQuery">\n' +
            'Click the button to view the average Magnitude of all types of Nebulae: ' +
            '<input type="submit" value="Submit" name="submit">\n' +
            '</form>';
    }
    else if (input === 'black_hole') {
        newInfo.innerHTML = '<form method="GET" action="home.php">\n' +
            '<input type="hidden" id="blackHoleQuery" name="blackHoleQuery">\n' +
            'Get all black hole types comapred with the Radius: <br>' +
            ' Radius is: <select id="comparison" name="comparison">' +
            '<option value=">">Greater than</option><option value="<">Less than</option>\n' +
            '<option value="=">Equal to</option></select>\n' +
            '<input type="number" id="radius" name="radius"><br>\n'+
            '<input type="submit" value="Submit" name="submit">\n' +
            '</form>';
    }
    else if (input === 'star') {
        newInfo.innerHTML = '<form method="GET" action="home.php">\n' +
            '<input type="hidden" id="planetQuery" name="planetQuery">\n' +
            'Press to view the number of stars per galaxy: ' +
            '<input type="submit" value="Submit" name="submit">' +
            '</form>';
    }
    else if (input === 'asteroid') {
        newInfo.innerHTML = '<form method="GET" action="home.php">\n' +
            '<input type="hidden" id="asteroidQuery" name="asteroidQuery">\n' +
            'Press to view the galaxies that have every type of asteroid: ' +
            '<input type="submit" value="Submit" name="submit">' +
            '</form>';
    }
    else if (input === 'planetary_system') {
        newInfo.innerHTML = '<form method="GET" action="home.php">\n' +
            '<input type="hidden" id="planetarySystemQuery" name="planetarySystemQuery">\n' +
            'Enter a Galaxy ID to view all planets in that galaxy: <input name="galaxyId">' +
            '<input type="submit" value="Submit" name="submit">' +
            '</form>';
    }
    else {
        newInfo.innerHTML = '<p>NOT YET IMPLEMENTED</p>'
    }
    newInfoDiv.appendChild(newInfo);
}