<?php
session_start();
require_once "conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $senha    = md5($_POST["senha"] ?? "");

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
    $stmt->execute([$usuario, $senha]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario"]    = $user["usuario"];
        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — TaskManager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-check2-square me-2"></i>TaskManager
                <div class="small mt-1 fw-normal opacity-75">Faça login para continuar</div>
            </div>
            <div class="card-body p-4">

                <?php if ($erro): ?>
                    <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <?php echo htmlspecialchars($erro); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="usuario" class="form-label fw-semibold">Usuário</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input
                                type="text"
                                id="usuario"
                                name="usuario"
                                class="form-control"
                                placeholder="Digite seu usuário"
                                required
                                autocomplete="username"
                            >
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="senha" class="form-label fw-semibold">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input
                                type="password"
                                id="senha"
                                name="senha"
                                class="form-control"
                                placeholder="Digite sua senha"
                                required
                                autocomplete="current-password"
                            >
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
