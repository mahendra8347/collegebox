<MARQUEE width=100% height=100% direction="up" scrolldelay="200" onmouseover="this.stop();" onmouseout="this.start();">
    <?php
    $connect = mysqli_connect('localhost', 'root', '', 'college');

    if (mysqli_connect_errno($connect)) {
        echo 'Failed to connect';
    }

    $run = mysqli_query($connect, "Select * from news order by 1 DESC");

    $total_records = mysqli_num_rows($run);
    if ($total_records == 0) { ?>
        <tr>
            <td>
                <h3 style="color:red"><?php echo "No Any Racord Here" ?></h3>
            </td>
        </tr>
        <?php } else {

        while ($row = mysqli_fetch_array($run)) {

            $title = strtoupper($row['title']);
            $detail = $row['detail'];
            $pieces = substr($detail, 0, 50);
            $date = $row['date'];
            $id = $row['id'];
        ?>
            <div>
                <table>
                    <tr>
                        <td><img src="images/new1.gif" height="10px" width="30px" alt="#"></td>
                        <td><a target="blank" href="includes/more_detail.php?id=<?php echo $row["id"]; ?>" data-toggle="tooltip" title="Click For More Detail"><?php echo "<h4>$title</h4>" ?></a></td>
                        <td><?php echo $date; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width:79%"><?php echo "$pieces......" ?></td>
                    </tr>
                </table>
            </div>
    <?php }
    } ?>
</MARQUEE>

