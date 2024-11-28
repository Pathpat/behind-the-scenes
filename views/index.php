<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<h1>Home Page</h1>
<hr/>
<div>
    <?php
    if (! empty($invoice)): ?>
        Invoice ID: <?= htmlspecialchars($invoice['id'], ENT_QUOTES) ?><br/>
        Invoice Amount: <?= htmlspecialchars($invoice['amount'], ENT_QUOTES) ?>
        <br/>
        User: <?= htmlspecialchars($invoice['full_name'], ENT_QUOTES) ?><br/>
    <?php
    endif; ?>
</div>
<form method="post" action="/upload" enctype="multipart/form-data">
    <input type="file" name="receipt"/>
    <button type="submit">Upload</button>
</form>
</body>
</html>