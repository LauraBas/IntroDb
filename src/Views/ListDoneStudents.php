<?php require_once("Components/Layout.php"); ?>

<body>

    <?php require_once("Components/Header.php") ?>
    <main class="container">
        <a href="index.php">
            <button type="button" class="btn btn-primary">
                Back to Students
            </button>
        </a>
        <table class="table table-dark">

            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>                    
                </tr>
            </thead>
            <h2>Students Done</h2>
            <tbody>
                <?php
                foreach ($data["students"] as $student) {
                    echo "
                    <tr>
                        <td>{$student->getId()}</td>
                        <td>{$student->getName()}</td>
                        <td>{$student->getCreatedAt()}</td>
                    </tr>
                    ";
                } ?>

            </tbody>
        </table>
    </main>
</body>