<?php
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['category']) && isset($_FILES['image'])) {

        $stmt = $db->prepare("INSERT INTO post (title, content, createdat, category, imagepath) VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)");
        $stmt->bind_param("ssss", $title, $content, $category, $inamepath);

        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        $targetDirectory = "../images/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $inamepath = $targetFile;

                if ($stmt->execute()) {
                    echo '<script>alert("Post Added Successfully...!"); window.location.href = "addpost.php?status=success";</script>';
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
            }
        }

        $stmt->close();
        $db->close();
    } else {
        echo '<script>alert("Please fill in all the required fields.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/scrollreveal"></script>
   <!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/l05ab4xjrymnz8ynzv0ksdvd8s6zohuu6t3bg7nvtgpwf3uh/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Nov 1, 2024:
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
  });
</script>

</head>

<body class="bg-[#000000]">
<div class="py-[4%] px-[10%] md:px-[2%] md:py-[1%]">
    <h1 class="text-4xl text-white font-bold text-center uppercase mb-2">Add Post</h1>
    <div class="flex flex-col rounded bg-[#0a0a0a] shadow-xl overflow-hidden">
        <div class="p-5 lg:p-6 grow w-full">
            <div class="sm:p-5 lg:px-10 lg:py-8">
                <form action="" method="post" enctype="multipart/form-data" class="space-y-6">
                    <div class="left_come space-y-1">
                        <label for="title" class="font-lg text-white capitalize">Post title</label>
                        <input class="block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none focus:border-blue-600 focus:outline-none focus:ring-0" type="text" id="title" name="title" required placeholder="Enter title">
                    </div>
                    <div class="right_come space-y-1">
                        <label for="category" class="font-lg text-white capitalize">Post category</label>
                        <input class="block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none focus:border-blue-600 focus:outline-none focus:ring-0" type="text" id="category" name="category" required placeholder="Enter category">
                    </div>
                    <div class="left_come space-y-1">
                        <label for="content" class="font-lg text-white capitalize">Post Content</label>
                        <textarea id="content" name="content" rows="5" class="peer block w-full appearance-none border-0 border-b border-[#292929] bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-600 focus:outline-none focus:ring-0"></textarea>
                    </div>
                    <div class="right_come space-y-1">
                        <label for="image" class="font-lg text-white capitalize">Upload image</label>
                        <input class="block focus:border-blue-600 focus:outline-none focus:ring-0 text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none" type="file" id="image" name="image" autocomplete="off" required>
                    </div>
                    <div>
                        <button type="submit" class="buttonhover outline-none border-none mt-9 left_come inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl">
                          Add Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
