<?php

function Layout(string $content, array $user)
{
    echo '<div class="layout">';
    include "components/sidenav/sidenav.php";
    echo '<div class="content">
                <div class="card">
                    ' . $content . '
                </div>
            </div>
        </div>';
}
