<div class="container-fluid">
    <a href="/library"><i class="fa fa-angle-double-left"></i> Back to Library</a>
    <h5 class="border-bottom mt-2">Unit of Measurement</h5>
    <div class="row mt-4">
        <div class="col-12 border-right">
            <div class="p-1">
                <div><button class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#unitModal" data-backdrop="static" data-keyboard="false">New Unit</button></div>
                <small class="font-weight-bold">Existing Units</small>
                <small class="text-muted ml-2 font-italic">Hint: You can click each entryc to update it</small>
                <input type="text" id="search" class="form-control col-4 search" id="" placeholder="Search Unit here. . ." >
                <div class="list-group col-4" id="units" style="max-height: 600px;overflow-y: auto">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" id="unit" class="form-control" placeholder="New Unit here">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="createUnit" class="btn btn-primary">Save Unit</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="unitUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <input type="hidden" id="unitId">
                    <input type="text" id="unitInput" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="updateUnit" class="btn btn-primary">Update Unit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#units button").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        referenceUnits('#units', 'buttons');
        $('#updateUnit').click(function () {
            data = {
                'unit': $('#unitInput').val()
            };
            postCreate('/api/library/unit/'+$('#unitId').val(), data);
        });
        $('#createUnit').click(function (){
            if(dataRequired(['#unit']) === 0) {
                data = {
                    'unit': $('#unit').val()
                };
                postCreate('/api/library/unit/create', data);
            }

        });
        $('#unitModal').on('hidden.bs.modal', function () {
            $('#unit').val('');
            referenceUnits('#units', 'buttons');

        });
        $('#unitUpdateModal').on('hidden.bs.modal', function () {
            $('#unitInput').val('');
            referenceUnits('#units', 'buttons');
        });
    });
</script>
