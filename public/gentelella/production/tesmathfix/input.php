<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>A Simple Page with CKEditor</title>
        <!-- Make sure the path to CKEditor is correct. -->
        <script src="ckeditor4/ckeditor.js"></script>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function getfocus()
        {
          var jwb1 = document.getElementById("jwb1");
          var jwb2 = document.getElementById("jwb2");
          var jwb3 = document.getElementById("jwb3");
          var jwb4 = document.getElementById("jwb4");
          var jwb5 = document.getElementById("jwb5");
            jwb1.style.display = "none";
            jwb2.style.display = "none";
            jwb3.style.display = "none";
            jwb4.style.display = "none";
            jwb5.style.display = "none";
        }
    function showhide(){
        var kat_soal = document.getElementById("kat_soal").value;
        var jwb1 = document.getElementById("jwb1");
        var jwb2 = document.getElementById("jwb2");
        var jwb3 = document.getElementById("jwb3");
        var jwb4 = document.getElementById("jwb4");
        var jwb5 = document.getElementById("jwb5");
        if (kat_soal == "esai"){
          jwb1.style.display = "none";
          jwb2.style.display = "none";
          jwb3.style.display = "none";
          jwb4.style.display = "none";
          jwb5.style.display = "none";
        }
        else if (kat_soal == "abc") {
          jwb1.style.display = "block";
          jwb2.style.display = "block";
          jwb3.style.display = "block";
          jwb4.style.display = "none";
          jwb5.style.display = "none";
        }
        else if (kat_soal == "abcd") {
          jwb1.style.display = "block";
          jwb2.style.display = "block";
          jwb3.style.display = "block";
          jwb4.style.display = "block";
          jwb5.style.display = "none";
        }
        else if (kat_soal == "abcde") {
          jwb1.style.display = "block";
          jwb2.style.display = "block";
          jwb3.style.display = "block";
          jwb4.style.display = "block";
          jwb5.style.display = "block";
        }
    }
  </script>
    </head>
    <body onload="getfocus();">
        <form action="simpan.php" method="post">
          <select name="kat_soal" id="kat_soal" onchange="showhide()">
                                <option value="esai" selected>Esai</option>
                                <option value="abc">Pil.ABC</option>
                                <option value="abcd">Pil.ABCD</option>
                                <option value="abcde">Pil.ABCDE</option>
          </select>
          <br>
          <textarea name="soal" id="editor_question">Soal</textarea>
          <textarea name="jwb_benar" id="editor_question0">Jawaban Benar</textarea>
          <div id="jwb1">
            <textarea name="jawaban1" value="" id="editor_question1">A</textarea>
          </div>
          <div id="jwb2">
            <textarea name="jawaban2" value="" id="editor_question2">B</textarea>
          </div>
          <div id="jwb3">
            <textarea name="jawaban3" value="" id="editor_question3">C</textarea>
          </div>
          <div id="jwb4">
            <textarea name="jawaban4" value="" id="editor_question4">D</textarea>
          </div>
          <div id="jwb5">
            <textarea name="jawaban5" value="" id="editor_question5">E</textarea>
          </div>
            <input type="submit" name="simpan" value="Simpan">
            <br>
        </form>


          <script>
              CKEDITOR.config.toolbar_Full =
                  [
                  { name: 'document', items : [ 'Source'] },
                  { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
                  { name: 'editing', items : [ 'Find'] },
                  { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
                  { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
                  ];
              CKEDITOR.config.height = '40px';
              CKEDITOR.plugins.addExternal('divarea', '../examples/extraplugins/divarea/', 'plugin.js');
              CKEDITOR.config.removePlugins = 'maximize';
              CKEDITOR.config.removePlugins = 'resize';
              CKEDITOR.replace('editor_question', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question0', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question1', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question2', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question3', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question4', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question5', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
          </script>
    </body>
</html>
