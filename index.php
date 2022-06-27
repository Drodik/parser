<?php

use Core\Controller;

error_reporting(E_ERROR | E_PARSE);

spl_autoload_register(function (string $sClassName) {
    $sClassFile = __DIR__ . '/classes';

    if (file_exists($sClassFile . '/' . str_replace('\\', '/', $sClassName) . '.php')) {
        require_once($sClassFile . '/' . str_replace('\\', '/', $sClassName) . '.php');
    }
});

$url = $_REQUEST['url'];

?>

<h4>Для подстчета кол-ва html тегов введите url страницы</h4>
<form action="" method="get">
    <input type="text" name="url" value="<?= $url ?>">
    <input type="submit" value="Посчитать">
</form>


<?php

if (empty($url)) {
    die();
}

echo "<h1>Результат:</h1>";

$controller = Controller::getInstance();

$result = $controller->getHtmlTags('url', $_REQUEST['url']);

if ($result['status'] == 'error') {
    echo "<h2 style='color: red;'>{$result['errors']}</h2>";
    die();
}

foreach ($result['data'] as $tag) {
    $tags[$tag] = (isset($tags[$tag])) ? ++$tags[$tag] : 1;
}

?>

<style>
    table {
        border-collapse: collapse;
        border: 1px solid black;
        text-align: center;
    }

    th, td {
        border: 1px solid grey;
    }
</style>
<table style="border: 1px solid black; border-collapse: collapse;">
    <thead>
    <tr>
        <th>
            Тег
        </th>
        <th>
            Кол-во
        </th>
    </tr>
    </thead>
    <tbody>

    <?php

    foreach ($tags as $tag => $count) {
        echo "<tr><td>{$tag}</td><td>{$count}</td></tr>";
    }
    ?>
    </tbody>
</table>
