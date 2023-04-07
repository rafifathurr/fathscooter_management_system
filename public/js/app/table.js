// Add Row
$('#add-row').DataTable({
	"pageLength": 10,
});

var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-simple-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-simple-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

$('#addRowButton').click(function() {
	$('#add-row').dataTable().fnAddData([
		$("#addName").val(),
		$("#addPosition").val(),
		$("#addOffice").val(),
		action
		]);
	$('#addRowModal').modal('hide');

});
