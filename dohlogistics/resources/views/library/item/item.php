<div class="container">

    <div class="card">
        <div class="card-header">
            <?=@$reference['itemName']?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <small>First Category</small>
                    <select name="firstCategory" id="" class="form-control" required>
                        <option value="">-</option>
                        <?php
                        foreach (@$reference['firstCategory'] as $firstCategory)
                        {
                            echo '<option value="'.$firstCategory['id'].'">'.$firstCategory['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <small>Second Category</small>
                    <select name="firstCategory" id="" class="form-control" required>
                        <option value="">-</option>
                        <?php
                        foreach (@$reference['secondCategory'] as $secondCategory)
                        {
                            echo '<option value="'.$secondCategory['id'].'">'.$secondCategory['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <small>Description</small>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <small>Type</small>
                    <select name="type" id="" class="form-control">
                        <option value="">-</option>
                        <?php
                        foreach (@$reference['types'] as $type)
                        {
                            echo '
                            <option>'.$type['typeName'].'</option>
                            ';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <small>Group</small>
                    <select name="group" id="" class="form-control">
                        <option value="">-</option>
                        <?php
                        foreach (@$reference['group'] as $group)
                        {
                            echo '<option>'.$group['groupName'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <small>Unit</small>
                    <select name="unit" id="" class="form-control">
                        <option value="">-</option>
                        <?php
                        foreach (@$reference['units'] as $unit)
                        {
                            echo '<option>'.$unit['unitName'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <small>Cost</small>
                    <input type="number" name="unitCost" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
