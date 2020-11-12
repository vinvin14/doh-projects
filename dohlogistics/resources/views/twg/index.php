<style>
    *
    {
        box-sizing: border-box;
    }
    .top-mini-nav li
    {
        display: inline-block;
        font-family: "Calibri Light";
        margin-right: 10px;
        /*border: 1px solid gray;*/
        /*border-radius: 5px 5px;*/
        /*background-color: white;*/
        cursor: pointer;
    }
    .top-mini-nav li a
    {
        color: darkgray;
        padding: 5px 5px;
        cursor: pointer !important;
    }
    .top-mini-nav li a:hover
    {
        color: cornflowerblue;
        transition: .4s;
        /*font-weight: bold;*/
    }
    .nav-active
    {
        font-weight: bold;
        color: cornflowerblue !important;
        border-bottom: 3px solid cornflowerblue;
    }
    a
    {
        text-decoration: none !important;
        outline: none !important;
    }
</style>
<div class="container-fluid">
    <h5 class="border-bottom">TWG/WFP</h5>
    <div class="row">
        <div class="col-8">
            <div class="">
                <!--                <a href="/inventory/movement" class="btn btn-outline-primary mt-3 mr-3 float-right">Inventory Movement</a>-->
                <ul class="top-mini-nav mt-1">
                    <li><a href="/twg/members" class="<?= (@$data['subPageSelected'] === 'members') ? 'nav-active': ''?>">TWG Members</a></li>
                    <li><a href="/twg/requests/approved" class="<?= (@$data['subPageSelected'] === 'requests') ? 'nav-active': ''?>">TWG Requests</a></li>
                    <li><a href="/twg/wfp" class="<?= (@$data['subPageSelected'] === 'wfp') ? 'nav-active': ''?>">WFP Reference</a></li>
                </ul>


            </div>
        </div>
        </div>
    <div class="card card-body shadow">
        <?= @$subPage?>
    </div>
</div>
