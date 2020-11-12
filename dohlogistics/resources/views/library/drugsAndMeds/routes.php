<div class="container-fluid">
    <a href="/library/drugsAndMeds"><i class="fa fa-angle-double-left"></i> Back to DM References</a>
    <h5 class="border-bottom mt-2">Routes</h5>
    <div class="row mt-4">
        <div class="col-12 border-right">
            <div class="p-1">
                <div><button class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#routeModal" data-backdrop="static" data-keyboard="false">New Route</button></div>
                <small class="font-weight-bold">Existing Routes</small>
                <small class="text-muted ml-2 font-italic">Hint: You can click each entry to update it</small>
                <input type="text" id="search" class="form-control col-4 search" id="" placeholder="Search Unit here. . ." >
                <div class="list-group col-4" id="routes" style="max-height: 600px;overflow-y: auto">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="routeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Route</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" id="route" class="form-control" placeholder="New Route here!">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="createRoute" class="btn btn-primary">Save Unit</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="routeUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Route</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <input type="hidden" id="routeID">
                    <input type="text" id="routeInput" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="updateRoute" class="btn btn-primary">Update Route</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#routes button").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        referenceRoutes('#routes', 'buttons');
        $('#updateRoute').click(function () {
            data = {
                'route': $('#routeInput').val()
            };
            postCreate('/api/library/route/'+$('#routeID').val(), data);
        });
        $('#createRoute').click(function (){
            if(dataRequired(['#route']) === 0) {
                data = {
                    'route': $('#route').val()
                };
                postCreate('/api/library/route/create', data);
            }

        });
        $('#routeModal').on('hidden.bs.modal', function () {
            $('#route').val('');
            referenceRoutes('#routes', 'buttons');

        });
        $('#routeUpdateModal').on('hidden.bs.modal', function () {
            $('#routeInput').val('');
            referenceRoutes('#routes', 'buttons');
        });
    });
</script>
