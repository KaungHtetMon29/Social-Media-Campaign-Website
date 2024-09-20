<?php
require 'components/header/header.php';
require 'utils/body_generator/bodygen.php';

$contents = [
    [
        "title" => "How live streaming works",
        "content" => "Live streaming is the process of delivering real-time audio and video content over the internet to an audience. 
        It works by capturing live events through cameras or software, encoding the audio and video into a digital format, 
        and then transmitting that data to a streaming server. This server distributes the content to viewers, 
        who can watch it live on their devices. Streaming protocols, such as RTMP (Real-Time Messaging Protocol) or 
        HLS (HTTP Live Streaming), ensure smooth delivery and low latency, allowing users to engage with the content in real-time. 
        Live streaming is commonly used for events like concerts, sports, webinars, and gaming.",
        "vid" => "https://www.youtube.com/embed/K5n3IqpbBCE"
    ],
    [
        "title" => "Danger of the live streaming app",
        "content" => "Live streaming apps have revolutionized the way we connect and 
        share content in real time, but they also pose several risks. One major concern is privacy, 
        as users can inadvertently share personal information, locations, or intimate moments with a global audience. 
        These apps are also prone to cyberbullying, harassment, and trolling, with users facing negative comments and hate speech 
        in real-time. The instant nature of live streams makes it difficult to moderate inappropriate or harmful content, potentially 
        exposing viewers, including children, to explicit or dangerous material. There are also safety risks, as some individuals may 
        use live streams to engage in or encourage illegal activities. Moreover, the pressure to perform and constantly engage audiences 
        can lead to mental health issues, including anxiety and stress. Additionally, once content is streamed, it can be recorded, 
        shared, and used maliciously, leaving a permanent digital footprint that’s difficult to erase. These risks highlight the 
        importance of responsible use and awareness when engaging with live streaming apps.",
        "vid" => "https://www.youtube.com/embed/9UMnG46AGO8"
    ],
    [
        "title" => "Risks and Dangers When Using Live Streaming Apps",
        "content" => "Live streaming apps come with significant risks, including privacy invasion, 
        as users may unintentionally share sensitive information or real-time locations, exposing themselves to danger. 
        Cyberbullying and harassment are common, with harmful comments being delivered in real time. The lack of effective content 
        moderation also means inappropriate or harmful material can easily be broadcast. There’s added pressure to entertain, 
        leading to potential mental health issues like stress or anxiety. Additionally, live streams can leave 
        a permanent digital footprint, with content being recorded and shared without consent, posing long-term reputational risks.",
        "vid" => "https://www.youtube.com/embed/I_-BErACa_s"
    ],
    [
        "title" => "How to Stay Safe While Streaming",
        "content" => "Staying safe while streaming is essential to protect your privacy and well-being. 
        First, avoid sharing personal information like your home address, phone number, or real-time location. 
        Use privacy settings to limit who can view and interact with your stream. 
        Moderate comments by enabling filters or appointing moderators to remove harmful or inappropriate messages. 
        Be mindful of your surroundings to ensure you're not unintentionally revealing private details. 
        Stick to platform guidelines and avoid broadcasting illegal or inappropriate content. 
        Lastly, limit interaction with strangers, and always block or report harassers or cyberbullies to maintain a positive and secure streaming environment.",
        "vid" => "https://www.youtube.com/embed/w60l1mNOSuA"
    ],
    [
        "title" => "Live streaming - what parents need to know",
        "content" => "
        Live streaming allows users to share real-time video content over the internet, 
        often on platforms like YouTube, Twitch, and social media. Parents should be aware of privacy concerns, 
        as live streams can expose personal information and lead to unwanted interactions in real-time chats. 
        It's essential to discuss the importance of managing privacy settings, recognizing inappropriate behavior, and knowing how to report it. 
        Setting rules around screen time and encouraging a balance between online activities and other interests is vital. 
        Additionally, live streaming can offer educational opportunities, 
        so fostering open conversations about content and safety can help children navigate this engaging medium responsibly.",
        "vid" => "https://www.youtube.com/embed/9xFJrUz0TaY"
    ]
]; ?>


<!DOCTYPE html>
<html lang="en">
<?php
setheader("Livestream");
?>

<body>
    <?php include 'components/navbar/navbar.php'; ?>
    <?php include 'components/overlay/overlay.php'; ?>
    <?php
    $bdygen = new BodyGen($contents, false, true);
    $bdygen->generateBody();
    ?>
    <?php include 'components/footer/footer.php'; ?>
</body>

<?php include 'utils/g_translate_script/g_translate_scrip.php' ?>
<script defer src="components/navbar/navbar.js" type="module"></script>
<script defer src="js/index.js" type="module"></script>

</html>