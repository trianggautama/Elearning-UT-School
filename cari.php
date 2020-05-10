<?php
include_once 'config/class.admin.php';
    if (isset($_GET['input'])) {
        $input = $_GET['input'];

        $query="SELECT id_user,nama,nrp FROM user WHERE nama LIKE '%$input%'"; 
        $result = $mysqli->query( $query );  
        $hasil = $result->num_rows;
        if ($hasil > 0)

        {
         while($data=$result->fetch_row()){
            ?>

            <a href="javascript:autoInsert('<?php echo $data[0]?>','<?php echo $data[1]?>');"><?=$data[1]?> - <?=$data[2]?><br> <!--- hasil -->

            <?php
            
            }    
           
        }

    } 
 
?>