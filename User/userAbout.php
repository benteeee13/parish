<?php
include 'userSessionStart.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parish of San Juan</title>
        <link rel="stylesheet" href="about.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <?php include 'userHeader.php'; ?>
        <div id="aboutDiv">
            <form>
                <h1 id="aboutLabel">About</h1>
                <div>
                    <div id="samplePic">
                        <img src="../Images/parokyaPic.png" id="parokyaPic">
                    </div>
                </div>
                    <div id="firstInfo">
                        <p class="info1st">Parokya ng San Juan Bautista is a Catholic church located in San Juan, Hagonoy, Bulacan. It is part of the Diocese of Malolos. It was established on 1947. The Parish Fiesta is celebrated every 24th day of June.</p>
                    </div>
                <h1 id="kasaysayanLabel">Kasaysayan ng Parokya</h1>
                <div id="secondInfo">
                    <p class="info2ndMini">Akda ni: Sherwin M. Antaran (Parokya ni San Juan Bautista)</p>
                    <p class="info2nd">Parokya ni San Juan Bautista Ang Parokya ni San Juan Bautista ay binubuong mga nayon ng San Miguel Arkanghel, San Isidro (San Isidro Matanda), San Isidro Labrador (Tampok) at San Juan Bautista, Hagonoy, Bulacan ay itinalaga noong Ika-23 ng Marso, 1948 bilang isang parokya sa pamamagitan ni Lubhang Kgg. Michael J. O'Doherty, ika-27 Arsobispo ng Maynila. Nanungkulan bilang unang Kura Paroko si Rdo. P. Elias Reyes at sinundan nina Rdo. P. Jose Ingco, Rdo. P. Serafin Riego De Dios, Rdo. P. Antonio Borlongan at Rdo. P. Generoso Jimenez ay unti-unting ipinagawa ang simbahang parokya na ito sa pakikipagtulungan ni Lubhang Kgg. Rufino Kardinal Santos, ika-29 na Arsobispo ng Maynila at ng mga mamamayang may mabuting loob sa parokya. At sa paglipas ng panahon, ang nasasakupan ng parokya ay lumawak na hanggang sa payak na sitio ng Sapang Bundok na namimintuho sa Ina ng Laging Saklolo.</p>
                </div>
                <div id="thirdInfo">
                    <p class="info3rd">Dumaan na rin sa maraming pagsasaayos ang simbahan at mga bisitang nasasakupan nito, ngunit pinanatiling orihinal ang arkitektura ng Simbahan, lalo na ang mga aspetong natatangi. Kabilang dito ay ang malaking ukit nakahoy sa altar na Imahe ni San Juan habang Binibinyagan si Hesukristo sa Ilog Jordan kasama ang Espiritu Santo na nag anyong kalapatina bumaba mula sa langit. At katulad rin sa iba pang mga parokya sa iba't-ibang lugar. Hindi rin matatawaran ang mga pagtulong ng mga mamamayan ng San Juan sa kanilang kontribusyon sa pagtatatag at pangangalaga ng naturang simbahan, kabilang rito ay ang Pamilya Cruz, sa pangunguna ng namayapa nang si Doña Lourdes Lontoc-Cruz. Ang kanilang pamilya ay naging tagapagtangkilik ng Parokya sa mahabang panahon at hanggang sa kasalukuyan at panalangin ng buong sambayanan at mga mananampalataya ng Parokya ni San Juan Bautista. Marami pa sanang katulad nila ang ipanganak sa ating bayan at maging bukas ang puso at isipan sa pagtulong at pagpapaunlad ng pagsamba sa ating Panginoon, ang Diyos ng walang hanggan.</p>
                </div>
                <div id="fourthInfo">
                    <p class="info4th">Matapos ang maraming paring naglingkod, kasalukuyang Kura Paroko si Rdo. P. Melchor R. Ignacio, na siya ring CSA President ng Diocese of Malolos. Sa kanyang panunungkulan, sinimulan niya ang malaking pagbabago at pagsasaayos ng bahay dalanginan, ang kaniyang pinakamalaking proyekto sa kasalukuyan. Pagkatapos ng pagkukumpuni sa mga nasira na bubong at pasilidad sa pangunahing gusaling sambahan, ang pag papaganda ng parokya lalo na ang altar na pinag gaganapan ng banal na misa at pag papayos ng choir loft ay naisakatuparan.</p>
                </div>
                <div id="logosDiv" class="d-flex">
                    <div class="logoContainer">
                        <div id="logo1st">
                            <p class="label">The Official Logo of</p>
                            <p class="label">Parokya ng San Bautista</p>
                            <img src="../Images/logo1.png" id="logo1" class="logos">
                        </div>
                        <div id="logo3rd">
                            <p class="label">The Church Marker</p>
                            <img src="../Images/logo3.png" id="logo3" class="logos">
                        </div>
                    </div>
                    <div class="logoContainer">
                        <div id="logo2nd">
                            <p class="label">The Official Logo of</p>
                            <p class="label">Parokya ng San Bautista</p>
                            <img src="../Images/logo2.png" id="logo2" class="logos">
                        </div>
                        <div id="quickLinksSection">
                            <p class="label">Quick Links</p>
                            <a href="#" id="massScheduleLink" class="quickLinks">Mass Schedule</a>
                            <a href="userBaptism.php" id="baptismLink" class="quickLinks">Baptism</a>
                            <a href="userWedding.php" id="weddingLink" class="quickLinks">Wedding</a>
                            <a href="userFuneral.php" id="funeralLink" class="quickLinks">Funeral</a>
                            <a href="userContactUs.php" id="contactUsLink" class="quickLinks">Contact Us</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>  
    </body>
</html>