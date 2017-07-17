<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AccomodateMe</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style_boardingProfile.css" rel="stylesheet">

</head>

<body>
    <div>
    <div  class="avatar img-circle"></div>
                <style>
                    .avatar{
                        height:250px;
                        width:250px;
                        background-image:url('img/team/01.jpg');
                        background-size:cover;
                        background-position:50% 50%;
                        //background-size: 150px;
                        background-repeat: no-repeat;
                    }
                    .img-circle{
                        float: left;
                        margin: 20px 5% 5px 120px;
                    }
                </style>
        <div class='details'>
        <h1>About</h1>
        <h3>Owner's Name:</h3>
        <h3>Email:</h3>
        <h3>Address:</h3>
        <h3>Telephone:</h3>
        <h3>Boarding For:</h3>
        <h3>No of Students:</h3>
        <h3>Monthly Fee:</h3>
        <h3>Distance from University:</h3>
        </div>
    </div>
    
    <!-- Half Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('img/slider/02.jpg');"></div>
                <div class="carousel-caption">
                    <h3>Caption 1</h3>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('img/slider/03.jpg');"></div>
                <div class="carousel-caption">
                    <h3>Caption 2</h3>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('img/slider/04.jpg');"></div>
                <div class="carousel-caption">
                    <h3>Caption 3</h3>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>

    <!-- Page Content -->
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-8">
                <button type="button" class="btn btn-info">Book the Boarding</button>
                <button type="button" class="btn btn-info">Purchase the Boarding</button>
        </div><br>
        </div></div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.1.11.1.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
