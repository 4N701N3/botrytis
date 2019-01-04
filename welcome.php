<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BcDb</title>
    <link rel="stylesheet" type="text/css" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="./css/content.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/datatables.css">
    <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
    <script type="text/javascript" charset="utf8" src="./DataTables/datatables.js"></script>
</head>

<body>
    <div class="heading">
        Botrytis Cynerea Database
    </div>
    <div class="main">

        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1">Welcome</label>

        <input id="tab2" type="radio" name="tabs">
        <label for="tab2">Tools</label>

        <input id="tab3" type="radio" name="tabs">
        <label for="tab3">Access BcDb</label>

        <div class="content">
            <!-- Welcome -->
            <div id="content1">
                <p>
                    Welcome to BcDb
                </p>
            </div>

            <!-- Infos -->
            <div id="content2">
                <p>
                    How to use BcDb
                </p>
            </div>

            <!-- Queries -->
            <div id="content3">
                <p>
                    <?php
                    include('query_test.php'); /*Edit 'query.php' */
                    ?>
                </p>
            </div>
        </div>

    </div>

    <div class="footer">
        <table>
            <tr>
                <th>
                    Documentation
                    <ul>
                        <li>
                            About <i>B. cynerea</i>
                        </li>
                    </ul>
                </th>
            </tr>
        </table>
    </div>
</body>
</html>
