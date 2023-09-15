/*
 *
 * Costom jQuery
 *
 */
/*-- loading page --*/

var myVar;
function myFunctionLoader() {
    myVar = setTimeout(showPage, 200);
}
function showPage() {
  $("#loader").fadeOut("slow");
}

  $(function () {
    $('#data_user').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 3, 4, 5, 6, 7, 8 ]
                }
            },
        ]
    })
    $('#example1').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
        },
    })
    $('#example2').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
        },
    })
    $('#example3').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
        },
    })
    $('#example4').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            },
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });

/*-- append to footer bottom --*/


/*-- date picker --*/
$( document ).ready(function() {
    $("#datepicker").datepicker({
        format: 'dd-mm-yyyy'
    });
    $("#datepicker").on("change", function () {
        var fromdate = $(this).val();
    });
});

$(function () {
	//Timepicker
	$('.timepicker').timepicker({
	  showInputs: false,
	  showMeridian: false
	})
});

$(function() {
  $('html, body, .wrapper').css('height', '100%');
})
