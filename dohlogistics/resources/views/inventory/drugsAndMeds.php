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
    <div class=""><span class="lead text-info">Existing Drugs and Medicines</span>
        <button class="btn btn-outline-primary my-2 float-right" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Inventory</button></div>
    <input type="text" id="search" class="form-control search" placeholder="Enter Keywords here">
    <div class="table-responsive">
        <table class="table table-borderless" >
            <thead>
            <th>First Category Name</th>
            <th>Second Category Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th></th>
            </thead>
            <tbody id="inventory">
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Drugs And Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <small class="font-weight-bold">PN/Stock Number</small>
                        <div class="row">
                            <div class="col-4">
                                <select name="" id="eprefix" class="form-control">
                                    <option value="">-</option>
                                    <option>PN</option>
                                    <option>SN</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="pnStockNumber">
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <small class="font-weight-bold">Item</small>
                        <input type="text" class="form-control" id="libItem" autocomplete="off">
                        <div class="container bg-light" data-id="" id="searchResult" style="display: none; position: absolute; z-index: 999; max-height: 400px;width:96%;overflow-y: auto">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <small class="font-weight-bold">IAR/LOT Number</small>
                        <input type="text" id="iarLotNum" class="form-control">
                    </div>
                    <div class="col-4">
                        <small class="font-weight-bold">Brand</small>
                        <input type="text" class="form-control" id="brand">
                    </div>
                    <div class="col-4">
                        <small class="font-weight-bold">Category</small>
                        <select name="" id="category" class="form-control">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <small class="font-weight-bold">Quantity</small>
                        <input type="number" id="quantity" class="form-control">
                    </div>
                    <div class="col-4">
                        <small class="font-weight-bold">Unit</small>
                        <select name="" id="unit" class="form-control"></select>
                    </div>
                    <div class="col-4">
                        <small class="font-weight-bold">Unit Cost</small>
                        <input type="number" id="unitCost" class="form-control">
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
                <button type="button" id="addEquipment" class="btn btn-primary">Add New Equipment</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        referenceDM('#searchResult', 'search');
        referenceUnits('#unit', 'select');
        referenceCategory('#category', 'select');
        // inventory('#inventory', 'table', 'drugsAndMeds');

        $('#libItem').click(function (){
            $('#searchResult').show();
            $('#searchResult div').click(function (){
                $('#libItem').val($(this).text());
                $('#libItem').attr('data-id', $(this).attr('data-id'));
                $('#searchResult').hide();
            });

            $('#libItem').on('keyup', function () {
                var searchVal = $(this).val().toLowerCase();
                $('#searchResult div').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchVal) > -1)
                });
            });
        });
        $('#libItem').focus(function (){
            $('#searchResult').show();
            $('#searchResult div').click(function (){
                $('#libItem').val($(this).text());
                $('#libItem').attr('data-id', $(this).attr('data-id'));
                $('#searchResult').hide();
            });

            $('#libItem').on('keyup', function () {
                var searchVal = $(this).val().toLowerCase();
                $('#searchResult div').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchVal) > -1)
                });
            });
        });

        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#reference tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#addEquipment').click(function (){
            if(dataRequired([
                '#eprefix', '#pnStockNumber', '#libItem', '#brand',
                '#category', '#quantity', '#unit', '#unitCost']) === 0)
            {
                var data = {
                    'pnStockNumber' : $('#eprefix').val()+'@'+$('#pnStockNumber').val(),
                    'libItem' : $('#libItem').attr('data-id'),
                    'iarLotNum' : $('#iarLotNum').val(),
                    'brand' : $('#brand').val(),
                    'category' : $('#category').val(),
                    'quantity' : $('#quantity').val(),
                    'unit' : $('#unit').val(),
                    'unitCost' : $('#unitCost').val(),
                    'dateReceived' : $('#dateReceived').val(),
                    'expiryDate' : $('#expiryDate').val(),
                    'isBufferStock' : $('#isBufferStock').val(),
                    'remarks' : $('#remarks').val(),
                };
                postCreate('/api/inventory/create/drugsAndMeds', data);
                // $('input, select, textarea').val('');
                $('input, select').css('border-color', 'lightgray');
                inventory('#inventory', 'table', 'drugsAndMeds');
            }
        });
    });
</script>
