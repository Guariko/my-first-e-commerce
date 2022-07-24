<?php

if (!isset($script)) {

    $script = "";
}

?>

<script src="<?= $script ?>"></script>

<?php

if (isset($adminScript)) : ?>

    <script src="<?= $adminScript ?>"></script>

<?php endif; ?>

</body>

</html>