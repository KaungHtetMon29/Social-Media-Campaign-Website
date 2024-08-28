<?php
require 'components/cards/cards.php';
$card_content = array(
    array("title" => "Privacy and Data Security", "content" => "Social media platforms store vast amounts of personal data, making them targets for hackers. Breaches can lead to identity theft and other cybercrimes.Complex privacy settings can result in users unintentionally sharing personal information with third parties or the public.Geotagging features can expose users' locations, increasing the risk of stalking or unwanted contact."),
    array("title" => "Mental Health Impacts", "content" => "Social media can enable bullying, causing emotional distress, anxiety, and depression.Seeing curated, often unrealistic portrayals of others can lead to feelings of inadequacy and low self-esteem.Overuse of social media can become addictive, disrupting sleep, productivity, and daily routines."),
    array("title" => "Misinformation and Manipulation", "content" => "Social media is a common channel for spreading false information, which can mislead the public and cause harm.Fraudsters frequently use social media to scam users or steal personal information.Algorithms can create echo chambers, reinforcing existing beliefs and contributing to societal division."),
)
    ?>
<div class="bg_gradient">
    <div class="main">
        <div class=" fre_risk_container">
            <div class="fre_risk_header">
                <h3>Most Frequent Risks Of Using Social Media</h3>
                <p>Social media platforms have become an integral part of modern life, offering endless opportunities
                    for
                    connection, communication, and content sharing. However, the convenience and reach of these
                    platforms
                    also come with significant risks that users should be aware of. Understanding these risks is crucial
                    for
                    maintaining a safe and positive online presence.</p>
            </div>
            <div class="fre_risk_card_container">
                <?php
                foreach ($card_content as $card) {
                    create_card($card["title"], $card["content"]);
                }
                ?>
            </div>
        </div>
    </div>
</div>