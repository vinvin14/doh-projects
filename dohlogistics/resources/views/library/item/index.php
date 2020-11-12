<style>
    table
    {
        min-width: 1200px !important;
        overflow-y: auto;
    }
    .table-fixed tbody {
        height: 500px;
        overflow-y: auto;
        width: 100%;
    }

    .table-fixed thead,
    .table-fixed tbody,
    .table-fixed tr,
    .table-fixed td,
    .table-fixed th {
        display: block;
    }

    .table-fixed tbody td,
    .table-fixed tbody th,
    .table-fixed thead > tr > th {
        float: left;
        position: relative;

    &::after {
         content: '';
         clear: both;
         display: block;
     }
    }
    #branch-selector li
    {
        display: inline-block;
        margin-right: 8px;
        margin-top: 10px;
        padding: 5px 10px;
        /*border: 1px solid gray;*/
        /*border-radius: 50px 50px;*/
        cursor: pointer;
        font-family: "Calibri Light";
        /*font-weight: bold;*/
        color: darkgray;


    }
    #branch-selector li:hover
    {
        /*background-color: #63C488;*/
        color: cornflowerblue !important;
        /*font-weight: bold;*/
        transition: .3s;
    }
    .branch-active
    {
        /*background-color: #63C488;*/
        color: cornflowerblue !important;
        font-weight: bold;
        border-bottom: 3px solid cornflowerblue;
        /*margin-right: 55px;*/
        /*margin-leftt: 55px;*/
    }
    #branch-item a
    {
        color: gray;
    }
</style>
<div class="container-fluid">
    <a href="/library" class="mb-2"><i class="fa fa-angle-double-left"></i> Back to Library</a>

    <?=@$branchNav?>
    <div class="card card-body mt-2">
        <div class="d-flex justify-content-between">
            <span class="lead text-info">Existing Items</span>
        </div>
<!--        <small class="font-weight-bold text-info" id="itemsCount"></small>-->
<!--        <input type="text" id="search" class="form-control search" placeholder="Search Item Here">-->
        <div class="table-responsive">
            <table class="table table-fixed">
                <thead>
                <tr>
                    <th scope="col" class="col-4">First Category Name</th>
                    <th scope="col" class="col-4">Second Category Name</th>
                    <th scope="col" class="col-2">Branch</th>
                    <th scope="col" class="col-2">&nbsp;</th>
                </tr>
                </thead>
                <tbody id="items">
                <?php
                foreach (@$data['items'] as $item)
                {
                    echo '
                    <tr>
                        <td scope="row" class="col-4">',$item->firstCategory,'</td>
                        <td class="col-4">',$item->secondCategory,'</td>
                        <td class="col-2 pl-4">',$item->branch,'</td>
                        <td class="col-2"><a href="/library/item/',$item->id,'">View</a> </td>
                    </tr>
                    ';
                }
                ?>
                </tbody>

            </table>
            <hr>
            <div class="p-2"><?= $data['items']->links()?></div>
        </div><!-- End -->
<!--        <div class="table-responsive" style="max-height: 600px; overflow-y: auto">-->
<!--            <table class="table able-striped sticky-header justify-content-lg-start" >-->
<!--                <thead>-->
<!--                    <th>First Category</th>-->
<!--                    <th>Second Category</th>-->
<!--                    <th>Brand</th>-->
<!--                    <th>Branch</th>-->
<!--                    <th></th>-->
<!--                </thead>-->
<!--                <tbody id="items"></tbody>-->
<!--            </table>-->
<!--        </div>-->
    </div>

</div>

<script>
    $(document).ready(function (){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#items tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#itemsModal').on('hidden.bs.modal', function () {

            // $('li').removeClass('branch-active');
            // $('.all').addClass('branch-active');
            // libraryItems();
            location.reload();
        });
    });
</script>
