<div class="container-fluid">
    <h6>Pending</h6>
    <div class="table-responsive p-3" style="max-height: 600px; overflow-y: auto">
        <table class="table table-border" >
            <thead>
            <th>1st Category Name</th>
            <th>2nd Category Name</th>
            <th>Description</th>
            <th>Branch</th>
            <th>Category</th>
            <th>Item Cost</th>
            <th>Unit</th>
            <th></th>
            </thead>
            <tbody>
            <?php
            foreach (@$data['twg'] as $twg)
            {
                echo '
                    <tr>
                        <td>',$twg->firstCategory,'</td>
                        <td>',$twg->secondCategory,'</td>
                        <td style="max-width: 200px;overflow-x: auto">',$twg->description,'</td>
                        <td>',$twg->branch,'</td>
                        <td>',$twg->category,'</td>
                        <td>₱',number_format($twg->itemCost),'</td>
                        <td>',$twg->unit,'</td>
                        <td><a href="#" id="twgView" data-id="',$twg->id,'" title="Check TWG" data-toggle="modal" data-target="#twgUpdate" data-backdrop="static" data-keyboard="false"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    ';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="twgUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Specification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="p-2">
                    <div class="">
                        <small class="font-weight-bold">1st Category Name</small>
                        <input type="text" id="firstCategory" class="form-control">
                    </div>
                    <div class="">
                        <small class="font-weight-bold">2nd Category Name</small>
                        <input type="text" id="secondCategory" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <small class="font-weight-bold">Branch</small>
                            <select id="branch" class="form-control">
                            </select>
                        </div>
                        <div class="col-6">
                            <small class="font-weight-bold">Category</small>
                            <select id="category" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <small class="font-weight-bold">Item Cost</small>
                            <input type="number" id="itemCost" step="any" class="form-control">
                        </div>
                        <div class="col-6">
                            <small class="font-weight-bold">Unit</small>
                            <select id="unit" class="form-control">
                            </select>
                        </div>
                    </div>
                    <small class="font-weight-bold">Description</small>
                    <textarea name="" id="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success float-left" id="acceptEntry" data-dismiss="modal">Accept Entry</button>
                <button type="button" data-id="" id="declineEntry" class="btn btn-danger float-right">Decline Entry</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        referenceBranch('#branch', 'select');
        referenceUnits('#unit', 'select');
        referenceCategory('#category', 'select');

        $('a[id="twgView"]').click(function (){
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/api/twg/'+id,
                type: 'get',
                success: function (data) {
                    // console.log(data.response);
                    $('#twgUpdate').on('shown.bs.modal', function () {
                        $('#firstCategory').val(data.response.firstCategory);
                        $('#secondCategory').val(data.response.secondCategory);
                        $('#branch').val(data.response.branch);
                        $('#unit').val(data.response.unit);
                        $('#category').val(data.response.category);
                        $('#itemCost').val(data.response.itemCost);
                        $('#description').val(data.response.description);
                    });
                    $('#twgUpdate').on('hidden.bs.modal', function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    });
                    $('#acceptEntry').click(function (){
                        if(dataRequired(['#firstCategory', '#secondCategory', '#branch']) === 0)
                        {
                            var data = {
                                'firstCategory' : $('#firstCategory').val(),
                                'secondCategory' : $('#secondCategory').val(),
                                'description' : $('#description').val(),
                                'branch' : $('#branch').val(),
                                'category' : $('#category').val(),
                                'unit' : $('#unit').val(),
                                'itemCost' : $('#itemCost').val(),
                                'status' : 'approved'
                            };
                            postCreate('/twg/update/'+id, data);
                            // $('input, select, textarea').val('');
                            $('input, select').css('border-color', '#cccccc');
                        }
                    });
                    $('#declineEntry').click(function (){
                        var data = {
                            'status' : 'denied'
                        };
                        postCreate('/twg/update/'+id, data);
                    });
                }
            });

        });
    });
</script>
