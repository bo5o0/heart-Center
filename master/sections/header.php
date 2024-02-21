</div>

<div class="page-data " id="page-box">
    <header>
        <div class="bars" id="go">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="profile">

            <ul class="ul-main">

                <li id="set">
                    <?php echo $_SESSION['user']; ?><i class="fas fa-chevron-down" id="icon-arrow"></i>
                    <ul class="sub h-s" id="sub-list">
                        <li>
                            <a href="change_pass.php">Change Password</a>
                        </li>
                        <li>
                            <a href="out.php">Logout</a>
                        </li>
                    </ul>
                </li>
                
            </ul>

        </div>
    </header>
