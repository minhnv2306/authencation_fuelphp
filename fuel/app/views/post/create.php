
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <title>Book add page</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="http://bookstore.local/assets/css/toastr.css?1531369240" />
    <script type="text/javascript" src="http://bookstore.local/assets/js/toastr.min.js?1531369240"></script>
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
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">admin <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/login/logout">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container" style="padding-top: 50px">
    <h2> Post information </h2>
    <p>The form below shows input elements with different heights using .input-lg and .input-sm:</p>
    <form method="POST" action="/post/store">
        <div class="form-group">
            <label for="inputdefault">Post title</label>
            <input class="form-control" id="inputdefault" type="text" name="title">
        </div>
        <div class="form-group">
            <label for="inputlg">Post content</label>
            <textarea class="form-control" id="inputlg" type="textarea" name="content">
            </textarea>
        </div>
        <button class="btn btn-primary"> Create </button>
    </form>
</div>
</body>

</html>