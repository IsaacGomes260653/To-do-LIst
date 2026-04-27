<?php
// Framework utilizado: Bootstrap 5
// Importado de: https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexao.php";

// Busca tarefas do usuário logado
$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC");
$stmt->execute([$_SESSION["usuario_id"]]);
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

include "layout.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="page-title mb-0">
        <i class="bi bi-list-task me-2"></i>Minhas Tarefas
    </h4>
    <a href="nova.php" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i>Nova Tarefa
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <?php if (empty($tarefas)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                Nenhuma tarefa cadastrada ainda.<br>
                <a href="nova.php" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-1"></i>Criar primeira tarefa
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Status</th>
                            <th>Data de Criação</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tarefas as $tarefa): ?>
                        <tr>
                            <td class="text-muted small"><?php echo $tarefa['id']; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($tarefa['titulo']); ?></strong>
                                <?php if (!empty($tarefa['descricao'])): ?>
                                    <br>
                                    <small class="text-muted">
                                        <?php echo htmlspecialchars(mb_substr($tarefa['descricao'], 0, 60)) . (mb_strlen($tarefa['descricao']) > 60 ? '...' : ''); ?>
                                    </small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($tarefa['status'] === 'concluida'): ?>
                                    <span class="badge badge-concluida">
                                        <i class="bi bi-check-circle me-1"></i>Concluída
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-pendente">
                                        <i class="bi bi-clock me-1"></i>Pendente
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-muted small">
                                <?php echo date('d/m/Y H:i', strtotime($tarefa['data_criacao'])); ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center flex-wrap">
                                    <a href="editar.php?id=<?php echo $tarefa['id']; ?>"
                                       class="btn btn-warning btn-action btn-sm">
                                        <i class="bi bi-pencil me-1"></i>Editar
                                    </a>
                                    <?php if ($tarefa['status'] === 'pendente'): ?>
                                    <a href="concluir.php?id=<?php echo $tarefa['id']; ?>"
                                       class="btn btn-success btn-action btn-sm"
                                       onclick="return confirm('Marcar como concluída?')">
                                        <i class="bi bi-check-lg me-1"></i>Concluir
                                    </a>
                                    <?php endif; ?>
                                    <a href="excluir.php?id=<?php echo $tarefa['id']; ?>"
                                       class="btn btn-danger btn-action btn-sm"
                                       onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                        <i class="bi bi-trash me-1"></i>Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include "footer.php"; ?>
