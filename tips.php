<?php
require 'components/header/header.php';
require 'utils/body_generator/bodygen.php';
$popular = [

];
$contents = [
    [
        "title" => "Open Communication",
        "content" => "Open communication is essential in supporting teens' healthy use of social media. By fostering an environment
     where teens feel comfortable discussing their online experiences, parents can stay informed about what their teens are encountering 
     on social platforms. This approach helps build trust, allowing teens to share both positive interactions and any challenges they might face, 
     such as cyberbullying or pressure to conform to social media trends. Through open dialogue, parents can offer guidance without being intrusive, 
     helping teens navigate the digital world responsibly. Encouraging honest conversations also gives parents the opportunity to address any concerns early 
     and offer advice on handling tricky situations, ultimately creating a safer and more supportive online experience for teens.",
        "image" => "img/OC.jpg",
    ],
    [
        "title" => "Set Time Limits",
        "content" => "Setting time limits on social media use is crucial for maintaining a healthy b
        alance between online and offline activities. By establishing boundaries, parents can help teens avoid the
         risks of excessive screen time, such as reduced sleep quality, academic distractions, or decreased physical activity. These 
         limits can be set by designating specific hours for social media use or using apps that track and limit daily screen time. Encouraging teens to 
         prioritize other activities like homework, hobbies, or spending time with family helps them develop a well-rounded routine while avoiding the potential 
         negative effects of overusing social media.",
        "image" => "img/STL.jpg",
    ],
    [
        "title" => "Teach Digital Literacy",
        "content" => "Teaching digital literacy empowers teens to navigate the online world safely and intelligently. 
        This involves educating them on recognizing misinformation, understanding the potential consequences of oversharing, 
        and being mindful of their digital footprint. When teens are equipped with the knowledge to critically assess content, 
        identify harmful behavior, and understand the implications of privacy settings, they are better prepared to engage in social media responsibly. 
        Digital literacy also includes the ability to avoid falling victim to online scams, cyberbullying, or inappropriate content,
         fostering a more positive and secure online experience.",
        "image" => "img/TDL.png",
    ],
    [
        "title" => "Model Healthy Use",
        "content" => "Parents play a key role in shaping how their teens approach social media, 
        and one effective way to do this is by modeling healthy use themselves. By practicing balanced social media habits, 
        such as limiting their own screen time, avoiding phone distractions during family time, and using platforms in a positive 
        and productive manner, parents can set an example for their teens to follow. Teens are likely to adopt similar behaviors when 
        they observe their parents using social media mindfully, fostering responsible usage patterns that prioritize real-world interactions 
        and well-being over excessive digital engagement.",
        "image" => "img/HU.jpg",
    ],
    [
        "title" => "Monitor Activity",
        "content" => "While respecting a teen's privacy is important, parents should still 
        take steps to monitor their online activity to ensure safety. This could involve checking the apps and 
        platforms they use, being aware of the types of content they are engaging with, and having regular discussions 
        about their online interactions. Monitoring can help parents detect early signs of inappropriate behavior, cyberbullying, 
        or exposure to harmful content, allowing them to step in and provide guidance when necessary. Keeping a balance between monitoring 
        and trust is key to ensuring that 
        teens have a safe yet autonomous online experience.",
        "image" => "img/MA.jpg",
    ],
    [
        "title" => "Encourage Positive Content",
        "content" => "Encouraging teens to engage with positive content on social media can significantly improve their online experience. 
        This involves guiding them to follow accounts, communities, or groups that promote learning, creativity, or personal interests, rather than focusing solely 
        on social comparison or trends that might affect their self-esteem. By fostering interests in educational or motivational content, parents can help teens 
        use social media as a tool for personal growth and enrichment. Encouraging positive interactions, such as sharing uplifting messages or supporting others, 
        also fosters a healthier and more meaningful use of these platforms.",
        "image" => "img/EPC.jpg",
    ],
    [
        "title" => "Discuss Privacy",
        "content" => "
            Discussing privacy is a vital aspect of keeping teens safe online. Parents should educate teens about the risks of sharing personal information, 
            such as their location, phone number, or other sensitive details, and the importance of using privacy settings to control who can view their content. 
            This conversation should also cover the potential long-term effects of what they post online, as shared content can often become permanent. 
            By encouraging teens to think critically about their digital footprint, parents can help them make more thoughtful decisions that protect their privacy and 
            online reputation.",
        "image" => "img/Privacy.png",
    ],
    [
        "title" => "Be Aware of Mental Health",
        "content" => "
            Being aware of the impact social media can have on mental health is crucial for supporting teens. 
            Parents should keep an eye on how social media affects their teen's mood, self-esteem, and overall well-being. 
            Excessive use, exposure to negative comparisons, or cyberbullying can lead to issues like anxiety, depression, or stress. 
            Encouraging regular breaks from social media and engaging in face-to-face interactions, exercise, or hobbies can help counteract these negative effects. 
            Open conversations about how social media makes them feel and promoting a healthy balance between online and 
            offline life are essential in maintaining teens' mental and emotional health.",
        "image" => "img/MentalH.png",
    ]

]; ?>
<!DOCTYPE html>
<html lang="en">

<?php
setheader("Tips");
?>

<body>
    <?php include 'components/navbar/navbar.php'; ?>
    <?php
    $bdygen = new BodyGen($contents);
    $bdygen->generateBody(true);
    ?>
    <?php include 'components/footer/footer.php'; ?>
</body>
<?php include 'utils/g_translate_script/g_translate_scrip.php' ?>
<script defer src="components/navbar/navbar.js" type="module"></script>
<script defer src="js/index.js" type="module"></script>

</html>