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

$con = \App\Conexao::getConexao();

if ($_POST) {
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $idcidade = (int) $_POST['idcidade'];

    $nascimentoDate = DateTime::createFromFormat(DATE_USUARIO, $nascimento);
    if (!$nascimentoDate) {
        $msg[] = "Informe uma data de nascimento no formato correto";
    }

    if (!$msg) {
        $usuarioVo = new \App\Vo\Usuario();
        $usuarioVo->setIdusuario($idusuario);
        $usuarioVo->setNome($nome);
        $usuarioVo->setNascimento($nascimentoDate);
        $usuarioVo->setIdcidade($idcidade);

        $usuariDao = new \App\Dao\UsuarioDao();

        try {
            $usuariDao->editar($usuarioVo);

            header('location: usuarios.php');
            exit;
        } catch (Exception $e) {
            $msg[] = $e->getMessage();
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
            <select class="form-control" id="fidcidade" name="idcidade">
                <option value="0">Selecione</option>
                <?php
                $sql = "Select idcidade, cidade, uf From cidade";
                $stmtCidade = $con->query($sql);
                while($cidade = $stmtCidade->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <option value="<?php echo $cidade['idcidade']; ?>"
                        <?php if ($cidade['idcidade'] == $idcidade) { ?> selected<?php } ?>>
                        <?php echo $cidade['cidade']; ?>/<?php echo $cidade['uf']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>