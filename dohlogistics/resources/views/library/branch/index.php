<div class="container-fluid">
    <a href="/library"><i class="fa fa-angle-double-left"></i> Back to Library</a>
    <h5 class="border-bottom mt-2">Branch</h5>
    <div class="row mt-4">
        <div class="col-12 border-right">
            <div class="p-1">
                <div><button class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#branchModal" data-backdrop="static" data-keyboard="false">New Branch</button></div>
                <small class="font-weight-bold">Existing Branches</small>
                <small class="text-muted ml-2 font-italic">Hint: You can click each entry to update it</small>
                <input type="text" id="search" class="form-control col-4 search" id="" placeholder="Search Branch here. . ." >
                <div class="list-group col-4" id="branches" style="max-height: 600px;overflow-y: auto">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" id="branch" class="form-control" placeholder="New Branch here">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="createBranch" class="btn btn-primary">Save Unit</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="branchUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <input type="hidden" id="branchId">
                    <input type="text" id="branchInput" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="updateBranch" class="btn btn-primary">Update Unit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#branches button").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        referenceBranch('#branches', 'buttons');
        $('#updateBranch').click(function () {
            data = {
                'branch': $('#branchInput').val()
            };
            postCreate('/api/library/branch/'+$('#branchId').val(), data);
        });
        $('#createBranch').click(function (){
            if(dataRequired(['#branch']) === 0) {
                data = {
                    'branch': $('#branch').val()
                };
                postCreate('/api/library/branch/create', data);
            }
        });
        $('#branchModal').on('hidden.bs.modal', function () {
            $('#branch').val('');
            referenceBranch('#branches', 'buttons');

        });
        $('#branchUpdateModal').on('hidden.bs.modal', function () {
            $('#branchInput').val('');
            referenceBranch('#branches', 'buttons');
        });
    });
</script>
