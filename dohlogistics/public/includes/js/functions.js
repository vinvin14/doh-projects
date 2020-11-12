function libraryItems()
{
    $.ajax(
        {
            async: true,
            url: '/api/library/items',
            type: 'get',
            statusCode: {
                200: function (data)
                {
                    $('#items').html('');
                    // console.log(data);
                    if(Array.isArray(data))
                    {
                        $('#itemsCount').html(data.length+' Total Item(s) encoded')
                        data.forEach(function (val){
                            $('#items').append('' +
                                '<tr>' +
                                '<td scope="row" class="col-4">'+val.firstCategory+'</td>' +
                                '<td class="col-4">'+val.secondCategory+'</td>' +
                                '<td class="col-2 pl-4">'+val.branch+'</td>' +
                                '<td class="col-2"><a href="/library/item/'+val.id+'">View</a> </td>' +
                                '</tr>');
                        });
                    }
                    else
                    {
                        $('#items').html('<tr><td colspan="4">'+data+'</td></tr>');
                    }
                    $('td').hover(function (){
                            $(this).css({"background-color" : "#E8E8E8", "transition" : ".5s"});
                        },
                        function(){
                            $(this).css("background-color", "white");
                        });
                },
                404: function (data)
                {
                    $('#items').html('<tr><td class="text-center" colspan="4">'+data.responseJSON+'</td></tr>');
                    $('#items').hover(function (){
                        $(this).css({"background-color" : "#E8E8E8", "transition" : ".5s"});
                        },
                        function(){
                            $(this).css("background-color", "white");
                        });
                }
            }
        }
    );
}
function libraryItemsBranch(branch)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/items/'+branch,
            type: 'get',
            statusCode: {
                200: function (data)
                {
                    $('#items').html('');
                    // console.log(data);
                    if(Array.isArray(data))
                    {
                        $('#itemsCount').html(data.length+' Total Item(s) encoded')
                        data.forEach(function (val){
                            $('#items').append('' +
                                '<tr>' +
                                '<td scope="row" class="col-4">'+val.firstCategory+'</td>' +
                                '<td class="col-4">'+val.secondCategory+'</td>' +
                                '<td class="col-1 pl-4">'+val.branch+'</td>' +
                                '<td class="col-1"><a href="/library/item/'+val.id+'">View</a> </td>' +
                                '</tr>');
                        });
                    }
                    else
                    {
                        $('#items').html('<tr><td colspan="4">'+data+'</td></tr>');
                    }

                },
                404: function (data)
                {
                    $('#itemsCount').html('0 Total Item(s) encoded')
                    $('#items').html('<tr><td class="text-center" colspan="4">'+data.responseJSON+'</td></tr>');
                }
            }
        }
    );
}
function libraryDM()
{
    $.ajax(
        {
            async: true,
            url: '/api/library/drugsAndMeds',
            type: 'get',
            statusCode: {
                200: function (data)
                {
                    $('#drugsAndMeds').html('');
                    // console.log(data);
                    if(Array.isArray(data))
                    {
                        $('#dmCount').html(data.length+' Total Item(s) encoded')
                        data.forEach(function (val){
                            $('#drugsAndMeds').append('' +
                                '<tr>' +
                                '<td scope="row" class="col-4">'+val.firstCategory+'</td>' +
                                '<td class="col-4">'+val.secondCategory+'</td>' +
                                '<td class="col-2">'+val.route+'</td>' +
                                '<td class="col-1">'+val.form+'</td>' +
                                '<td class="col-1"><a href="/library/drugsAndMeds/'+val.id+'">View</a> </td>' +
                                '</tr>');
                        });
                    }
                    else
                    {
                        $('#drugsAndMeds').html('<tr><td colspan="5">'+data+'</td></tr>');
                    }
                    $('td').hover(function (){
                            $(this).css({"background-color" : "#E8E8E8", "transition" : ".5s"});
                        },
                        function(){
                            $(this).css("background-color", "white");
                        });
                },
                404: function (data)
                {
                    $('#drugsAndMeds').html('<tr><td class="text-center" colspan="5">'+data.responseJSON+'</td></tr>');
                    $('#drugsAndMeds').hover(function (){
                            $(this).css({"background-color" : "#E8E8E8", "transition" : ".5s"});
                        },
                        function(){
                            $(this).css("background-color", "white");
                        });
                }
            }
        }
    );
}
function referenceDM(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/dm',
            type: 'get',
            statusCode: {
                200: function (data) {
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.firstCategory+', '+val.secondCategory+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="programButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#formUpdateModal" data-backdrop="static" data-keyboard="false">'+val.program+'</button>');
                            });
                            $('button[id="formButtons"]').click(function (){
                                $('#formInput').val($(this).text());
                                $('#formID').val($(this).attr('data-id'));
                            });
                            break;
                        case 'search':
                            data.forEach(function (val)
                            {
                                $(selector).append('<div id="searchItem" class="p-2 bg-light" data-id="'+val.id+'">'+val.firstCategory+', '+val.secondCategory+'</div>');
                            });
                            break;
                    }
                }
            }
        }
    );
}
function referenceUnits(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/units',
            type: 'get',
            statusCode: {
                200: function (data) {
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.unit+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="unitButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#unitUpdateModal" data-backdrop="static" data-keyboard="false">'+val.unit+'</button>');
                            });
                            $('button[id="unitButtons"]').click(function (){
                                $('#unitInput').val($(this).text());
                                $('#unitId').val($(this).attr('data-id'));
                            });
                            break;
                    }
                },
                404: function (data)
                {
                    $(selector).html('<div class="p-3 font-weight-bold">'+data.responseJSON+'</div>');
                }
            }
        }
    );
}
function referenceTypes(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/types',
            type: 'get',
            statusCode: {
                200: function (data) {
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.type+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="unitButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#unitUpdateModal" data-backdrop="static" data-keyboard="false">'+val.unit+'</button>');
                            });
                            $('button[id="unitButtons"]').click(function (){
                                $('#unitInput').val($(this).text());
                                $('#unitId').val($(this).attr('data-id'));
                            });
                            break;
                    }
                },
                404: function (data)
                {
                    $(selector).html('<div class="p-3 font-weight-bold">'+data.responseJSON+'</div>');
                },
                500: function (data)
                {
                    console.log(data);
                }
            }
        }
    );
}
function referenceBranch(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/branches',
            type: 'get',
            statusCode: {
                200: function (data) {
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.branch+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="branchButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#branchUpdateModal" data-backdrop="static" data-keyboard="false">'+val.branch+'</button>');
                            });
                            $('button[id="branchButtons"]').click(function (){
                                $('#branchInput').val($(this).text());
                                $('#branchId').val($(this).attr('data-id'));
                            });
                            break;
                        case 'li':
                            $('#branch-selector').append('<li id="branch-item" data-id="all" class="all branch-active">All Items</li>');
                            data.forEach(function (val)
                            {
                                // console.log(val.branch);
                                $('#branch-selector').append('<li id="branch-item" data-id="'+val.id+'">'+val.branch+'</li>');
                            });

                            $('li[id="branch-item"]').click(function (){
                                $('li').removeClass('branch-active');
                                $(this).addClass('branch-active')
                                libraryItemsBranch($(this).attr('data-id'));
                            });
                            console.log($('li').filter('#branch-active').text());
                            break;
                    }
                }
            }
        }
    );
}
function referenceCategory(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/categories',
            type: 'get',
            statusCode: {
                200: function (data) {
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.category+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="categoryButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#categoryUpdateModal" data-backdrop="static" data-keyboard="false">'+val.category+'</button>');
                            });
                            $('button[id="categoryButtons"]').click(function (){
                                $('#categoryInput').val($(this).text());
                                $('#categoryId').val($(this).attr('data-id'));
                            });
                            break;
                    }
                }
            }
        }
    );
}
function referenceRoutes(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/routes',
            type: 'get',
            statusCode: {
                200: function (data) {
                    // console.log(data);
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.route+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="routeButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#routeUpdateModal" data-backdrop="static" data-keyboard="false">'+val.route+'</button>');
                            });
                            $('button[id="routeButtons"]').click(function (){
                                $('#routeInput').val($(this).text());
                                $('#routeID').val($(this).attr('data-id'));
                            });
                            break;
                    }
                }
            }
        }
    );
}
function referenceForms(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/forms',
            type: 'get',
            statusCode: {
                200: function (data) {
                    console.log(data);
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.form+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="formButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#formUpdateModal" data-backdrop="static" data-keyboard="false">'+val.form+'</button>');
                            });
                            $('button[id="formButtons"]').click(function (){
                                $('#formInput').val($(this).text());
                                $('#formID').val($(this).attr('data-id'));
                            });
                            break;
                    }
                }
            }
        }
    );
}
function referencePrograms(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/programs',
            type: 'get',
            statusCode: {
                200: function (data) {
                    console.log(data);
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.program+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="programButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#formUpdateModal" data-backdrop="static" data-keyboard="false">'+val.program+'</button>');
                            });
                            $('button[id="formButtons"]').click(function (){
                                $('#formInput').val($(this).text());
                                $('#formID').val($(this).attr('data-id'));
                            });
                            break;
                    }
                }
            }
        }
    );
}
function postCreate(url, data)
{
    // console.log(data);
    $.ajax(
        {
            async: true,
            url: url,
            type: 'POST',
            data:data,
            statusCode: {
                200: function (data)
                {
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data,
                    });
                    $(".swal2-container.in").css('background-color', 'rgba(255, 255, 255, 1)');
                },
                401: function (data)
                {
                    // console.log(data);
                    Swal.fire({
                        icon: 'error',
                        title: 'Request Denied!',
                        text: data.responseJSON,
                    });
                    $(".swal2-container.in").css('background-color', 'black');
                },
                500: function (data)
                {
                    console.log(data);
                },
                404: function (data)
                {
                    console.log(data);
                },
                501: function (data)
                {
                    console.log(data);
                }
            }
        }
    );
}
function dataRequired(selectors)
{
    var count = [];
    selectors.forEach(function (item){
        $(item).siblings('#error').remove();
        if($(item).val() === '')
        {
            $(item).css('border','1px solid red');
            $(item).parent().append('<small id="error" class="text-danger">Error! Data Required</small>');
            count.push(1);
        }
        else
        {
            $(item).css('border','1px solid green');
            $(item).siblings('#error').remove();
        }
    });
    return count.length;
}
function referenceItems(selector, type)
{
    $.ajax(
        {
            async: true,
            url: '/api/library/items',
            type: 'get',
            statusCode: {
                200: function (data) {
                    switch (type){
                        case 'select':
                            $(selector).html('<option value="">-</option>');
                            data.forEach(function (val)
                            {
                                $(selector).append('<option value="'+val.id+'">'+val.firstCategory+', '+val.secondCategory+'</option>');
                            });
                            break;
                        case 'buttons':
                            $(selector).html('');
                            data.forEach(function (val)
                            {
                                $(selector).append('<button type="button" id="programButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#formUpdateModal" data-backdrop="static" data-keyboard="false">'+val.program+'</button>');
                            });
                            $('button[id="formButtons"]').click(function (){
                                $('#formInput').val($(this).text());
                                $('#formID').val($(this).attr('data-id'));
                            });
                            break;
                        case 'search':
                            data.forEach(function (val)
                            {
                                $(selector).append('<div id="searchItem" class="p-2 bg-light" data-id="'+val.id+'">'+val.firstCategory+', '+val.secondCategory+'</div>');
                            });
                            break;
                    }
                }
            }
        }
    );
}
function inventory(selector, form, type)
{
    $.ajax({
        async: true,
        url: '/api/inventory/'+type,
        type: 'get',
        statusCode: {
            200: function (data){
                switch (form){
                    case 'select':
                        $(selector).html('<option value="">-</option>');
                        data.forEach(function (val)
                        {
                            $(selector).append('<option value="'+val.id+'">'+val.firstCategory+', '+val.secondCategory+'</option>');
                        });
                        break;
                    case 'buttons':
                        $(selector).html('');
                        data.forEach(function (val)
                        {
                            $(selector).append('<button type="button" id="programButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#formUpdateModal" data-backdrop="static" data-keyboard="false">'+val.program+'</button>');
                        });
                        $('button[id="formButtons"]').click(function (){
                            $('#formInput').val($(this).text());
                            $('#formID').val($(this).attr('data-id'));
                        });
                        break;
                    case 'search':
                        data.forEach(function (val)
                        {
                            $(selector).append('<div id="searchItem" class="p-2 bg-light" data-id="'+val.id+'">'+val.firstCategory+', '+val.secondCategory+'</div>');
                        });
                        break;
                    case 'table':
                        $(selector).html('');
                        data.forEach(function (val)
                        {
                            $(selector).append('' +
                                '<tr>' +
                                '<td>'+val.firstCategory+'</td>' +
                                '<td>'+val.secondCategory+'</td>' +
                                '<td>'+val.category+'</td>' +
                                '<td>'+val.quantity+'</td>' +
                                '<td><a href="/inventory/details/'+val.origin+'/'+val.eqid+'">Details</a></td>' +
                                '</tr>');
                        });
                        break;
                }
            },
            404: function (data) {
                switch (form){
                    case 'select':
                        $(selector).html('<option value="">No Records</option>');
                        break;
                    case 'buttons':
                        $(selector).html('');
                        data.forEach(function (val)
                        {
                            $(selector).append('<button type="button" id="programButtons" data-id="'+val.id+'" class="list-group-item list-group-item-action mt-2" data-toggle="modal" data-target="#formUpdateModal" data-backdrop="static" data-keyboard="false">'+val.program+'</button>');
                        });
                        $('button[id="formButtons"]').click(function (){
                            $('#formInput').val($(this).text());
                            $('#formID').val($(this).attr('data-id'));
                        });
                        break;
                    case 'search':
                        data.forEach(function (val)
                        {
                            $(selector).append('<div id="searchItem" class="p-2 bg-light" data-id="'+val.id+'">'+val.firstCategory+', '+val.secondCategory+'</div>');
                        });
                        break;
                    case 'table':
                        $(selector).html('<tr><td>No Record(s) Found!</td></tr>');
                        break;
                }
            }
        }
    });
}


$(document).ready(function () {
//for inventory
    referenceItems('#searchResult', 'search');
    referenceUnits('#unit', 'select');
    referenceCategory('#category', 'select');
    referenceTypes('#type', 'select');

    //inventory indexes
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
    $('#inventoryModal input').not('#libItem').click(function (){
        $('#searchResult').hide();
    });


    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#reference tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $('#unitCost').on('input', function (){
        var unitCost = $(this).val();
        var quantity = $('#quantity').val();

        $('#totalValue').val(unitCost*quantity);
    });
    $('#quantity').on('input', function (){
        var quantity = $(this).val();
        var totalValue = $('#unitCost').val();

        $('#totalValue').val(totalValue*quantity);
    });
    $('#addEquipment').click(function (){
        if(dataRequired([
            '#eprefix', '#pnStockNumber', '#libItem',
            '#category', '#quantity', '#unit', '#type', '#unitCost']) === 0)
        {
            var data = {
                'pnStockNumber' : $('#pnStockNumber').val(),
                'libItem' : $('#libItem').attr('data-id'),
                'iarLotNum' : $('#iarLotNum').val(),
                'brand' : $('#brand').val(),
                'category' : $('#category').val(),
                'quantity' : $('#quantity').val(),
                'unit' : $('#unit').val(),
                'unitCost' : $('#unitCost').val(),
                'type' : $('#type').val(),
                'totalValue' : $('#totalValue').val(),
                'dateReceived' : $('#dateReceived').val(),
                'expiryDate' : $('#expiryDate').val(),
                'isBufferStock' : $('#isBufferStock').val(),
                'remarks' : $('#remarks').val(),
            };

            postCreate('/api/inventory/create', data);

            $('input, select').css('border-color', 'lightgray');
        }
    });
    $('#inventoryModal').on('hidden.bs.modal', function () {
        location.reload();
    });

//for details
    $('a[id="editStock"]').click(function (){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');

        $.ajax({
            url: '/api/inventory/stock/'+type+'/'+id,
            type: 'get',
            // statusCode: {
            //     500: function (data)
            //     {
            //         console.log(data);
            //     }
            // }
            success: function(data){
                $('#stockID').val(data.id);
                $('#iarLotNum').val(data.iarLotNum);
                $('#brand').val(data.brand);
                $('#quantity').val(data.quantity);
                $('#dateReceived').val(data.dateReceived);
                $('#unitCost').val(data.unitCost);
                $('#unit').val(data.unit);
                $('#totalValue').val(data.totalValue);
                $('#expiryDate').val(data.expiryDate);
                $('#updateDetail').attr('data-id', type);
            }
        });
    });
    $('#updateDetail').click(function (){
        var id = $('#stockID').val();
        var type = $(this).attr('data-id');
        // console.log(id);
        if(dataRequired([
            '#iar', '#brand', '#quantity',
            '#dateReceived', '#unitCost', '#unit', '#totalValue']) === 0)
        {
            var data = {
                'iarLotNum' : $('#iarLotNum').val(),
                'brand' : $('#brand').val(),
                'quantity' : $('#quantity').val(),
                'unit' : $('#unit').val(),
                'unitCost' : $('#unitCost').val(),
                'totalValue' : $('#totalValue').val(),
                'dateReceived' : $('#dateReceived').val(),
                'expiryDate' : $('#expiryDate').val(),

            };

            postCreate('/api/inventory/stock/update/'+type+'/'+id, data);
            $('#updateStockCard').on('hidden.bs.modal', function () {
                location.reload();
            });
            $('input, select').css('border-color', 'lightgray');
        }
    });
});
