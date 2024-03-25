//setup dataTable
new DataTable('.report',{
    order: [[0, 'desc']],
    layout: {
    topStart: {
        buttons: ['copy', 'csv', 'excel', 'print']
    }
}
});

//Session Date filter
let minDate, maxDate;

// Custom filtering function which will search data in column four between two values
DataTable.ext.search.push(function (settings, data, dataIndex) {
    let min = minDate.val();
    let max = maxDate.val();
    let date = new Date(data[8]);

    if (
        (min === null && max === null) ||
        (min === null && date <= max) ||
        (min <= date && max === null) ||
        (min <= date && date <= max)
    ) {
        return true;
    }
    return false;
});

// Create date inputs
minDate = new DateTime('#min', {
    format: 'DD-MMM-YYYY'
});
maxDate = new DateTime('#max', {
    format: 'DD-MMM-YYYY'
});

// DataTables initialisation
let table = new DataTable('.report');

// Refilter the table
document.querySelectorAll('#min, #max').forEach((el) => {
    el.addEventListener('change', () => table.draw());
});
