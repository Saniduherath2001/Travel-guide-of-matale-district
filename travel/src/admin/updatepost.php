<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);

    $sql = "SELECT * FROM post WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $category = $row['category'];
        $content = $row['content'];
       

        $isUpdate = true;
    } else {
        echo "Post not found.";
        exit;
    }

    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']);
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    // Check for image upload
    if (isset($_FILES['upload_file']) && $_FILES['upload_file']['name'] !== '') {
        $image = $_FILES['upload_file']['name'];
        $image_temp = $_FILES['upload_file']['tmp_name'];
        $imagelocation = '../images/' . $image;

        // Debugging: Check if file upload is successful
        if (move_uploaded_file($image_temp, $imagelocation)) {
            $imagepath = $image;

            $sql = "UPDATE post SET title = ?, category = ?, content = ?, imagepath = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ssssi', $title, $category, $content, $imagepath, $post_id);
        } else {
            echo "Failed to upload image.";
            exit;
        }
    } else {
        $sql = "UPDATE post SET title = ?, category = ?, content = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sssi', $title, $category, $content, $post_id);
    }

    if ($stmt->execute()) {
        header('Location: viewposts.php?status=success');
        exit;
    } else {
        echo "Error updating post: " . $stmt->error;
    }

    $stmt->close();
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
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
>
</head>
<body class="bg-[#000000]">
    <div class="py-[4%] px-[10%] md:px-[2%] md:py-[1%]">
        <?php if (isset($isUpdate) && $isUpdate) { ?>
            <h1 class="text-4xl text-white font-bold text-center uppercase mb-2">Update Post</h1>
            <form action="updatepost.php" method="post" enctype="multipart/form-data" class="py-[4%] px-[10%] md:px-[2%] md:py-[1%]">
                <div class="flex flex-col rounded bg-[#0a0a0a] shadow-xl overflow-hidden p-5 lg:p-6 grow w-full">
                    <div class="sm:p-5 lg:px-10 lg:py-8 space-y-6">
                        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
                        <div class="left_come space-y-1">
                            <label for="title" class="text-lg text-white capitalize">Post Title:</label>
                            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required class="block focus:border-blue-600 focus:outline-none focus:ring-0 text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none">
                        </div>
                        <div class="right_come space-y-1">
                            <label for="category" class="text-lg text-white capitalize">Post Category:</label>
                            <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($category); ?>" required class="block focus:border-blue-600 focus:outline-none focus:ring-0 text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none">
                        </div>
                        <div class="left_come space-y-1">
                            <label for="content" class="text-lg text-white capitalize">Post Content:</label>
                            <textarea id="content" name="content" rows="5" required class="peer block w-full appearance-none border-0 border-b border-[#292929] bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-600 focus:outline-none focus:ring-0"><?php echo htmlspecialchars($content); ?></textarea>
                        </div>
                        <div class="right_come space-y-1">
                            <label for="upload" class="text-lg text-white capitalize">Upload Image:</label>
                            <input type="file" id="upload" name="upload_file" accept="image/*" class="focus:border-blue-600 focus:outline-none focus:ring-0 block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none">
                        </div>
                        <button type="submit" class="buttonhover mt-4 bg-blue-600 text-white py-2 px-4 rounded">Update Post</button>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</body>
</html>
