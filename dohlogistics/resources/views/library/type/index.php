<div class="container">
    <h5 class="border-bottom">Type</h5>
    <div class="row">
        <div class="col-6">
            <small class="font-weight-bold">List of All Types</small>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                    <?php
                    foreach (@$reference['types'] as $type)
                    {
                        echo '
                        <tr>
                            <td>'.$type['typeName'].'</td>
                            <td><a href="/library/type/'.$type['id'].'">Edit</a></td>
                        </tr>
                        ';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    New Type
                </div>
                <div class="card-body">
                    <form action="/library/type/create">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Type</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="typeName">
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
