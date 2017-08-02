<?php
require './protege.php';
require './config.php';

$msg = array();

$nome = '';
$nascimento = '';
$idcidade = 0;

if ($_POST) {
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $idcidade = (int) $_POST['idcidade'];

    // Validacoes
    if ($nome == '') {
        $msg[] = 'Informe o nome completo';
    }
    if ($nascimento == '') {
        $msg[] = 'Informe a data de nascimento';
    }
    if ($idcidade == 0) {
        $msg[] = 'Informe a cidade';
    }

    if (!$msg) {
        $nascimentoDate = DateTime::createFromFormat(DATE_USUARIO, $nascimento);
        $nascimentoBd = $nascimentoDate->format(DATE_BD);

        $sql = "Insert into usuario (nome, nascimento, idcidade)
        VALUES
        ('$nome', '$nascimentoBd', $idcidade)";

        $con = Conexao::getConexao();
        try {
            $stmt = $con->query($sql);

            header('location: usuarios.php');
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
        <h1><i class="fa fa-user"></i> Cadastrar usuário</h1>
    </div>

    <?php if ($msg) {
        msgHtml($msg);
    } ?>

    <form role="form" method="post" action="">

        <div class="form-group">
            <label for="fnome">Nome</label>
            <input type="text" class="form-control" id="fnome" name="nome" placeholder="Nome completo"
                   value="<?php echo $nome; ?>">
        </div>

        <div class="form-group">
            <label for="fnascimento">Nascimento</label>
            <input type="text" class="form-control" id="fnascimento" name="nascimento" placeholder="Data de nascimento"
                   value="<?php echo $nascimento; ?>">
        </div>

        <div class="form-group">
            <label for="fidcidade">Cidade</label>
            <input type="number" class="form-control" id="fidcidade" name="idcidade"
                   value="<?php echo $idcidade; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>