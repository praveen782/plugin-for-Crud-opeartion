<?php

function User_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "Usertable";
    $id = $_GET["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array('name' => $name,'email'=>$email,'phone'=>$phone), //data
                array('ID' => $id), //where
                array('%s','%s','%s'), //data format
                array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $users = $wpdb->get_results($wpdb->prepare("SELECT id,name,email,phone from $table_name where id=%s", $id));
        foreach ($users as $u) {
            $name = $u->name;
            $email =$u->email;
            $phone =$u->phone;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/crud-plugin/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Users</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>User deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=User_list') ?>">&laquo; Back to Users list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>User updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=User_list') ?>">&laquo; Back to Users list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr>
                        <th>Name</th>
                        <td><input type="text" name="name" value="<?php echo $name; ?>"/></td>
                        <td><input type="text" name="email" value="<?php echo $email; ?>"/></td>
                        <td><input type="text" name="phone" value="<?php echo $phone; ?>"/></td>
                    </tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure want to delete?')">
            </form>
        <?php } ?>

    </div>
    <?php
}