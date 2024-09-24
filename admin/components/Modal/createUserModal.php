<?php


function createUserModal($type = false, $dbinstance)
{


    $url = parse_url($_SERVER['REQUEST_URI']);
    parse_str($url["query"], $params);
    $urlstring = "components/Modal/insertUser.php?" . $url["query"];
    if ($type) {
        $data = $dbinstance->select_one(["email" => $params["email"]], 'user');
    }

    echo
        '<div class="modalbg">
            <div class="admincard">
                <div class="card-header">
                    <h2>' . (array_key_exists('update', $params) ? ($params['update'] ? "Update " .
                ($params['tab'] === "admin" ? "Admin" : "User") . "" :
                "Create " . ($params['tab'] === "admin" ? "Admin" : "User") . "") :
            "Create " . ($params['tab'] === "admin" ? "Admin" : "User") . "") . '</h2>
                    <form action="adminpanel.php" method="POST">
                        <button type="submit" name="close" value="' . $params["tab"] . '" class="adminmodal_close_btn">
                            <img src="../img/cross.svg" alt="button">
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <form action=' . $urlstring . ' method="POST">
                        <div class="form_group_row">
                            <div class="form-group">
                                <label>Enter Username</label>
                                <input type="text" placeholder="Username" name="name"
                                    value="' . ($type ? $data["name"] : "") . '" />
                            </div>
                            <div class="form-group">
                                <label>Enter Date of Birth</label>
                                <input type="date" name="dob" onkeypress="return false"
                                    value="' . ($type ? $data["dob"] : "") . '" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Enter Email</label>
                            <input type="text" placeholder="Email" name="email"
                                value="' . ($type ? $data["email"] : "") . '" />
                        </div>
                        <div class="form_group_row">
                            <div class="form-group">
                                <label>Enter Password</label>
                                <input type="password" placeholder="Password" name="password" />
                            </div>
                            <div class="form-group">
                                <label>Re-enter Password</label>
                                <input type="password" placeholder="Re-enter Password" name="repassword" />
                            </div>
                        </div>

                        <div class="form-btn-group">
                            <button class="admin-user-btn" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
}
?>