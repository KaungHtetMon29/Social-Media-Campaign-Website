<?php
class BodyGen
{
    private $title;
    private $content;
    private $img;
    private $vid;
    private $cols;
    private array $contents;
    // public function __construct($img = null, $vid = null, $title = null, $content = null)
    // {
    //     if ($img === null || strlen($img) === 0) {
    //         $this->img = null;
    //         $this->vid = $vid;
    //         $this->title = $title;
    //         $this->content = $content;
    //     } else {
    //         $this->vid = null;
    //         $this->img = $img;
    //         $this->title = $title;
    //         $this->content = $content;
    //     }

    // }
    public function __construct(array $contents, bool $img = true, bool $vid = false, array $cols = ["id", "title", "content", "image"])
    {
        $this->contents = $contents;
        $this->img = $img;
        $this->vid = $vid;
        $this->cols = $cols;
    }
    public function generateBody(bool $rev = false): void
    {

        $left = !$rev;
        if (count($this->contents) === 0) {
            $_SESSION["statusmsg"]["msg"] = "No content available";
            echo '<div class="herobg saferInternetbg"></div>';
        } else {
            foreach ($this->contents as $content) {
                echo '
            <div class="' . ($left ? "bg_gradient" : "") . '  herobg saferInternetbg' . (!$left ? " iwfcampaign" : "") . '">
                <section class="main infocontent saferInternetcontent">';
                if (!$left) {
                    if ($this->img) {
                        echo '<img src="' . $content["image"] . '" width="50%" class="bdygen_img flipped_img">';
                    } else {
                        echo '<iframe src="https://www.youtube.com/embed/i0K40f-6mLs?list=RDi0K40f-6mLs" width="50%" height="null" class="bdygen_img"
                        frameborder="0"></iframe>';
                    }
                }

                echo '
                <div class="">
                    <p class="infocontenthead">
                    ' . $content[$this->cols[1]] . '
                    </p>
                    <p class="infocontentdetail">
                    ' . $content["content"] . '
                    </p>
                </div>';
                if ($left) {
                    if ($this->img) {
                        echo '<img src="' . $content["image"] . '" width="50%" class="bdygen_img ">';
                    } else {
                        echo '<iframe src="https://www.youtube.com/embed/i0K40f-6mLs?list=RDi0K40f-6mLs" width="50%" height="null"
                            class="bdygen_img" frameborder="0"></iframe>';
                    }
                }
                echo '</section>
            </div>';
                $left = !$left;
            }
        }



    }
}

class content_interface
{
    public string $title;
    public string $content;
    public ?string $img = null;
    public ?string $vid = null;
}
