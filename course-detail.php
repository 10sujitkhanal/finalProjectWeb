<?php
	session_start();
    require('config/config.php');
    require('auth/auth.php');
    $course_id = $_GET['course_id'];
    $chapter_id = $_GET['chapter_id'];

    $course_name = mysqli_query($con,"SELECT * FROM course where id = $course_id");
    $data = mysqli_fetch_array($course_name,MYSQLI_ASSOC);

    $course = mysqli_query($con,"SELECT * FROM chapter where course_id = $course_id");
    $topic = mysqli_query($con,"SELECT * FROM topic where chapter_id = $chapter_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <title>Adhyan-Course Detail</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="docs-head bg-primary" style="background-image: url('<?= $data['image'] ?>');">
        <div class="container grid">
            <div>
                <h1 class="xl"><?= $data['course_name'] ?></h1>
                <p class="lead">
                    Learn in Esay Way
                </p>
            </div>
            <img src="<?= $data['image'] ?>" width="100px" height="200px">
        </div>
    </section>

    <section class="docs-main">
      <div class="container">
        <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <center><div class="alert" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div></center>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>
      </div>

        <div class="grid">
            <div class="card bg-light p-3" style="width: 80%">
                <h3 class="my-2"><?= $data['course_name'] ?> Tutorial</h3>
                <nav>
                    <ul>
                      <?php if (mysqli_num_rows($course) > 0) { 
              while($row = mysqli_fetch_array($course)) {
          ?>
                        <li><a href="course-detail.php?course_id=<?= $course_id ?>&chapter_id=<?= $row['id'] ?>"><?= $row['chapter_name'] ?></a></li>
                        <?php
              }
          }
          ?>
                    </ul>
                </nav>
            </div>
            <div class="card" style="width: 100%; margin-left:-70px;">
                <?php if (mysqli_num_rows($topic) > 0) { 
            while($row = mysqli_fetch_array($topic)) {
        ?>

        <?= $row['detail'] ?>

        <?php } }?>


        </div>
        <div class="card bg-light p-3" style="margin-left:-70px;width: 100%">
                <?php if($_SESSION['user_type'] == 1){?>
                  <button id="chapter" class="btn btn-primary">Add Chapter</button> <button id="topic" class="btn btn-primary">Add Topic</button><br>
                <?php }?>
                <br><h3><b><?= $data['course_name'] ?> Detail</b></h3>
                <?= $data['course_detail'] ?>
            </div>
      </div>
    </section>
    
<?php include 'footer.php'; ?> 
</body>
</html>


    <link rel="stylesheet" type="text/css" href="custom.css">
    <script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>




  <div id="chapter_insert" class="modal-overlay">
    <div class="modal-content">
      <div class="modal-header">
          <span class="closeBtn"> X</span>
          <h2>Header</h2>
      </div>
      <div class="modal-body">
        <form method="post" action="chapter_insert.php" id="chapter_insert_form">
		Chapter Name:<br>
		<input type="text" name="chapter_name">
		<input type="hidden" name="course_id" value="<?= $course_id ?>">
		<br>
		Detail:<br>
		<textarea class="ckeditor" name="chapter_content"></textarea>
		<br>
		<input type="submit" name="save" value="submit" id="chapter_create">
	</form>
	<script type="text/javascript">
	document.getElementById("chapter_create").addEventListener("click", function () {
		var form = document.getElementById("chapter_insert_form");
		var chapter_name = document.getElementById("chapter_name").value;
		var course_id = document.getElementById("course_id").value;
		var chapter_content = document.getElementById("chapter_content").value;
  		if(chapter_name == '' || chapter_content == '' || course_id == ''){
  			alert("Field Required");
  		}
  		else{
  			form.submit();
  		}
	});
  </script>

      </div>
    </div>
  </div>



  <div id="topic_insert" class="modal-overlay">
    <div class="modal-content">
      <div class="modal-header">
          <span class="closeBtn"> X</span>
          <h2>Header</h2>
      </div>
      <div class="modal-body">
        <form method="post" action="topic_insert.php" id="topic_insert_form">
          <input type="hidden" name="course_id" value="<?= $course_id ?>">
		<input type="hidden" name="chapter_id" value="<?= $chapter_id ?>">
		<br>
		Topic Detail:<br>
		<textarea class="ckeditor" name="detail"></textarea>
		<br>
		<input type="submit" name="save" value="submit" id="topic_create">
	</form>
	<script type="text/javascript">
	document.getElementById("topic_create").addEventListener("click", function () {
		var form = document.getElementById("topic_insert_form");
		var chapter_id = document.getElementById("chapter_id").value;
		var detail = document.getElementById("detail").value;
  		if(chapter_id == '' || detail == ''){
  			alert("Field Required");
  		}
  		else{
  			form.submit();
  		}
	});
  </script>

      </div>
    </div>
  </div>


<script type="text/javascript">
var modal2 = document.getElementById('chapter_insert');
var modalBtn2 = document.getElementById('chapter');
var closeBtn2 = document.getElementsByClassName('closeBtn')[0];

modalBtn2.addEventListener('click', openModal);
closeBtn2.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);

function openModal(){
  modal2.style.display = 'block';
}

function closeModal(){
  modal2.style.display = 'none';
}

function outsideClick(e){
  if(e.target == modal){
    modal2.style.display = 'none';
  }
}
</script>


<script type="text/javascript">
var modal3 = document.getElementById('topic_insert');
var modalBtn3 = document.getElementById('topic');
var closeBtn3 = document.getElementsByClassName('closeBtn')[1];

modalBtn3.addEventListener('click', openModal);
closeBtn3.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);

function openModal(){
  modal3.style.display = 'block';
}

function closeModal(){
  modal3.style.display = 'none';
}

function outsideClick(e){
  if(e.target == modal){
    modal3.style.display = 'none';
  }
}
</script>






</body>

</html>