<main class="content">
        <div class="navbar" id="myNavbar">
            <a href="#" id="sidebarToggle" class="icon" onclick=""> &#9776; </a>
            <div class="adm">
                <a href="../logout.php" data-toggle="tooltip" title="Logout">Admin</a>
            </div>
        </div>
    </main>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="sidebar">
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            <br/><br/><br/><br/>
                            <li class="nav-item">
                                <a class="nav-link active" href="dashboard.php"> Dashboard </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manage_user.php">Manage Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="payment.php">Payments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="feedback.php">Order Feedbacks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="review.php">reviews</a>
                            </li>
                            <li class="nav-item dropdown">
                                <!-- Dropdown class added -->
                                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-toggle="dropdown" aria-expanded="true">
                                Manage Orders
                                </a>
                                <div class="nav dropdown-menu">
                                    <a class="nav dropdown-item" href="all_orders.php">All Orders</a>
                                    <a class="nav dropdown-item" href="confirmation.php">Confirmation</a>
                                    <a class="nav dropdown-item" href="orderUpdate.php">Order Tracking</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#sidebarToggle").click(function() {
                $("#sidebar").toggleClass("active");
                $(".content").toggleClass("active");
            });
        });
</Script>