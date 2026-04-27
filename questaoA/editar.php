<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexao.php";

$id = intval($_GET["id"] ?? 0);

// Busca a tarefa (garantindo que pertence ao usuário logado)
$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $_SESSION["usuario_id"]]);
$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarefa) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo    = trim($_POST["titulo"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $status    = $_POST["status"] ?? "pendente";

    if ($titulo !== "") {
        $stmt = $pdo->prepare("UPDATE tarefas SET titulo = ?, descricao = ?, status = ? WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$titulo, $descricao, $status, $id, $_SESSION["usuario_id"]]);
    }

    header("Location: index.php");
    exit;
}

include "layout.php";
?>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <i class="bi bi-pencil-square me-2"></i>Editar Tarefa
            </div>
            <div class="card-body p-4">
                <form method="POST" action="editar.php?id=<?php echo $id; ?>">

                    <div class="mb-3">
                        <label for="titulo" class="form-label fw-semibold">
                            Título <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="titulo"
                            name="titulo"
                            class="form-control"
                            value="<?php echo htmlspecialchars($tarefa['titulo']); ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-semibold">Descrição</label>
                        <textarea
                            id="descricao"
                            name="descricao"
                            class="form-control"
                            rows="4"
                        ><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="pendente"  <?php echo $tarefa['status'] === 'pendente'  ? 'selected' : ''; ?>>
                                ⏳ Pendente
                            </option>
                            <option value="concluida" <?php echo $tarefa['status'] === 'concluida' ? 'selected' : ''; ?>>
                                ✅ Concluída
                            </option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save me-1"></i>Salvar Alterações
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
