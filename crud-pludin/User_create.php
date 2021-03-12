<?php

function User_create() {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "Usertable";

        $wpdb->insert(
                $table_name, //table
                array('id' => $id, 'name' => $name,'email'=>$email,'phone'=>$phone), //data
                array('%s', '%s','%s','%s') //data format			
        );
        $message.="User inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/crud-plugin/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New User</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <p>Three capital letters for the ID</p>
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">ID</th>
                    <td><input type="text" name="id" value="auto_increment" class="ss-field-width" disabled /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Name</th>
                    <td><input type="text" name="name" value="<?php echo $name; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Email</th>
                    <td><input type="text" name="email" value="<?php echo $email; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Phone</th>
                    <td><input type="text" name="phone" value="<?php echo $phone; ?>" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}