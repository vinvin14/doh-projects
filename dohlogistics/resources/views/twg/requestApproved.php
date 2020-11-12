<div class="container-fluid">
    <h6>Approved</h6>
    <div class="table-responsive" style="max-height: 600px; overflow-y: auto">
        <table class="table table-border">
            <thead>
                <th>1st Category Name</th>
                <th>2nd Category Name</th>
                <th>Description</th>
                <th>Branch</th>
                <th>Category</th>
                <th>Item Cost</th>
                <th>Unit</th>
            </thead>
            <tbody style="max-height: 500px;overflow-y: auto">
            <?php
                foreach (@$data['twg'] as $twg)
                {
                    echo '
                    <tr>
                        <td>',$twg->firstCategory,'</td>
                        <td>',$twg->secondCategory,'</td>
                        <td style="max-width: 200px;overflow-x: auto">',$twg->description,'</td>
                        <td>',$twg->branch,'</td>
                        <td>',$twg->category,'</td>
                        <td>₱',number_format($twg->itemCost),'</td>
                        <td>',$twg->unit,'</td>
                    </tr>
                    ';
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
