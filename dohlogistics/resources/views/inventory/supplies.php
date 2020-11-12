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
    <div class=""><span class="lead text-info">Existing Supplies</span>
        <hr>
    <input type="text" id="search" class="form-control search" placeholder="Enter Keywords here">
    <div class="table-responsive">
        <table class="table table-borderless" >
            <thead>
            <th>First Category Name</th>
            <th>Second Category Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Total Value</th>
            <th></th>
            </thead>
            <tbody id="inventory">
            <?php
            foreach (@$data['supplies'] as $supplies)
            {
                echo '
                <tr>
                    <td>',$supplies->firstCategory,'</td>
                    <td>',$supplies->secondCategory,'</td>
                    <td>',$supplies->category,'</td>
                    <td>',$supplies->quantity,'</td>
                    <td>₱ ',number_format($supplies->totalValue),'</td>
                    <td><a href="/inventory/details/',$supplies->origin,'/',$supplies->supid,'?currtrans=supplies">Details</a></td>
                </tr>
                ';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

