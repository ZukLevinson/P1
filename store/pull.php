<?php

include '../db_connection.php';
$conn = OpenCon();

$num = 0;

if(!isset($_GET['search'])){
    $sql = "SELECT * FROM data";
} else {
    $search = $_GET['search'];
    $sql = "SELECT * FROM data WHERE name LIKE '%$search%'";
}

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
    if($num==0){
        echo "<div class='items'>";
    }
    echo "<div class='itemEx'>";
        echo "<img class='banner' src='../images/item_ex.jpg' id='pic1'>";
        echo "<a class='ttl'>".$row['name']."</a>";
        echo "<ul class='desc'>".$row['dscr']."</ul>";
        echo "<div class='summery'>";
            echo "<a class='prc'>".$row['pric']."$</a>";
            echo "<button onclick='add_to_cart(".$row['Id'].")'>";
                echo "<svg height='462pt' viewBox='-49 0 462 462.002' width='462pt' xmlns='http://www.w3.org/2000/svg'><path d='m353.480469 133.953125h-82.011719v-46.796875c0-48.136719-39.023438-87.15625-87.15625-87.15625-48.136719 0-87.15625 39.019531-87.15625 87.15625v46.796875h-87.15625c-5.523438 0-10 4.480469-10 10v228.050781c.0546875 49.679688 40.316406 89.941406 90 90h183.480469c49.683593-.058594 89.945312-40.320312 90-90v-228.050781c0-5.519531-4.476563-10-10-10zm-236.324219-46.796875c-.09375-24.054688 12.6875-46.320312 33.503906-58.375s46.488282-12.054688 67.304688 0 33.597656 34.320312 33.503906 58.375v46.796875h-134.3125zm226.324219 284.847656c-.046875 38.640625-31.359375 69.953125-70 70h-183.480469c-38.640625-.046875-69.957031-31.359375-70-70v-218.050781h77.15625v112.015625c0 5.519531 4.476562 10 10 10s10-4.480469 10-10v-112.015625h134.3125v112.015625c0 5.519531 4.476562 10 10 10s10-4.480469 10-10v-112.015625h72.011719zm0 0'/></svg>";
            echo "</button>";
        echo "</div>";
    echo "</div>";
    $num += 1;
    if($num==4){
        echo "</div>";
        $num = 0;
    }
}

CloseCon($conn);