<style>
    *
    {
        box-sizing: border-box;
    }
    .top-mini-nav li
    {
        display: inline-block;
        font-family: "Calibri Light";
        margin-right: 10px;
        /*border: 1px solid gray;*/
        /*border-radius: 5px 5px;*/
        /*background-color: white;*/
        cursor: pointer;
    }
    .top-mini-nav li a
    {
        color: darkgray;
        padding: 5px 5px;
        cursor: pointer !important;
    }
    .top-mini-nav li a:hover
    {
        color: cornflowerblue;
        transition: .4s;
        /*font-weight: bold;*/
    }
    .nav-active
    {
        font-weight: bold;
        color: cornflowerblue !important;
        border-bottom: 3px solid cornflowerblue;
    }
    a
    {
        text-decoration: none !important;
        outline: none !important;
    }
</style>
<div class="container-fluid">
    <h5 class="border-bottom">Inventory</h5>
    <div class="row">
        <div class="col-8">
            <div class="mt-3">
<!--                <a href="/inventory/movement" class="btn btn-outline-primary mt-3 mr-3 float-right">Inventory Movement</a>-->
                <ul class="top-mini-nav mt-3">
                    <li><a href="/inventory/equipments" class="<?= (@$data['subPageSelected'] === 'equipments') ? 'nav-active': ''?>">Equipments</a></li>
                    <li><a href="/inventory/supplies" class="<?= (@$data['subPageSelected'] === 'supplies') ? 'nav-active': ''?>">Supplies</a></li>
                    <li><a href="/inventory/drugsAndMeds" class="<?= (@$data['subPageSelected'] === 'drugsAndMeds') ? 'nav-active': ''?>">Drugs and Medicines</a></li>
                </ul>


            </div>
        </div>
        <div class="col-4">
            <button class="btn btn-outline-primary mt-2 mr-2 float-right" data-toggle="modal" data-target="#inventoryModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Inventory</button></div>
        </div>
    <div class="card card-body mx-1 mt-3 shadow">
        <?= @$subPage?>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="inventoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <small class="font-weight-bold">PN/Stock Number</small>
                        <input type="text" class="form-control" id="pnStockNumber">
                    </div>
                    <div class="col-8">
                        <small class="font-weight-bold">Item</small>
                        <input type="text" class="form-control" id="libItem" autocomplete="off">
                        <div class="container bg-light" data-id="" id="searchResult" style="display: none; position: absolute; z-index: 999; max-height: 400px;width:96%;overflow-y: auto">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <small class="font-weight-bold">IAR/LOT Number</small>
                        <input type="text" id="iarLotNum" class="form-control">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Brand</small>
                        <input type="text" class="form-control" id="brand">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Category</small>
                        <select name="" id="category" class="form-control">
                            <option value="">-</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Type</small>
                        <select name="" id="type" class="form-control">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <small class="font-weight-bold">Quantity</small>
                        <input type="number" id="quantity" class="form-control">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Unit</small>
                        <select name="" id="unit" class="form-control"></select>
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Unit Cost</small>
                        <input type="number" id="unitCost" class="form-control">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Total Value</small>
                        <input type="number" id="totalValue" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <small class="font-weight-bold">Date Received</small>
                        <input type="date" id="dateReceived" class="form-control">
                    </div>
                    <div class="col-4">
                        <small class="font-weight-bold">Expiry Date</small>
                        <input type="date" id="expiryDate" class="form-control">
                    </div>

                    <div class="col-4">
                        <small class="font-weight-bold">Buffer Stock</small>
                        <select name="" id="isBufferStock" class="form-control">
                            <option value="">-</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="font-weight-bold">Remarks</small>
                    <textarea name="" id="remarks" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button"  id="addEquipment" class="btn btn-primary">Add New Equipment</button>
            </div>
        </div>
    </div>
</div>
