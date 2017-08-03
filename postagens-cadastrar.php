<?php
require './protege.php';
require './config.php';

$msg = array();

$idcategoria = 0;
$titulo = '';
$texto = '';
$situacao = POSTAGEM_ATIVO;

$con = \App\Conexao::getConexao();

if ($_POST) {
    $idcategoria = (int) $_POST['idcategoria'];
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $situacao = isset($_POST['situacao'])
        ? POSTAGEM_ATIVO : POSTAGEM_INATIVO;

    if (!$msg) {

        $idadmin = $_SESSION['idadmin'];

        $postagemVo = new \App\Vo\Postagem();
        $postagemVo->setIdcategoria($idcategoria);
        $postagemVo->setTitulo($titulo);
        $postagemVo->setTexto($texto);
        $postagemVo->setIdadmin($idadmin);
        $postagemVo->setSituacao($situacao);

        $postagemDao = new \App\Dao\PostagemDao();

        try {
            $postagemDao->cadastrar($postagemVo);

            header('location: postagens.php');
            exit;
        } catch (Exception $e) {
            $msg[] = $e->getMessage();
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