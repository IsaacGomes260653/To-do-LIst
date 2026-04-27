<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo    = trim($_POST["titulo"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");

    if ($titulo !== "") {
        $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, descricao, usuario_id) VALUES (?, ?, ?)");
        $stmt->execute([$titulo, $descricao, $_SESSION["usuario_id"]]);
    }

    header("Location: index.php");
    exit;
}

include "layout.php";
?>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-success text-white">
                <i class="bi bi-plus-circle me-2"></i>Nova Tarefa
            </div>
            <div class="card-body p-4">
                <form method="POST" action="nova.php">

                    <div class="mb-3">
                        <label for="titulo" class="form-label fw-semibold">
                            Título <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="titulo"
                            name="titulo"
                            class="form-control"
                            placeholder="Digite o título da tarefa"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label for="descricao" class="form-label fw-semibold">Descrição</label>
                        <textarea
                            id="descricao"
                            name="descricao"
                            class="form-control"
                            rows="4"
                            placeholder="Descreva os detalhes da tarefa (opcional)"
                        ></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg me-1"></i>Salvar Tarefa
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
