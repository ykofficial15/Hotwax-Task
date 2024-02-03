function fetchData(table) {
    jQuery.ajax({
        url: `http://localhost/hotwax/${table}_api.php`,
        type: 'GET',
        dataType: 'json', // Set the expected data type to JSON
        success: function (data) {
            displayData(data, table);
        },
        error: function (error) {
            console.error('Error fetching data:', error.responseText);
        }
    });
}

function displayData(data, table) {
    const tableBody = jQuery(`#${table}TableBody`);
    tableBody.empty();

    data.forEach(item => {
        let row = '<tr>';
        Object.values(item).forEach(value => {
            row += `<td>${value}</td>`;
        });
        row += '</tr>';
        tableBody.append(row);
    });
}
