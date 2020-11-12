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
    .titles
    {
        display: block;
        width: 600px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    #searching{
        animation:fading 0.8s infinite;
    }
    @keyframes fading{
        0%{     color: #000;    }
        49%{    color: #000; }
        60%{    color: transparent; }
        99%{    color:transparent;  }
        100%{   color: #000;    }
    }
    #close:hover
    {
        color: red;
        transition: 1s;
    }

</style>
<div class="container-fluid">
<!--    --><?//=@$branchNav?>
    <div class="float-right p-1">
        <form action="/" method="get">
            <small class="font-weight-bold">Filter By:</small>
            <select name="" id="" class="form-control">
            </select>
        </form>
    </div>
    <div class="">
        <div class="d-flex justify-content-between">
            <span class="lead text-info">Existing Items</span>
        </div>
        <div class="search-container">
            <button class="btn btn-success m-2" id="createNewItem" data-toggle="modal" data-target="#wfpModal" data-backdrop="static" data-keyboard="false">Create WFP</button>

            <input type="text" class="form-control" id="searchWfp" placeholder="Search here!" autocomplete="off">
            <div class="p-2 shadow bg-light border wfpSearchContainer" style="position: absolute; z-index: 9 !important; display: none">
                <span class="font-weight-bold float-right pr-3" id="close" style="cursor: pointer">X Close</span>
                <div id="searching" style="display: none; max-width: inherit !important;"><i class="fas fa-hourglass"></i> Searching . . . .</div>
                <div id="searchResultNum" class="font-weight-bold"></div>
                <div id="wfpSearchResult" style="max-height: 400px; overflow-y: auto;"></div>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-fixed">
                <thead>
                <tr>
                    <th scope="col" class="col-2">First Category Name</th>
                    <th scope="col" class="col-4">Second Category Name</th>
                    <th scope="col" class="col-1">Item Cost</th>
                    <th scope="col" class="col-1">Unit</th>
                    <th scope="col" class="col-2">Branch</th>
                    <th scope="col" class="col-2">&nbsp;</th>
                </tr>
                </thead>
                <tbody id="items">
                <?php
                foreach (@$data['wfp'] as $wfp)
                {
                    echo '
                    <tr>
                        <td scope="row" class="col-2 titles">',$wfp->firstCategory,'</td>
                        <td class="col-4 titles">',$wfp->secondCategory,'</td>
                        <td class="col-1 pl-4">₱',number_format($wfp->itemCost,2),'</td>
                        <td class="col-1 pl-4">',$wfp->unit,'</td>
                        <td class="col-2 pl-4">',$wfp->branch,'</td>
                        <td class="col-2"><a href="/twg/wfp/',$wfp->id,'?page=',(isset($_GET['page'])) ? $_GET['page']:'','">View</a> <a class="pl-4 text-danger" href="/twg/wfp/delete/',$wfp->id,'?page=',(isset($_GET['page'])) ? $_GET['page']:'','" onclick="return confirm(\'Are you sure you want to delete this entry?\')">Delete</a></td>
                    </tr>
                    ';
                }
                ?>
                </tbody>
            </table>
            <hr>
            <div class="p-1"><?= $data['wfp']->links()?></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="wfpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="col-6 firstCategory">
                        <small class="font-weight-bold">First Category</small>
                        <input type="text" id="firstCategory" class="form-control">
                    </div>
                    <div class="col-6 secondCategory">
                        <small class="font-weight-bold">Second Category</small>
                        <input type="text" id="secondCategory" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <small class="font-weight-bold">Category</small>
                        <select name="" id="category" class="form-control"></select>
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Branch</small>
                        <select name="" id="branch" class="form-control"></select>
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Item Cost</small>
                        <input type="number" id="itemCost" step="0.01" class="form-control">
                    </div>
                    <div class="col-3">
                        <small class="font-weight-bold">Unit</small>
                        <select name="" id="unit" class="form-control"></select>
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
    $(document).ready(function (){
        referenceBranch('#branch', 'select');
        $("#searchWfp").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            if(value === '')
            {
                $('.wfpSearchContainer').hide();
            }
            $.ajax({
                async: true,
                url: '/api/items/search/'+value,
                type: 'get',
                success: function (data) {
                        $('.wfpSearchContainer').show();
                        // $('#wfpSearchResult').show();

                        $('#searchResultNum').text('');
                        var count = data.items.length;
                        if(count <= 0)
                        {
                            $('#wfpSearchResult').html('<span class="text-danger">No Result(s) Found!</span>');
                        }
                    setTimeout(function () {
                        $('#wfpSearchResult').html('');
                        data.items.forEach(function (val){
                            $('#wfpSearchResult').append('<div class="p-2 border-bottom" style="cursor: pointer;" id="wfpSearchResultChild" data-id="'+val.id+'">'+val.text+'</div>');
                            $('#searching').hide();
                            $('#searchResultNum').text('Total Record(s) Found: '+count).fadeIn(500);
                        });
                        $('div[id="wfpSearchResultChild"]').click(function (){
                            window.location.href = '/twg/wfp/'+$(this).attr('data-id');

                        });
                    }, 1500)
                },
                error: function ()
                {
                    $('#wfpSearchResult').html('<span class="text-danger">No Result(s) Found!</span>');
                }
            });
            $('#searching').show();
        });
        $("#searchWfp").on('focusout', function (){
            // $('.wfpSearchContainer').hide();
        });
        $("#searchWfp").click(function(){
            if($(this).val() !== '')
            {
                var value = $(this).val().toLowerCase();

                $.ajax({
                    async: true,
                    url: '/api/items/search/'+value,
                    type: 'get',
                    success: function (data) {
                        $('.wfpSearchContainer').show();
                        // $('#wfpSearchResult').show();
                        $('#wfpSearchResult').html('');
                        $('#searchResultNum').text('');
                        var count = data.items.length;
                        if(data.items === null)
                        {
                            $('#wfpSearchResult').html('<span class="text-danger">No Result(s) Found!</span>');
                        }
                        data.items.forEach(function (val){

                            $('#wfpSearchResult').append('<div class="p-2 border-bottom" id="wfpSearchResultChild" data-id="'+val.id+'">'+val.text+'</div>');
                            $('#searching').hide();
                            $('#searchResultNum').text('Total Record(s) Found: '+count).fadeIn(500);
                        });
                        $('div[id="wfpSearchResultChild"]').click(function (){
                            console.log($(this).attr('data-id'));
                        });
                    },
                    error: function ()
                    {
                        $('#wfpSearchResult').html('<span class="text-danger">No Result(s) Found!</span>');
                    }
                });
            }
        });
        $('#wfpModal').on('hidden.bs.modal', function () {

            // $('li').removeClass('branch-active');
            // $('.all').addClass('branch-active');
            // libraryItems();
            location.reload();
        });
        $('#saveItem').on('click', function (){
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
                    'origin' : 'twg'
                };

                postCreate('/api/wfp/create', data);
                $('input, select, textarea').val('');
                $('input, select').css('border-color', '#cccccc');
            }
        });

        $('#close').click(function (){
            $("#searchWfp").val('');
            $('.wfpSearchContainer').hide();
        });
    });
</script>
