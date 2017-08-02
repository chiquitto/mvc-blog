<?php
require './protege.php';
require './config.php';

$msg = array();

$idpostagem = 0;
$nomeadmin = $_SESSION['idadmin'];
$idcategoria = 0;
$titulo = '';
$texto = '';
$situacao = POSTAGEM_ATIVO;

if (isset($_POST['idpostagem'])) {
    $idpostagem = (int) $_POST['idpostagem'];
} elseif (isset($_GET['idpostagem'])) {
    $idpostagem = (int) $_GET['idpostagem'];
}

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

    $datacadastro = date('Y-m-d');
    $idadmin = $_SESSION['idadmin'];

    if (!$msg) {
        $sql = "Update postagem Set
          idcategoria = $idcategoria,
          titulo = '$titulo',
          texto = '$texto',
          situacao = '$situacao'
        Where idpostagem = $idpostagem";

        try {
            $stmt = $con->query($sql);

            header('location: postagens.php');
            exit;
        } catch (PDOException $e) {
            $msg[] = "Não foi possível inserir o registro. Motivo: " . $e->getMessage();
            $msg[] = $sql;
        }
    }
} else {
    $sql = "Select idcategoria, titulo, texto, datacadastro, idadmin, situacao From postagem
      Where idpostagem = $idpostagem";
    $stmt = $con->query($sql);

    if ($stmt->rowCount() == 0) {
        javascriptAlertFim("Registro inexistente", "./");
    }

    $postagem = $stmt->fetch(PDO::FETCH_ASSOC);
    $idcategoria = $postagem['idcategoria'];
    $titulo = $postagem['titulo'];
    $texto = $postagem['texto'];
    $datacadastro = $postagem['datacadastro'];
    $nomeadmin = $postagem['idadmin'];
    $situacao = $postagem['situacao'];
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
                   value="<?php echo $nomeadmin; ?>">
        </div>

        <div class="form-group">
            <label for="fdatacadastro">Data de cadastro</label>
            <input type="text" class="form-control" id="fdatacadastro" name="datacadastro" disabled
                   value="<?php echo date('d/m/Y') ?>">
        </div>

        <div class="form-group">
            <label for="fcategoria">Categoria</label>
            <input type="number" class="form-control" id="fcategoria" name="idcategoria" placeholder="Código da categoria"
                   value="<?php echo $idcategoria; ?>">
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

        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>