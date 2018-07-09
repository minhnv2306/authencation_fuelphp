<style>
    #form table {
        width: 90%;
    }
    #form table tr {
        width: 90%
    }
    #form table tr td {
        width: 50%
    }
    #form input[type = text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    #form input[type = submit] {
        width: 100%;
        background-color: #3c3c3c;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    #form div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>

<div id = "form">
    <h2>Book form</h2>

    <?php
    if(isset($errors)) {
        echo $errors;
    }
    echo $form;
    ?>
</div>