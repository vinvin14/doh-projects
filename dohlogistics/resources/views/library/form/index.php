<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="h5">Forms</div>
            <ul class="list-group">
                <?php
                foreach (@$reference['forms'] as $forms)
                {
                    echo '<li class="list-group-item">'.$forms['form'].'</li>';
                }
                ?>
            </ul>
        </div>
        <div class="col-6">
            <form action="/library/form/create" method="post">
                <div class="card">
                    <div class="card-header">
                        New Form
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                Form
                            </div>
                            <div class="col-9">
                                <input type="text" name="form" class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
