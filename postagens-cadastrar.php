<?php
require './protege.php';
require './config.php';

$msg = array();

$idcategoria = 0;
$titulo = '';
$texto = '';
$situacao = POSTAGEM_ATIVO;

$con = Conexao::getConexao();

if ($_POST) {
    $idcategoria = (int) $_POST['idcategoria'];
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $situacao = isset($_POST['situacao'])
        ? POSTAGEM_ATIVO : POSTAGEM_INATIVO;

    // Validacoes
    if ($idcategoria == 0) {
        $msg[] = 'Informe a categoria';
    }
    if ($titulo == '') {
        $msg[] = 'Informe o título';
    }
    if ($texto == '') {
        $msg[] = 'Informe o texto';
    }

    $datacadastro = date(DATE_BD);
    $idadmin = $_SESSION['idadmin'];

    if (!$msg) {
        $sql = "Insert into postagem (idcategoria, titulo, texto, datacadastro, idadmin, situacao)
        VALUES
        ($idcategoria, '$titulo', '$texto', '$datacadastro', $idadmin, '$situacao')";

        try {
            $stmt = $con->query($sql);

            header('location: postagens.php');
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
        <h1><i class="fa fa-list"></i> Cadastrar postagem</h1>
    </div>

    <?php if ($msg) {
        msgHtml($msg);
    } ?>

    <form role="form" method="post" action="">

        <div class="form-group">
            <label for="fautor">Autor</label>
            <input type="text" class="form-control" id="fautor" name="autor" disabled
                   value="<?php echo $_SESSION['nomeadmin']; ?>">
        </div>

        <div class="form-group">
            <label for="fdatacadastro">Data de cadastro</label>
            <input type="text" class="form-control" id="fdatacadastro" name="datacadastro" disabled
                   value="<?php echo date('d/m/Y') ?>">
        </div>

        <div class="form-group">
            <label for="fcategoria">Categoria</label>
            <select class="form-control" id="fcategoria" name="idcategoria">
                <option value="0">Selecione</option>
                <?php
                $sql = "Select idcategoria, categoria From categoria
                  Where situacao = '" . CATEGORIA_ATIVO . "'";
                $stmtCategoria = $con->query($sql);
                while($categoria = $stmtCategoria->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $categoria['idcategoria']; ?>"
                    <?php if ($categoria['idcategoria'] == $idcategoria) { ?> selected<?php } ?>>
                    <?php echo $categoria['categoria']; ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ftitulo">Título</label>
            <input type="text" class="form-control" id="ftitulo" name="titulo" placeholder="Título da postagem"
                   value="<?php echo $titulo; ?>">
        </div>

        <div class="form-group">
            <label for="ftexto">Texto</label>
            <textarea class="form-control" id="ftexto" name="texto" rows="5"><?php echo $texto; ?></textarea>
        </div>

        <div class="checkbox">
            <label for="fsituacao">
                <input type="checkbox" name="situacao" id="fsituacao"
                       <?php if ($situacao == POSTAGEM_ATIVO) { ?>checked<?php } ?>>
                Postagem ativa
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>