<?php

# Require composer autoload & packages
require_once './vendor/autoload.php';
require_once './vendor/jeroendesloovere/vcard/src/VCard.php';

# Use VCard Class
use JeroenDesloovere\VCard\VCard;

# Display all php errors
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

function exportvCard($data, $image)
{
    # Init vCard instance
    $uservcard = new VCard();

    # vCard Data
    $uservcard->addName($data["firstname"], $data["lastname"]);
    $uservcard->addEmail($data["email"]);
    $uservcard->addPhoneNumber($data["phone"], 'PREF;WORK');
    $uservcard->addURL($data["website"]);
    $uservcard->addCompany($data["company"]);
    $uservcard->addPhoneNumber($data["officephone"], 'WORK');
    $uservcard->addJobtitle($data["workposition"]);

    # If vcard with image, then add photo
    if (isset($image)) {
        $uservcard->addPhoto("./" . $image);
    }

    # Set Filename
    $uservcard->setFileName("vcard");

    # Download vCard
    $uservcard->download();

    # After downloading vCard, remove the image
    if (isset($image)) {
        unlink("./" . $image);
    }
}

# Export Post Action
if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["action"]) && $_POST["action"] == "export_vcard") {
        # Get user data
        $userdata = [
            'firstname'    => isset($_POST["firstname"]) ? $_POST["firstname"] : "",
            'lastname'     => isset($_POST["lastname"]) ? $_POST["lastname"] : "",
            'email'        => isset($_POST["email"]) ? $_POST["email"] : "",
            'phone'        => isset($_POST["phone"]) ? $_POST["phone"] : "",
            'website'      => isset($_POST["website"]) ? $_POST["website"] : "",
            'company'      => isset($_POST["company"]) ? $_POST["company"] : "",
            'officephone'  => isset($_POST["officephone"]) ? $_POST["officephone"] : "",
            'workposition' => isset($_POST["workposition"]) ? $_POST["workposition"] : ""
        ];

        # Image processing
        if (!empty($_FILES["profilepicture"]["name"])) {
            $img_status = false;
            $img_msg = "";

            $img_dir = "images/";
            $img_file = $img_dir . basename($_FILES["profilepicture"]["name"]);
            $img_ext = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));
            $img_size = getimagesize($_FILES["profilepicture"]["tmp_name"]);

            # If image
            if ($img_size !== false) {
                $img_status = true;
            } else {
                $img_msg = "Invalid image !";
                $img_status = false;
                echo $img_msg;
            }

            # Image file type
            if ($img_ext !== "jpg") {
                $img_msg = "File type not allowed, use jpg,jpeg,png";
                $img_status = false;
                echo $img_msg;
            }

            # Upload image
            if ($img_status == false) {
                $img_msg = "Cannot upload image , try again.";
                echo $img_msg;
            } else {
                if (move_uploaded_file($_FILES["profilepicture"]["tmp_name"], $img_file)) {
                    $img_msg = "Image uploaded successfully !";
                    echo $img_msg;
                } else {
                    $img_msg = "Sorry, there was an error uploading your image.";
                    echo $img_msg;
                }
            }

            # Export vcard with image
            exportvCard($userdata, $img_file);
        } else {
            # Export vcard without image
            exportvCard($userdata, null);
        }
    }
}


# Require head file (repositioned here to prevent being inserted on vCard)
require_once './inc/head.php';

?>

<div class="kv-container">
    <h2>KamVCard</h2>
    <p>Export your personal & professional profile into a vCard file ( .vcf )</p>

    <form class="kv-form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="export_vcard">
        <ul>
            <li>
                <label>First name : </label><br />
                <input type="text" name="firstname" autocomplete="new-firstname">
            </li>
            <li>
                <label>Last name : </label><br />
                <input type="text" name="lastname" autocomplete="new-lastname">
            </li>
            <li>
                <label>Email address : </label><br />
                <input type="text" name="email" autocomplete="new-email">
            </li>
            <li>
                <label>Phone number : </label><br />
                <input type="text" name="phone" autocomplete="new-phone">
            </li>
            <li>
                <label>Website (or LinkedIn Profile): </label><br />
                <input type="text" name="website" autocomplete="new-website">
            </li>
            <li>
                <label>Company : </label><br />
                <input type="text" name="company" autocomplete="new-company">
            </li>
            <li>
                <label>Office phone : </label><br />
                <input type="text" name="officephone" autocomplete="new-officephone">
            </li>
            <li>
                <label>Work position : </label><br />
                <input type="text" name="workposition" autocomplete="new-workposition">
            </li>
            <li class="kv-profilepicture">
                <label>Profile picture : </label><br />
                <input type="file" name="profilepicture" autocomplete="new-profilepicture">
            </li>
            <button type="submit" class="btn-export">Export</button>
        </ul>
    </form>
</div>

<!-- # FIX: Prevent sending form after page reload -->
<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>