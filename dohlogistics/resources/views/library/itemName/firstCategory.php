<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="h5 border-bottom">First Category</div>
            <ul class="list-group">
                <?php
                foreach (@$reference['firstCategory'] as $firstCategory)
                {
                    echo '
                        <li class="list-group-item">'.$firstCategory['name'].'</li>
                    ';
                }
                ?>
            </ul>
        </div>
        <div class="col-6">
            <div class="h5 border-bottom">Second Category</div>
            <ul class="list-group">
                <?php
                foreach (@$reference['secondCategory'] as $secondCategory)
                {
                    echo '
                        <li class="list-group-item">'.$secondCategory['name'].'</li>
                    ';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
