<div class="container-fluid">
    <a href="/library/items" class="mb-2"><i class="fa fa-angle-double-left"></i> Back to Items</a>
    <div class="card card-body mt-2">
        <div class="h4 text-muted border-bottom">Item Information</div>
        <div class="row mt-3 p-3 border-bottom">
            <div class="col-3">
                <small>First Category</small>
                <div class="font-weight-bold"><?=@$data['item']->firstCategory?></div>
            </div>
            <div class="col-3">
                <small>Second Category</small>
                <div class="font-weight-bold"><?=@$data['item']->secondCategory?></div>
            </div>
            <div class="col-3">
                <small>Branch</small>
                <div class="font-weight-bold"><?=@$data['item']->branch?></div>
            </div>
        </div>
        <div class="mt-3 px-3">
            <small>Description</small>
            <textarea name="" id="" cols="30" rows="10" class="form-control" readonly><?=@$data['item']->description?></textarea>
        </div>
        <div class="mt-3 px-3">
            <button class="btn btn-dark form-control" data-toggle="modal" data-target="#updateItemModal" data-backdrop="static" data-keyboard="false"><i class="far fa-calendar-check"></i> Update this item</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-bold border-bottom">Item Information</h5>
                <div class="row mt-3 px-3">
                    <div class="col-6">
                        <small class="font-weight-bold">First Category</small>
                        <input type="text" id="firstCategory" class="form-control" value="<?=@$data['item']->firstCategory?>">
                    </div>
                    <div class="col-6">
                        <small class="font-weight-bold">Second Category</small>
                        <input type="text" id="secondCategory" class="form-control" value="<?=@$data['item']->secondCategory?>">
                    </div>
                </div>
                <div class="row mt-3 px-3">
                    <div class="col-6">
                        <small class="font-weight-bold">Branch</small>
                        <select name="" id="branch" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="mt-3 px-3">
                    <small>Description</small>
                    <textarea name="" id="description" cols="30" rows="10" class="form-control"><?=@$data['item']->description?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="updateItem">Update this Item</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        referenceBranch('#branch', 'select');

        $('#updateItem').on('click', function (){
            var data = {
                'firstCategory' : $('#firstCategory').val(),
                'secondCategory' : $('#secondCategory').val(),
                'brand' : $('#brand').val(),
                'branch' : $('#branch').val(),
                'description' : $('#description').val()
            };

            postCreate('/api/library/item/update/<?=@$data['item']->id?>', data);
        });
        $('#updateItemModal').on('shown.bs.modal', function () {
            $('#branch').val('<?=@$data['item']->branchID?>');
        });
        $('#updateItemModal').on('hidden.bs.modal', function () {
            location.reload();
        });
    });
</script>
