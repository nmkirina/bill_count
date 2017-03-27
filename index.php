<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
            $billData = [
                ['id' => 1, 'name' => 'Иванов', 'rest' => 123],
                ['id' => 2, 'name' => 'Петров', 'rest' => 334],
                ['id' => 3, 'name' => 'Сидоров', 'rest' => 0],
                ['id' => 4, 'name' => 'Александров', 'rest' => 1892],
            ]
//        $billData = array();
        ?>
        <div class="container well">
            <div class="alert alert-danger">
                Текст ошибки
                <button type="button" class="close" data-dismiss="alert">x</button>
            </div>
            <div class="alert alert-success">
                Текст успешной операции
                <button type="button" class="close" data-dismiss="alert">x</button>
            </div>
            <div class="hero-unit">
                <h1>Расчет остатка средств</h1>
                <p>
                    Для расчета  остатка, загрузите .xlsx файл.
                </p>
                <p>
                    <form action="controller.php" enctype="multipart/form-data" method="POST">
                        <input type="file" title="Загрузить файл" class="btn btn-primary btn-large">
                    </form>
                </p>
            </div>
            <?php if(!empty($billData)):?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Фамилия</th>
                            <th>Остаток</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($billData as $data):?>
                            <tr>
                                <td><?= $data['id']?></td>
                                <td><?= $data['name']?></td>
                                <td><?= $data['rest']?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            <?php endif;?>
        </div>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrap.file-input.js"></script>
        <script>
            $('input[type=file]').bootstrapFileInput();
            $('.file-inputs').bootstrapFileInput();
        </script>
    </body>
</html>
