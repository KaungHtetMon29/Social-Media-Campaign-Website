<?php

function popularAppView($dbconnection)
{
    $url = parse_url($_SERVER['REQUEST_URI']);
    parse_str($url["query"], $params);
    $contents = $dbconnection->select_all(
        "popularapp",
        ["id", "appname", "content", "image"]
    );
    ?>
    <?php ob_start(); ?>
    <table>
        <tr>
            <th>id</th>
            <th>App Name</th>
            <th>Content</th>
            <th>img</th>
            <th>
                <form method="get" action="">
                    <input type="hidden" name="tab" value=<?php echo $params["tab"] ?>>
                    <input type="hidden" name="create_content" value="true">
                    <button type="submit">Create</button>
                </form>
            </th>
        </tr>
        <?php
        foreach ($contents as $content) {
            echo '<tr>';
            foreach ($content as $key => $value) {
                if ($key === "image") {
                    echo '<td><img class="img_style" src="' . $value . '"/></td>';
                } else {
                    echo '<td>' . $value . '</td>';
                }
            }
            echo '  <td>
                        <div class="table_div">
                            <form method="get" action="" >
                             <input type="hidden" name="tab" value=' . $params["tab"] . '>
                             <input type="hidden" name="update_content" value="true">
                            <button type="submit" name="id" value=' . $content["id"] . ' class="updatebtn">Update</button>
                            </form>
                            <form method="get" action="components/Modal/deleteContent.php">
                            <input type="hidden" name="tab" value=' . $params["tab"] . '>
                            <button type="submit" name="id" value=' . $content["id"] . ' class="deletebtn">Delete</button>
                            </form>
                        </div>
                    </td>';
            echo '</tr>';
        }

        ?>
    </table>
    <?php
    $view_content = ob_get_clean();
    return $view_content;
}
