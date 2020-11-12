<div class="container-fluid">
    <a href="/library"><i class="fa fa-angle-double-left"></i> Back to Library</a>
    <h5 class="border-bottom mt-2">Programs</h5>
    <div class="row mt-4">
        <div class="col-12 border-right">
            <div class="p-1">
                <div><button class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#programModal" data-backdrop="static" data-keyboard="false">New Program</button></div>
                <small class="font-weight-bold">Existing Program(s)</small>
                <small class="text-muted ml-2 font-italic">Hint: You can click each entry to update it</small>
                <input type="text" id="search" class="form-control col-4 search" id="" placeholder="Search Form here. . ." >
                <div class="list-group col-4" id="programs" style="max-height: 600px;overflow-y: auto">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="programModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" id="form" class="form-control" placeholder="New Program here!">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="createProgram" class="btn btn-primary">Save Program</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="programUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <input type="hidden" id="programID">
                    <input type="text" id="programInput" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="updateProgram" class="btn btn-primary">Update Program</button>
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
        referencePrograms('#programs', 'buttons');
        $('#updateProgram').click(function () {
            data = {
                'form': $('#formInput').val()
            };
            postCreate('/api/library/program/'+$('#programID').val(), data);
        });
        $('#createProgram').click(function (){
            if(dataRequired(['#program']) === 0) {
                data = {
                    'program': $('#program').val()
                };
                postCreate('/api/library/program/create', data);
            }

        });
        $('#programModal').on('hidden.bs.modal', function () {
            $('#program').val('');
            referencePrograms('#programs', 'buttons');

        });
        $('#programUpdateModal').on('hidden.bs.modal', function () {
            $('#programInput').val('');
            referencePrograms('#programs', 'buttons');
        });
    });
</script>
