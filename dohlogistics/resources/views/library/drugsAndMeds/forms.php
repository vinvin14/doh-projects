<div class="container-fluid">
    <a href="/library/drugsAndMeds"><i class="fa fa-angle-double-left"></i> Back to DM References</a>
    <h5 class="border-bottom mt-2">Forms</h5>
    <div class="row mt-4">
        <div class="col-12 border-right">
            <div class="p-1">
                <div><button class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#formModal" data-backdrop="static" data-keyboard="false">New Form</button></div>
                <small class="font-weight-bold">Existing forms</small>
                <small class="text-muted ml-2 font-italic">Hint: You can click each entry to update it</small>
                <input type="text" id="search" class="form-control col-4 search" id="" placeholder="Search Form here. . ." >
                <div class="list-group col-4" id="forms" style="max-height: 600px;overflow-y: auto">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" id="form" class="form-control" placeholder="New form here!">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="createform" class="btn btn-primary">Save Form</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="formUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <input type="hidden" id="formID">
                    <input type="text" id="formInput" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="updateform" class="btn btn-primary">Update form</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#forms button").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        referenceForms('#forms', 'buttons');
        $('#updateform').click(function () {
            data = {
                'form': $('#formInput').val()
            };
            postCreate('/api/library/form/'+$('#formID').val(), data);
        });
        $('#createform').click(function (){
            if(dataRequired(['#form']) === 0) {
                data = {
                    'form': $('#form').val()
                };
                postCreate('/api/library/form/create', data);
            }

        });
        $('#formModal').on('hidden.bs.modal', function () {
            $('#form').val('');
            referenceForms('#forms', 'buttons');

        });
        $('#formUpdateModal').on('hidden.bs.modal', function () {
            $('#formInput').val('');
            referenceForms('#forms', 'buttons');
        });
    });
</script>
