<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <title> Import file </title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php echo Asset::css('toastr.css'); ?>
    <?php echo Asset::js('toastr.min.js'); ?>
</head>

<body>
<nav class = "navbar navbar-inverse navbar-fixed-top">
    <div class = "container">
        <div class = "navbar-header">

            <button type = "button" class = "navbar-toggle collapsed"
                    datatoggle = "collapse" data-target = "#navbar"
                    aria-expanded = "false" ariacontrols = "navbar">
                <span class=  "sr-only">Toggle navigation</span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
            </button>
            <a class = "navbar-brand" href = "#">FuelPHP Sample</a>
        </div>

        <div id = "navbar" class = "collapse navbar-collapse">
            <ul class = "nav navbar-nav">
                <li class = "active"><a href = "/book/index">Home</a></li>
                <li><a href = "/book/add">Add book</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class = "container">
    <div class = "starter-template" style = "padding: 50px 0 0 0;">
        <form method="post" action="/csv/importfile" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" name="filecsv">
            </div>
            <button> Submit </button>
        </form>
    </div>

</div><!-- /.container -->
</body>

</html>