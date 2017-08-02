<?php
require './protege.php';
require './config.php';

$msg = array();

$categoria = '';
$descricao = '';
$situacao = CATEGORIA_ATIVO;

if ($_POST) {
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $situacao = isset($_POST['situacao'])
        ? CATEGORIA_ATIVO : CATEGORIA_INATIVO;

    // Validacoes
    if ($categoria == '') {
        $msg[] = 'Informe o nome da categoria';
    }
    if ($descricao == '') {
        $msg[] = 'Informe a descrição';
    }

    if (!$msg) {
        $sql = "Insert into categoria (categoria, descricao, situacao) VALUES
        ('$categoria', '$descricao', '$situacao')";

        $con = Conexao::getConexao();
        try {
            $stmt = $con->query($sql);

            header('location: categorias.php');
            exit;
        } catch (PDOException $e) {
            $msg[] = "Não foi possível inserir o registro. Motivo: " . $e->getMessage();
            $msg[] = $sql;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo TITLE; ?></title>

    <?php include PATH . '/cabecalho.php'; ?>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

    <div class="page-header">
        <h1><i class="fa fa-cubes"></i> Cadastrar categoria</h1>
    </div>

    <?php if ($msg) {
        msgHtml($msg);
    } ?>

    <form role="form" method="post" action="">

        <div class="form-group">
            <label for="fcategoria">Categoria</label>
            <input type="text" class="form-control" id="fcategoria" name="categoria" placeholder="Nome da categoria"
                   value="<?php echo $categoria; ?>">
        </div>

        <div class="form-group">
            <label for="fdescricao">Descrição</label>
            <textarea class="form-control" id="fdescricao" name="descricao"><?php echo $descricao; ?></textarea>
        </div>

        <div class="checkbox">
            <label for="fsituacao">
                <input type="checkbox" name="situacao" id="fsituacao"
                       <?php if ($situacao == CATEGORIA_ATIVO) { ?>checked<?php } ?>>
                Categoria ativa
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>