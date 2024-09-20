<?php

function messageView($dbconnection)
{
    $url = parse_url($_SERVER['REQUEST_URI']);
    parse_str($url["query"], $params);
    $contents = $dbconnection->select_all(
        "usermessages",
        ["id", "sender_email", "subject", "message", "date"]
    );
    ?>
    <?php ob_start(); ?>
    <table>
        <tr>
            <th>id</th>
            <th>Subject</th>
            <th>Sender_email</th>
            <th>Message</th>
            <th>date</th>
            <th></th>
        </tr>
        <?php
        foreach ($contents as $content) {
            echo '<tr>';
            foreach ($content as $key => $value) {

                echo '<td>' . $value . '</td>';

            }
            echo '  <td>
                        <div class="table_div">
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
