<?php

# Require head file
require_once './inc/head.php';

# Display all php errors
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

# Export Post Action
if (isset($_POST["action"]) && $_POST["action"] == "export_vcard") {

    $userdata = [
        'firstname'    => isset($_POST["firstname"]) ? $_POST["firstname"] : "",
        'lastname'     => isset($_POST["lastname"]) ? $_POST["lastname"] : "",
        'email'        => isset($_POST["email"]) ? $_POST["email"] : "",
        'phone'        => isset($_POST["phone"]) ? $_POST["phone"] : "",
        'website'      => isset($_POST["website"]) ? $_POST["website"] : "",
        'company'      => isset($_POST["company"]) ? $_POST["company"] : "",
        'officephone'  => isset($_POST["officephone"]) ? $_POST["officephone"] : "",
        'workposition' => isset($_POST["workposition"]) ? $_POST["workposition"] : "",
    ];
}

?>

<div class="kv-container">
    <h2>KamVCard</h2>
    <p>Export your personal & professional profile into a vCard file ( .vcf )</p>

    <form class="kv-form" method="post">
        <input type="hidden" name="action" value="export_vcard">
        <ul>
            <li>
                <label>First name : </label><br />
                <input type="text" name="firstname">
            </li>
            <li>
                <label>Last name : </label><br />
                <input type="text" name="lastname">
            </li>
            <li>
                <label>Email address : </label><br />
                <input type="text" name="email">
            </li>
            <li>
                <label>Phone number : </label><br />
                <input type="text" name="phone">
            </li>
            <li>
                <label>Website (or LinkedIn Profile): </label><br />
                <input type="text" name="website">
            </li>
            <li>
                <label>Company : </label><br />
                <input type="text" name="company">
            </li>
            <li>
                <label>Office phone : </label><br />
                <input type="text" name="officephone">
            </li>
            <li>
                <label>Work position : </label><br />
                <input type="text" name="workposition">
            </li>
            <button type="submit" class="btn-export">Export</button>
        </ul>
    </form>
</div>