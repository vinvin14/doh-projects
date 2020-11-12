<div class="row">
    <div class="col-8">
        <ul id="branch-selector">
            <a href="/library/items"><li id="branch-item" class="<?= (@$data['branchSelected'] == 'allitems') ? 'branch-active' : ''?>">All Items</li></a>
            <?php
            if(is_array(@$data['branches']))
            {
                foreach (@$data['branches'] as $branch)
                {
                    echo '<a href="/library/items/',$branch->branch,'"><li id="branch-item" class="',(@$data['branchSelected'] == $branch->branch) ? 'branch-active' : '','">',$branch->branch,'</li></a>';
                }
            }
            ?>
        </ul>
    </div>
    <div class="col-4">
        <button class="btn btn-outline-primary mt-4 mr-3 float-right" id="createNewItem" data-toggle="modal" data-target="#itemsModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create New Item</button>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="itemsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4 firstCategory">
                        <small class="font-weight-bold">First Category</small>
                        <input type="text" id="firstCategory" class="form-control">
                    </div>
                    <div class="col-4 secondCategory">
                        <small class="font-weight-bold">Second Category</small>
                        <input type="text" id="secondCategory" class="form-control">
                    </div>
                    <div class="col-4">
                        <small class="font-weight-bold">Branch</small>
                        <select name="" id="branch" class="form-control"></select>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="font-weight-bold">Description</small>
                    <textarea name="" id="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveItem">Record this Item</button>
            </div>
        </div>
    </div>
</div>

<script>
    referenceBranch('#branch', 'select');
    $('#saveItem').on('click', function (){
        if(dataRequired(['#firstCategory', '#secondCategory', '#branch']) === 0)
        {
            var data = {
                'firstCategory' : $('#firstCategory').val(),
                'secondCategory' : $('#secondCategory').val(),
                'branch' : $('#branch').val(),
                'description' : $('#description').val()
            };

            postCreate('/api/library/item/create', data);
            $('input, select, textarea').val('');
            $('input, select').css('border-color', 'black');
        }
    });
</script>
