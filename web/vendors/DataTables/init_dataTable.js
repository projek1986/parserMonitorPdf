       
        
function init_dataTable(table_name){
    var table = $(table_name).DataTable({
            dom: 'Bfrtip',
            buttons: [
               'excel'
            ],
            "scrollY": "530px",
            "scrollX": "800px",
            "scrollCollapse": true,
            paging: true,
            stateSave: true,
            "oLanguage": {
                "sInfo": "Wyników _TOTAL_  (_START_ do _END_)",
                "sSearch": "Szukaj:"

            }
            
        }
    );

}