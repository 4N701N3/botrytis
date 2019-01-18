<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gene view</title>
    <link rel="stylesheet" type="text/css" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="./css/content.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>
</head>

<body>
    <div class="heading">
        Botrytis Cynerea Database
    </div>
    <div class="main">
        <div class="content" id="gene_search">
        <?php
            $gene_locus = "BC1G_$_POST[gene_number]";
            // echo "$gene_locus</br>"; // TEST

            // Query
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
                $query_gene = $dbh->query('SELECT gene_locus, gene_seq, gene_start, gene_stop, gene_length, gene_strand, gene_supercontig, gene_operon, trans_id FROM gene WHERE gene_locus = "'.$gene_locus.'";');

                while ($row = $query_gene->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($row); // TEST
                    $locus = $row['gene_locus'];
                    $seq = $row['gene_seq'];
                    $start = $row['gene_start'];
                    $stop = $row['gene_stop'];
                    $length = $row['gene_length'];
                    $strand = $row['gene_strand'];
                    $supercontig = $row['gene_supercontig'];
                    $operon = $row['gene_operon'];
                    $trans = $row['trans_id'];
                }

                $query_prot = $dbh->query('SELECT prot_name,prot_seq, prot_length FROM protein WHERE gene_locus = "'.$locus.'" AND trans_id = "'.$trans.'";');

                while ($line = $query_prot->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($row);
                    $prot_name = $line['prot_name'];
                    $prot_seq = $line['prot_seq'];
                    $prot_length = $line['prot_length'];
                }
            } catch (PDOException $e) {
                echo "Erreur ! " . $e->getMessage() . "<br/>";
                die();
            } catch (Exception $ee) {
                echo "Erreur ! " . $ee->getMessage() . "<br/>";
                die();
            }

            // $columns = array($locus, $seq, $start, $stop, $length, $strand, $supercontig, $operon, $trans);
            // foreach ($columns as $key => $value) {
            //     echo $key . " : " . $value . "</br>";
            // }
            ?>
            <script>
            $(document).ready(function() {
                $('#table_gene').DataTable();
            } );
            </script>
            <table id="table_gene" class="display" style="align:center">
                <tbody>
                    <tr>
                        <td><b>Gene Locus</b></td>
                        <td><?php echo $locus ?></td>
                    </tr>
                    <tr>
                        <td><b>Sequence</b></td>
                        <td style="word-break: break-all">
                            <?php echo $seq ?></br>
                            <!-- Form to perform Blast research on sequence -->
                            <!-- <form method="POST" action="blastn.php" name="blast_n_form" target="_blank">
                                <input type="hidden" name="seq" value="<?php //$seq ?>">
                                <button type="submit">Blast</button>
                            </form> -->
                        </td>
                    </tr>
                    <tr>
                        <td><b>Start</b></td>
                        <td><?php echo $start ?></td>
                    </tr>
                    <tr>
                        <td><b>Stop</b></td>
                        <td><?php echo $stop ?></td>
                    </tr>
                    <tr>
                        <td><b>Length</b></td>
                        <td><?php echo $length ?></td>
                    </tr>
                    <tr>
                        <td><b>Strand</b></td>
                        <td><?php echo $strand ?></td>
                    </tr>
                    <tr>
                        <td><b>Supercontig</b></td>
                        <td><?php echo $supercontig ?></td>
                    </tr>
                    <tr>
                        <td><b>Transcript ID</b></td>
                        <td><?php echo $trans ?></td>
                    </tr>

                     <!-- Display Protein informations -->
                    <tr>
                        <td><b>Protein name</b></td>
                        <td><?php echo $prot_name ?></td>
                    </tr>
                    <tr>
                        <td><b>Protein Sequence</b></td>
                        <td  style="word-break: break-all">
                            <?php echo $prot_seq ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Protein Length</b></td>
                        <td><?php echo $prot_length ?></td>
                    </tr>
                    <?php
                    if ($operon != "") {
                        echo
                        '<tr>
                            <td><b>Pfam</b></td>
                            <td><b>';
                        $pfam = preg_split("/;/", $operon);
                        foreach ($pfam as $key => $value) {
                            echo '<a href="https://pfam.xfam.org/family/'.$value.'" target="_blank" title="Pfam webpage of '.$value.'">'.$value.'</a>; ';
                        }
                        echo
                        '</b></td>
                        </tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
