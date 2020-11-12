<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= @$title ?></title>
    <link rel="icon" href="/includes/images/favicodoh.png">
    <link rel="stylesheet" type="text/css" href="/includes/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/includes/css/fonts.css">

    <script defer src="/includes/bootstrap/svg/fontawesome-all.js"></script>
    <script type="text/javascript" src="/includes/js/jquery-3.5.js"></script>
    <script src="/includes/bootstrap/js/dist/util.js"></script>
    <script type="text/javascript" src="/includes/js/sweetalert2.all.min.js"></script>
    <script>window.jQuery || document.write('<script src="/includes/bootstrap/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="/includes/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/includes/js/functions.js"></script>

    <?php if(isset($styles)){foreach ($styles AS $style): ?>
    <link rel="stylesheet" href="<?= @$style; ?>">
    <?php endforeach;} ?>
    <?php if(isset($scripts)){ foreach ($scripts AS $script): ?>
       <script src=" <?= @$script ?>"></script>
    <?php endforeach; }?>
</head>
<body>
    <?= @$content ?>
</body>
</html>
