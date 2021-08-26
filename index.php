<?php
session_start();
if (!$_SESSION["fb_email"] and !$_SESSION["password"]) {
  header('location: login.php');
}

include_once "config.php";


?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facebook</title>
  <link rel="shortcut icon" href="images/favicon.png">
  <!--
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      />
      -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" type="text/css" media="all" />
</head>
<body>
  <?php require_once "nav.php"; ?>

  <!-- Hero Section -->
  <section class="hero-section">
    <p></p>
    <h1 class="wow">Best graphics designer contest</h1>
    <a class="start-btn wow" href="#get-started">Get Started</a>
  </section>

  <!-- Started Section -->
  <section id="get-started" style="text-align: center;" class="start-section">
    <br></br>
  <h1 class="vote-heading">Online Voting System</h1>
  <br>
  <div class="start-wrapper">
    <div class="card wow animate_fade_left">

      <?php
      $res_bipu = mysqli_query($conn, "SELECT vote_count FROM voted_info WHERE id = 1");
      ?>

      <img src="images/bipu.png" alt="Bipu">
      <div class="card-body">
        <h2>MD Abu Saim Bipu</h2>
        <p>
          An unprofessional graphic designer of S-Osg team
          working for 8 months. Created a lot of logo of some expensive company for free.
        </p>
      </div>

      <div class="card-bottom">
        <button onclick="update_vote(1, document.getElementById('bipu-voted', this).innerText, 'bipu-voted', 'bipu-vote-btn')" id="bipu-vote-btn">Vote - <span id="bipu-voted">
          <?php
          while ($result_bipu = mysqli_fetch_array($res_bipu)) {
            echo $result_bipu["vote_count"];
          }
          ?>
        </span></button>

        <button onclick="openComments('bipu-comment-wrapper')"><i class="fas fa-comments"></i> - <span id="comment-number-bipu">
          <?php
          $sql_bipu = mysqli_query($conn, "SELECT comments FROM comments WHERE designer_id = '1'");
          $row_bipu = mysqli_num_rows($sql_bipu);
          echo $row_bipu;
          ?>
        </span></button>
      </div>

    </div>

    <br><br>

    <div class="card wow animate_backInRight">

      <?php
      $res_aslam = mysqli_query($conn, "SELECT vote_count FROM voted_info WHERE id = 2");
  
      ?>

      <img src="images/aslam.png" alt="Bipu">
      <div class="card-body">
        <h2>MD Atiq Aslam</h2>
        <p>
          A designer of Pakistan,
          working for paki.gd for 1 year.
          Md of their team. Completed many tasks with his own hands.
        </p>
      </div>

      <div class="card-bottom">
        <button onclick="update_vote(2, document.getElementById('aslam-voted').innerText, 'aslam-voted', 'aslam-vote-btn')" id="aslam-vote-btn">Vote - <span id="aslam-voted"><?php
          while ($result_aslam = mysqli_fetch_array($res_aslam)) {
            echo $result_aslam["vote_count"];
          }
          ?></span></button>

        <button id="aslam-btn" onclick="openComments('aslam-comment-wrapper')"><i class="fas fa-comments"></i> - <span id="comment-number-aslam">
          <?php
          $res = mysqli_query($conn, "SELECT comments FROM comments WHERE designer_id = '2'");
          $row_aslam = mysqli_num_rows($res);
          echo $row_aslam;
          ?>
        </span></button>
      </div>

    </div>
  </div>
</section>


<div id="bipu-comment-wrapper" class="comments-container">
  <span class="comment-close" onclick="closeComments('bipu-comment-wrapper')">&times;</span>
  <div id="comment-box">
    <div class="comments-wrapper">
      <div class="comment-header">
        MD Abu Saim Bipu
      </div>
      <div id="comment-body-bipu" class="comment-body">
        <?php
        if ($row_bipu > 0) {
          while ($comment_bipu = mysqli_fetch_assoc($sql_bipu)) {
            $comm_bipu = $comment_bipu['comments'];
            echo '
              <div class="comment">
          ' . $comm_bipu . '
        </div>
              ';
          }
        }
        ?>
      </div>
    </div>
    <div class="comment-input">
      <span>Write a comment...</span>
      <div class="d-flex">
        <p id="comment-bipu" contenteditable="true">

        </p>
        <button onclick="comment_action('1', 'comment-bipu', 'comment-body-bipu',<?php echo $row_bipu; ?>, 'comment-number-bipu'); "><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
</div>

<div id="aslam-comment-wrapper" class="comments-container">
  <span onclick="closeComments('aslam-comment-wrapper')" class="comment-close">&times;</span>
  <div id="comment-box">
    <div class="comments-wrapper">
      <div class="comment-header">
        MD Atiq Aslam
      </div>
      <div id="comment-body-aslam" class="comment-body">
        <?php
        if ($row_aslam > 0) {
          while ($comment_row = mysqli_fetch_assoc($res)) {
            $comm = $comment_row['comments'];
            echo '
              <div class="comment">
          ' . $comm . '
        </div>
              ';
          }
        }
        ?>
      </div>
    </div>
    <div class="comment-input">
      <span>Write a comment...</span>
      <div class="d-flex">
        <p id="comment-aslam" contenteditable="true">

        </p>
        <button onclick="comment_action('2', 'comment-aslam', 'comment-body-aslam',<?php echo $row_aslam; ?>, 'comment-number-aslam')" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
</div>

<br><br>
</div>

<?php require_once("footer.php"); ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>


<script type="text/javascript">
function update_vote(designer_id, vote, span_id, btn) {

document.getElementById(btn).classList.add('after-vote');

let xhttp = new XMLHttpRequest();
xhttp.onload = function () {
if (this.readyState == 4 && this.status == 200) {
document.getElementById(span_id).innerHTML = this.responseText;
}
};
xhttp.open("GET", "vote_update.php?user_id=" + designer_id + "&vote=" + vote, true);

xhttp.send();

}

function openComments(id) {
document.getElementById(id).style.transform = "scaleY(1)";
}

function closeComments(id) {
document.getElementById(id).style.transform = "scaleY(0)";
}

function comment_action(designerId, commId, commBody, comment_row_number, comment_show_id) {

let comm = document.getElementById(commId).innerHTML;

if (comm.length > 0) {

let xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function () {
if (this.readyState == 4 && this.status == 200) {
document.getElementById(commBody).innerHTML += '<br><div class="comment">'+ this.responseText + '</div>';
el.innerHTML = "";

document.getElementById(comment_show_id).innerText = comment_row_number + 1;

}
};

xmlhttp.open("GET", "comment_action.php?designerId=" + designerId + "&comment=" + comm, true);
xmlhttp.send();

}

var el = document.getElementById(commId);
const selection = window.getSelection();
const range = document.createRange();
selection.removeAllRanges();
range.selectNodeContents(el);
range.collapse(false);
selection.addRange(range);
el.focus();

}
new WOW().init();
</script>

</body>
</html>