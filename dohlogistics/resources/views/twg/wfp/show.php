<style>
    .modal-lg
    {
        max-width: 50% !important;
    }
</style>
<div class="container-fluid">
    <a href="/twg/wfp?page=<?= @$_GET['page']?>" class="text-dark font-weight-bold"><i class="fas fa-arrow-circle-left"></i> Go back</a>
    <div class="d-flex justify-content-between border-bottom mt-3">
        <span class="h4 text-muted">Specification</span>
    </div>
    <div class="row mt-3 pb-3 border-bottom">
        <div class="col-6">
            <small class="">First Category Name</small>
            <div class="p-2 font-weight-bold"><?= $data['wfp']->firstCategory?></div>
        </div>
        <div class="col-6">
            <small class="">Second Category Name</small>
            <div class="p-2 font-weight-bold"><?= $data['wfp']->secondCategory?></div>
        </div>
    </div>
    <div class="row mt-3 pb-3 border-bottom">
        <div class="col-3">
            <small class="">Branch</small>
            <div class="p-2 font-weight-bold"><?= $data['wfp']->branch?></div>
        </div>
        <div class="col-3">
            <small class="">Category</small>
            <div class="p-2 font-weight-bold"><?= $data['wfp']->category?></div>
        </div>
        <div class="col-3">
            <small class="">Item Cost</small>
            <div class="p-2 font-weight-bold">₱<?= number_format($data['wfp']->itemCost, 2)?></div>
        </div>
        <div class="col-3">
            <small class="">Unit</small>
            <div class="p-2 font-weight-bold"><?= $data['wfp']->unit?></div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <small class="">Description</small>
            <div class="p-2 font-weight-bold"><?= $data['wfp']->description?></div>
        </div>
    </div>

</div>
<button class="btn btn-dark text-light text-center p-2 mt-3 shadow" data-toggle="modal" data-target="#wfpUpdate" data-backdrop="static" data-keyboard="false"><i class="far fa-calendar-check"></i> Update this Information</button>

<!-- Modal -->
<div class="modal fade" id="wfpUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" id="firstCategory" value="<?= @$data['wfp']->firstCategory?>" class="form-control">
                    </div>
                    <div class="">
                        <small class="font-weight-bold">2nd Category Name</small>
                        <textarea rows="5" id="secondCategory" class="form-control"><?= @$data['wfp']->secondCategory?></textarea>
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
                            <input type="number" id="itemCost" class="form-control" value="<?= @$data['wfp']->itemCost?>">
                        </div>
                        <div class="col-6">
                            <small class="font-weight-bold">Unit</small>
                            <select id="unit" class="form-control">
                            </select>
                        </div>
                    </div>
                    <small class="font-weight-bold">Description</small>
                    <textarea name="" id="description" value="<?= @$data['wfp']->description?>" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" data-id="" id="updateWFP" class="btn btn-primary">Update Entry</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        referenceBranch('#branch', 'select');
        referenceUnits('#unit', 'select');
        referenceCategory('#category', 'select');
        $('#wfpUpdate').on('shown.bs.modal', function () {
            $('#branch').val('<?=@$data['wfp']->branchID?>');
            $('#unit').val('<?=@$data['wfp']->unitID?>');
            $('#category').val('<?=@$data['wfp']->categoryID?>');
        });
        $('#wfpUpdate').on('hidden.bs.modal', function () {
            location.reload();
        });
        $('#updateWFP').on('click', function (){
            var data = {
                'firstCategory' : $('#firstCategory').val(),
                'secondCategory' : $('#secondCategory').val(),
                'branch' : $('#branch').val(),
                'category' : $('#category').val(),
                'itemCost' : $('#itemCost').val(),
                'unit' : $('#unit').val(),
                'description' : $('#description').val()
            };

            postCreate('/api/wfp/update/<?=@$data['wfp']->id ?>', data);
        });
    });
</script>
