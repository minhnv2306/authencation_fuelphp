<table class = "table">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Author</th>
        <th>Price</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach($books as $book) {
        ?>

        <tr>
            <td><?php echo $book['id']; ?></td>
            <td><?php echo $book['title']; ?></td>
            <td><?php echo $book['author']; ?></td>
            <td><?php echo $book['price']; ?></td>
            <td>
                <a href = "/book/edit/<?php echo $book['id']; ?>">Edit</a>
                <a href = "/book/delete/<?php echo $book['id']; ?>">Delete</a>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
<ul>
</ul>
<a href="/csv/export">Download CSV</a>
<a href="/csv/gettxt" style="padding-left: 30px">Download TXT</a>
<a href="/csv/import" style="padding-left: 30px">Import CSV</a>
<script>
    toastr.success('Have fun storming the castle!', 'Miracle Max Says');
</script>