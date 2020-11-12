<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-2 border-right">
            <small class="p-1 text-center font-weight-bold">Navigation Tools</small>
            <div class="list-group mt-3 mb-4 shadow-sm">
                <a href="/twg/requests/approved" class="list-group-item list-group-item-action <?= (@$data['subPage2Selected'] == 'requestApproved')? 'active':''?>">Approved </a>
                <a href="/twg/requests/pending" class="list-group-item list-group-item-action <?= (@$data['subPage2Selected'] == 'requestPending')? 'active':''?>">
                    Pending
                </a>
                <a href="/twg/requests/declined" class="list-group-item list-group-item-action <?= (@$data['subPage2Selected'] == 'requestDeclined')? 'active':''?>">Denied</a>
<!--                <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>-->
<!--                <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Vestibulum at eros</a>-->
            </div>
        </div>
        <div class="col-10">
            <?= @$subPage2?>
        </div>
    </div>
</div>
