<?php 
include "../controller/config.php"; 
session_start();

$jso4=[];
$json5=[];
// $json2=[];
$sql17 = "select DISTINCT sellerid from seller_product_mapping";
$result17 = mysqli_query($db,$sql17) or die("Bad query $sql17");
while($row17 = mysqli_fetch_assoc($result17)){
    $sql18 = "select DISTINCT username from user_mst,seller_product_mapping where user_mst.uid=seller_product_mapping.sellerid and sellerid={$row17['sellerid']}";
$result18 = mysqli_query($db,$sql18) or die("Bad query $sql18");
while($row18 = mysqli_fetch_assoc($result18)){
  $sql19 = "select COUNT(oid) as countorders from order_mst,seller_product_mapping where order_mst.pid=seller_product_mapping.productid and sellerid={$row17['sellerid']}";
  $result19 = mysqli_query($db,$sql19) or die("Bad query $sql19");
  while($row19 = mysqli_fetch_assoc($result19)){
    //   $json[]=(int)$row12['sellerid'];
      $json4[]=$row18['username'];
      $json5[]=(int)$row19['countorders'];
}
}
}
    echo json_encode($json4);
    echo json_encode($json5);
    // echo json_encode($json2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<canvas style="width: 30px; height: 10px;" id="myChart"></canvas> 
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'doughnut',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($json4); ?>,
        datasets: [{
            label: 'My First dataset',
            // backgroundColor: 'rgb(255, 99, 132)',
            borderWidth: 0,
            backgroundColor: [
                // red,blue,green,pink
                        '#3eb579',
                        '#49cd8b',
                        "#54e69d",
                        "#71e9ad"
                    ],
                    hoverBackgroundColor: [
                        '#3eb579',
                        '#49cd8b',
                        "#54e69d",
                        "#71e9ad"
                    ],
            // borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($json5); ?>
        }]
    },

    // Configuration options go here
    options: {}
});
</script>
</body>
</html>