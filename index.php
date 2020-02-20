<?php 
require_once('app/config/config.php');
require_once('app/modules/hg-api.php');

$hg = new HG_API(HG_API_KEY);
$dolar = $hg->dollar_quotation();

// Verificação de Variação. 
if ($hg->is_error() == false){
    $variation = ( $dolar['variation'] < 0 ) ? 'danger' : 'primary'; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotação Dollar </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="">Cotação Dollar</p>
                <?php if ($hg->is_error() == false) : ?>
                <p>USD <span class="badge badge-pill badge-<?= $variation ?>"><?= $dolar['buy']; ?></span></p>
                <?php else: ?>
                <p><span class="badge badge-pill badge-danger">Serviço Indisponivel</span></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>