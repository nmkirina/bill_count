<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        
        <div class="container well">
            
            <?php if(isset($_SESSION['success'])&&(!$_SESSION['success'])):?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error'];?>
                    <button type="button" class="close" data-dismiss="alert">x</button>
                </div>
            <?php elseif(isset($_SESSION['success'])&&($_SESSION['success'])):?>
                <div class="alert alert-success">
                    Загрузка прошла успешно
                    <button type="button" class="close" data-dismiss="alert">x</button>
                </div>
            <?php endif;?>
            
            <div class="hero-unit">
                <h1>Расчет остатка средств</h1>
                <p>
                    Для расчета  остатка, загрузите .xlsx файл.
                </p>
                <p>
                    <form action="main.php" enctype="multipart/form-data" method="POST"  id="uploadForm">
                        <input type="file" title="Загрузить файл" class="btn btn-primary btn-large" id="uploadButton" name="file">
                    </form>
                </p>
            </div>
            <?php if((isset($_SESSION['billData']))&&($_SESSION['billData'])):?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Фамилия</th>
                            <th>Остаток</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['billData'] as $id => $data):?>
                            <tr>
                                <td><?= $id?></td>
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
        <script src="js/main.js"></script>
    </body>
</html>
