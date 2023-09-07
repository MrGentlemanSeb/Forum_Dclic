<?php global $user;?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border" style="display: flex; flex-direction:column" >
        <div class="container col-lg-9 col-sm-12 col-md-10 d-flex flex-lg-row flex-md-row flex-sm-column justify-content-between">
            <!-- <div class="d-flex justify-content-between col-lg-8 col-sm-12">
                <a class="navbar-brand" href="?"><img src="assets/images/Logo_AUF-removebg.png" alt="" height="40"></a>
            </div> -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/images/Logo_AUF-removebg.png" class="d-block w-100" alt="Image 1">
      </div>
      <div class="carousel-item">
        <img src="assets/images/Logo_OIF.svg.png" class="d-block w-100" alt="Image 2">
      </div>
    </div>
  </div>
            <ul class="navbar-nav flex-fill flex-row justify-content-evenly mb-lg-1 mb-sm-0 fluid w-50 "  style="font-size:larger;">
         
                <li class="nav-item">
                    <a class="nav-link text-primary" href="?"><i class="bi bi-house-door "></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-primary" data-bs-toggle="modal" data-bs-target="#addpost" href="#"><i class="bi bi-plus-square" ></i></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-primary" data-bs-toggle="modal" data-bs-target="#addevent" href="#"><i class="bi bi-calendar2-event"></i></a>
                </li>  -->
                <li class="nav-item">
                   <?php
                        if(getUnreadNotificationsCount()>0){
                            ?>
                        <a class="nav-link text-primary position-relative" id="show_not" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample">
                                            <i class="bi bi-bell "></i>
                        <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
                        <small><?=getUnreadNotificationsCount()?></small>
                        </span>
                        </a>

                            <?php
                        }else{
                            ?>
                        <a class="nav-link text-primary" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample"><i class="bi bi-bell "></i></a>
                            <?php
                        }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary " data-bs-toggle="offcanvas" href="#message_sidebar" href="#"><i class="bi bi-chat-right-dots"></i>  <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger" id="msgcounter"></span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link  text-primary" href="http://127.0.0.1:5500/Presentation/index.html"><i class="bi bi-arrow-bar-left"></i></a>
                </li>
                <li class="nav-item dropdown dropstart">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/images/profile/<?=$user['profile_pic']?>" alt="" height="30" width="30" class="rounded-circle border">
                    </a>
                    <ul class="dropdown-menu position-absolute top-100 end-50" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="?u=<?=$user['username']?>"><i class="bi bi-person"></i> Profil</a></li>

                        <li><a class="dropdown-item" href="?editprofile"><i class="bi bi-pencil-square"></i> Modifier le profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i>Paramètre</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="assets/php/actions.php?logout"><i class="bi bi-box-arrow-in-left"></i>se deconnecter</a></li>
                    </ul>
                </li>
             
            </ul>
            <!-- <div class="d-flex justify-content-between col-lg-8 col-sm-12" id="logo">
                <a class="navbar-brand" href="?"><img class="img" src="assets/images/Logo_OIF.svg.png" alt="" height="40"></a>
            </div> -->
           
        </div>

      
        <form class="d-flex" id="searchform justify-content-between" >
                    <input class="form-control me-2 text-primary  " type="search" id="search" placeholder="rechercher..." aria-label="Search" autocomplete="off">
                <div class="bg-white text-end rounded border shadow py-3 px-4 mt-5" style="display:none;position:absolute;z-index:+99;" id="search_result" data-bs-auto-close="true">
                    <button type="button" class="btn-close" aria-label="Close" id="close_search"></button>
                    <div id="sra" class="text-start">
                        <p class="text-center text-muted">saisissez</p>
                    </div>
                </div>
        </form>
    </nav>

    <style>
        
                .navbar-nav .nav-item .nav-link{
                        transition: 0.5 ease;
                }
                .navbar-nav .nav-item .nav-link:hover{
                    border-bottom: 2px solid #52A5FF;
                    border-top: 2px solid #AE2BE1;
                    border-radius: 8px;
                    cursor: pointer;
                }
          
                .text-start{
                    width: 100%;
                }
            
              .d-flex #search {
                    margin-top: -10px;
                    max-height: 30px;
                }
                .navbar{
                    
                    position:fixed;
                    width: 100%;
                    z-index: 100;
                    top:0;
                    height: 17%;
                   
                }
                .carousel{
                    width: 12%;
                }
                @media screen and ( max-width:"500px") {

                    .carousel{
                    width: 50%;
                }
                .navbar{
                
                    height: 14%;
                   
                }
                .d-flex #search {
                    margin-top: -10px;
                    max-height: 40px;
                }
                  .d-flex #search {
                    margin-top: -10px;
                    max-height: 30px;
                }
                
                }
            
            </style>


  