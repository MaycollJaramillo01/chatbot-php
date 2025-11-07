<?php
// youtube.php
include('header2.php');

/* ================================
   CONFIGURACIÓN
   ================================ */
$YouTubeChannelID = 'UCi_F__2NTQrpidAkxAL3YwA'; // <-- PON AQUÍ EL CHANNEL ID (UC…)
$MAX_VIDEOS       = 5;

/* ================================
   Helpers: GET con cURL o fopen
   ================================ */
function http_get($url){
    if(function_exists('curl_init')){
        $ch=curl_init($url);
        curl_setopt_array($ch,[
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_FOLLOWLOCATION=>true,
            CURLOPT_CONNECTTIMEOUT=>10,
            CURLOPT_TIMEOUT=>15,
            CURLOPT_USERAGENT=>'Mozilla/5.0 (YouTube RSS)'
        ]);
        $data=curl_exec($ch);
        curl_close($ch);
        if($data!==false) return $data;
    }
    if(ini_get('allow_url_fopen')){
        $ctx=stream_context_create(['http'=>[
            'method'=>'GET','timeout'=>15,
            'header'=>"User-Agent: Mozilla/5.0 (YouTube RSS)\r\n"
        ]]);
        $data=@file_get_contents($url,false,$ctx);
        if($data!==false) return $data;
    }
    return false;
}

/* ================================
   Cargar RSS del canal
   ================================ */
$feedUrl = "https://www.youtube.com/feeds/videos.xml?channel_id=".urlencode($YouTubeChannelID);
$xmlStr  = http_get($feedUrl);

$videos=[];
if($xmlStr){
    $xml=@simplexml_load_string($xmlStr,null,LIBXML_NOCDATA);
    if($xml && isset($xml->entry)){
        $ns_media=$xml->getNamespaces(true)['media']??null;
        $ns_yt   =$xml->getNamespaces(true)['yt']??null;
        foreach($xml->entry as $entry){
            $vid='';
            if($ns_yt && isset($entry->children($ns_yt)->videoId)){
                $vid=(string)$entry->children($ns_yt)->videoId;
            }else{
                $link=(string)$entry->link['href'];
                if(preg_match('/v=([a-zA-Z0-9_\-]+)/',$link,$m)) $vid=$m[1];
            }
            if(!$vid) continue;
            $title=trim((string)$entry->title);
            $videos[]=[
                'id'=>$vid,
                'title'=>$title,
                'embed'=>"https://www.youtube.com/embed/$vid?rel=0"
            ];
            if(count($videos)>=$MAX_VIDEOS) break;
        }
    }
}

/* playlist de subidas para fallback/botón */
$uploadsPlaylist = (preg_match('/^UC/i',$YouTubeChannelID)) ? ('UU'.substr($YouTubeChannelID,2)) : $YouTubeChannelID;
?>

<!-- Breadcrumb -->
<div class="breadcrumb-wrapper bg-cover" style="background-image:url('assets/img/breadcrumb/about-breadcrumb.jpg');">
  <div class="container">
    <div class="page-heading">
      <h1 class="wow fadeInUp" data-wow-delay=".3s">Videos</h1>
      <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
        <li><a href="index.php">Home</a></li>
        <li><i class="fa-regular fa-chevrons-right"></i></li>
        <li>Videos</li>
      </ul>
    </div>
  </div>
</div>

<!-- Página Videos -->
<section class="section-padding" style="padding:60px 0;">
  <div class="container">

    <?php if(!empty($videos)){ ?>
      <div class="row justify-content-center">
        <div class="col-12">
          <h2 class="text-center mb-4" style="font-size:1.9rem;font-weight:700;">Últimos videos</h2>
        </div>

        <?php foreach($videos as $v){ ?>
          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius:12px;">
              <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-top-left-radius:12px;border-top-right-radius:12px;background:#000;">
                <iframe
                  src="<?php echo htmlspecialchars($v['embed']); ?>"
                  title="<?php echo htmlspecialchars($v['title']); ?>"
                  style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;border-top-left-radius:12px;border-top-right-radius:12px;"
                  loading="lazy"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen></iframe>
              </div>
              <div class="card-body text-center">
                <h3 style="font-size:1.05rem;margin:0;"><?php echo htmlspecialchars($v['title']); ?></h3>
              </div>
            </div>
          </div>
        <?php } ?>

        <div class="col-12 text-center mt-1">
          <a class="btn btn-primary" style="padding:10px 18px;border-radius:8px;"
             target="_blank" rel="noopener"
             href="https://www.youtube.com/playlist?list=<?php echo htmlspecialchars($uploadsPlaylist); ?>">
             Ver más en YouTube
          </a>
        </div>
      </div>
    <?php } else { ?>
      <!-- Fallback si el RSS falla: embebo la playlist completa -->
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10">
          <div class="card shadow-sm border-0" style="border-radius:12px;">
            <div class="card-body p-3 p-md-4">
              <h2 class="text-center mb-3" style="font-size:1.9rem;font-weight:700;">Nuestro canal de YouTube</h2>
              <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:10px;background:#000;">
                <iframe
                  src="https://www.youtube.com/embed?listType=playlist&list=<?php echo htmlspecialchars($uploadsPlaylist); ?>&rel=0"
                  title="YouTube playlist"
                  style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;border-radius:10px;"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen></iframe>
              </div>
              <p class="text-center mt-3 mb-0" style="font-size:.95rem;color:#666;">
                No se pudo leer el RSS, mostrando la playlist de subidas.
              </p>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

  </div>
</section>

<?php include('footer.php'); ?>
