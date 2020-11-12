<style>
    .modal-lg {
        max-width: 60% !important;
    }
    #searchItem
    {
        cursor: pointer;
    }
    #searchItem:hover
    {
        background-color: gray !important;
        color: white;
    }
</style>
<div class="container-fluid">
    <div class=""><span class="lead text-info">Existing Equipments</span>
    <hr>
    <button class="btn btn-outline-warning" data-toggle="modal" data-target="#dispenseModal" data-backdrop="static" data-keyboard="false">Dispense an Item</button>
    <input type="text" id="search" class="form-control search" placeholder="Enter Keywords here">
    <div class="table-responsive">
        <table class="table table-borderless" >
            <thead>
                <th>First Category Name</th>
                <th>Second Category Name</th>
                <th>Category</th>
                <th>For</th>
                <th>Quantity</th>
                <th>Total Value</th>
                <th></th>
            </thead>
            <tbody id="inventory">
            <?php
            foreach (@$data['equipments'] as $equipment)
            {
                echo '
                <tr>
                    <td>',$equipment->firstCategory,'</td>
                    <td>',$equipment->secondCategory,'</td>
                    <td>',$equipment->category,'</td>
                    <td>',$equipment->quantity,'</td>
                    <td>₱ ',number_format($equipment->totalValue),'</td>
                    <td><a href="/inventory/details/',$equipment->origin,'/',$equipment->eqid,'?currtrans=equipments">Details</a></td>
                </tr>
                ';
            }
            ?>
            </tbody>
        </table>
        <?= @$data['equipments']->links();?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dispenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Dispense an Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="lead">Existing Request(s) <span id="request"></span></div>
                <button class="btn btn-outline-info float-right">Create Dispense</button>
                <div class="p-3" id="ris">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <th>Request Code</th>
                                <th>No. of Items</th>
                                <th>Date of Request</th>
                                <th>Department</th>
                                <th></th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

