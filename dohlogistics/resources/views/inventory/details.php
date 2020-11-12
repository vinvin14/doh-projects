<style>
    .modal-lg {
        max-width: 60% !important;
    }
</style>
<div class="container-fluid">
    <a href="/inventory/<?= $_GET['currtrans']?>" class="mb-2"><i class="fa fa-angle-double-left"></i> Back to Inventory List</a>
    <div class="lead text-info mt-3">Inventory Details</div>
    <div class="row mt-3">
        <div class="col-3">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body shadow">
                    <h5><?= @$data['motherItem']->firstCategory,', ', @$data['motherItem']->secondCategory?></h5>
                    <div class="p-2">
                        <small class="font-weight-bold">Total Quantity</small>
                        <div><?= @$data['inventory']->quantity?></div>
                    </div>
                    <div class="p-2">
                        <small class="font-weight-bold">Total Value</small>
                        <div>₱ <?= number_format(@$data['inventory']->totalValue)?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card shadow">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
<!--                            <th>Property / Stock Number</th>-->
                            <th>IAR</th>
                            <th>Brand</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Unit Cost</th>
                            <th>Total Value</th>
                            <th>Date Received</th>
                            <th>Expiry Date</th>
                            <th></th>
                            </thead>
<!--                            <td class="font-weight-bold">',$stock->stockNumber,'</td>-->
                            <tbody>
                            <?php
                            foreach (@$data['stocks'] as $stock)
                            {
                                echo '
                           <tr>
                               
                                <td class="font-weight-bold">',$stock->iarLotNum,'</td>
                                <td>',$stock->brand,'</td>
                                <td>',$stock->quantity,'</td>
                                <td>',$stock->unit,'</td>
                                <td>₱',number_format($stock->unitCost),'</td>
                                <td>₱',number_format($stock->totalValue),'</td>
                                <td>',$stock->dateReceived,'</td>
                                <td>',$stock->expiryDate,'</td>
                                <td><a href="#" title="Edit" id="editStock" data-type="'.@$data['inventory']->stockOrPn.'" data-id="'.$stock->id.'" data-toggle="modal" data-target="#updateStockCard" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i></a></td>
                           </tr>
                           ';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateStockCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" id="stockID">
                <div class="row">
                    <div class="col-3">
                        <small class="font-weight-bold">IAR</small>
                        <input type="text" class="form-control" id="iarLotNum">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Brand</small>
                        <input type="text" class="form-control" id="brand">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Quantity</small>
                        <input type="text" class="form-control" id="quantity">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Date Received</small>
                        <input type="date" class="form-control" id="dateReceived">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <small class="font-weight-bold">Unit Cost</small>
                        <input type="number" class="form-control" id="unitCost">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Unit</small>
                        <select type="number" class="form-control" id="unit"></select>
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Total Value</small>
                        <input type="number" class="form-control" id="totalValue" readonly>
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Expiry Date</small>
                        <input type="date" class="form-control" id="expiryDate">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" data-id="" id="updateDetail" class="btn btn-primary">Update Entry</button>
            </div>
        </div>
    </div>
</div>
