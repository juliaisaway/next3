<?php
    $acessos = (object) [
        ['name' => 'Usuário 01', 'date' => '03/01/2018', 'ip' => '187.180.191.161'],
        ['name' => 'Usuário 02', 'date' => '03/01/2018', 'ip' => '187.180.191.161'],
        ['name' => 'Usuário 03', 'date' => '03/01/2018', 'ip' => '187.180.191.161'],
        ['name' => 'Usuário 04', 'date' => '03/01/2018', 'ip' => '187.180.191.161'],
    ];
?>

<div class="col-md-6">
        <div class="content-block">
            <h3>Últimos Acessos</h3>
            <div class="table">
                <div class="table-header light">
                    <div class="title">Nome</div>
                    <div class="data">Data</div>
                    <div class="ip">IP</div>
                </div>
                <?php
                    if(is_array($acessos) || is_object($acessos)) {
                    foreach($acessos as $row):
                ?>
                    <div class="table-row">
                        <div class="table_label"><?= $row['name'] ?></div>
                        <div class="table_date"><?= $row['date'] ?></div>
                        <div class="table_ip"><?= $row['ip'] ?></div>
                    </div>
                <?php
                    endforeach;
                    } else {
                        echo '<div class="nada">Nenhum valor encontrado</div>';
                    }
                ?>
            </div>
        </div>
    </div>