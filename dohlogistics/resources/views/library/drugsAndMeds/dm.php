<style>
    table
    {
        min-width: 1200px !important;
        overflow-y: auto;
    }
    .table-fixed tbody {
        height: 600px;
        overflow-y: auto;
        width: 100%;
    }

    .table-fixed thead,
    .table-fixed tbody,
    .table-fixed tr,
    .table-fixed td,
    .table-fixed th {
        display: block;
    }

    .table-fixed tbody td,
    .table-fixed tbody th,
    .table-fixed thead > tr > th {
        float: left;
        position: relative;

    &::after {
         content: '';
         clear: both;
         display: block;
     }
    }
</style>
<div class="container-fluid">
    <a href="/library/drugsAndMeds" class="mb-2"><i class="fa fa-angle-double-left"></i> Back to Library</a>
    <div class="card card-body mt-2">
        <div class="d-flex justify-content-between">
            <span class="lead text-info">Existing Drugs and Medicines</span>
            <button class="btn btn-outline-primary ml-3" data-toggle="modal" data-target="#dmModal" data-backdrop="static" data-keyboard="false">Create New DM</button>
        </div>
        <small class="font-weight-bold text-info" id="dmCount"></small>
        <input type="text" id="search" class="form-control search" placeholder="Search Item Here">
        <div class="table-responsive">
            <table class="table table-fixed">
                <thead>
                <tr>
                    <th scope="col" class="col-4">First Category</th>
                    <th scope="col" class="col-4">Second Category</th>
                    <th scope="col" class="col-2">Route</th>
                    <th scope="col" class="col-1">Form</th>
                    <th scope="col" class="col-1">&nbsp;</th>
                </tr>
                </thead>
                <tbody id="drugsAndMeds">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="dmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New DM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3 firstCategory">
                        <small class="font-weight-bold">First Category</small>
                        <input type="text" id="firstCategory" class="form-control">
                    </div>
                    <div class="col-3 secondCategory">
                        <small class="font-weight-bold">Second Category</small>
                        <input type="text" id="secondCategory" class="form-control">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Route</small>
                        <select name="" id="route" class="form-control"></select>
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Form</small>
                        <select name="" id="form" class="form-control"></select>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="font-weight-bold">Description</small>
                    <textarea name="" id="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveDM">Record this DM</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#drugsAndMeds tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        libraryDM();
        referenceRoutes('#route', 'select');
        referenceForms('#form', 'select');
        $('#saveDM').on('click', function (){
            if(dataRequired(['#firstCategory', '#secondCategory', '#route', '#form']) === 0)
            {
                var data = {
                    'firstCategory' : $('#firstCategory').val(),
                    'secondCategory' : $('#secondCategory').val(),
                    'route' : $('#route').val(),
                    'form' : $('#form').val(),
                    'description' : $('#description').val()
                };

                postCreate('/api/library/drugsAndMeds/create', data);
                $('input, select, textarea').val('');
                $('input, select').css('border-color', 'black');
            }
        });
        $('#dmModal').on('hidden.bs.modal', function () {
            libraryDM();

        });
    });
</script>
