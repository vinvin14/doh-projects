<div class="text-center border-bottom pb-1">

<!--    <div><small class="px-2 text-light font-weight-bold" style="font-size: 12px;">DEPARTMENT OF HEALTH</small></div>-->
<!--    <small class="text-light font-weight-bold" style="font-size: 10px;">CORDILLERA ADMINISTRATIVE REGION</small>-->
    <div class="font-weight-bold text-light">
        <div><img src="/includes/images/dohlogo.png" class="" alt="" style="width: 100px;height:65px;"></div>
        <small>Welcome</small>
    </div>
    <div class="font-weight-bold text-light"><?= @$_SESSION['fullname']?></div>
    <small class="font-weight-bold"><?= @$_SESSION['role']?></small>
</div>
<div class="sidebar-items">
    <div class="sidebar-title text-center">
        <small class="font-weight-bold">NAVIGATION TOOLS</small>
    </div>
    <?php
    foreach($sidebar as $option)
    {
        echo '<a href="'.$option['link'].'" class="';
        if($option['sidebar'] === $sidebar_selected) echo 'active';
        echo '" >'.$option['label'].'</a>';
    }

    ?>
</div>
