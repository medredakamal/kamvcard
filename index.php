<?php require_once './inc/head.php';
?>

<div class='kv-container'>
    <h2>KamVCard</h2>
    <p>Export your personal & professional files into a vCard file ( .vcf )</p>

    <form class="kv-form" method="post">
        <ul>
            <li>
                <label>First name : </label>
                <input type=" text" name="firstname">
            </li>
            <li>
                <label>Last name : </label>
                <input type="text" name="lastname">
            </li>
            <li>
                <label>Email address : </label>
                <input type="text" name="email">
            </li>
            <li>
                <label>Phone number : </label>
                <input type="text" name="phone">
            </li>
            <li>
                <label>Website (or LinkedIn Profile): </label>
                <input type="text" name="website">
            </li>
            <li>
                <label>Company : </label>
                <input type="text" name="company">
            </li>
            <li>
                <label>Office phone : </label>
                <input type="text" name="officephone">
            </li>
            <li>
                <label>Work position : </label>
                <input type="text" name="workposition">
            </li>
            <button type="submit" class="btn-export">Export</button>
        </ul>
    </form>
</div>