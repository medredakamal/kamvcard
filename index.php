<?php require_once './inc/head.php';
?>

<div class='kv-container'>
    <h2>KamVCard</h2>
    <p>Export your personal & professional profile into a vCard file ( .vcf )</p>

    <form class="kv-form" method="post">
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