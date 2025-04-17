<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALCULADORA</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

</head>
<body id="body">
<h1 id="h1">Calculadora</h1>
<FOrm method="POST" action="/Calc/calcular">

    <!-- <input type="text" name="visor" id="visor" value="<?= isset($valor_visor) ? $valor_visor : '' ?>" readonly> -->

    <textarea name="visor" id="visor" rows="3" readonly><?= isset($valor_visor) ? $valor_visor : '' ?></textarea>
<div class="teclado">
    <button type="submit" name="limpar" value="c">C</button>
    <button></button>
    <button></button>
    <button type="submit" name="historico" value="1">H</button>
    
    <button type="submit" name="num" value="1">1</button>
    <button type="submit" name="num" value="2">2</button>
    <button type="submit" name="num" value="3">3</button>
    <button type="submit" name="operacao" value="/">/</button>
    <button type="submit" name="num" value="4">4</button>
    <button type="submit" name="num" value="5">5</button>
    <button type="submit" name="num" value="6">6</button> 
    <button type="submit" name="operacao" value="*">*</button>
    <button type="submit" name="num" value="7">7</button>
    <button type="submit" name="num" value="8">8</button>
    <button type="submit" name="num" value="9">9</button>   
    <button type="submit" name="operacao" value="-">-</button>   
    <button type="submit" name="num" value="0">0</button>   
    <button class="igual" type="submit" name="calcular" value="=">=</button>
    <button type="submit" name="operacao" value="+">+</button>
</div>
    
</FOrm>
<!-- <?php if (isset($historico) && !empty($historico)): ?>
    <h2>Histórico</h2>
    <ul>
        <?php foreach ($historico as $item): ?>
            <li><?= esc($item) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?> -->
</body>
</html>