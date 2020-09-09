<?php
$page_title = '新增活動';
$page_name = 'events-insert';
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
                    <h5 class="card-title">新增活動</h5>

                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <div class="form-group">
                            <label for="title"><span class="red-stars">**</span>活動名稱</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            <small class="form-text error-msg"></small>
                        </div>
                        <div class="form-group">
                            <label for="picture"><span class="red-stars">**</span> 活動照片</label>
                            <br>
                            <button type="button" class="btn btn-primary" onclick="file_input.click()">上傳檔案</button>
                            <input type="hidden" id="picture" name="picture">
                            <img src="./uploads/" alt="" id="myimg" width="250px" />
                        </div>
                        <div class="form-group">
                            <label for="content"><span class="red-stars">**</span> 活動說明</label>
                            <textarea cols="30" rows="3" class="form-control" id="content" name="content"></textarea>
                            <small class="form-text error-msg"></small>
                        </div>
                        <div class="form-group">
                            <label><span class="red-stars">**</span> 活動日期</label>
                            <input type="date" class="form-control" id="date_from" name="date_from">
                            <span>～</span>
                            <input type="date" class="form-control" id="date_end" name="date_end">
                            <small class="form-text error-msg"></small>
                        </div>

                        <button type="submit" class="btn btn-primary">確認送出</button>
                    </form>
                    <input type="file" id="file_input" style="display: none">
                </div>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/__scripts.php'; ?>
<script>
    const $title = document.querySelector('#title');
    const $picture = document.querySelector('#picture');
    const $content = document.querySelector('#content');
    const file_input = document.querySelector('#file_input');
    const $date_from = document.querySelector('#date_from');
    const $date_end = document.querySelector('#date_from');
    const r_fields = [$title, $picture, $content, $date_from, $date_end];
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
        if ($title.value.length < 1) {
            isPass = false;
            $title.style.borderColor = 'red';
            $title.nextElementSibling.innerHTML = '請填寫農場及農有姓名';
        }

        if ($content.value.length < 1) {
            isPass = false;
            $content.style.borderColor = 'red';
            $content.nextElementSibling.innerHTML = '請填寫活動說明';
        }


        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('events-insert-api.php', {
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
                            location.href = 'events.php';
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