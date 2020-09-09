<?php
$page_title = '新增文章';
$page_name = 'article-insert';
require __DIR__ . '/parts/__connect_db.php';
?>
<?php require __DIR__ . '/parts/__html_head.php'; ?>
<style>
    span.red-stars {
        color: red;
    }

    small.error-msg {
        color: red;
    }
</style>
<?php include __DIR__ . '/parts/__navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div id="infobar" class="alert alert-success" role="alert" style="display: none">
                A simple success alert—check it out!
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增文章</h5>

                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <div class="form-group">
                            <label for="author"><span class="red-stars">**</span> 作者</label>
                            <input type="text" class="form-control" id="author" name="author" required>
                            <small class="form-text error-msg"></small>
                        </div>

                        <div class="form-group">
                            <label for="picture"><span class="red-stars">**</span> 作者照片</label>
                            <br>
                            <button type="button" class="btn btn-primary" onclick="file_input.click()">上傳檔案</button>
                            <input type="hidden" id="picture" name="picture">
                            <img src="./uploads/" alt="" id="myimg" width="250px" />
                        </div>

                        <div class="form-group">
                            <label for="article"><span class="red-stars">**</span>好文推薦</label>
                            <textarea cols="30" rows="3" class="form-control" id="article" name="article"></textarea>
                            <small class="form-text error-msg"></small>
                            <button type="submit" class="btn btn-primary">確認送出</button>
                        </div>
                    </form>
                    <input type="file" id="file_input" style="display: none">
                </div>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/__scripts.php'; ?>
<script>
    const $author = document.querySelector('#author');
    const $picture = document.querySelector('#picture');
    const $article = document.querySelector('#article');
    const file_input = document.querySelector('#file_input');
    const r_fields = [$author, $picture, $article];
    const infobar = document.querySelector('#infobar');
    const submitBtn = document.querySelector('button[type=submit]');

    file_input.addEventListener('change', function(event) {
        console.log(file_input.files)
        const fd = new FormData();
        fd.append('picture', file_input.files[0]);

        fetch('pic-api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                picture.value = obj.filename;
                document.querySelector('#myimg').src = './uploads/' + obj.filename;
            });
    });



    function checkForm() {
        let isPass = true;

        r_fields.forEach(el => {
            el.style.borderColor = '#cccccc';
            el.nextElementSibling.innerHTML = '';
        });


        submitBtn.style.display = 'none';
        // TODO:檢查資料格式
        if ($author.value.length < 1) {
            isPass = false;
            $author.style.borderColor = 'red';
            $author.nextElementSibling.innerHTML = '請填寫作者';
        }

        if ($article.value.length < 1) {
            isPass = false;
            $article.style.borderColor = 'red';
            $article.nextElementSibling.innerHTML = '請填寫文章內容';
        }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('article-insert-api.php', {
                    method: 'POST',
                    body: fd
                })

                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infobar.innerHTML = '新增成功';
                        infobar.className = "alert alert-success";

                        setTimeout(() => {
                            location.href = 'article.php';
                        }, 2000)
                    } else {
                        infobar.innerHTML = obj.error || '新增失敗';
                        infobar.className = "alert alert-danger";

                        submitBtn.style.display = 'block';
                    }
                    infobar.style.display = 'block';
                });

        } else {
            submitBtn.style.display = 'block';
        }
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php'; ?>