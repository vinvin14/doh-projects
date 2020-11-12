<div class="container">
    <h5 class="border-bottom">New Item</h5>
    <div class="card card-body">
        <form action="/library/item/create" method="post">
            <div class="row">
                <div class="col-3">
                    First Category
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="firstCategory" required>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    First Category
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="firstCategory" required>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Second Category
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="secondCategory" required>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Description
                </div>
                <div class="col-9">
                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Type
                </div>
                <div class="col-9">
                    <select name="type" id="" class="form-control" required>
                        <option value="">-</option>
                        <?php
                        foreach(@$reference['type'] as $type)
                        {
                            echo '<option value="'.$type['id'].'">'.$type['typeName'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Group
                </div>
                <div class="col-9">
                    <select name="group" id="" class="form-control" required>
                        <option value="">-</option>
                        <?php
                        foreach(@$reference['group'] as $group)
                        {
                            echo '<option value="'.$group['id'].'">'.$group['groupName'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Unit
                </div>
                <div class="col-9">
                    <select name="unit" id="" class="form-control">
                        <option value="">-</option>
                        <?php
                        foreach(@$reference['units'] as $unit)
                        {
                            echo '<option value="'.$unit['id'].'">'.$unit['unitName'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Unit Cost
                </div>
                <div class="col-9">
                    <input type="number" name="unitCost" class="form-control" required>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</div>
