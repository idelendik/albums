<?php
/**
 * @var array $items
 */


$defaultItems = [
    "/" => [
        "title" => "all albums",
    ]
];


$items = array_merge($defaultItems, $items);

function isItemLast(array $items, string $key): bool
{
    return array_key_last($items) === $key;
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php
        ob_start();

        foreach ($items as $path => $info) {
            $class_name = "text-black-50 breadcrumb-item";
            $class_name = isItemLast($items, $path) ? $class_name . " active" : $class_name;

            $aria_current = isItemLast($items, $path) ? " aria-current='page'" : "";

            $title = strtoupper($info['title']);

            $link = isItemLast($items, $path) ? $title : sprintf('<a href="%s" class="text-decoration-none">%s</a>', $path, $title);

            printf('<li class="%s"%s>%s</li>', $class_name, $aria_current, $link);
        }

        echo ob_get_clean();
        ?>
    </ol>
</nav>
