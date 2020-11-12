<?php require_once("Components/Layout.php"); ?>

<body>
    <?php require_once("Components/Header.php"); ?>

    <main class="container text-center">

        <h2 class="text-center">Is this student done?</h2>

        <form action='?action=savedone&id=<?php echo $data["student"]->getId() ?>' method="post">
            <h3><?php echo $data["student"]->getName()?></h3>
            <div class="btn-group buttonGroup" role="group" aria-label="Basic example">
                <button type="submit">Done</button>
                <button type="button"><a href="index.php">Cancel</a></button>
            </div>
    </main>
    </main>

</body>