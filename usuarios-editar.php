<?php
require './protege.php';
require './config.php';

$msg = array();

$idusuario = 0;
$nome = '';
$nascimento = '';
$idcidade = 0;

if (isset($_POST['idusuario'])) {
    $idusuario = (int) $_POST['idusuario'];
} elseif (isset($_GET['idusuario'])) {
    $idusuario = (int) $_GET['idusuario'];
}

$con = Conexao::getConexao();

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

        $sql = "Update usuario Set
        nome = '$nome',
        nascimento = '$nascimentoBd',
        idcidade = $idcidade
        Where idusuario = $idusuario";

        try {
            $stmt = $con->query($sql);

            header('location: usuarios.php');
            exit;
        } catch (PDOException $e) {
            $msg[] = "Não foi possível atualizar o registro. Motivo: " . $e->getMessage();
            $msg[] = $sql;
        }
    }
} else {
    $sql = "Select nome, nascimento, idcidade From usuario Where idusuario = $idusuario";
    $stmt = $con->query($sql);

    if ($stmt->rowCount() == 0) {
        javascriptAlertFim("Registro inexistente", "./");
    }

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    $nome = $usuario['nome'];
    $nascimentoBd = $usuario['nascimento'];
    $idcidade = $usuario['idcidade'];

    $nascimentoDate = DateTime::createFromFormat(DATE_BD, $nascimentoBd);
    $nascimento = $nascimentoDate->format(DATE_USUARIO);
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
        <h1><i class="fa fa-user"></i> Editar usuário</h1>
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

        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>