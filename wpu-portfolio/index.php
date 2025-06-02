<?php
function get_CURL($url)
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($curl);
  curl_close($curl);
  
  return json_decode($result, true);
}

$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UC1ej-C9siBqnhHSHbsf1y_g&key=AIzaSyBaIJIHdaiT57WH7vP_cq9mSUv1VHAWVm0');

$youtubeProfilPic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['subscriberCount'];

//instagram API
$clientID = "17841475095108160";
$accessToken = "IGAAPCZBZBcSWBBBZAE9TcHMyWHdrM1E1UWpuNFMxYjJvMHpCeXFaUXI4T0pBb2ZApLXRfdEFGZAkg0WGd0VVNadjFBOGRMUTV3M0tnbjdpYkF4bzZAiRG5CS0xtUldWcVAzaHZAUNzgwSFA0Y0ZAJb096eGV1MFo0LVY1R0dzaTcwcHdYawZDZD";

$result2 = get_Curl("https://graph.instagram.com/v22.0/me?fields=username,profile_picture_url,followers_count&access_token=IGAAPCZBZBcSWBBBZAE9TcHMyWHdrM1E1UWpuNFMxYjJvMHpCeXFaUXI4T0pBb2ZApLXRfdEFGZAkg0WGd0VVNadjFBOGRMUTV3M0tnbjdpYkF4bzZAiRG5CS0xtUldWcVAzaHZAUNzgwSFA0Y0ZAJb096eGV1MFo0LVY1R0dzaTcwcHdYawZDZD");

$usernameIG = $result2['username'];
$profilePictureIG = $result2['profile_picture_url'];
$followersIG = $result2['followers_count'];

//ig post
$result = get_CURL('https://graph.instagram.com/me/media?fields=id,media_type,media_url&access_token=IGAAPCZBZBcSWBBBZAE9TcHMyWHdrM1E1UWpuNFMxYjJvMHpCeXFaUXI4T0pBb2ZApLXRfdEFGZAkg0WGd0VVNadjFBOGRMUTV3M0tnbjdpYkF4bzZAiRG5CS0xtUldWcVAzaHZAUNzgwSFA0Y0ZAJb096eGV1MFo0LVY1R0dzaTcwcHdYawZDZD');

$photos = [];

if (isset($result['data']) && is_array($result['data'])) {
    foreach ($result['data'] as $media) {
        // Filter media_type image
        if ($media['media_type'] == 'IMAGE' || $media['media_type'] == 'CAROUSEL_ALBUM') {
            $photos[] = $media['media_url'];
        }
    }
} else {
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}


//latest video
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyBaIJIHdaiT57WH7vP_cq9mSUv1VHAWVm0&channelId=UC1ej-C9siBqnhHSHbsf1y_g&maxResults=1&order=date&part=snippet';
$result = get_CURL($urlLatestVideo);
$latestVideoId = $result['items'][0]['id']['videoId'];


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>My Portfolio</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#home">Siti Aisyah Denia Putri</a>
      </div>
    </nav>


    <div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
          <img src="img/WhatsApp.jpg" class="rounded-circle img-thumbnail">
          <h1 class="display-4">SITI AISYAH DENIA PUTRI</h1>
          <h3 class="lead">Nim : 2217020045 | Sitem Informasi</h3>
        </div>
      </div>
    </div>


    <!-- Sosial Media -->
     <section class="social" id="social">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Sosial Media</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="row mt-3 pb-3">
              <div class="col-md-4">
                <img src="<?= $youtubeProfilPic; ?>" width="200" class="rounded-circle img-thumbnail">
              </div>
              <div class="col-md-8">
                <h5><?= $channelName; ?></h5>
                <p><?= $subscriber ; ?> Subscriber. </p>
                <div class="g-ytsubscribe" data-channelid="UC1ej-C9siBqnhHSHbsf1y_g" data-layout="default" data-count="default"></div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $latestVideoId; ?>" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4 ">
                <img src="<?=$profilePictureIG; ?>" width="200" class="rounded-circle img-thumbnail">
              </div>
              <div class="col-md-8">
                  <h5><?=$usernameIG; ?></h5>
                  <p><?=$followersIG; ?> Followers</p>
              </div>
            </div>

            <div class="row mt-3 pb-3">
              <div class="col">
                <?php foreach ($photos as $photo) : ?>
                <div class="ig-thumbnail">
                  <img src="<?=$photo; ?>">
                </div>
                <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
     </section>
  


    <!-- Portfolio -->
    <section class="portfolio bg-light" id="portfolio">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Portfolio</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="https://cdn-sekolah.annibuku.com/10307624/2.jpg" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Alumni Dari SDN 05 Koto Tangah.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="https://cdn-sekolah.annibuku.com/10302393/1.jpg" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Alumni Dari SMPN 01 Tanjung Emas.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQLWoRF6F5U9anCraFXOOXhdD88ZPlpGUrEw&s" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Alumni Dari SMAN 1 Padang Ganting.</p>
              </div>
            </div>
          </div>   
        </div>

        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="https://uinib.ac.id/2022/wp-content/uploads/2022/07/bg-login.jpg" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Mahasiswa Prodi Sistem Informasi, Fakultas Sains dan Teknologi, Universitas Islam Negeri Imam Bonjol Padang.</p>
              </div>
            </div>
          </div> 
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="https://cdn1-production-images-kly.akamaized.net/Mbgr_4AE0eW7RbvXXm5c0xDl_00=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3448531/original/075666300_1620194587-WhatsApp_Image_2021-05-05_at_12.01.55__3_.jpeg" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Tinggal dan Lahir di Kota Batusangkar.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact -->
    <section class="contact" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>Location</h3></li>
              <li class="list-group-item">My Home</li>
              <li class="list-group-item">Saruaso, Kec. Tj. Emas, Kabupaten Tanah Datar, Sumatera Barat</li>
              <li class="list-group-item">West Sumatera, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">
            
            <form>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2025.</p>
          </div>
        </div>
      </div>
    </footer>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
  </body>
</html>