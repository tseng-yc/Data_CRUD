<?php
$page_title = '熱門商品';
$page_name = 'hot_products';
require __DIR__ . '/parts/__connect_db.php';
$perPage = 5; //每頁有幾筆資料
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(*) FROM `hot_products`";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
$rows = [];
if ($totalRows > 0) {
    if ($page < 1) {
        header('Location: hot_products.php');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: hot_products.php?page=' . $totalPages);
        exit;
    };
    $sql = sprintf("SELECT * FROM `hot_products` LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
}
?>

<?php require __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__navbar.php' ?>

<div class="container">
    <div class="row">
        <div class="col d-flex justify-content">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="nav-item  <?= $page_name == 'hot_products-insert' ? 'active' : ''  ?> ">
                        <a class="nav-link ">
                            <熱門商品>
                        </a>
                    </li>
                    <li class="nav-item  <?= $page_name == 'hot_products-insert' ? 'active' : ''  ?> ">
                        <a class="nav-link " href="./hot_products-insert.php">新增項目</a>
                    </li>

                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                    </li>

                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                        if ($i < 1) continue;
                        if ($i > $totalPages) break;
                    ?>

                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>

                <th scope="col"><i class="fas fa-trash-alt"></i></th>

                <th scope="col">#</th>
                <th scope="col">商品名稱</th>
                <th scope="col">照片</th>
                <th scope="col">卡路里</th>
                <th scope="col">商品簡介</th>

                <th scope="col"><i class="fas fa-edit"></i></th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>

                    <td><a href="hot_products-delete.php?sid=<?= $r['sid'] ?>" onclick="ifDel(event)" hot_products-sid="<?= $r['sid'] ?>">
                            <i class="fas fa-trash-alt"></i></a></td>


                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['name'] ?></td>
                    <td><img src="./uploads/<?= $r['picture'] ?>" alt="..." width="200px"></td>
                    <td><?= $r['calories'] ?></td>
                    <td><?= $r['introduction'] ?></td>

                    <td><a href="hot_products-edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit">
                            </i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/parts/__scripts.php'; ?>

<script>
    function ifDel(event) {
        const a = event.currentTarget;
        console.log(event.target, event.currentTarget);
        const sid = a.getAttribute('hot_products-sid');
        if (!confirm(`是否要刪除編號為 ${sid} 的資料?`)) {
            event.preventDefault(); // 取消連往 href 的設定
        }
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php'; ?>