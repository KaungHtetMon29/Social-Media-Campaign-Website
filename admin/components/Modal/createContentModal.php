<?php


function createContentModal($type = false, $dbinstance)
{


    $url = parse_url($_SERVER['REQUEST_URI']);
    parse_str($url["query"], $params);
    $urlstring = "components/Modal/insertContent.php?" . $url["query"];
    if ($type) {
        $data = $dbinstance->select_one(["id" => $params["id"]], $params["tab"]);
    }
    echo
        '<div class="modalbg">
            <div class="admincard">
                <div class="card-header">
                    <h2>Create User</h2>
                    <form action="adminpanel.php" method="POST">
                        <button type="submit" name="close" value="' . $params["tab"] . '" class="adminmodal_close_btn">
                            <img src="../img/cross.svg" alt="button">
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <form action=' . $urlstring . ' method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Enter ' . ($params["tab"] === "popularapp" ? "App Name" : "Title") . '</label>
                            <input type="text" placeholder="Enter ' . ($params["tab"] === "popularapp" ? "App Name" : "Title") . '" name="' . ($params["tab"] === "popularapp" ? "appname" : "title") . '"
                                    value="' . ($type ? ($params["tab"] === "information" ? $data["title"] : $data["appname"]) : "") . '" require/>
                        </div>
                        <div class="form-group">
                            <label>Enter Content</label>
                            <textarea name="content"  require>' . ($type ? $data["content"] : "") . '</textarea>
                        </div>
                        <div class="form-group">
                        
                        ' . ($type ? " <label>Previous Photo</label><img src='" . $data["image"] . "'  alt='img' class='img_style'>" : "") . '
                            <label>Upload Photo</label>
                                <input type="hidden" name="prev_img" value="' . ($type ? $data["image"] : "") . '">
                             <input type="file" name="image" id="image" accept="image/*" ' . ($type ? "" : " require") . '>
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