<?php
function create_card($title, $content)
{
    echo "
        <div class='fre_risk_cards'>
            <div>
                <h4>" . htmlspecialchars($title) . "</h4>
            </div>
            <div>
                <p>
                    " . htmlspecialchars($content) . "
                </p>
            </div>
        </div>
    ";
}