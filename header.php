<style type="text/css">
  .form {
    padding: 30px 40px; 
}

.search-control {
    padding-bottom: 0px;
    position: relative;
}

.search-control input {
    border: 2px solid #f0f0f0;
    border-radius: 4px;
    display: block;
    font-family: inherit;
    font-size: 14px;
    padding: 10px;
    width: 400px;
}
</style>
<div class="navbar" style="background-color: #A23EF9;">
        <div class="container flex">
            <img src="images/logo.png" height="80px">
            <nav>
              <?php if($_SESSION['user_type']==1) { ?>
                <ul>
                  <li class="search-control">
                    <form action="search.php" method="post">
                      <input type="text" name="query" placeholder="Search">
                    </form>
                  </li>
                    <li class="under"><a href="index.php">Home</a></li>
                    <li class="under"><div class="dropdown">
                          <span class="dropbtn" style="color:white;">Admin Task</span>
                          <div class="dropdown-content">
                          <a href="admin_course.php">Admin Course</a>
                          <a href="admin_chapter.php">Admin Chapter</a>
                          <a href="admin_topic.php">Admin Topic</a>
                          </div>
                        </div></li>
                    <li class="under"><a href="alluser.php">All User</a></li>
                    <li><a href="#">
                                                <div class="dropdown">
                          <span class="dropbtn">
                            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar"></span>
                          <div class="dropdown-content">
                          <a href="profile.php">Profile</a>
                          <a href="profile.php">Change Password</a>
                          <a href="logout.php">Logout</a>
                          </div>
                        </div>
                    </a>
                    </li>
                </ul>
                <?php } else{ ?>
                  <ul>
                    <li class="under"><a>Welcome <?= $_SESSION['username'] ?> !!</a></li>
                    <li><a href="#">
                                                <div class="dropdown">
                          <span class="dropbtn">
                            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar"></span>
                          <div class="dropdown-content">
                          <a href="profile.php">Profile</a>
                          <a href="profile.php">Change Password</a>
                          <a href="logout.php">Logout</a>
                          </div>
                        </div>
                    </a>
                    </li>
                </ul>
                 <?php } ?>
            </nav>
        </div>
    </div>