<?php
include __DIR__ . '/owner-header.php';
?>

<div class="body">
    <nav class="owner-nav">
        <button class="round-button" onclick="closePopup()"><i class="fa-solid fa-angles-left"></i></button>
        <ul>
            <a href="./dashboard.php"><li class="active">Dashboard</li></a>
            <a href="./view-accomodation.php"><li>View Accomodation</li></a>
            <a href="./manage-rooms.php"><li>Manage Rooms</li></a>
            <a href="./add-accomodation.php"><li >Add Accommodation</li></a>
        </ul>
    </nav>
    <div class="wrapper">

    </div>
</div>

<?php
include __DIR__ . '/owner-footer.php';
?>