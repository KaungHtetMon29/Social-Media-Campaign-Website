<?php



function View($dbconnection, string $type = "user")
{
    $url = parse_url($_SERVER['REQUEST_URI']);
    parse_str($url["query"], $params);
    $users = $dbconnection->select_all(
        "user",
        ["name", "email", "dob"],
        "type = '" . $type . "'"
    );

    ?>
    <?php ob_start(); ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>
                <form method="get" action="">
                    <input type="hidden" name="tab" value=<?php echo $params["tab"] ?>>
                    <input type="hidden" name="create" value="true">
                    <button type="submit">Create</button>
                </form>
            </th>
        </tr>

        <?php
        foreach ($users as $user) {
            echo '<tr>';
            foreach ($user as $key => $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '  <td>
                        <div class="table_div">
                            <form method="get" action="">
                             <input type="hidden" name="tab" value=' . $params["tab"] . '>
                             <input type="hidden" name="update" value="true">
                            <button type="submit" name="email" value=' . $user["email"] . ' class="updatebtn">Update</button>
                            </form>
                            <form method="get" action="">
                            <button type="submit" name="email" value=' . $user["email"] . ' class="deletebtn">Delete</button>
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
