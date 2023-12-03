function addTypeButton() {
    const input = document.getElementById('add_type').value;
    const newInfoDiv = document.getElementById('add_data');
    const newInfo = document.createElement('div');
    newInfoDiv.innerHTML = '';
    if (input === 'galaxy') {
        newInfo.innerHTML = '<h3>Insert Values into galaxy table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Galaxy ID: <input type="text" name="id"> <br /><br />' +
            'Galaxy Size: <input type="text" name="SIZE"> <br /><br />' +
            'Galaxy Type: <input type="text" name="TYPE"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="galaxy">'+
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else if (input === 'satellite') {
        newInfo.innerHTML = '<h3>Insert Values into satellite table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Satellite ID: <input type="text" name="id"> <br /><br />' +
            'ID of Satellite\'s Planet: <input type="text" name="planetId"> <br /><br />' +
            'Satellite Mass: <input type="text" name="mass"> <br /><br />' +
            'Is this a Moon?: <input type="checkbox" name="ismoon"> <br /><br />' +
            'Radius: <input type="text" name="radius"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="satellite">'+
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else if (input === 'asteroid') {
        newInfo.innerHTML = '<h3>Insert Values into asteroid table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Asteroid ID: <input type="text" name="id"> <br /><br />' +
            'Asteroid Composition: <input type="text" name="composition"> <br /><br />' +
            'Galaxy ID: <input type="text" name="galaxyID"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="asteroid">' +
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else if (input === 'planetarysystem') {
        newInfo.innerHTML = '<h3>Insert Values into planetary system table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Planetary System ID: <input type="text" name="id"> <br /><br />' +
            'Planetary System Type: <input type="text" name="systemType"> <br /><br />' +
            'Planetary System Age: <input type="text" name="age"> <br /><br />' +
            'Galaxy ID: <input type="text" name="galaxyID"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="planetarysystem">' +
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else if (input === 'planet') {
        newInfo.innerHTML = '<h3>Insert Values into planet table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Planet ID: <input type="text" name="id"> <br /><br />' +
            'Declination: <input type="text" name="declination"> <br /><br />' +
            'Right Ascension: <input type="text" name="rightAscension"> <br /><br />' +
            'Mass: <input type="text" name="mass"> <br /><br />' +
            'Radius: <input type="text" name="radius"> <br /><br />' +
            'Planet Type: <input type="text" name="planetType"> <br /><br />' +
            'Planetary System ID: <input type="text" name="planetarySystemId"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="planet">' +
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else if (input === 'meteor') {
        newInfo.innerHTML = '<h3>Insert Values into meteor table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Meteor ID: <input type="text" name="id"> <br /><br />' +
            'Planet Entered ID: <input type="text" name="planetEnteredId"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="meteor">' +
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else if (input === 'nebula') {
        newInfo.innerHTML = '<h3>Insert Values into nebula table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Nebula ID: <input type="text" name="id"> <br /><br />' +
            'Nebula Type: <input type="text" name="TYPE"> <br /><br />' +
            'Nebula Magnitude: <input type="text" name="magnitude"> <br /><br />' +
            'Galaxy ID: <input type="text" name="galaxyID"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="nebula">' +
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else if (input === 'star') {
        newInfo.innerHTML = '<h3>Insert Values into star table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Star ID: <input type="text" name="id"> <br /><br />' +
            'Declination: <input type="text" name="declination"> <br /><br />' +
            'Right Ascension: <input type="text" name="rightAscension"> <br /><br />' +
            'Mass: <input type="text" name="mass"> <br /><br />' +
            'Radius: <input type="text" name="radius"> <br /><br />' +
            'Temperature: <input type="text" name="temperature"> <br /><br />' +
            'Luminosity: <input type="text" name="luminosity"> <br /><br />' +
            'Planetary System ID: <input type="text" name="planetarySystemID"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="star">' +
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else if (input === 'blackhole') {
        newInfo.innerHTML = '<h3>Insert Values into black hole table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="insertQueryRequest" name="insertQueryRequest">' +
            'Black Hole ID: <input type="text" name="id"> <br /><br />' +
            'Radius: <input type="text" name="radius"> <br /><br />' +
            'Mass: <input type="text" name="mass"> <br /><br />' +
            'Galaxy ID: <input type="text" name="galaxyID"> <br /><br />' +
            '<input type="hidden" id="insert_table_name" name="insertTableName" value="blackhole">' +
            '<input type="submit" value="Insert" name="insertSubmit"></p>' +
            '</form>';
    } else {
        newInfo.innerHTML = '<p>NOT YET IMPLEMENTED</p>';
    }
    newInfoDiv.appendChild(newInfo);
}





// handle update
function updateButton() {
    const input = document.getElementById('update_type').value;
    const updateInfoDiv = document.getElementById('update_data');
    const updateInfo = document.createElement('div');
    updateInfoDiv.innerHTML = '';

    if (input === 'galaxy') {
        updateInfo.innerHTML = '<h3>Update Values in galaxy table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="updateQueryRequest" name="updateQueryRequest">' +
            'Galaxy ID to Update: <input type="text" name="oldId"> <br /><br />' +
            'New Galaxy Size: <input type="text" name="newSize"> <br /><br />' +
            'New Galaxy Type: <input type="text" name="newType"> <br /><br />' +
            '<input type="hidden" id="update_table_name" name="updateTableName" value="galaxy">' +
            '<input type="submit" value="Update" name="updateSubmit"></p>' +
            '</form>';
    } else if (input === 'satellite') {
        updateInfo.innerHTML = '<h3>Update Values in satellite table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="updateQueryRequest" name="updateQueryRequest">' +
            'Satellite ID to Update: <input type="text" name="oldId"> <br /><br />' +
            'New ID of Satellite\'s Planet: <input type="text" name="newPlanetId"> <br /><br />' +
            'New Satellite Mass: <input type="text" name="newMass"> <br /><br />' +
            '<input type="hidden" id="update_table_name" name="updateTableName" value="satellite">' +
            '<input type="submit" value="Update" name="updateSubmit"></p>' +
            '</form>';
    } else {
        updateInfo.innerHTML = '<p>NOT YET IMPLEMENTED</p>';
    }

    updateInfoDiv.appendChild(updateInfo);
}


// handle remove button
function removeButton() {
    const input = document.getElementById('remove_type').value;
    const removeInfoDiv = document.getElementById('remove_data');
    const removeInfo = document.createElement('div');
    removeInfoDiv.innerHTML = '';

    // Implement logic similar to addTypeButton for each type
    if (input === 'galaxy') {
        removeInfo.innerHTML = '<h3>Remove Values from galaxy table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="removeQueryRequest" name="removeQueryRequest">' +
            'Galaxy ID to Remove: <input type="text" name="removeId"> <br /><br />' +
            '<input type="hidden" id="remove_table_name" name="removeTableName" value="galaxy">' +
            '<input type="submit" value="Remove" name="removeSubmit"></p>' +
            '</form>';
    } else if (input === 'satellite') {
        removeInfo.innerHTML = '<h3>Remove Values from satellite table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="removeQueryRequest" name="removeQueryRequest">' +
            'Satellite ID to Remove: <input type="text" name="removeId"> <br /><br />' +
            '<input type="hidden" id="remove_table_name" name="removeTableName" value="satellite">' +
            '<input type="submit" value="Remove" name="removeSubmit"></p>' +
            '</form>';
    } else if (input === 'planet') {
        removeInfo.innerHTML = '<h3>Remove Values from planet table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="removeQueryRequest" name="removeQueryRequest">' +
            'Planet ID to Remove: <input type="text" name="removeId"> <br /><br />' +
            '<input type="hidden" id="remove_table_name" name="removeTableName" value="planet">' +
            '<input type="submit" value="Remove" name="removeSubmit"></p>' +
            '</form>';
    } else if (input === 'asteroid') {
        removeInfo.innerHTML = '<h3>Remove Values from asteroid table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="removeQueryRequest" name="removeQueryRequest">' +
            'Asteroid ID to Remove: <input type="text" name="removeId"> <br /><br />' +
            '<input type="hidden" id="remove_table_name" name="removeTableName" value="asteroid">' +
            '<input type="submit" value="Remove" name="removeSubmit"></p>' +
            '</form>';
    } else if (input === 'meteor') {
        removeInfo.innerHTML = '<h3>Remove Values from meteor table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="removeQueryRequest" name="removeQueryRequest">' +
            'Meteor ID to Remove: <input type="text" name="removeId"> <br /><br />' +
            '<input type="hidden" id="remove_table_name" name="removeTableName" value="meteor">' +
            '<input type="submit" value="Remove" name="removeSubmit"></p>' +
            '</form>';
    } else if (input === 'nebula') {
        removeInfo.innerHTML = '<h3>Remove Values from nebula table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="removeQueryRequest" name="removeQueryRequest">' +
            'Nebula ID to Remove: <input type="text" name="removeId"> <br /><br />' +
            '<input type="hidden" id="remove_table_name" name="removeTableName" value="nebula">' +
            '<input type="submit" value="Remove" name="removeSubmit"></p>' +
            '</form>';
    } else if (input === 'star') {
        removeInfo.innerHTML = '<h3>Remove Values from star table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="removeQueryRequest" name="removeQueryRequest">' +
            'Star ID to Remove: <input type="text" name="removeId"> <br /><br />' +
            '<input type="hidden" id="remove_table_name" name="removeTableName" value="star">' +
            '<input type="submit" value="Remove" name="removeSubmit"></p>' +
            '</form>';
    } else if (input === 'blackhole') {
        removeInfo.innerHTML = '<h3>Remove Values from blackhole table</h3>' +
            '<form method="POST" action="admin.php">' +
            '<input type="hidden" id="removeQueryRequest" name="removeQueryRequest">' +
            'Black Hole ID to Remove: <input type="text" name="removeId"> <br /><br />' +
            '<input type="hidden" id="remove_table_name" name="removeTableName" value="blackhole">' +
            '<input type="submit" value="Remove" name="removeSubmit"></p>' +
            '</form>';
    } else {
        removeInfo.innerHTML = '<p>NOT YET IMPLEMENTED</p>';
    }

    removeInfoDiv.appendChild(removeInfo);
}