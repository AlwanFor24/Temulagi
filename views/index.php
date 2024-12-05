<?php include('../includes/header.php'); ?>
<?php require_once '../backend/config.php'; ?>


<div class="container-fluid p-0">
            <div class="hero-section text-center px-3 px-lg-5">
                <h1>TEMULAGI</h1>
            </div>
</div>

<div class="container main-section mb-5">
    <div class="row my-4 justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <h2 class="text-center">Fakultas Sains dan Teknologi UIN Bandung</h2>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item  mb-3" role="presentation">
                    <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true"><i class="ri-gallery-view-2 me-1"></i> All</button>
                </li>
                <li class="nav-item mb-3" role="presentation">
                    <button class="nav-link" id="pills-lost-items-tab" data-bs-toggle="pill" data-bs-target="#pills-lost-items" type="button" role="tab" aria-controls="pills-lost-items" aria-selected="false"><i class="ri-emotion-unhappy-line me-1"></i> Lost Items</button>
                </li>
                <li class="nav-item  mb-3" role="presentation">
                    <button class="nav-link" id="pills-found-items-tab" data-bs-toggle="pill" data-bs-target="#pills-found-items" type="button" role="tab" aria-controls="pills-found-items" aria-selected="false"><i class="ri-emotion-happy-line me-1"></i> Found Items</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">

                    <div class="container mt-5">
                        <div class="row justify-content-center">
                            <?php
                            $result = $conn->query("SELECT * FROM items ORDER BY created_at DESC");
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-md-6 col-lg-4 col-xl-3 mb-3">';
                                echo '<div class="card">';
                                echo '<img src="' . $row['photo'] . '" class="card-img-top" style="object-fit:cover;height:170px" alt="Item">';
                                echo '<div class="card-body">';
                                echo '<div class="d-flex align-items-center justify-content-between border-bottom mb-3 card-head">
                                <p class="text-capitalize badge ' . 
                                ($row['status'] === 'lost' ? 'text-bg-danger' : 'text-bg-success') . 
                                '">' . $row['status'] . '</p> 
                                <p><i class="ri-calendar-2-line"></i> ' . $row['date'] . '</p>
                              </div>'; date("d M Y", strtotime($row['date'])). '</p></div>';
                                echo '<h5 class="card-title text-center line-clamp1">' . $row['name'] . '</h5>';
                                echo '<p class="card-text text-center line-clamp2">' . $row['description'] . '</p>';
                                echo '<div class="text-center"><a href="item_details.php?id=' . $row['id'] . '" class="btn btn-outline-dark">View Details</a></div>';
                                echo '</div></div></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-lost-items" role="tabpanel" aria-labelledby="pills-lost-items-tab" tabindex="0">
                <div class="container mt-5">
                        <div class="row justify-content-center">
                            <?php
                            $result = $conn->query("SELECT * FROM items where status='lost' ORDER BY created_at DESC ");
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-md-6 col-lg-4 col-xl-3 mb-3">';
                                echo '<div class="card">';
                                echo '<img src="' . $row['photo'] . '" class="card-img-top" style="object-fit:cover;height:170px"  alt="Item">';
                                echo '<div class="card-body">';
                                echo '<div class="d-flex align-items-center justify-content-between border-bottom mb-3 card-head">
                                <p class="text-capitalize badge ' . 
                                ($row['status'] === 'lost' ? 'text-bg-danger' : 'text-bg-success') . 
                                '">' . $row['status'] . '</p> 
                                <p><i class="ri-calendar-2-line"></i> ' . $row['date'] . '</p>
                              </div>'; date("d M Y", strtotime($row['date'])). '</p></div>';
                                echo '<h5 class="card-title text-center line-clamp1">' . $row['name'] . '</h5>';
                                echo '<p class="card-text text-center line-clamp2">' . $row['description'] . '</p>';
                                echo '<div class="text-center"><a href="item_details.php?id=' . $row['id'] . '" class="btn btn-outline-dark">View Details</a></div>';
                                echo '</div></div></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-found-items" role="tabpanel" aria-labelledby="pills-found-items-tab" tabindex="0">
                <div class="container mt-5">
                        <div class="row justify-content-center">
                            <?php
                            $result = $conn->query("SELECT * FROM items where status='found' ORDER BY created_at DESC");
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-md-6 col-lg-4 col-xl-3  mb-3">';
                                echo '<div class="card">';
                                echo '<img src="' . $row['photo'] . '" class="card-img-top" style="object-fit:cover;height:170px" alt="Item">';
                                echo '<div class="card-body">';
                                echo '<div class="d-flex align-items-center justify-content-between border-bottom mb-3 card-head">
                                <p class="text-capitalize badge ' . 
                                ($row['status'] === 'lost' ? 'text-bg-danger' : 'text-bg-success') . 
                                '">' . $row['status'] . '</p> 
                                <p><i class="ri-calendar-2-line"></i> ' . $row['date'] . '</p>
                              </div>'; date("d M Y", strtotime($row['date'])). '</p></div>';
                                echo '<h5 class="card-title text-center line-clamp1">' . $row['name'] . '</h5>';
                                echo '<p class="card-text text-center line-clamp2">' . $row['description'] . '</p>';
                                echo '<div class="text-center"><a href="item_details.php?id=' . $row['id'] . '" class="btn btn-outline-dark">View Details</a></div>';
                                echo '</div></div></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
