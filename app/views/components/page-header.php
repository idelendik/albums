<?php
    $tag = $args['tag'] ?? 'h1';
    $text = $args['text'] ?? '';
    ?>

<div class="row text-center">
    <?php echo "<$tag>$text</$tag>"; ?>
</div>