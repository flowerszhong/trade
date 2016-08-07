<?php 
if(isset($price_data)){ 
    $firstrow = $price_data['firstrow'];
    $pricedata = $price_data['pricedata'];

    ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <?php 
                foreach ($firstrow as $key => $value) {

                    if($key=='A'){
                        echo '<td>' . $value . '</td>';
                    }else{
                        echo '<td>' . $value . 'KG  </td>';
                    }
                }

                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            
            foreach ($pricedata as $row => $cells) {
                echo '<tr>';
                foreach ($cells as $cell) {
                    echo '<td>' . $cell . '</td>';
                }

                echo '</tr>';
            }

             ?>
        </tbody>
    </table>
<?php }
 ?>
