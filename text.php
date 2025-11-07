<?php
// ========================================================
// text.php  — Variables globales del sitio (orden correcto)
// ========================================================

// Página actual
$full_name = $_SERVER['PHP_SELF'];
$name_array = explode('/', $full_name);
$count = count($name_array);
$page_name = $name_array[$count - 1];

// Sufijo del título (opcional, por si lo usas en otro lado)
if ($page_name == 'index.php')         { $namepage = "| Home"; }
elseif ($page_name == 'about.php')     { $namepage = "| About"; }
elseif ($page_name == 'services.php')  { $namepage = "| Services"; }
elseif ($page_name == 'gallery.php')   { $namepage = "| Gallery"; }
elseif ($page_name == 'youtube.php')   { $namepage = "| Youtube"; } // <-- NUEVO
elseif ($page_name == 'testimonials.php'){ $namepage = "| Testimonials"; }
elseif ($page_name == '404.php')       { $namepage = "| Not Found"; }
elseif ($page_name == 'contact.php')   { $namepage = "| Contact Us"; }
else                                   { $namepage = ""; }

// -------------------------
// Info de la compañía
// -------------------------
$MAVEN   = "www.go-maven-marketing.com";
$Company = "ALCAR All Services Corp";             // <-- Definido ANTES de usarse
$Domain  = 'alcarallservices.com';
$Address = 'Tampa,FL 33612';

// Teléfonos
$Phone        = '(239) 789-5187';
$PhoneConvert = str_replace(str_split('(-)/:*?"<>|\'	'."\t\n\r".'Ofice'), '', $Phone);
$PhoneRef     = "tel:" . str_replace(' ', '', $PhoneConvert);

$SEOConvert   = str_replace(' ', '-', $PhoneConvert);
$SEOPhone     = '+1' . $SEOConvert;

// Correo
$Mail    = 'office@alcarllservices.com';
$MailRef = "mailto:" . $Mail;

// Mensajes/etiquetas
$Services   = "Residential and Commercial Services";
$Estimates  = "Free Estimates Are Available";
$Payment    = "Check and Cash";
$Experience = "8 Years of Experience";
$Schedule   = "Monday to Saturday 6:00AM – 6:00PM";
$Cover      = "We Cover 50 Miles";

// Mostrar horario en header
$HeaderTime = $Schedule; // <-- Evita 'Undefined variable $HeaderTime'

// Redes / enlaces
$thumbtack = 'https://www.thumbtack.com/fl/tampa/handyman/alcar-all-services-corp/service/470691763606429721';
$instagram = 'https://www.instagram.com/alcarestoration';
$google    = 'https://g.co/kgs/GmQaMTb';
$facebook  = "https://www.facebook.com/alcarallservicescorp/";

// Mapa
$GoogleMap = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28169.283307386257!2d-82.4686259716642!3d28.050126237931714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c2c71810dd01a1%3A0x7b726dbb5538624c!2sTampa%2C%20FL%2033612%2C%20USA!5e0!3m2!1sen!2sni!4v1742411808731!5m2!1sen!2sni" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';

// Frases
$Phrase = array(
  "Transforming Spaces, Elevating Lives!",
  "Your Vision, Our Expertise – Building Dreams Together!",
  "Revitalize, Restore, Renew – We’re Here for You!",
  "Quality Craftsmanship Meets Unmatched Service!",
  "Where Every Project is a Promise Kept!"
);

// Home - Mission
$Home = array(
"Building a foundation of trust and excellence, ALCAR All Services Corp takes pride in
transforming homes across Tampa, FL. With over eight years of industry experience, our
talented team is dedicated to delivering quality craftsmanship and exceptional service in
every project. We understand that each client’s needs are unique, which is why we offer
personalized solutions designed specifically for you. Committed to your satisfaction, we
remain transparent throughout your journey, providing free quotes and guidance to help you
make informed decisions. Discover the difference with ALCAR, where your vision becomes
our mission!"
);

// About
$About = array(
"ALCAR All Services Corp is a dedicated provider of comprehensive home improvement
services, including remodeling and roofing. Our mission is to enhance your
living spaces while prioritizing customer satisfaction and quality results. With a team of
skilled professionals, we leverage our extensive knowledge and expertise to address a
variety of residential projects. We take pride in our attention to detail and commitment to
exceeding expectations, ensuring that every project reflects the unique style and needs of
our valued clients. Trust ALCAR for exceptional service and lasting results in Tampa, FL!"
);

// -------------------------
// Services
// -------------------------
$SN = $SD = array();

$SN[1] = "Remodeling";
$SD[1] = "ALCAR All Services Corp specializes in comprehensive remodeling
solutions tailored to enhance the functionality and aesthetics of your home. From kitchen
upgrades featuring cutting-edge designs and modern appliances to luxurious bathroom
renovations that offer spa-like retreats, our skilled team is committed to transforming your
dream concepts into reality. We prioritize your preferences and style, ensuring the final result
is a seamless blend of beauty and practicality that increases property value and enjoyment.";

$SN[3] = "Roofing";
$SD[3] = "Protect your home with dependable roofing solutions from ALCAR All
Services Corp. Our team of experienced professionals offers an array of roofing services,
including inspections, installations, repairs, and replacements, tailored to suit any residential
or commercial property. We prioritize high-quality materials and expert craftsmanship to
guarantee your roof withstands the elements while enhancing the curb appeal of your home.
With a focus on customer satisfaction and enduring results, you can trust us to shield your
investment for years to come.";

// Excerpt (si los usas en cards)
$ExAbout  = (strlen($About[0]) > 10) ? substr($About[0], 0, 145) . '...' : $About[0];
$ExHome   = (strlen($Home[0])  > 10) ? substr($Home[0],  0, 286) . '...' : $Home[0];
$ExSD     = array();
$ExSD[1]  = (strlen($SD[1]) > 10) ? substr($SD[1], 0, 68) . '...' : $SD[1];
$ExSD[3]  = (strlen($SD[3]) > 10) ? substr($SD[3], 0, 68) . '...' : $SD[3];
